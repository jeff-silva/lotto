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
          'drawn_at' => join('-', array_reverse(explode('/', $draw[1]))),
          'result' => [
            intval($draw[2]),
            intval($draw[3]),
            intval($draw[4]),
            intval($draw[5]),
            intval($draw[6]),
            intval($draw[7]),
          ],
        ]
      );
    }

    $this->info('Mega-Sena: Finished');
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
  }

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
  }
}
