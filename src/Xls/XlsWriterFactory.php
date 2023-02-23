<?php

declare(strict_types=1);

namespace DigitalCz\Exporter\Xls;

use DigitalCz\Exporter\Concern\Export;
use DigitalCz\Exporter\Writer;
use DigitalCz\Exporter\WriterFactory;

final class XlsWriterFactory implements WriterFactory
{
    public function support(string $writer): bool
    {
        return $writer === XlsWriter::NAME;
    }

    public function create(Export $export): Writer
    {
        return new XlsWriter($export);
    }
}
