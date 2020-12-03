<?php

/*
 * Copyright (c) 2016 - 2020 Itspire.
 * This software is licensed under the BSD-3-Clause license. (see LICENSE.md for full license)
 * All Right Reserved.
 */

declare(strict_types=1);

namespace Itspire\Exception;

use Itspire\Exception\Definition\ExceptionDefinitionInterface;

interface ExceptionInterface extends \Throwable
{
    public function getExceptionDefinition(): ExceptionDefinitionInterface;
}
