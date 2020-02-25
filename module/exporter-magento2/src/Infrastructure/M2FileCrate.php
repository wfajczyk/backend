<?php
/**
 * Copyright © Bold Brand Commerce Sp. z o.o. All rights reserved.
 * See LICENSE.txt for license details.
 *
 */

declare(strict_types = 1);

namespace Ergonode\ExporterMagento2\Infrastructure;

use Ergonode\Exporter\Domain\Entity\Catalog\AbstractExportProduct;
use Ergonode\Exporter\Infrastructure\Writer\Type\CSV;

/**
 */
class M2FileCrate
{
    /**
     * @var CSV
     */
    private CSV $writer;
    /**
     * @var Mapper
     */
    private Mapper $mapper;

    /**
     */
    public function __construct()
    {
        $name = 'test_csv_file.csv';
        $this->mapper = new Mapper();

        $this->writer = new CSV(
            $name,
            $this->mapper->getHeader()
        );
    }

    /**
     * @param AbstractExportProduct[] $products
     */
    public function create(array $products): void
    {
        $data = $this->prepareData($products);
        $this->writer->generate($data);
    }

    /**
     * @param AbstractExportProduct[] $products
     *
     * @return array
     */
    private function prepareData(array $products): array
    {
        $result = [];
        foreach ($products as $product) {
            $result[] = $this->prepareRow($product);
        }

        return $result;
    }

    /**
     * @param AbstractExportProduct $product
     *
     * @return array
     */
    private function prepareRow(AbstractExportProduct $product): array
    {
        $result = [];
        foreach ($this->mapper->getHeader() as $key => $map) {
            if ($map) {
                $attribute = $product->getAttribute($map);
                if ($attribute) {
                    $result[$key] = $attribute->getValue()->getValue();
                }
            }
        }
        $result['sku'] = $product->getSku();
        $result['categories'] = 'A...123, D... 123';

        return $result;
    }
}
