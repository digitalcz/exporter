<?php

declare(strict_types=1);

namespace DigitalCz\Exporter\Concern;

/**
 * Enables defining format for cell or range of cells
 *
 * @see \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet::setSelectedCells
 */
interface WithColumnFormatting
{
    /**
     * Key is column or range, Value is \PhpOffice\PhpSpreadsheet\Style\NumberFormat constant
     *
     * @return array<string, string>
     */
    public function formats(): array;
}
