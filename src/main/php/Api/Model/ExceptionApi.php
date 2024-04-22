<?php

/*
 * Copyright (c) 2016 - 2024 Itspire.
 * This software is licensed under the BSD-3-Clause license. (see LICENSE.md for full license)
 * All Right Reserved.
 */

declare(strict_types=1);

namespace Itspire\Exception\Api\Model;

use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Serializer\Attribute\SerializedName;

#[Serializer\XmlRoot(name: 'exception')]
final class ExceptionApi implements ExceptionApiInterface
{
    public function __construct(
        // Code is set to string because it can contains user-defined string based codes (i.e : ws exception codes)
        #[Serializer\XmlAttribute]
        #[Serializer\SerializedName(name: 'code')]
        #[SerializedName('@code')]
        public ?string $code = null,
        #[Serializer\XmlAttribute]
        #[Serializer\SerializedName(name: 'message')]
        #[SerializedName('@message')]
        public ?string $message = null
    ) {
    }

    /** @deprecated use code property directly */
    public function getCode(): string
    {
        return $this->code;
    }

    /** @deprecated use constructor instead */
    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    /** @deprecated use code property directly */
    public function getMessage(): ?string
    {
        return $this->message;
    }

    /** @deprecated use constructor instead */
    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }
}
