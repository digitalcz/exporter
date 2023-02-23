<?php

use DigitalCz\Exporter\Concern\Export;
use DigitalCz\Exporter\Exporter;
use DigitalCz\Streams\Stream;

require '../vendor/autoload.php';

$export = new class implements Export {
    public function iterate(): iterable
    {
        return [
            ['foo', 123],
            ['bar', 321],
            ['moo', 213],
            ['baz', 231],
        ];
    }
};

$exporter = new Exporter();
$exporter->exportInto($export, new Stream(fopen('php://output', 'wb+')), 'csv');
