<?php

/*
 * Copyright (c) 2016 - 2024 Itspire.
 * This software is licensed under the BSD-3-Clause license. (see LICENSE.md for full license)
 * All Right Reserved.
 */

declare(strict_types=1);

namespace Itspire\Exception\Api\Model\Webservice;

use Itspire\Exception\Api\Model\ExceptionApiInterface;

interface WebserviceExceptionApiInterface extends ExceptionApiInterface
{
    public function setDetails(array $details): self;

    public function getDetails(): array;
}
