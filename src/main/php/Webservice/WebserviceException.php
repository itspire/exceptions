<?php

/*
 * Copyright (c) 2016 - 2020 Itspire.
 * This software is licensed under the BSD-3-Clause license. (see LICENSE.md for full license)
 * All Right Reserved.
 */

declare(strict_types=1);

namespace Itspire\Exception\Webservice;

use Itspire\Exception\AbstractException;
use Itspire\Exception\Webservice\Definition\WebserviceExceptionDefinitionInterface;

/** @property WebserviceExceptionDefinitionInterface $exceptionDefinition */
class WebserviceException extends AbstractException implements WebserviceExceptionInterface
{
    protected array $details = [];

    public function __construct(
        WebserviceExceptionDefinitionInterface $exceptionDefinition,
        array $details = [],
        \Exception $previous = null
    ) {
        parent::__construct($exceptionDefinition, $previous);
        $this->details = $details;
    }

    public function getExceptionDefinition(): WebserviceExceptionDefinitionInterface
    {
        return $this->exceptionDefinition;
    }

    public function getDetails(): array
    {
        return $this->details;
    }
}
