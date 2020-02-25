<?php
/**
 * Copyright © Bold Brand Commerce Sp. z o.o. All rights reserved.
 * See LICENSE.txt for license details.
 *
 */

declare(strict_types = 1);

namespace Ergonode\ExporterMagento2\Application\Command;

use Ergonode\Exporter\Domain\Entity\Catalog\Product\DefaultExportProduct;
use Ergonode\Exporter\Domain\Repository\ProductRepositoryInterface;
use Ergonode\ExporterMagento2\Infrastructure\M2FileCrate;
use Ramsey\Uuid\Uuid;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 */
class ExportMagentoCommand extends Command
{
    protected static $defaultName = 'test:export';

    private ProductRepositoryInterface $repository;

    /**
     * ExportMagentoCommand constructor.
     *
     * @param ProductRepositoryInterface $repository
     */
    public function __construct(ProductRepositoryInterface $repository)
    {
        parent::__construct();
        $this->repository = $repository;
    }

    /**
     * @param InputInterface  $input
     * @param OutputInterface $output
     *
     * @return int|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $fromRepo = [
            $this->repository->load(Uuid::fromString('d94f626b-53b4-5461-9103-0c61681858e3')),
            $this->repository->load(Uuid::fromString('66bc0199-39cf-5ced-8780-0ccff5f83675')),
            $this->repository->load(Uuid::fromString('f6995a78-9f75-57bb-878b-3ea75052c10d')),
        ];


        $products = array_merge(
            $fromRepo,
            [
            ]
        );

        $m2 = new M2FileCrate();
        $m2->create($products);
    }
}
