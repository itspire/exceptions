<?php

/*
 * Copyright (c) 2016 - 2020 Itspire.
 * This software is licensed under the BSD-3-Clause license. (see LICENSE.md for full license)
 * All Right Reserved.
 */

declare(strict_types=1);

namespace Itspire\Exception\Webservice;

use Itspire\Exception\ExceptionInterface;
use Itspire\Exception\Webservice\Definition\WebserviceExceptionDefinitionInterface;

interface WebserviceExceptionInterface extends ExceptionInterface
{
    public function getDetails(): array;

    public function getExceptionDefinition(): WebserviceExceptionDefinitionInterface;
}
