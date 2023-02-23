<?php

declare(strict_types=1);

namespace DigitalCz\Exporter\Csv;

use DigitalCz\Exporter\Concern\Export;
use DigitalCz\Exporter\Writer;
use DigitalCz\Exporter\WriterFactory;

final class CsvWriterFactory implements WriterFactory
{
    public function support(string $writer): bool
    {
        return $writer === CsvWriter::NAME;
    }

    public function create(Export $export): Writer
    {
        return new CsvWriter($export);
    }
}
