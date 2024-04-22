<?php

/*
 * Copyright (c) 2016 - 2024 Itspire.
 * This software is licensed under the BSD-3-Clause license. (see LICENSE.md for full license)
 * All Right Reserved.
 */

declare(strict_types=1);

namespace Itspire\Exception\Api\Mapper\Webservice;

use Itspire\Common\Enum\Http\HttpResponseStatus;
use Itspire\Exception\Api\Mapper\AbstractExceptionApiMapper;
use Itspire\Exception\Definition\ExceptionDefinitionInterface;
use Itspire\Exception\Definition\Webservice\WebserviceExceptionDefinition;

final class WebserviceExceptionApiMapper extends AbstractExceptionApiMapper
{
    public function map(ExceptionDefinitionInterface $exceptionDefinition): HttpResponseStatus
    {
        $this->checkSupports($exceptionDefinition);

        return $this->getExceptionMap()[$exceptionDefinition->getName()]
            ?? HttpResponseStatus::HTTP_INTERNAL_SERVER_ERROR;
    }

    protected function getSupportedClass(): string
    {
        return WebserviceExceptionDefinition::class;
    }

    private function getExceptionMap(): array
    {
        return [
            WebserviceExceptionDefinition::VALIDATION->name => HttpResponseStatus::HTTP_BAD_REQUEST,
            WebserviceExceptionDefinition::RETRIEVAL->name => HttpResponseStatus::HTTP_BAD_REQUEST,
            WebserviceExceptionDefinition::FORMAT->name => HttpResponseStatus::HTTP_BAD_REQUEST,
            WebserviceExceptionDefinition::PERSISTENCE->name => HttpResponseStatus::HTTP_NON_PROCESSABLE_ENTITY,
            WebserviceExceptionDefinition::CONFLICT->name => HttpResponseStatus::HTTP_CONFLICT,
            WebserviceExceptionDefinition::MISSING->name => HttpResponseStatus::HTTP_NOT_FOUND,
        ];
    }
}
