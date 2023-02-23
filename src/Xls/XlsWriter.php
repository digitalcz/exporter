<?php

declare(strict_types=1);

namespace DigitalCz\Exporter\Xls;

use DigitalCz\Exporter\Excel\ExcelWriter;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\IWriter;
use PhpOffice\PhpSpreadsheet\Writer\Xls;

final class XlsWriter extends ExcelWriter
{
    public const NAME = 'xls';

    protected function createExcelWriter(Spreadsheet $spreadsheet): IWriter
    {
        return new Xls($spreadsheet);
    }
}
