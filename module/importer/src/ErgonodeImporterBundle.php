<?php

/**
 * Copyright © Ergonode Sp. z o.o. All rights reserved.
 * See LICENSE.txt for license details.
 */

declare(strict_types=1);

namespace Ergonode\Importer;

use Ergonode\SharedKernel\Application\AbstractModule;
use Ergonode\Importer\Application\DependencyInjection\CompilerPass\SourceFormFactoryCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Ergonode\Importer\Application\DependencyInjection\CompilerPass\SourceTypeCompilerPass;
use Ergonode\Importer\Application\DependencyInjection\CompilerPass\ServiceCompilerPass;
use Ergonode\Importer\Application\DependencyInjection\CompilerPass\ServiceImportCompilerPass;
use Ergonode\Importer\Application\DependencyInjection\CompilerPass\CreateSourceCommandBuilderCompilerPass;
use Ergonode\Importer\Application\DependencyInjection\CompilerPass\UpdateSourceCommandBuilderCompilerPass;

class ErgonodeImporterBundle extends AbstractModule
{
    public function build(ContainerBuilder $container): void
    {
        parent::build($container);

        $container->addCompilerPass(new SourceTypeCompilerPass());
        $container->addCompilerPass(new ServiceCompilerPass());
        $container->addCompilerPass(new SourceFormFactoryCompilerPass());
        $container->addCompilerPass(new ServiceImportCompilerPass());
        $container->addCompilerPass(new CreateSourceCommandBuilderCompilerPass());
        $container->addCompilerPass(new UpdateSourceCommandBuilderCompilerPass());
    }
}
