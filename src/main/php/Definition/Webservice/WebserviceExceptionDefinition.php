<?php

/*
 * Copyright (c) 2016 - 2021 Itspire.
 * This software is licensed under the BSD-3-Clause license. (see LICENSE.md for full license)
 * All Right Reserved.
 */

declare(strict_types=1);

namespace Itspire\Exception\Definition\Webservice;

use Itspire\Common\Enum\ExtendedBackedEnumTrait;
use Itspire\Exception\Definition\ExceptionDefinitionInterface;

enum WebserviceExceptionDefinition: int implements ExceptionDefinitionInterface
{
    use ExtendedBackedEnumTrait;

    case VALIDATION = 1;
    case RETRIEVAL = 2;
    case PERSISTENCE = 3;
    case CONFLICT = 4;
    case MISSING = 5;
    case FORMAT = 6;

    public static function getAllDescriptions(): array
    {
        return [
            self::VALIDATION->name => 'itspire.exceptions.definitions.webservice.validation',
            self::RETRIEVAL->name => 'itspire.exceptions.definitions.webservice.retrieval',
            self::PERSISTENCE->name => 'itspire.exceptions.definitions.webservice.persistence',
            self::CONFLICT->name => 'itspire.exceptions.definitions.webservice.conflict',
            self::MISSING->name => 'itspire.exceptions.definitions.webservice.missing',
            self::FORMAT->name => 'itspire.exceptions.definitions.webservice.format',
        ];
    }
}
