<?php

/*
 * Copyright (c) 2016 - 2024 Itspire.
 * This software is licensed under the BSD-3-Clause license. (see LICENSE.md for full license)
 * All Right Reserved.
 */

declare(strict_types=1);

namespace Itspire\Exception\Adapter\Test\Unit\Webservice;

use Itspire\Exception\Api\Adapter\ExceptionApiAdapterInterface;
use Itspire\Exception\Api\Adapter\Webservice\WebserviceExceptionApiAdapter;
use Itspire\Exception\Api\Model as ApiModel;
use Itspire\Exception\Api\Model\Webservice as ApiWebserviceModel;
use Itspire\Exception\Definition\Http\HttpExceptionDefinition;
use Itspire\Exception\Definition\Webservice\WebserviceExceptionDefinition;
use Itspire\Exception\Http\HttpException;
use Itspire\Exception\ExceptionInterface;
use Itspire\Exception\Webservice as BusinessModel;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Translation\Loader\YamlFileLoader;
use Symfony\Component\Translation\Translator;
use Symfony\Contracts\Translation\TranslatorInterface;

class WebserviceExceptionApiAdapterTest extends TestCase
{
    private static ?TranslatorInterface $translator = null;
    private ?ExceptionApiAdapterInterface $webserviceExceptionAdapter = null;
    private ?ExceptionInterface $businessWebserviceException = null;
    private ?ApiWebserviceModel\WebserviceExceptionApiInterface $apiWebserviceException = null;

    public static function setUpBeforeClass(): void
    {
        if (null === self::$translator) {
            self::$translator = new Translator('en');
            self::$translator->addLoader('yml', new YamlFileLoader());

            $finder = new Finder();
            $finder->files()->in([
                realpath('src/main/resources/translations'),
                realpath('src/test/resources/translations')
            ]);

            foreach ($finder as $file) {
                $fileNameParts = explode('.', $file->getFilename());
                self::$translator->addResource('yml', $file->getRealPath(), $fileNameParts[1], $fileNameParts[0]);
            }
        }
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->businessWebserviceException = new BusinessModel\WebserviceException(
            WebserviceExceptionDefinition::VALIDATION,
            []
        );

        $this->apiWebserviceException = (new ApiWebserviceModel\WebserviceExceptionApi())
            ->setCode(WebserviceExceptionDefinition::VALIDATION->name)
            ->setMessage('The validation of the submitted data failed.');

        $this->webserviceExceptionAdapter = new WebserviceExceptionApiAdapter(self::$translator);
    }

    protected function tearDown(): void
    {
        unset($this->webserviceExceptionAdapter, $this->businessWebserviceException, $this->apiWebserviceException);

        parent::tearDown();
    }

    #[Test]
    public function supportsTest(): void
    {
        static::assertFalse($this->webserviceExceptionAdapter->supports(new ApiModel\ExceptionApi()));

        static::assertTrue(
            $this->webserviceExceptionAdapter->supports(new ApiWebserviceModel\WebserviceExceptionApi())
        );
    }

    #[Test]
    public function adaptBusinessToApiWithUnsupportedClassTest(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage(
            sprintf('Adapter %s does not support %s class', WebserviceExceptionApiAdapter::class, HttpException::class)
        );

        $this->webserviceExceptionAdapter->adaptBusinessExceptionToApiException(
            new HttpException(HttpExceptionDefinition::HTTP_LOCKED)
        );
    }

    #[Test]
    public function adaptBusinessToApiTest(): void
    {
        static::assertEquals(
            $this->apiWebserviceException,
            $this->webserviceExceptionAdapter->adaptBusinessExceptionToApiException($this->businessWebserviceException)
        );
    }

    #[Test]
    public function adaptBusinessToApiWithDetailsTest(): void
    {
        $this->businessWebserviceException = new BusinessModel\WebserviceException(
            WebserviceExceptionDefinition::VALIDATION,
            ['itspire.exceptions.details.testDetails1', 'itspire.exceptions.details.testDetails2']
        );

        $this->apiWebserviceException->setDetails(['My first detailed information', 'My second detailed information']);

        static::assertEquals(
            $this->apiWebserviceException,
            $this->webserviceExceptionAdapter->adaptBusinessExceptionToApiException($this->businessWebserviceException)
        );
    }

    #[Test]
    public function adaptApiToBusinessWithUnsupportedClassTest(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage(sprintf(
            'Adapter %s does not support %s class',
            WebserviceExceptionApiAdapter::class,
            ApiModel\ExceptionApi::class
        ));

        $this->webserviceExceptionAdapter->adaptApiExceptionToBusinessException(new ApiModel\ExceptionApi());
    }

    #[Test]
    public function adaptApiToBusinessTest(): void
    {
        $businessWebserviceException = $this->webserviceExceptionAdapter->adaptApiExceptionToBusinessException(
            $this->apiWebserviceException
        );

        static::assertEquals(
            $this->businessWebserviceException->getExceptionDefinition()->name,
            $businessWebserviceException->getExceptionDefinition()->name
        );

        static::assertEquals($this->apiWebserviceException->getDetails(), $businessWebserviceException->getDetails());
    }

    #[Test]
    public function adaptApiToBusinessWithDetailsTest(): void
    {
        $this->apiWebserviceException->setDetails(['detail1', 'detail2']);

        $businessWebserviceException = $this->webserviceExceptionAdapter->adaptApiExceptionToBusinessException(
            $this->apiWebserviceException
        );

        static::assertEquals($this->apiWebserviceException->getDetails(), $businessWebserviceException->getDetails());
    }
}
