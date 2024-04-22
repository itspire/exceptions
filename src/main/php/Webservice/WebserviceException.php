<?php

/*
 * Copyright (c) 2016 - 2024 Itspire.
 * This software is licensed under the BSD-3-Clause license. (see LICENSE.md for full license)
 * All Right Reserved.
 */

declare(strict_types=1);

namespace Itspire\Exception\Webservice;

use Itspire\Exception\AbstractException;
use Itspire\Exception\Definition\ExceptionDefinitionInterface;
use Itspire\Exception\Definition\Webservice\WebserviceExceptionDefinition;

class WebserviceException extends AbstractException
{
    public static function getSupportedClass(): string
    {
        return WebserviceExceptionDefinition::class;
    }

    public function __construct(
        ExceptionDefinitionInterface $exceptionDefinition,
        protected array $details = [],
        \Throwable $previous = null
    ) {
        parent::__construct($exceptionDefinition, $previous);
        $this->details = $details;
    }

    public function setDetails(array $details): self
    {
        $this->details = $details;

        return $this;
    }

    public function getDetails(): array
    {
        return $this->details;
    }
}
