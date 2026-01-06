<?php

namespace App\Module\Lotto\Algorithm;

class NumberAvgAlgorithm extends Algorithm
{
  public $name = 'Média de vezes que os números sairam';

  public function handler()
  {
    $result = [];

    foreach ($this->numbers as $number) {
      $result[$number] = 12;
    }

    $this->result = $result;
  }
}
