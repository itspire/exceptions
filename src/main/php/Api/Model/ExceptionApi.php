<?php

/*
 * Copyright (c) 2016 - 2021 Itspire.
 * This software is licensed under the BSD-3-Clause license. (see LICENSE.md for full license)
 * All Right Reserved.
 */

declare(strict_types=1);

namespace Itspire\Exception\Api\Model;

use JMS\Serializer\Annotation as Serializer;

/** @Serializer\XmlRoot("exception") */
class ExceptionApi implements ExceptionApiInterface
{
    /**
     * Code is set to string because it can contains user-defined string based codes (i.e : ws exception codes)
     *
     * @Serializer\XmlAttribute
     * @Serializer\SerializedName("code")
     * @Serializer\Type("string")
     */
    private string $code = '';

    /**
     * @Serializer\XmlAttribute
     * @Serializer\SerializedName("message")
     * @Serializer\Type("string")
     */
    private ?string $message = null;

    public function getCode(): string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }
}
