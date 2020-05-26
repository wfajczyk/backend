<?php
/**
 * Copyright © Bold Brand Commerce Sp. z o.o. All rights reserved.
 * See LICENSE.txt for license details.
 */

declare(strict_types = 1);

namespace Ergonode\ExporterFile\Tests\Domain\Command;

use Ergonode\ExporterFile\Domain\Command\UpdateFileExportProfileCommand;
use PHPUnit\Framework\TestCase;
use Ergonode\SharedKernel\Domain\Aggregate\ExportProfileId;

/**
 */
class UpdateFileExportProfileCommandTest extends TestCase
{
    /**
     */
    public function testCommand(): void
    {
        $id = $this->createMock(ExportProfileId::class);
        $name = 'Name';
        $format = 'Format';
        $command = new UpdateFileExportProfileCommand($id, $name, $format);
        $this->assertEquals($id, $command->getId());
        $this->assertEquals($name, $command->getName());
        $this->assertEquals($format, $command->getFormat());
    }
}
