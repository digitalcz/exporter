<?php

declare(strict_types=1);

namespace DigitalCz\Exporter\Concern;

/**
 * Enables defining header row for export
 */
interface WithHeadings
{
    /**
     * The titles for header row
     *
     * @return array<string>
     */
    public function headings(): array;
}
