<?php

/*
 * Copyright (c) 2016 - 2020 Itspire.
 * This software is licensed under the BSD-3-Clause license. (see LICENSE.md for full license)
 * All Right Reserved.
 */

declare(strict_types=1);

namespace Itspire\Exception\Webservice\Definition;

use Itspire\Exception\Definition\AbstractExceptionDefinition;

abstract class AbstractWebserviceExceptionDefinition extends AbstractExceptionDefinition implements
    WebserviceExceptionDefinitionInterface
{
    public const TRANSFORMATION_ERROR = [1, 'itspire.exceptions.adapter_transformation_error'];
}
