<?php

namespace App\Module\Lotto\Algorithm;

class AllTimeBadAlgorithm extends Algorithm
{
  public $name = 'Números mais azarões de todos os tempos';

  public function handler()
  {
    $result = [];

    foreach ($this->draws as $draw) {
      if (is_array($draw->result)) {
        foreach ($draw->result as $nn) {
          if (!isset($result[$nn])) {
            $result[$nn] = [
              'number' => $nn,
              'total' => 0,
            ];
          }

          $result[$nn]['total']++;
        }
      }
    }

    $this->result = collect($result)
      ->sortBy('total')
      ->take(5)
      ->pluck('total', 'number')
      ->all();
  }
}
