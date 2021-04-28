<?php

/*
 * Copyright (c) 2016 - 2021 Itspire.
 * This software is licensed under the BSD-3-Clause license. (see LICENSE.md for full license)
 * All Right Reserved.
 */

declare(strict_types=1);

namespace Itspire\Exception\Tests\Api\Model\Webservice;

use Itspire\Exception\Api\Model\Webservice\WebserviceExceptionApi;
use Itspire\Exception\Api\Model\Webservice\WebserviceExceptionApiInterface;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\SerializerInterface;
use PHPUnit\Framework\TestCase;

class WebserviceExceptionTest extends TestCase
{
    private static ?SerializerInterface $serializer = null;
    private ?WebserviceExceptionApiInterface $webserviceException = null;

    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();
        if (null === self::$serializer) {
            // obtaining the serializer
            $serializerBuilder = SerializerBuilder::create();
            self::$serializer = $serializerBuilder->build();
        }
    }

    public static function tearDownAfterClass(): void
    {
        static::$serializer = null;
        parent::tearDownAfterClass();
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->webserviceException = (new WebserviceExceptionApi())
            ->setCode('TEST')
            ->setMessage('test')
            ->setDetails(['Detail1', 'Detail2']);
    }

    protected function tearDown(): void
    {
        unset($this->WebserviceException);

        parent::tearDown();
    }

    /** @test */
    public function serializeExceptionTest(): void
    {
        static::assertXmlStringEqualsXmlFile(
            realpath('src/test/resources/test_webservice_exception.xml'),
            static::$serializer->serialize($this->webserviceException, 'xml')
        );
    }

    /** @test */
    public function serializeExceptionWithRemovedDetailTest(): void
    {
        $this->webserviceException->setDetails(['Detail1']);

        static::assertXmlStringEqualsXmlFile(
            realpath('src/test/resources/test_webservice_exception_single_detail.xml'),
            static::$serializer->serialize($this->webserviceException, 'xml')
        );
    }

    /** @test */
    public function deserializeExceptionTest(): void
    {
        /** @var \SimpleXMLElement $webserviceException */
        $webserviceException = simplexml_load_string(
            file_get_contents(realpath('src/test/resources/test_webservice_exception.xml'))
        );

        /** @var WebserviceExceptionApi $deserializedResult */
        $deserializedResult = static::$serializer->deserialize(
            $webserviceException->asXML(),
            WebserviceExceptionApi::class,
            'xml'
        );

        static::assertEquals($this->webserviceException->getCode(), $deserializedResult->getCode());
        static::assertEquals($this->webserviceException->getMessage(), $deserializedResult->getMessage());
        static::assertEquals($this->webserviceException->getDetails(), $deserializedResult->getDetails());
    }
}
