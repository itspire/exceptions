<?php

/*
 * Copyright (c) 2016 - 2020 Itspire.
 * This software is licensed under the BSD-3-Clause license. (see LICENSE.md for full license)
 * All Right Reserved.
 */

declare(strict_types=1);

namespace Itspire\Exception\Http;

use Itspire\Exception\AbstractException;
use Itspire\Http\Common\Enum\HttpResponseStatus;

class HttpException extends AbstractException
{
    protected HttpResponseStatus $httpResponseStatus;
    protected array $headers = [];

    public function __construct(HttpResponseStatus $httpResponseStatus, $headers = [], \Exception $previous = null)
    {
        $this->httpResponseStatus = $httpResponseStatus;

        if (!empty($headers)) {
            $this->headers = (is_array($headers)) ? $headers : [$headers];
        }

        parent::__construct($httpResponseStatus->getDescription(), $httpResponseStatus->getValue(), $previous);
    }

    public function getHeaders(): array
    {
        return $this->headers;
    }

    public function getHttpResponseStatus(): HttpResponseStatus
    {
        return $this->httpResponseStatus;
    }
}
