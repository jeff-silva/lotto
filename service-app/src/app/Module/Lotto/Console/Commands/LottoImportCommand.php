<?php

namespace App\Module\Lotto\Console\Commands;

use App\Module\Lotto\Models\LottoRaffleDraw;
use App\Module\Lotto\Models\LottoRaffleType;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class LottoImportCommand extends Command
{

  protected $signature = 'lotto:import';

  protected $description = 'Import Lotto Data';

  public function handle()
  {
    $this->importMegaSena();
    $this->importLotoFacil();
    $this->importQuina();
    $this->importLotoMania();
    $this->importTimemania();
    $this->importDuplaSena();
    $this->importFederal();
    $this->importLoteca();
    $this->importDiaDeSorte();
    $this->importSuperSete();
    $this->importMaisMilionaria();
  }

  public function importRaw(array $draws, LottoRaffleType $lottoRaffleType, \Closure $result)
  {
    $head = null;
    foreach ($draws as $i => $draw) {
      if ($i == 0) {
        $head = $draw;
        continue;
      }

      $lottoRaffleDraw = LottoRaffleDraw::make();
      $lottoRaffleDraw->type_id = $lottoRaffleType->id;
      $lottoRaffleDraw->type = $lottoRaffleType->slug;
      $lottoRaffleDraw->raw = $draw;
      call_user_func($result, $lottoRaffleDraw, $draw);

      $lottoRaffleDrawNew = LottoRaffleDraw::firstOrCreate([
        'type_id' => $lottoRaffleDraw->type_id,
        'number' => $lottoRaffleDraw->number,
      ]);

      $lottoRaffleDrawNew->update($lottoRaffleDraw->toArray());
    }
  }

  protected function downloadDataCaixaGov($modalidade)
  {
    $date_now = now()->format('Y-m-d');
    $file_dir = app_path('/Module/Lotto/Import');
    $file_path = (string) Str::of(urldecode($modalidade))->ascii()->slug();
    $file_path = $file_dir . "/{$file_path}.json";

    if (file_exists($file_path)) {
      $data = file_get_contents($file_path);
      $data = json_decode($data);
      if ($data->last_import == $date_now) {
        return $data->data;
      }
    }

    $resp = "https://servicebus2.caixa.gov.br/portaldeloterias/api/resultados/download?modalidade={$modalidade}";
    $resp = Http::withoutVerifying()->get($resp);
    $draws = \App\Addon\Helper\Excel::fromContent($resp->body())->toArray();
    $heads = $draws[0];
    $keys = [];
    foreach ($heads as $head) {
      $keys[] = (string) Str::of($head)->slug()->studly()->snake();
    }

    $data = [];
    foreach ($draws as $draw) {
      $data_item = [];
      foreach ($draw as $i => $value) {
        $data_item[$keys[$i]] = $value;
      }
      $data[] = (object) $data_item;
    }

    if (!file_exists($file_dir)) {
      mkdir($file_dir, 0777);
    }

    file_put_contents($file_path, json_encode([
      'last_import' => $date_now,
      'data' => $data,
    ]));

    chmod($file_path, 0777);
    return $data;
  }

  public function importMegaSena()
  {
    $lottoRaffleType = LottoRaffleType::firstOrCreate(['slug' => 'mega-sena'], []);

    $lottoRaffleType->update([
      'name' => 'Mega-Sena',
      'color' => '#209869',
      'pool_min' => 1,
      'pool_max' => 60,
      'pool_cols' => 10,
    ]);

    $draws = $this->downloadDataCaixaGov('Mega-Sena');
    $this->info("{$lottoRaffleType->name}: Importing " . sizeof($draws) . ' rows');

    $this->importRaw($draws, $lottoRaffleType, function ($lottoRaffleDraw, $draw) {
      $lottoRaffleDraw->number = $draw->concurso;
      $lottoRaffleDraw->drawn_at = join('-', array_reverse(explode('/', $draw->data_do_sorteio)));
      $lottoRaffleDraw->result = [
        intval($draw->bola1),
        intval($draw->bola2),
        intval($draw->bola3),
        intval($draw->bola4),
        intval($draw->bola5),
        intval($draw->bola6),
      ];
    });

    $this->info("{$lottoRaffleType->name}: Finished");
  }

  public function importLotoFacil()
  {
    $lottoRaffleType = LottoRaffleType::firstOrCreate(['slug' => 'lotofacil'], []);
    $lottoRaffleType->update([
      'name' => 'Lotofácil',
      'color' => '#94028a',
      'pool_min' => 1,
      'pool_max' => 25,
      'pool_cols' => 5,
    ]);

    $draws = $this->downloadDataCaixaGov('Lotof%C3%A1cil');
    $this->info("{$lottoRaffleType->name}: Importing " . sizeof($draws) . ' rows');

    $this->importRaw($draws, $lottoRaffleType, function ($lottoRaffleDraw, $draw) {
      $lottoRaffleDraw->number = $draw->concurso;
      $lottoRaffleDraw->drawn_at = join('-', array_reverse(explode('/', $draw->data_sorteio)));
      $lottoRaffleDraw->result = [
        intval($draw->bola1),
        intval($draw->bola2),
        intval($draw->bola3),
        intval($draw->bola4),
        intval($draw->bola5),
        intval($draw->bola6),
        intval($draw->bola7),
        intval($draw->bola8),
        intval($draw->bola9),
        intval($draw->bola10),
        intval($draw->bola11),
        intval($draw->bola12),
        intval($draw->bola13),
        intval($draw->bola14),
        intval($draw->bola15),
      ];
    });

    $this->info("{$lottoRaffleType->name}: Finished");
  }

  public function importQuina()
  {
    $lottoRaffleType = LottoRaffleType::firstOrCreate(['slug' => 'quina'], []);
    $lottoRaffleType->update([
      'name' => 'Quina',
      'color' => '#260085',
      'pool_min' => 1,
      'pool_max' => 25,
      'pool_cols' => 5,
    ]);

    $draws = $this->downloadDataCaixaGov('Quina');
    $this->info("{$lottoRaffleType->name}: Importing " . sizeof($draws) . ' rows');

    $this->importRaw($draws, $lottoRaffleType, function ($lottoRaffleDraw, $draw) {
      $lottoRaffleDraw->number = $draw->concurso;
      $lottoRaffleDraw->drawn_at = join('-', array_reverse(explode('/', $draw->data_sorteio)));
      $lottoRaffleDraw->result = [
        intval($draw->bola1),
        intval($draw->bola2),
        intval($draw->bola3),
        intval($draw->bola4),
        intval($draw->bola5),
      ];
    });

    $this->info("{$lottoRaffleType->name}: Finished");
  }

  public function importLotoMania()
  {
    $lottoRaffleType = LottoRaffleType::firstOrCreate(['slug' => 'lotomania'], []);
    $lottoRaffleType->update([
      'name' => 'Lotomania',
      'color' => '#f78100',
      'pool_min' => 1,
      'pool_max' => 25,
      'pool_cols' => 5,
    ]);

    $draws = $this->downloadDataCaixaGov('Lotomania');
    $this->info("{$lottoRaffleType->name}: Importing " . sizeof($draws) . ' rows');

    $this->importRaw($draws, $lottoRaffleType, function ($lottoRaffleDraw, $draw) {
      $lottoRaffleDraw->number = $draw->concurso;
      $lottoRaffleDraw->drawn_at = join('-', array_reverse(explode('/', $draw->data_sorteio)));
      $lottoRaffleDraw->result = [
        intval($draw->bola1),
        intval($draw->bola2),
        intval($draw->bola3),
        intval($draw->bola4),
        intval($draw->bola5),
        intval($draw->bola6),
        intval($draw->bola7),
        intval($draw->bola8),
        intval($draw->bola9),
        intval($draw->bola10),
        intval($draw->bola11),
        intval($draw->bola12),
        intval($draw->bola13),
        intval($draw->bola14),
        intval($draw->bola15),
        intval($draw->bola16),
        intval($draw->bola17),
        intval($draw->bola18),
        intval($draw->bola19),
        intval($draw->bola20),
      ];
    });

    $this->info("{$lottoRaffleType->name}: Finished");
  }

  public function importTimemania()
  {
    $lottoRaffleType = LottoRaffleType::firstOrCreate(['slug' => 'timemania'], []);
    $lottoRaffleType->update([
      'name' => 'Timemania',
      'color' => '#02ff02',
      'pool_min' => 1,
      'pool_max' => 25,
      'pool_cols' => 5,
    ]);

    $draws = $this->downloadDataCaixaGov('Timemania');
    $this->info("{$lottoRaffleType->name}: Importing " . sizeof($draws) . ' rows');

    $this->importRaw($draws, $lottoRaffleType, function ($draw) {
      return [];
    });

    $this->info("{$lottoRaffleType->name}: Finished");
  }

  // Entender formato melhor
  public function importDuplaSena()
  {
    $lottoRaffleType = LottoRaffleType::firstOrCreate(['slug' => 'dupla-sena'], []);
    $lottoRaffleType->update([
      'name' => 'Dupla Sena',
      'color' => '#a61324',
      'pool_min' => 1,
      'pool_max' => 25,
      'pool_cols' => 5,
    ]);

    $draws = $this->downloadDataCaixaGov('Dupla%20Sena');
    $this->info("{$lottoRaffleType->name}: Importing " . sizeof($draws) . ' rows');

    $this->importRaw($draws, $lottoRaffleType, function ($lottoRaffleDraw, $draw) {
      $lottoRaffleDraw->number = $draw->concurso;
      $lottoRaffleDraw->drawn_at = join('-', array_reverse(explode('/', $draw->data_sorteio)));
      $lottoRaffleDraw->result = [];
    });

    $this->info("{$lottoRaffleType->name}: Finished");
  }

  public function importFederal()
  {
    $lottoRaffleType = LottoRaffleType::firstOrCreate(['slug' => 'federal'], []);
    $lottoRaffleType->update([
      'name' => 'Federal',
      'color' => '#103099',
      'pool_min' => 1,
      'pool_max' => 25,
      'pool_cols' => 5,
    ]);

    $draws = $this->downloadDataCaixaGov('Federal');
    $this->info("{$lottoRaffleType->name}: Importing " . sizeof($draws) . ' rows');

    $this->importRaw($draws, $lottoRaffleType, function ($lottoRaffleDraw, $draw) {
      $lottoRaffleDraw->number = $draw->extracao;
      $lottoRaffleDraw->drawn_at = join('-', array_reverse(explode('/', $draw->data_sorteio)));
      $lottoRaffleDraw->result = [];
    });

    $this->info("{$lottoRaffleType->name}: Finished");
  }

  public function importLoteca()
  {
    $lottoRaffleType = LottoRaffleType::firstOrCreate(['slug' => 'loteca'], []);
    $lottoRaffleType->update([
      'name' => 'Loteca',
      'color' => '#fb1f00',
      'pool_min' => 1,
      'pool_max' => 25,
      'pool_cols' => 5,
    ]);

    $draws = $this->downloadDataCaixaGov('Loteca');
    $this->info("{$lottoRaffleType->name}: Importing " . sizeof($draws) . ' rows');

    $this->importRaw($draws, $lottoRaffleType, function ($draw) {
      return [];
    });

    $this->info("{$lottoRaffleType->name}: Finished");
  }

  public function importDiaDeSorte()
  {
    $lottoRaffleType = LottoRaffleType::firstOrCreate(['slug' => 'dia-de-sorte'], []);
    $lottoRaffleType->update([
      'name' => 'Dia de Sorte',
      'color' => '#fb1f00',
      'pool_min' => 1,
      'pool_max' => 25,
      'pool_cols' => 5,
    ]);

    $draws = $this->downloadDataCaixaGov('Dia%20de%20Sorte');
    $this->info("{$lottoRaffleType->name}: Importing " . sizeof($draws) . ' rows');

    $this->importRaw($draws, $lottoRaffleType, function ($lottoRaffleDraw, $draw) {
      $lottoRaffleDraw->number = $draw->concurso;
      $lottoRaffleDraw->drawn_at = join('-', array_reverse(explode('/', $draw->data_sorteio)));
      $lottoRaffleDraw->result = [
        intval($draw->bola1),
        intval($draw->bola2),
        intval($draw->bola3),
        intval($draw->bola4),
        intval($draw->bola5),
        intval($draw->bola6),
        intval($draw->bola7),
      ];
    });

    $this->info("{$lottoRaffleType->name}: Finished");
  }

  public function importSuperSete()
  {
    $lottoRaffleType = LottoRaffleType::firstOrCreate(['slug' => 'super-sete'], []);
    $lottoRaffleType->update([
      'name' => 'Super Sete',
      'color' => '#a8cf44',
      'pool_min' => 1,
      'pool_max' => 25,
      'pool_cols' => 5,
    ]);

    $draws = $this->downloadDataCaixaGov('Super%20Sete');
    $this->info("{$lottoRaffleType->name}: Importing " . sizeof($draws) . ' rows');

    $this->importRaw($draws, $lottoRaffleType, function ($lottoRaffleDraw, $draw) {
      $lottoRaffleDraw->number = $draw->concurso;
      $lottoRaffleDraw->drawn_at = join('-', array_reverse(explode('/', $draw->data_sorteio)));
      $lottoRaffleDraw->result = [
        intval($draw->coluna1),
        intval($draw->coluna2),
        intval($draw->coluna3),
        intval($draw->coluna4),
        intval($draw->coluna5),
        intval($draw->coluna6),
        intval($draw->coluna7),
      ];
    });

    $this->info("{$lottoRaffleType->name}: Finished");
  }

  public function importMaisMilionaria()
  {
    $lottoRaffleType = LottoRaffleType::firstOrCreate(['slug' => 'mais-milionaria'], []);
    $lottoRaffleType->update([
      'name' => 'Mais Milionária',
      'color' => '#2e317a',
      'pool_min' => 1,
      'pool_max' => 25,
      'pool_cols' => 5,
    ]);

    $draws = $this->downloadDataCaixaGov('+Milion%C3%A1ria');
    $this->info("{$lottoRaffleType->name}: Importing " . sizeof($draws) . ' rows');

    $this->importRaw($draws, $lottoRaffleType, function ($lottoRaffleDraw, $draw) {
      $lottoRaffleDraw->number = $draw->concurso;
      $lottoRaffleDraw->drawn_at = join('-', array_reverse(explode('/', $draw->data_sorteio)));
      $lottoRaffleDraw->result = [
        intval($draw->bola1),
        intval($draw->bola2),
        intval($draw->bola3),
        intval($draw->bola4),
        intval($draw->bola5),
        intval($draw->bola6),
      ];
    });

    $this->info("{$lottoRaffleType->name}: Finished");
  }
}
