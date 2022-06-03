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
use Itspire\Exception\Webservice\WebserviceException;
use PHPUnit\Framework\TestCase;

class WebserviceExceptionTest extends TestCase
{
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

    public function getWebserviceExceptions(): array
    {
        return [
            WebserviceExceptionDefinition::VALIDATION->name => [
                WebserviceExceptionDefinition::VALIDATION,
                new WebserviceException(WebserviceExceptionDefinition::VALIDATION)
            ],
            WebserviceExceptionDefinition::RETRIEVAL->name => [
                WebserviceExceptionDefinition::RETRIEVAL,
                new WebserviceException(WebserviceExceptionDefinition::RETRIEVAL)
            ],
            WebserviceExceptionDefinition::PERSISTENCE->name => [
                WebserviceExceptionDefinition::PERSISTENCE,
                new WebserviceException(WebserviceExceptionDefinition::PERSISTENCE)
            ],
            WebserviceExceptionDefinition::CONFLICT->name => [
                WebserviceExceptionDefinition::CONFLICT,
                new WebserviceException(WebserviceExceptionDefinition::CONFLICT)
            ],
            WebserviceExceptionDefinition::MISSING->name => [
                WebserviceExceptionDefinition::MISSING,
                new WebserviceException(WebserviceExceptionDefinition::MISSING)
            ],
            WebserviceExceptionDefinition::FORMAT->name => [
                WebserviceExceptionDefinition::FORMAT,
                new WebserviceException(WebserviceExceptionDefinition::FORMAT)
            ],
        ];
    }

    /**
     * @test
     * @dataProvider getWebserviceExceptions
     * @covers \Itspire\Exception\Definition\Webservice\WebserviceExceptionDefinition::getDescription
     */
    public function getExceptionDefinitionTest(
        WebserviceExceptionDefinition $webserviceExceptionDefinition,
        WebserviceException $webserviceException
    ): void {
        static::assertEquals(
            $webserviceExceptionDefinition->name,
            $webserviceException->getExceptionDefinition()->getName()
        );
        static::assertEquals(
            $webserviceExceptionDefinition->value,
            $webserviceException->getExceptionDefinition()->getValue()
        );
        static::assertEquals(
            $webserviceExceptionDefinition->getDescription(),
            $webserviceException->getExceptionDefinition()->getDescription()
        );
    }

    /** @test */
    public function getDetailsTest(): void
    {
        $webserviceException = new WebserviceException(
            WebserviceExceptionDefinition::VALIDATION,
            ['detail1', 'detail2']
        );
        static::assertEquals(['detail1', 'detail2'], $webserviceException->getDetails());

        $webserviceException->setDetails(['detail1']);
        static::assertEquals(['detail1'], $webserviceException->getDetails());
    }
}
