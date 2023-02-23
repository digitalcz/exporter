<?php

declare(strict_types=1);

namespace DigitalCz\Exporter;

use DigitalCz\Exporter\Concern\Export;
use DigitalCz\Exporter\Csv\CsvWriterFactory;
use DigitalCz\Exporter\Xls\XlsWriterFactory;
use DigitalCz\Exporter\Xlsx\XlsxWriterFactory;
use DigitalCz\Streams\FileInterface;
use DigitalCz\Streams\StreamInterface;
use DigitalCz\Streams\TempFile;
use LogicException;

final class Exporter
{
    /**
     * @var iterable<WriterFactory>
     */
    private readonly iterable $writerFactories;

    /**
     * @param iterable<WriterFactory>|null $writerFactories
     */
    public function __construct(?iterable $writerFactories = null)
    {
        $this->writerFactories = $writerFactories ?? self::defaultWriterFactories();
    }

    public function exportAsFile(Export $export, string $writer): FileInterface
    {
        $file = new TempFile();

        $this->exportInto($export, $file, $writer);

        return $file;
    }

    public function exportInto(Export $export, StreamInterface $stream, string $writer): void
    {
        $this->createWriter($writer, $export)->write($stream);
    }

    protected function createWriter(string $writer, Export $export): Writer
    {
        foreach ($this->writerFactories as $writerFactory) {
            if ($writerFactory->support($writer)) {
                return $writerFactory->create($export);
            }
        }

        throw new LogicException('No writer factory for ' . $writer);
    }

    /**
     * @return iterable<WriterFactory>
     */
    private static function defaultWriterFactories(): iterable
    {
        return [
            new XlsxWriterFactory(),
            new XlsWriterFactory(),
            new CsvWriterFactory(),
        ];
    }
}
