<?php

declare(strict_types=1);

namespace DigitalCz\Exporter\Concern;

/**
 * Allows set properties for Spreadsheet
 */
interface WithProperties
{
    /**
     * @return array<string, string>
     */
    public function properties(): array;
}
