<?php

/*
 * Copyright (c) 2016 - 2021 Itspire.
 * This software is licensed under the BSD-3-Clause license. (see LICENSE.md for full license)
 * All Right Reserved.
 */

declare(strict_types=1);

namespace Itspire\Exception\Api\Model\Webservice;

use Itspire\Exception\Api\Model\ExceptionApi;
use JMS\Serializer\Annotation as Serializer;

#[Serializer\XmlRoot(name: 'ws_exception')]
class WebserviceExceptionApi extends ExceptionApi implements WebserviceExceptionApiInterface
{
    #[Serializer\XmlList(inline: false, entry: 'detail')]
    #[Serializer\SerializedName(name: 'details')]
    #[Serializer\Type(name: 'array<string>')]
    protected array $details = [];

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
