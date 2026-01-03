<?php

namespace App\Addon\Migrator;

use Illuminate\Support\Facades\DB;
use Symfony\Component\Finder\Finder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\ForeignKeyDefinition;

class Migrator
{
  public $table = '';
  public $depends_on = [];
  public $enabled = true;

  public function fields()
  {
    return [];
  }

  public function relations($table)
  {
    return [];
  }

  static function run()
  {
    DB::statement('SET session_replication_role = "replica";');

    $tablesDb = collect(Schema::getTables())
      ->mapWithKeys(function ($item) {
        $key = "{$item['schema']}.{$item['name']}";
        return [$key => (object) $item];
      });

    $rawMigrators = collect(
      iterator_to_array(
        (new Finder)
          ->files()
          ->in(app_path())
          ->name('*Migrator.php')
      )
    )
      ->map(function ($file) {
        $file->class = $file->getRealPath();
        $file->class = str_replace(app_path(), 'App', $file->class);
        $file->class = preg_replace('/.php$/', '', $file->class);
        $file->class = str_replace('/', '\\', $file->class);
        $file->classParams = (object) (new \ReflectionClass($file->class))->getDefaultProperties();
        return $file;
      })
      ->filter(function ($file) {
        return is_subclass_of($file->class, Migrator::class);
      })
      ->filter(function ($file) {
        return $file->classParams->enabled;
      })
      ->map(function ($file) {
        return app($file->class);
      })
      ->values()
      ->toArray();

    $migrators = collect([]);

    $loop = 0;
    while (isset($rawMigrators[0])) {
      $migrator = array_shift($rawMigrators);
      if (!$migrator) break;

      $depends_on_error = 0;
      foreach ($migrator->depends_on as $table) {
        if (!$migrators->has($table)) {
          $depends_on_error++;
        }
      }

      if ($depends_on_error == 0) {
        $migrators->put($migrator->table, $migrator);
      }

      if ($depends_on_error > 0) {
        $rawMigrators[] = $migrator;
      }

      $loop++;
      if ($loop > 50) break;
    }

    foreach ($migrators as $migrator) {
      if (!$tablesDb->get($migrator->table)) {
        Schema::create($migrator->table, function (Blueprint $table) use ($migrator) {
          foreach ($migrator->fields() as $call) {
            call_user_func($call, $table);
          }
        });
      } else {
        Schema::table($migrator->table, function (Blueprint $table) use ($migrator) {
          $fkeys = Schema::getForeignKeys($migrator->table);
          foreach ($fkeys as $fkey) {
            $table->dropForeign($fkey['name']);
            foreach ($fkey['columns'] as $column) {
              $table->dropColumn($column);
            }
          }
        });

        Schema::table($migrator->table, function (Blueprint $table) use ($migrator) {
          $fields = Schema::getColumnListing($migrator->table);

          $field_last = null;
          foreach ($migrator->fields() as $field => $call) {
            $f = call_user_func($call, $table);

            if ($field_last) {
              $f->after($field_last);
            }

            if (in_array($field, $fields)) {
              $f->change();
            }

            $field_last = $field;
          }
        });
      }
    }

    DB::statement('SET session_replication_role = "origin";');
  }
}
