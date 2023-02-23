<?php

declare(strict_types=1);

namespace DigitalCz\Exporter\Excel;

use DigitalCz\Exporter\Concern\Export;
use DigitalCz\Exporter\Concern\WithProperties;
use DigitalCz\Exporter\Concern\WithTitle;
use InvalidArgumentException;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

final class SpreadsheetExporter
{
    public function __construct(private readonly Spreadsheet $spreadsheet)
    {
    }

    public function export(Export $export): Spreadsheet
    {
        $this->prepare($export);
        $this->exportWorksheet($export);

        return $this->spreadsheet;
    }

    private function prepare(Export $export): void
    {
        if ($export instanceof WithProperties) {
            $this->applyProperties($export);
        }

        if ($export instanceof WithTitle) {
            $this->spreadsheet->getProperties()->setTitle($export->title());
        }
    }

    private function applyProperties(WithProperties $export): void
    {
        $props = $this->spreadsheet->getProperties();

        foreach ($export->properties() as $property => $value) {
            match ($property) {
                'title' => $props->setTitle($value),
                'description' => $props->setDescription($value),
                'creator' => $props->setCreator($value),
                'lastModifiedBy' => $props->setLastModifiedBy($value),
                'subject' => $props->setSubject($value),
                'keywords' => $props->setKeywords($value),
                'category' => $props->setCategory($value),
                'manager' => $props->setManager($value),
                'company' => $props->setCompany($value),
                default => throw new InvalidArgumentException('Invalid property ' . $property),
            };
        }
    }

    private function exportWorksheet(Export $export): void
    {
        (new WorksheetExporter($this->spreadsheet))->export($export);
    }
}
