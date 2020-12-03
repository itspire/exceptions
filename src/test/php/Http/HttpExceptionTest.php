<?php

/*
 * Copyright (c) 2016 - 2020 Itspire.
 * This software is licensed under the BSD-3-Clause license. (see LICENSE.md for full license)
 * All Right Reserved.
 */

declare(strict_types=1);

namespace Itspire\Exception\Tests\Http;

use Itspire\Exception\Http\Definition\HttpExceptionDefinition;
use Itspire\Exception\Http\HttpException;
use Itspire\Exception\Http\HttpExceptionInterface;
use PHPUnit\Framework\TestCase;

class HttpExceptionTest extends TestCase
{
    private ?HttpExceptionInterface $httpException = null;

    protected function setUp(): void
    {
        parent::setUp();

        $this->httpException = new HttpException(new HttpExceptionDefinition(HttpExceptionDefinition::HTTP_CONFLICT));
    }

    protected function tearDown(): void
    {
        unset($this->httpException);

        parent::tearDown();
    }

    /** @test */
    public function getHttpExceptionDefinitionTest(): void
    {
        $httpExceptionDefinition = $this->httpException->getExceptionDefinition();

        static::assertEquals(HttpExceptionDefinition::HTTP_CONFLICT[0], $httpExceptionDefinition->getValue());
        static::assertEquals(HttpExceptionDefinition::HTTP_CONFLICT[1], $httpExceptionDefinition->getDescription());
        static::assertEquals('HTTP_CONFLICT', $httpExceptionDefinition->getCode());
    }
}
