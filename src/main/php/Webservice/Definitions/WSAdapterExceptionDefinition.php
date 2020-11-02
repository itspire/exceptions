<?php

/**
 * Copyright (c) 2016 - 2019 Itspire.
 * This software is licensed under the BSD-3-Clause license. (see LICENSE.md for full license)
 * All Right Reserved.
 */

declare(strict_types=1);

namespace Itspire\Exception\Webservice\Definitions;

class WSAdapterExceptionDefinition extends AbstractWSExceptionDefinition
{
    /** @var array TRANSFORMATION_ERROR */
    public const TRANSFORMATION_ERROR = [1, 'itspire.exceptions.adapter_transformation_error'];
}
