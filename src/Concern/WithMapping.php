<?php

declare(strict_types=1);

namespace DigitalCz\Exporter\Concern;

/**
 * Allows map the result of export with
 */
interface WithMapping
{
    /**
     * @return array<mixed>
     */
    public function map(mixed $row): array;
}
