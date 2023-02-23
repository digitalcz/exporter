<?php

declare(strict_types=1);

namespace DigitalCz\Exporter\Concern;

/**
 * Default interface for Export classes
 */
interface Export
{
    /**
     * Return iterable result of rows
     *
     * @return iterable<mixed>
     */
    public function iterate(): iterable;
}
