<?php

declare(strict_types=1);

namespace DigitalCz\Exporter\Xlsx;

use DigitalCz\Exporter\Concern\Export;
use DigitalCz\Exporter\Writer;
use DigitalCz\Exporter\WriterFactory;

final class XlsxWriterFactory implements WriterFactory
{
    public function support(string $writer): bool
    {
        return $writer === XlsxWriter::NAME;
    }

    public function create(Export $export): Writer
    {
        return new XlsxWriter($export);
    }
}
