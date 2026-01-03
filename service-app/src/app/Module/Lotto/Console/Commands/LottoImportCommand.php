<?php

namespace App\Module\Lotto\Console\Commands;

use App\Module\Lotto\Models\LottoRaffleDraw;
use App\Module\Lotto\Models\LottoRaffleType;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class LottoImportCommand extends Command
{

  protected $signature = 'lotto:import';

  protected $description = 'Import Lotto Data';

  public function handle()
  {
    $this->importMegaSena();
  }

  public function importMegaSena()
  {
    $lottoRaffleType = LottoRaffleType::firstOrCreate(['slug' => 'mega-sena'], []);

    $lottoRaffleType->update([
      'name' => 'Mega-Sena',
      'pool_min' => 1,
      'pool_max' => 60,
      'pool_cols' => 10,
    ]);

    $resp = 'https://servicebus2.caixa.gov.br/portaldeloterias/api/resultados/download?modalidade=Mega-Sena';
    $resp = Http::withoutVerifying()->get($resp);
    $draws = \App\Addon\Helper\Excel::fromContent($resp->body())->toArray();
    $this->info('Mega-Sena: Importing ' . sizeof($draws) . ' rows');

    foreach ($draws as $i => $draw) {
      if ($i == 0) {
        continue;
      }

      LottoRaffleDraw::firstOrCreate(
        [
          'type_id' => $lottoRaffleType->id,
          'number' => intval($draw[0]),
        ],
        [
          'date' => join('-', array_reverse(explode('/', $draw[1]))),
          'result' => json_encode([
            intval($draw[2]),
            intval($draw[3]),
            intval($draw[4]),
            intval($draw[5]),
            intval($draw[6]),
            intval($draw[7]),
          ]),
        ]
      );
    }

    $this->info('Mega-Sena: Finished');
  }
}
