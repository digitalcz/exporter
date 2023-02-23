<?php

declare(strict_types=1);

namespace DigitalCz\Exporter\Concern;

/**
 * Enables defining data types for columns
 */
interface WithDataTypes
{
    /**
     * Key is column, Value is \PhpOffice\PhpSpreadsheet\Cell\DataType const
     *
     * @return array<string, string>
     */
    public function types(): array;
}
