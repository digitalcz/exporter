<?php

declare(strict_types=1);

namespace DigitalCz\Exporter\Excel;

use Generator;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

#[CoversClass(ExcelHelper::class)]
final class ExcelHelperTest extends TestCase
{
    #[DataProvider('provideForGetExcelColumn')]
    public function testGetExcelColumn(int $value, string $expected): void
    {
        $converted = ExcelHelper::mapNumberToColumn($value);

        self::assertEquals($expected, $converted);
    }

    public static function provideForGetExcelColumn(): Generator
    {
        yield [1, 'A'];
        yield [2, 'B'];
        yield [3, 'C'];
        yield [4, 'D'];
        yield [26, 'Z'];
        yield [27, 'AA'];
        yield [28, 'AB'];
        yield [52, 'AZ'];
        yield [53, 'BA'];
        yield [702, 'ZZ'];
        yield [0, ''];
        yield [-5, ''];
    }
}
