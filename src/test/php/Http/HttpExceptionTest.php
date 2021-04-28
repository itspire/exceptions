<?php

/*
 * Copyright (c) 2016 - 2020 Itspire.
 * This software is licensed under the BSD-3-Clause license. (see LICENSE.md for full license)
 * All Right Reserved.
 */

declare(strict_types=1);

namespace Itspire\Exception\Tests\Http;

use Itspire\Exception\Definition\Http\HttpExceptionDefinition;
use Itspire\Exception\Definition\Webservice\WebserviceExceptionDefinition;
use Itspire\Exception\ExceptionInterface;
use Itspire\Exception\Http\HttpException;
use PHPUnit\Framework\TestCase;

class HttpExceptionTest extends TestCase
{
    private ?ExceptionInterface $httpException = null;

    protected function setUp(): void
    {
        parent::setUp();

        $this->httpException = new HttpException(HttpExceptionDefinition::HTTP_CONFLICT);
    }

    protected function tearDown(): void
    {
        unset($this->httpException);

        parent::tearDown();
    }

    /** @test */
    public function unsupportedClassTest(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage(
            sprintf(
                'Provided exception definition is not valid : must be an instance of %s.',
                HttpExceptionDefinition::class
            )
        );

        new HttpException(WebserviceExceptionDefinition::CONFLICT);
    }

    /**
     * @test
     * @covers \Itspire\Exception\Definition\Http\HttpExceptionDefinition::getDescription
     */
    public function getHttpExceptionDefinitionTest(): void
    {
        $httpExceptionDefinition = $this->httpException->getExceptionDefinition();

        static::assertEquals(HttpExceptionDefinition::HTTP_CONFLICT->name, $httpExceptionDefinition->getName());
        static::assertEquals(HttpExceptionDefinition::HTTP_CONFLICT->value, $httpExceptionDefinition->getValue());
        static::assertEquals(
            HttpExceptionDefinition::HTTP_CONFLICT->getDescription(),
            $httpExceptionDefinition->getDescription()
        );
    }
}
