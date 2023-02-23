<?php

declare(strict_types=1);

namespace DigitalCz\Exporter\Concern;

/**
 * Allows to set styles for cell or range
 */
interface WithStyles
{
    /**
     * Return array where key is coordinate/range and value is array for styles
     *
     * @return array<string, array<mixed>>
     */
    public function styles(): array;
}
