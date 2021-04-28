<?php

/*
 * Copyright (c) 2016 - 2020 Itspire.
 * This software is licensed under the BSD-3-Clause license. (see LICENSE.md for full license)
 * All Right Reserved.
 */

declare(strict_types=1);

namespace Itspire\Exception\Tests\Webservice;

use Itspire\Exception\Definition\Http\HttpExceptionDefinition;
use Itspire\Exception\Definition\Webservice\WebserviceExceptionDefinition;
use Itspire\Exception\ExceptionInterface;
use Itspire\Exception\Webservice\WebserviceException;
use PHPUnit\Framework\TestCase;

class WebserviceExceptionTest extends TestCase
{
    private ?ExceptionInterface $webserviceException = null;

    protected function setUp(): void
    {
        parent::setUp();

        $this->webserviceException = new WebserviceException(WebserviceExceptionDefinition::VALIDATION);
    }

    protected function tearDown(): void
    {
        unset($this->webserviceException);

        parent::tearDown();
    }

    /** @test */
    public function unsupportedClassTest(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage(
            sprintf(
                'Provided exception definition is not valid : must be an instance of %s.',
                WebserviceExceptionDefinition::class
            )
        );

        new WebserviceException(HttpExceptionDefinition::HTTP_CONFLICT);
    }

    /**
     * @test
     * @covers \Itspire\Exception\Definition\Webservice\WebserviceExceptionDefinition::getDescription
     */
    public function getExceptionDefinitionTest(): void
    {
        $webserviceExceptionDefinition = $this->webserviceException->getExceptionDefinition();

        static::assertEquals(
            WebserviceExceptionDefinition::VALIDATION->name,
            $webserviceExceptionDefinition->getName()
        );
        static::assertEquals(
            WebserviceExceptionDefinition::VALIDATION->value,
            $webserviceExceptionDefinition->getValue()
        );
        static::assertEquals(
            WebserviceExceptionDefinition::VALIDATION->getDescription(),
            $webserviceExceptionDefinition->getDescription()
        );
    }

    /** @test */
    public function getDetailsTest(): void
    {
        $this->webserviceException->setDetails(['detail1', 'detail2']);

        static::assertEquals(['detail1', 'detail2'], $this->webserviceException->getDetails());
        $this->webserviceException->setDetails(['detail1']);
        static::assertEquals(['detail1'], $this->webserviceException->getDetails());
    }
}
