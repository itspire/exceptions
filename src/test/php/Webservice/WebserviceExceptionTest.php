<?php
/*
 * Copyright (c) 2016 - 2020 Itspire.
 * This software is licensed under the BSD-3-Clause license. (see LICENSE.md for full license)
 * All Right Reserved.
 */

declare(strict_types=1);

namespace Itspire\Exception\Tests\Webservice;

use Itspire\Exception\Webservice\Definition\WebserviceExceptionDefinition;
use Itspire\Exception\Webservice\WebserviceException;
use Itspire\Exception\Webservice\WebserviceExceptionInterface;
use PHPUnit\Framework\TestCase;

class WebserviceExceptionTest extends TestCase
{
    private ?WebserviceExceptionInterface $webserviceException = null;

    protected function setUp(): void
    {
        parent::setUp();

        $this->webserviceException = new WebserviceException(
            new WebserviceExceptionDefinition(WebserviceExceptionDefinition::TRANSFORMATION_ERROR)
        );
    }

    protected function tearDown(): void
    {
        unset($this->webserviceException);

        parent::tearDown();
    }

    /** @test */
    public function getExceptionDefinitionTest(): void
    {
        $webserviceExceptionDefinition = $this->webserviceException->getExceptionDefinition();

        static::assertEquals(
            WebserviceExceptionDefinition::TRANSFORMATION_ERROR[0],
            $webserviceExceptionDefinition->getValue()
        );
        static::assertEquals(
            WebserviceExceptionDefinition::TRANSFORMATION_ERROR[1],
            $webserviceExceptionDefinition->getDescription()
        );
        static::assertEquals('TRANSFORMATION_ERROR', $webserviceExceptionDefinition->getCode());
    }

    /** @test */
    public function getDetailsTest(): void
    {
        $this->webserviceException->addDetail('detail1')->addDetail('detail2');

        static::assertEquals(['detail1', 'detail2'], $this->webserviceException->getDetails());
        $this->webserviceException->removeDetail('detail2');
        static::assertEquals(['detail1'], $this->webserviceException->getDetails());
    }
}
