<?php

/*
 * Copyright (c) 2016 - 2024 Itspire.
 * This software is licensed under the BSD-3-Clause license. (see LICENSE.md for full license)
 * All Right Reserved.
 */

declare(strict_types=1);

namespace Itspire\Exception\Api\Mapper;

use Itspire\Common\Enum\Http\HttpResponseStatus;
use Itspire\Exception\Definition\ExceptionDefinitionInterface;

interface ExceptionApiMapperInterface
{
    public function map(ExceptionDefinitionInterface $exceptionDefinition): HttpResponseStatus;

    public function supports(ExceptionDefinitionInterface $exceptionDefinition): bool;
}
