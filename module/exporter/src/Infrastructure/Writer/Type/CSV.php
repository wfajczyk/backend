<?php
/**
 * Copyright © Bold Brand Commerce Sp. z o.o. All rights reserved.
 * See LICENSE.txt for license details.
 *
 */

declare(strict_types = 1);

namespace Ergonode\Exporter\Infrastructure\Writer\Type;

use Ergonode\Exporter\Infrastructure\Writer\WriterInterface;

/**
 */
class CSV implements WriterInterface
{
    /**
     * @var array
     */
    private array $structure;

    /**
     * @var string
     */
    private string  $delimiter;

    /**
     * @var false|resource
     */
    protected $file;

    /**
     * @param string $fileName
     * @param array  $structure
     * @param string $delimiter
     */
    public function __construct(string $fileName, array $structure, string $delimiter = ',')
    {
        $this->structure = $structure;
        $this->delimiter = $delimiter;

        $this->file = fopen($fileName, 'wb');
    }

    /**
     * @param array $data
     */
    public function generate($data): void
    {
        $header = array_keys($this->structure);

        $this->addRow($header);

        foreach ($data as $row) {
            $line = [];
            foreach ($header as $key) {
                $line[$key] = '';
                if (isset($row[$key]) && $row[$key] !== null) {
                    $line[$key] = $row[$key];
                }
            }
            $this->addRow($line);
            unset($line);
        }

        fclose($this->file);
    }

    /**
     * @param array $rowData
     *
     * @return bool
     */
    protected function addRow(array $rowData): bool
    {
        return fputcsv($this->file, $rowData, $this->delimiter) > 0;
    }
}
