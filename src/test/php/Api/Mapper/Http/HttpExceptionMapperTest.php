<?php

/*
 * Copyright (c) 2016 - 2024 Itspire.
 * This software is licensed under the BSD-3-Clause license. (see LICENSE.md for full license)
 * All Right Reserved.
 */

declare(strict_types=1);

namespace Itspire\Exception\Tests\Api\Mapper\Http;

use Itspire\Common\Enum\Http\HttpResponseStatus;
use Itspire\Exception\Definition\Http\HttpExceptionDefinition;
use Itspire\Exception\Api\Mapper\ExceptionApiMapperInterface;
use Itspire\Exception\Api\Mapper\Http\HttpExceptionApiMapper;
use Itspire\Exception\Definition\Webservice\WebserviceExceptionDefinition;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class HttpExceptionMapperTest extends TestCase
{
    private ?ExceptionApiMapperInterface $exceptionMapper = null;

    protected function setUp(): void
    {
        $this->exceptionMapper = new HttpExceptionApiMapper();
    }

    #[Test]
    public function supportsTest(): void
    {
        static::assertFalse($this->exceptionMapper->supports(WebserviceExceptionDefinition::VALIDATION));

        static::assertTrue($this->exceptionMapper->supports(HttpExceptionDefinition::HTTP_BAD_REQUEST));
    }

    #[Test]
    public function mapUnsupportedExceptionDefinitionTest(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage(sprintf(
            'Provided exception definition is not valid : must be an instance of %s.',
            HttpExceptionDefinition::class
        ));

        $this->exceptionMapper->map(WebserviceExceptionDefinition::CONFLICT);
    }

    #[Test]
    public function mapTest(): void
    {
        /** @var HttpResponseStatus $httpResponseStatus */
        $httpResponseStatus = $this->exceptionMapper->map(HttpExceptionDefinition::HTTP_BAD_REQUEST);

        static::assertEquals(HttpResponseStatus::HTTP_BAD_REQUEST, $httpResponseStatus);
    }
}
