<?php

/*
 * Copyright (c) 2016 - 2024 Itspire.
 * This software is licensed under the BSD-3-Clause license. (see LICENSE.md for full license)
 * All Right Reserved.
 */

declare(strict_types=1);

namespace Itspire\Exception\Tests\Api\Model;

use Itspire\Exception\Api\Model\ExceptionApi;
use Itspire\Exception\Api\Model\ExceptionApiInterface;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\SerializerInterface;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Symfony\Component\Serializer\Mapping\Loader\AttributeLoader;
use Symfony\Component\Serializer\NameConverter\MetadataAwareNameConverter;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class ExceptionTest extends TestCase
{
    private static ?\Symfony\Component\Serializer\SerializerInterface $symfonySerializer = null;
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

        if (null === self::$symfonySerializer) {
            $classMetadataFactory = new ClassMetadataFactory(new AttributeLoader());

            self::$symfonySerializer = new Serializer(
                [
                    new ObjectNormalizer(
                        classMetadataFactory: $classMetadataFactory,
                        nameConverter: new MetadataAwareNameConverter($classMetadataFactory)
                    ),
                ],
                [new XmlEncoder(), new JsonEncoder()]
            );
        }
    }

    public static function tearDownAfterClass(): void
    {
        static::$serializer = null;
        static::$symfonySerializer = null;
        parent::tearDownAfterClass();
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->exception = new ExceptionApi(code:'TEST', message: 'test');
    }

    protected function tearDown(): void
    {
        unset($this->exception);

        parent::tearDown();
    }

    #[Test]
    public function serializeExceptionTest(): void
    {
        static::assertXmlStringEqualsXmlFile(
            realpath('src/test/resources/test_exception.xml'),
            static::$serializer->serialize($this->exception, 'xml')
        );

        // see https://github.com/symfony/symfony/issues/51652
        // XmlEncoder::ROOT_NODE_NAME has to be specified here until this issue is fixed
        static::assertXmlStringEqualsXmlFile(
            realpath('src/test/resources/test_exception.xml'),
            static::$symfonySerializer->serialize($this->exception, 'xml', [XmlEncoder::ROOT_NODE_NAME => 'exception'])
        );
    }

    #[Test]
    public function deserializeExceptionTest(): void
    {
        /** @var \SimpleXMLElement $exceptionXml */
        $exceptionXml = simplexml_load_string(
            file_get_contents(realpath('src/test/resources/test_exception.xml'))
        );

        /** @var ExceptionApi $deserializedResult */
        $deserializedResult = static::$serializer->deserialize($exceptionXml->asXML(), ExceptionApi::class, 'xml');

        static::assertEquals($this->exception->getCode(), $deserializedResult->code);
        static::assertEquals($this->exception->getMessage(), $deserializedResult->message);

        /** @var ExceptionApi $deserializedResult */
        $deserializedResult = static::$symfonySerializer->deserialize(
            $exceptionXml->asXML(),
            ExceptionApi::class,
            'xml'
        );

        static::assertEquals($this->exception->getCode(), $deserializedResult->code);
        static::assertEquals($this->exception->getMessage(), $deserializedResult->message);
    }
}
