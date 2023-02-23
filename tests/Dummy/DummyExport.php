<?php

declare(strict_types=1);

namespace DigitalCz\Exporter\Dummy;

use DigitalCz\Exporter\Concern\Export;
use DigitalCz\Exporter\Concern\WithDataTypes;
use DigitalCz\Exporter\Concern\WithHeadings;
use PhpOffice\PhpSpreadsheet\Cell\DataType;

final class DummyExport implements Export, WithHeadings, WithDataTypes
{
    /** @inheritDoc */
    public function iterate(): iterable
    {
        return [
            ['foo', 123, '2022-01-01'],
            ['bar', 321, '2022-03-01'],
            ['moo', 213, '2022-04-01'],
            ['baz', 231, '2022-05-01'],
        ];
    }

    /** @inheritDoc */
    public function headings(): array
    {
        return ['string', 'integer', 'date'];
    }

    /** @inheritDoc */
    public function types(): array
    {
        return [
            'C' => DataType::TYPE_STRING,
        ];
    }
}
