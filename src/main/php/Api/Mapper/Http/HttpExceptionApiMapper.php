<?php

/*
 * Copyright (c) 2016 - 2024 Itspire.
 * This software is licensed under the BSD-3-Clause license. (see LICENSE.md for full license)
 * All Right Reserved.
 */

declare(strict_types=1);

namespace Itspire\Exception\Api\Mapper\Http;

use Itspire\Common\Enum\Http\HttpResponseStatus;
use Itspire\Exception\Api\Mapper\AbstractExceptionApiMapper;
use Itspire\Exception\Definition\ExceptionDefinitionInterface;
use Itspire\Exception\Definition\Http\HttpExceptionDefinition;

final class HttpExceptionApiMapper extends AbstractExceptionApiMapper
{
    public function map(ExceptionDefinitionInterface $exceptionDefinition): HttpResponseStatus
    {
        $this->checkSupports($exceptionDefinition);

        return HttpResponseStatus::from($exceptionDefinition->getValue());
    }

    protected function getSupportedClass(): string
    {
        return HttpExceptionDefinition::class;
    }
}
