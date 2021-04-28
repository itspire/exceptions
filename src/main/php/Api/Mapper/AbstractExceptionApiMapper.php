<?php

/*
 * Copyright (c) 2016 - 2021 Itspire.
 * This software is licensed under the BSD-3-Clause license. (see LICENSE.md for full license)
 * All Right Reserved.
 */

declare(strict_types=1);

namespace Itspire\Exception\Api\Mapper;

use Itspire\Exception\Definition\ExceptionDefinitionInterface;

abstract class AbstractExceptionApiMapper implements ExceptionApiMapperInterface
{
    final public function supports(ExceptionDefinitionInterface $exceptionDefinition): bool
    {
        return $exceptionDefinition::class === $this->getSupportedClass();
    }

    final protected function checkSupports(ExceptionDefinitionInterface $exceptionDefinition): void
    {
        if (get_class($exceptionDefinition) !== $this->getSupportedClass()) {
            throw new \InvalidArgumentException(
                sprintf(
                    'Provided exception definition is not valid : must be an instance of %s.',
                    $this->getSupportedClass()
                )
            );
        }
    }

    abstract protected function getSupportedClass(): string;
}
