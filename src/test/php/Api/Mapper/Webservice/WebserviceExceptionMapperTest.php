<?php

/*
 * Copyright (c) 2016 - 2024 Itspire.
 * This software is licensed under the BSD-3-Clause license. (see LICENSE.md for full license)
 * All Right Reserved.
 */

declare(strict_types=1);

namespace Itspire\Exception\Tests\Api\Mapper\Webservice;

use Itspire\Common\Enum\Http\HttpResponseStatus;
use Itspire\Exception\Api\Mapper\ExceptionApiMapperInterface;
use Itspire\Exception\Api\Mapper\Webservice\WebserviceExceptionApiMapper;
use Itspire\Exception\Definition\Http\HttpExceptionDefinition;
use Itspire\Exception\Definition\Webservice\WebserviceExceptionDefinition;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class WebserviceExceptionMapperTest extends TestCase
{
    private ?ExceptionApiMapperInterface $exceptionMapper = null;

    protected function setUp(): void
    {
        $this->exceptionMapper = new WebserviceExceptionApiMapper();
    }

    public static function getWebserviceExceptionDefinitionMap(): array
    {
        return [
            'VALIDATION' => [WebserviceExceptionDefinition::VALIDATION, HttpResponseStatus::HTTP_BAD_REQUEST],
            'RETRIEVAL' => [WebserviceExceptionDefinition::RETRIEVAL, HttpResponseStatus::HTTP_BAD_REQUEST],
            'FORMAT' => [WebserviceExceptionDefinition::FORMAT, HttpResponseStatus::HTTP_BAD_REQUEST],
            'PERSISTENCE' => [
                WebserviceExceptionDefinition::PERSISTENCE,
                HttpResponseStatus::HTTP_NON_PROCESSABLE_ENTITY,
            ],
            'CONFLICT' => [WebserviceExceptionDefinition::CONFLICT, HttpResponseStatus::HTTP_CONFLICT],
            'MISSING' => [WebserviceExceptionDefinition::MISSING, HttpResponseStatus::HTTP_NOT_FOUND],
        ];
    }

    #[Test]
    public function supportsTest(): void
    {
        static::assertFalse($this->exceptionMapper->supports(HttpExceptionDefinition::HTTP_BAD_REQUEST));

        static::assertTrue($this->exceptionMapper->supports(WebserviceExceptionDefinition::VALIDATION));
    }

    #[Test]
    public function mapUnsupportedExceptionDefinitionTest(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage(
            sprintf(
                'Provided exception definition is not valid : must be an instance of %s.',
                WebserviceExceptionDefinition::class
            )
        );

        $this->exceptionMapper->map(HttpExceptionDefinition::HTTP_CONFLICT);
    }

    #[Test]
    #[DataProvider('getWebserviceExceptionDefinitionMap')]
    public function mapTest(
        WebserviceExceptionDefinition $webserviceExceptionDefinition,
        HttpResponseStatus $expectedHttpResponseStatus
    ): void {
        /** @var HttpResponseStatus $httpResponseStatus */
        $httpResponseStatus = $this->exceptionMapper->map($webserviceExceptionDefinition);

        static::assertEquals($expectedHttpResponseStatus, $httpResponseStatus);
    }
}
