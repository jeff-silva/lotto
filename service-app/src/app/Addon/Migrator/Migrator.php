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
          ->in(base_path())
          ->exclude('vendor')
          ->name('*Migrator.php')
      )
    )
      ->filter(function ($file) {
        return 'Migrator' != $file->getBasename('.php');
      })
      ->map(function ($file) {
        $class = $file->getRealPath();
        $class = str_replace(app_path(), 'App', $class);
        $class = preg_replace('/.php$/', '', $class);
        $class = str_replace('/', '\\', $class);
        return app($class);
      })
      ->filter(function ($migrator) {
        return $migrator->enabled;
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
