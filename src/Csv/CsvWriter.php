<?php

declare(strict_types=1);

namespace DigitalCz\Exporter\Csv;

use DigitalCz\Exporter\Excel\ExcelWriter;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Csv;
use PhpOffice\PhpSpreadsheet\Writer\IWriter;

final class CsvWriter extends ExcelWriter
{
    public const NAME = 'csv';

    protected function createExcelWriter(Spreadsheet $spreadsheet): IWriter
    {
        return new Csv($spreadsheet);
    }
}
