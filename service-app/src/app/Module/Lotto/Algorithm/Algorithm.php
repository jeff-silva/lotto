<?php

namespace App\Module\Lotto\Algorithm;

class Algorithm
{
  public $name = null;
  public $result = null;

  public function __construct(
    protected $draws,
    protected $numbers,
  ) {
    $this->handler();
  }

  static function make($draws, $numbers)
  {
    return app()->makeWith(static::class, [
      'draws' => $draws,
      'numbers' => $numbers,
    ]);
  }

  public function handler()
  {
    // 
  }

  static function all()
  {
    return collect(glob(__DIR__ . '/*Algorithm.php'))
      ->map(function ($file) {
        $file = pathinfo($file, PATHINFO_FILENAME);
        if ($file == 'Algorithm') return null;
        return "\App\Module\Lotto\Algorithm\\{$file}";
      })
      ->filter(fn($file) => $file)
      ->values();
  }
}
