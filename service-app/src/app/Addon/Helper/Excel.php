<?php

/**
 * composer require phpoffice/phpspreadsheet
 */

namespace App\Addon\Helper;

use Illuminate\Support\Fluent;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Reader\Html;

class Excel
{
  static function fromArray(array $data = [])
  {
    $file = new Fluent([
      'name' => null,
      'mime' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
      'size' => null,
      'url' => null,
    ]);

    $data = array_map(function ($item) {
      return array_values($item);
    }, $data);

    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    $sheet->getStyle('A1:XFD1048576')->getNumberFormat()->setFormatCode('@');
    $sheet->fromArray($data, null, 'A1');
    return new Exporter($sheet, $spreadsheet);
  }

  static function fromHtml($html)
  {
    $reader = new Html();
    $spreadsheet = $reader->loadFromString($html);
    $sheet = $spreadsheet->getActiveSheet();
    $sheet->getStyle('A1:XFD1048576')->getNumberFormat()->setFormatCode('@');
    foreach ($sheet->getColumnIterator() as $column) {
      $sheet->getColumnDimension($column->getColumnIndex())->setAutoSize(true);
    }
    return new Exporter($sheet, $spreadsheet);
  }

  static function fromBase64(string $base64Url)
  {
    [, $raw] = array_values(array_filter(preg_split('/(data\:|\;base64\,)/', $base64Url)));
    $raw = base64_decode($raw);
    $data = [];

    try {
      $tempDir = sys_get_temp_dir();
      $tempFileName = tempnam($tempDir, 'phpspreadsheet_');
      $tempFilePath = $tempFileName . '.xlsx';
      rename($tempFileName, $tempFilePath);
      file_put_contents($tempFilePath, $raw);
      $spreadsheet = IOFactory::load($tempFilePath);
      $sheet = $spreadsheet->getActiveSheet();
      return new Exporter($sheet, $spreadsheet);
      // $data = $sheet->toArray();
    } catch (\Exception $e) {
    }

    return $data;
  }

  static function fromContent($raw)
  {
    try {
      $tempDir = sys_get_temp_dir();
      $tempFileName = tempnam($tempDir, 'phpspreadsheet_');
      $tempFilePath = $tempFileName . '.xlsx';
      rename($tempFileName, $tempFilePath);
      file_put_contents($tempFilePath, $raw);
      $spreadsheet = IOFactory::load($tempFilePath);
      $sheet = $spreadsheet->getActiveSheet();
      return new Exporter($sheet, $spreadsheet);
      // $data = $sheet->toArray();
    } catch (\Exception $e) {
    }
  }
}

class Exporter
{
  public function __construct(
    protected $sheet,
    protected $spreadsheet,
  ) {}

  public function toFile()
  {
    $file = new Fluent([
      'name' => null,
      'mime' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
      'size' => null,
      'url' => null,
    ]);

    $writer = new Xlsx($this->spreadsheet);

    ob_start();
    $writer->save('php://output');
    $raw = ob_get_clean();

    $file->name = $name ?? now()->format('Ymd-His');
    $file->name = pathinfo($file->name, PATHINFO_FILENAME) . '.xlsx';
    $file->size = strlen($raw);
    $file->url = "data:{$file->mime};base64," . base64_encode($raw);

    return $file;
  }

  public function toArray()
  {
    return $this->sheet->toArray();
  }
}
