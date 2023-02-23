<?php

declare(strict_types=1);

namespace DigitalCz\Exporter\Excel;

final class ExcelHelper
{
    /**
     * Returns Excel-like column name by column index
     *
     * Example
     *  index 1 => A
     *  index 5 => E
     *  index 27 => AA
     */
    public static function mapNumberToColumn(int $index): string
    {
        if ($index < 1) {
            return '';
        }

        //converted to base26 and switched from nubmers to A-Z chars
        $chars = range('A', 'Z');
        $result = '';
        do {
            $remainder = $index % 26;
            $remainder = $remainder !== 0 ? $remainder : 26;
            $result .= $chars[$remainder - 1];
            $index -= $remainder;
            $index /= 26;
        } while ($index > 0);

        return strrev($result);
    }
}
