<?php

/*
 * Copyright (c) 2016 - 2024 Itspire.
 * This software is licensed under the BSD-3-Clause license. (see LICENSE.md for full license)
 * All Right Reserved.
 */

declare(strict_types=1);

namespace Itspire\Exception\Tests\Api\Model\Webservice;

use Itspire\Exception\Api\Model\Webservice\WebserviceExceptionApi;
use Itspire\Exception\Api\Model\Webservice\WebserviceExceptionApiInterface;
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

class WebserviceExceptionTest extends TestCase
{
    private static ?\Symfony\Component\Serializer\SerializerInterface $symfonySerializer = null;
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

        $this->webserviceException = new WebserviceExceptionApi(
            code: 'TEST',
            message: 'test',
            details: ['Detail1', 'Detail2']
        );
    }

    protected function tearDown(): void
    {
        unset($this->WebserviceException);

        parent::tearDown();
    }

    #[Test]
    public function serializeExceptionTest(): void
    {
        static::assertXmlStringEqualsXmlFile(
            realpath('src/test/resources/test_webservice_exception.xml'),
            static::$serializer->serialize($this->webserviceException, 'xml')
        );

        // see https://github.com/symfony/symfony/issues/51652
        // XmlEncoder::ROOT_NODE_NAME has to be specified here until this issue is fixed
        static::assertXmlStringEqualsXmlFile(
            realpath('src/test/resources/test_webservice_exception.xml'),
            static::$symfonySerializer->serialize(
                $this->webserviceException,
                'xml',
                [XmlEncoder::ROOT_NODE_NAME => 'ws_exception']
            )
        );
    }

    #[Test]
    public function serializeExceptionWithRemovedDetailTest(): void
    {
        $this->webserviceException->setDetails(['Detail1']);

        static::assertXmlStringEqualsXmlFile(
            realpath('src/test/resources/test_webservice_exception_single_detail.xml'),
            static::$serializer->serialize($this->webserviceException, 'xml')
        );

        // see https://github.com/symfony/symfony/issues/51652
        // XmlEncoder::ROOT_NODE_NAME has to be specified here until this issue is fixed
        static::assertXmlStringEqualsXmlFile(
            realpath('src/test/resources/test_webservice_exception_single_detail.xml'),
            static::$symfonySerializer->serialize(
                $this->webserviceException,
                'xml',
                [XmlEncoder::ROOT_NODE_NAME => 'ws_exception']
            )
        );
    }

    #[Test]
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

        static::assertEquals($this->webserviceException->getCode(), $deserializedResult->code);
        static::assertEquals($this->webserviceException->getMessage(), $deserializedResult->message);
        static::assertEquals($this->webserviceException->getDetails(), $deserializedResult->details);

        /** @var WebserviceExceptionApi $deserializedResult */
        $deserializedResult = static::$symfonySerializer->deserialize(
            $webserviceException->asXML(),
            WebserviceExceptionApi::class,
            'xml'
        );

        static::assertEquals($this->webserviceException->getCode(), $deserializedResult->code);
        static::assertEquals($this->webserviceException->getMessage(), $deserializedResult->message);
        static::assertEquals($this->webserviceException->getDetails(), $deserializedResult->details);
    }
}
