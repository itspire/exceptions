<?php

/**
 * Copyright (c) 2016 - 2019 Itspire.
 * This software is licensed under the BSD-3-Clause license. (see LICENSE.md for full license)
 * All Right Reserved.
 */

declare(strict_types=1);

namespace Itspire\Exception\Webservice;

use Exception;
use Itspire\Exception\AbstractException;
use Itspire\Exception\Webservice\Definitions\AbstractWSExceptionDefinition;

class WSException extends AbstractException
{
    protected AbstractWSExceptionDefinition $exceptionDefinition;
    protected array $details = [];
    protected array $headers = [];

    public function __construct(
        AbstractWSExceptionDefinition $webserviceExceptionDefinition,
        array $headers = [],
        array $details = [],
        Exception $previous = null
    ) {
        $this->exceptionDefinition = $webserviceExceptionDefinition;

        if (!empty($details)) {
            $this->details = (is_array($details)) ? $details : [$details];
        }

        if (!empty($headers)) {
            $this->headers = (is_array($headers)) ? $headers : [$headers];
        }

        // WS exceptions are designed to use a string code for simpler visual understanding
        // We set the default exception code here : 0
        parent::__construct($webserviceExceptionDefinition->getDescription(), 0, $previous);
    }

    public function getDetails(): array
    {
        return $this->details;
    }

    public function getHeaders(): array
    {
        return $this->headers;
    }

    public function getExceptionDefinition(): AbstractWSExceptionDefinition
    {
        return $this->exceptionDefinition;
    }
}
