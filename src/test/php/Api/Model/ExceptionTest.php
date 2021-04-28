<?php

/*
 * Copyright (c) 2016 - 2021 Itspire.
 * This software is licensed under the BSD-3-Clause license. (see LICENSE.md for full license)
 * All Right Reserved.
 */

declare(strict_types=1);

namespace Itspire\Exception\Tests\Api\Model;

use Itspire\Exception\Api\Model\ExceptionApi;
use Itspire\Exception\Api\Model\ExceptionApiInterface;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\SerializerInterface;
use PHPUnit\Framework\TestCase;

class ExceptionTest extends TestCase
{
    private static ?SerializerInterface $serializer = null;
    private ?ExceptionApiInterface $exception = null;

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

        $this->exception = (new ExceptionApi())->setCode('TEST')->setMessage('test');
    }

    protected function tearDown(): void
    {
        unset($this->exception);

        parent::tearDown();
    }

    /** @test */
    public function serializeExceptionTest(): void
    {
        static::assertXmlStringEqualsXmlFile(
            realpath('src/test/resources/test_exception.xml'),
            static::$serializer->serialize($this->exception, 'xml')
        );
    }

    /** @test */
    public function deserializeExceptionTest(): void
    {
        /** @var \SimpleXMLElement $exceptionXml */
        $exceptionXml = simplexml_load_string(
            file_get_contents(realpath('src/test/resources/test_exception.xml'))
        );

        /** @var ExceptionApi $deserializedResult */
        $deserializedResult = static::$serializer->deserialize($exceptionXml->asXML(), ExceptionApi::class, 'xml');

        static::assertEquals($this->exception->getCode(), $deserializedResult->getCode());
        static::assertEquals($this->exception->getMessage(), $deserializedResult->getMessage());
    }
}
