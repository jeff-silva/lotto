<?php

namespace App\Module\Lotto\Algorithm;

class TimesDrawnAlgorithm extends Algorithm
{
  public $name = 'Quantas vezes foram sorteados?';

  public function handler()
  {
    $result = [];

    foreach ($this->numbers as $number) {
      $result[$number] = 0;
    }

    foreach ($this->draws as $draw) {
      if (is_array($draw->result)) {
        foreach ($draw->result as $nn) {
          if (isset($result[$nn])) {
            $result[$nn]++;
          }
        }
      }
    }

    $this->result = $result;
  }
}
