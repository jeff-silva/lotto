<?php

namespace App\Module\Lotto\Algorithm;

class TipsAlgorithm extends Algorithm
{
  public $name = 'Dicas';

  public function handler()
  {
    $result = [];
    $result = $this->numberUserLastTwoDraws($result);
    $this->result = $result;
  }

  protected function numberUserLastTwoDraws($result)
  {
    // Get the last 2 draws
    $lastTwoDraws = $this->draws->take(-2);

    $repeatedNumbers = [];

    foreach ($lastTwoDraws as $draw) {
      foreach ($this->numbers as $number) {
        if (in_array($number, $draw->result)) {
          $repeatedNumbers[] = $number;
        }
      }
    }

    // Remove duplicates
    $repeatedNumbers = array_unique($repeatedNumbers);

    if (!empty($repeatedNumbers)) {
      $numbersText = implode(', ', array_map(function ($num) {
        return str_pad($num, 2, '0', STR_PAD_LEFT);
      }, $repeatedNumbers));

      $result[] = [
        'type' => 'warning',
        'title' => 'Números Repetidos Recentemente',
        'text' => "Os números <strong>{$numbersText}</strong> saíram nos últimos 2 concursos consecutivos. Considere evitá-los para aumentar as chances de acerto.",
      ];
    }

    return $result;
  }

  // tem sena? no caso, verificar premiação maxima, se ela existe
  // protected function numberHasSena($result)
  // {
  //   // 
  // }
}
