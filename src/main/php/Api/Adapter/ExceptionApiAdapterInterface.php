<?php

/*
 * Copyright (c) 2016 - 2024 Itspire.
 * This software is licensed under the BSD-3-Clause license. (see LICENSE.md for full license)
 * All Right Reserved.
 */

declare(strict_types=1);

namespace Itspire\Exception\Api\Adapter;

use Itspire\Exception\Api\Model\ExceptionApiInterface;
use Itspire\Exception\ExceptionInterface;

interface ExceptionApiAdapterInterface
{
    public function adaptApiExceptionToBusinessException(ExceptionApiInterface $apiException): ExceptionInterface;

    public function adaptBusinessExceptionToApiException(ExceptionInterface $businessException): ExceptionApiInterface;

    /** @param ExceptionApiInterface|ExceptionInterface $exception */
    public function supports($exception): bool;
}
