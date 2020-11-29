<?php

/*
 * Copyright (c) 2016 - 2020 Itspire.
 * This software is licensed under the BSD-3-Clause license. (see LICENSE.md for full license)
 * All Right Reserved.
 */

declare(strict_types=1);

namespace Itspire\Exception;

use Itspire\Exception\Definition\ExceptionDefinitionInterface;

abstract class AbstractException extends \RuntimeException implements ExceptionInterface
{
    protected ExceptionDefinitionInterface $exceptionDefinition;

    public function __construct(ExceptionDefinitionInterface $exceptionDefinition, \Exception $previous = null)
    {
        $this->exceptionDefinition = $exceptionDefinition;

        // Some ExceptionDefinitionInterface implementations may use a non integer value
        // When that happens, we use 0 as default exception value
        parent::__construct(
            $exceptionDefinition->getDescription(),
            is_int($exceptionDefinition->getValue()) ? $exceptionDefinition->getValue() : 0,
            $previous
        );
    }
}
