<?php
/*
 * Copyright © Bold Brand Commerce Sp. z o.o. All rights reserved.
 * See LICENSE.txt for license details.
 */

declare(strict_types = 1);

namespace Ergonode\Account\Application\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GeneratePrivilegeCommand extends Command
{
    private const NAME = 'ergonode:privilege:generate';

    private $privilege;

    public function __construct($privilege)
    {
        parent::__construct(static::NAME);
        $this->privilege = $privilege;
    }

    public function execute(InputInterface $input, OutputInterface $output): int
    {
        dump($this->privilege);
        die;

    }
}
