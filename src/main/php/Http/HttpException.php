<?php

/*
 * Copyright (c) 2016 - 2020 Itspire.
 * This software is licensed under the BSD-3-Clause license. (see LICENSE.md for full license)
 * All Right Reserved.
 */

declare(strict_types=1);

namespace Itspire\Exception\Http;

use Itspire\Exception\AbstractException;
use Itspire\Exception\Http\Definition\HttpExceptionDefinitionInterface;

/**
 * @property HttpExceptionDefinitionInterface $exceptionDefinition
 * @method HttpExceptionDefinitionInterface getExceptionDefinition()
 */
class HttpException extends AbstractException implements HttpExceptionInterface
{
    public function __construct(
        HttpExceptionDefinitionInterface $exceptionDefinition,
        \Exception $previous = null
    ) {
        parent::__construct($exceptionDefinition, $previous);
    }
}
