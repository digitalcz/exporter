<?php

declare(strict_types=1);

namespace DigitalCz\Exporter;

use DigitalCz\Exporter\Dummy\DummyExport;
use PhpOffice\PhpSpreadsheet\Reader\Xls;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(Exporter::class)]
class ExporterTest extends TestCase
{
    public function testCsvExport(): void
    {
        $exporter = new Exporter();
        $temp = $exporter->exportAsFile(new DummyExport(), 'csv');

        self::assertSame(
            '"string","integer","date"' . PHP_EOL .
            '"foo","123","2022-01-01"' . PHP_EOL .
            '"bar","321","2022-03-01"' . PHP_EOL .
            '"moo","213","2022-04-01"' . PHP_EOL .
            '"baz","231","2022-05-01"' . PHP_EOL,
            (string)$temp,
        );
    }

    public function testXlsxExport(): void
    {
        $exporter = new Exporter();
        $temp = $exporter->exportAsFile(new DummyExport(), 'xlsx');

        $reader = new Xlsx();
        $spreadsheet = $reader->load($temp->getPath());

        self::assertSame('string', $spreadsheet->getActiveSheet()->getCell('A1')->getValue());
        self::assertSame('integer', $spreadsheet->getActiveSheet()->getCell('B1')->getValue());
        self::assertSame('date', $spreadsheet->getActiveSheet()->getCell('C1')->getValue());
        self::assertSame('foo', $spreadsheet->getActiveSheet()->getCell('A2')->getValue());
        self::assertSame(123, $spreadsheet->getActiveSheet()->getCell('B2')->getValue());
        self::assertSame('2022-01-01', $spreadsheet->getActiveSheet()->getCell('C2')->getValue());
    }

    public function testXlsExport(): void
    {
        $exporter = new Exporter();
        $temp = $exporter->exportAsFile(new DummyExport(), 'xls');

        $reader = new Xls();
        $spreadsheet = $reader->load($temp->getPath());

        self::assertSame('string', $spreadsheet->getActiveSheet()->getCell('A1')->getValue());
        self::assertSame('integer', $spreadsheet->getActiveSheet()->getCell('B1')->getValue());
        self::assertSame('date', $spreadsheet->getActiveSheet()->getCell('C1')->getValue());
        self::assertSame('foo', $spreadsheet->getActiveSheet()->getCell('A2')->getValue());
        self::assertSame(123, $spreadsheet->getActiveSheet()->getCell('B2')->getValue());
        self::assertSame('2022-01-01', $spreadsheet->getActiveSheet()->getCell('C2')->getValue());
    }
}
