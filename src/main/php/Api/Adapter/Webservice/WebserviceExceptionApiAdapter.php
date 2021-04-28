<?php

/*
 * Copyright (c) 2016 - 2021 Itspire.
 * This software is licensed under the BSD-3-Clause license. (see LICENSE.md for full license)
 * All Right Reserved.
 */

declare(strict_types=1);

namespace Itspire\Exception\Api\Adapter\Webservice;

use Itspire\Exception\Api\Adapter\AbstractExceptionApiAdapter;
use Itspire\Exception\Api\Model\ExceptionApiInterface;
use Itspire\Exception\Api\Model\Webservice as ApiModel;
use Itspire\Exception\Definition\Webservice\WebserviceExceptionDefinition;
use Itspire\Exception\ExceptionInterface;
use Itspire\Exception\Webservice as BusinessModel;

final class WebserviceExceptionApiAdapter extends AbstractExceptionApiAdapter
{
    public function adaptApiExceptionToBusinessException(ExceptionApiInterface $apiException): ExceptionInterface
    {
        $this->checkSupports($apiException);

        /** @var WebserviceExceptionDefinition $exceptionDefinition */
        $exceptionDefinition = WebserviceExceptionDefinition::fromName($apiException->getCode());

        $details = [];
        foreach ($apiException->getDetails() as $detail) {
            $details[] = $detail;
        }

        return (new BusinessModel\WebserviceException($exceptionDefinition))->setDetails($details);
    }

    public function adaptBusinessExceptionToApiException(ExceptionInterface $businessException): ExceptionApiInterface
    {
        $this->checkSupports($businessException);

        $details = [];
        foreach ($businessException->getDetails() as $detail) {
            $details[] = null !== $this->getTranslationDomain()
                ? $this->translator->trans($detail, [], $this->getTranslationDomain())
                : $detail;
        }

        return (new ApiModel\WebserviceExceptionApi())
            ->setCode($businessException->getExceptionDefinition()->getName())
            ->setMessage(
                null !== $this->getTranslationDomain()
                    ? $this->translator->trans(
                        $businessException->getExceptionDefinition()->getDescription(),
                        [],
                        $this->getTranslationDomain()
                    )
                    : $businessException->getExceptionDefinition()->getDescription()
            )
            ->setDetails($details);
    }

    protected function getSupportedClasses(): array
    {
        return [BusinessModel\WebserviceException::class, ApiModel\WebserviceExceptionApi::class];
    }
}
