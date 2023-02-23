<?php

declare(strict_types=1);

namespace DigitalCz\Exporter\Excel;

use DigitalCz\Exporter\Concern\Export;
use DigitalCz\Exporter\Writer;
use DigitalCz\Streams\StreamInterface;
use DigitalCz\Streams\StreamWrapper;
use PhpOffice\PhpSpreadsheet\Cell\AdvancedValueBinder;
use PhpOffice\PhpSpreadsheet\Cell\Cell;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\IWriter;

abstract class ExcelWriter implements Writer
{
    private readonly Export $export;
    private readonly Spreadsheet $spreadsheet;

    public function __construct(Export $export)
    {
        $this->export = $export;
        $this->spreadsheet = new Spreadsheet();
        Cell::setValueBinder(new AdvancedValueBinder());
    }

    public function write(StreamInterface $stream): void
    {
        $this->prepare();
        $this->finish($stream);
    }

    abstract protected function createExcelWriter(Spreadsheet $spreadsheet): IWriter;

    private function prepare(): void
    {
        $exporter = new WorksheetExporter($this->spreadsheet);
        $exporter->export($this->export);
    }

    private function finish(StreamInterface $stream): void
    {
        $writer = $this->createExcelWriter($this->spreadsheet);
        $writer->save(StreamWrapper::from($stream));
    }
}
