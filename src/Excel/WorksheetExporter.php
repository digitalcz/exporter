<?php

declare(strict_types=1);

namespace DigitalCz\Exporter\Excel;

use DigitalCz\Exporter\Concern\Export;
use DigitalCz\Exporter\Concern\ShouldAutoSize;
use DigitalCz\Exporter\Concern\WithColumnFormatting;
use DigitalCz\Exporter\Concern\WithDataTypes;
use DigitalCz\Exporter\Concern\WithHeadings;
use DigitalCz\Exporter\Concern\WithMapping;
use DigitalCz\Exporter\Concern\WithStyles;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use RuntimeException;

final class WorksheetExporter
{
    private Worksheet $worksheet;
    private int $currentRow = 1;

    public function __construct(Spreadsheet $spreadsheet)
    {
        $this->worksheet = $spreadsheet->getActiveSheet();
    }

    public function export(Export $export): void
    {
        $this->prepare($export);
        $this->rows($export);
        $this->finish($export);
    }

    private function prepare(Export $export): void
    {
        $this->currentRow = 1;

        if ($export instanceof WithHeadings) {
            $this->addRow($export->headings());
        }
    }

    private function rows(Export $export): void
    {
        foreach ($export->iterate() as $row) {
            if (!is_array($row) && !$export instanceof WithMapping) {
                throw new RuntimeException('Export must have array rows or implement WithMapping.');
            }

            /** @var array<mixed> $mappedRow */
            $mappedRow = $export instanceof WithMapping ? $export->map($row) : $row;
            $types = $export instanceof WithDataTypes ? $export->types() : [];

            $this->addRow($mappedRow, $types);
        }
    }

    /**
     * @param iterable<mixed> $values
     * @param array<string, string> $types
     */
    private function addRow(iterable $values, array $types = []): void
    {
        $column = 1;
        foreach ($values as $value) {
            if ($value !== null) {
                $columnName = ExcelHelper::mapNumberToColumn($column);
                $cell = $this->worksheet->getCell($columnName . $this->currentRow);

                if (isset($types[$columnName])) {
                    $cell->setValueExplicit($value, $types[$columnName]);
                } else {
                    $cell->setValue($value);
                }
            }

            $column++;
        }

        $this->currentRow++;
    }

    private function finish(Export $export): void
    {
        if ($export instanceof WithColumnFormatting) {
            foreach ($export->formats() as $column => $format) {
                $this->worksheet->getStyle($column)->getNumberFormat()->setFormatCode($format);
            }
        }

        if ($export instanceof ShouldAutoSize) {
            foreach ($this->worksheet->getColumnIterator() as $column) {
                $dimension = $this->worksheet->getColumnDimension($column->getColumnIndex());

                // Only auto-size columns that do not have explicit width
                if ($dimension->getWidth() === -1.0) {
                    $dimension->setAutoSize(true);
                }
            }
        }

        if ($export instanceof WithStyles) {
            foreach ($export->styles() as $coordinate => $style) {
                $this->worksheet->getStyle($coordinate)->applyFromArray($style);
            }
        }
    }
}
