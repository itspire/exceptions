<?php

/*
 * Copyright (c) 2016 - 2020 Itspire.
 * This software is licensed under the BSD-3-Clause license. (see LICENSE.md for full license)
 * All Right Reserved.
 */

declare(strict_types=1);

namespace Itspire\Exception\Http;

use Itspire\Exception\ExceptionInterface;
use Itspire\Exception\Http\Definition\HttpExceptionDefinitionInterface;

interface HttpExceptionInterface extends ExceptionInterface
{
    public function getHeaders(): array;

    public function getExceptionDefinition(): HttpExceptionDefinitionInterface;
}
