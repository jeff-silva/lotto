<?php

namespace App\Module\Lotto\Algorithm;

class NumberAvgAlgorithm extends Algorithm
{
  public $name = 'Quantos sorteios em média cada número fica sem sair';

  public function handler()
  {
    $result = [];

    foreach ($this->numbers as $number) {
      $appearances = [];

      foreach ($this->draws as $draw) {
        if (in_array($number, $draw->result)) {
          $appearances[] = $draw->number;
        }
      }

      if (count($appearances) > 1) {
        $gaps = [];
        for ($i = 1; $i < count($appearances); $i++) {
          $gaps[] = $appearances[$i] - $appearances[$i - 1];
        }
        $average = array_sum($gaps) / count($gaps);
        $result[$number] = round($average, 1);
      } else {
        $result[$number] = null; // or perhaps a large number indicating rare
      }
    }

    $this->result = $result;
  }
}
