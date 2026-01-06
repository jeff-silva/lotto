<?php

namespace App\Module\Lotto\Algorithm;

class AllTimeHotAlgorithm extends Algorithm
{
  public $name = 'Números mais pé-quente';

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
      ->sortByDesc('total')
      ->take(10)
      ->pluck('total', 'number')
      ->all();
  }
}
