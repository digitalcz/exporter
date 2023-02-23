<?php

declare(strict_types=1);

namespace DigitalCz\Exporter;

use DigitalCz\Streams\StreamInterface;

interface Writer
{
    public function write(StreamInterface $stream): void;
}
