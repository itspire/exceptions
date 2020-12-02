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

/**
 * @property WebserviceExceptionDefinitionInterface $exceptionDefinition
 * @method WebserviceExceptionDefinitionInterface getExceptionDefinition()
 */
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

    public function addDetail(string $detail): WebserviceExceptionInterface
    {
        $this->details[] = $detail;

        return $this;
    }

    public function removeDetail(string $detail): WebserviceExceptionInterface
    {
        $key = array_search($detail, $this->details, true);

        if (false !== $key) {
            unset($this->details[$key]);
        }

        return $this;
    }

    public function getDetails(): array
    {
        return $this->details;
    }
}
