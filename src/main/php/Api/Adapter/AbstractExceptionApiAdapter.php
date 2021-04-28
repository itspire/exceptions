<?php

/*
 * Copyright (c) 2016 - 2021 Itspire.
 * This software is licensed under the BSD-3-Clause license. (see LICENSE.md for full license)
 * All Right Reserved.
 */

declare(strict_types=1);

namespace Itspire\Exception\Api\Adapter;

use Itspire\Exception\Api\Model\ExceptionApiInterface;
use Itspire\Exception\ExceptionInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

abstract class AbstractExceptionApiAdapter implements ExceptionApiAdapterInterface
{
    public function __construct(protected TranslatorInterface $translator)
    {
    }

    /** @param ExceptionApiInterface|ExceptionInterface $exception */
    final public function supports($exception): bool
    {
        return in_array(get_class($exception), $this->getSupportedClasses(), true);
    }

    /** @param ExceptionApiInterface|ExceptionInterface $exception */
    final protected function checkSupports($exception): void
    {
        $class = get_class($exception);
        if (false === in_array($class, $this->getSupportedClasses(), true)) {
            throw new \InvalidArgumentException(sprintf('Adapter %s does not support %s class', static::class, $class));
        }
    }

    protected function getTranslationDomain(): ?string
    {
        return 'exceptions';
    }

    abstract protected function getSupportedClasses(): array;
}
