<?php

declare(strict_types=1);

namespace DigitalCz\Exporter;

use DigitalCz\Exporter\Concern\Export;

interface WriterFactory
{
    public function support(string $writer): bool;

    public function create(Export $export): Writer;
}
