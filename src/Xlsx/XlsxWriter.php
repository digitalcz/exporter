<?php

declare(strict_types=1);

namespace DigitalCz\Exporter\Xlsx;

use DigitalCz\Exporter\Excel\ExcelWriter;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\IWriter;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

final class XlsxWriter extends ExcelWriter
{
    public const NAME = 'xlsx';

    protected function createExcelWriter(Spreadsheet $spreadsheet): IWriter
    {
        return new Xlsx($spreadsheet);
    }
}
