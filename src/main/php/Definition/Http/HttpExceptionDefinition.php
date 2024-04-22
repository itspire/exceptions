<?php

/*
 * Copyright (c) 2016 - 2024 Itspire.
 * This software is licensed under the BSD-3-Clause license. (see LICENSE.md for full license)
 * All Right Reserved.
 */

declare(strict_types=1);

namespace Itspire\Exception\Definition\Http;

use Itspire\Common\Enum\ExtendedBackedEnumTrait;
use Itspire\Exception\Definition\ExceptionDefinitionInterface;

enum HttpExceptionDefinition: int implements ExceptionDefinitionInterface
{
    use ExtendedBackedEnumTrait;

    // 4XX Client Errors
    case HTTP_BAD_REQUEST = 400;
    case HTTP_UNAUTHORIZED = 401;
    case HTTP_PAYMENT_REQUIRED = 402;
    case HTTP_FORBIDDEN = 403;
    case HTTP_NOT_FOUND = 404;
    case HTTP_METHOD_NOT_ALLOWED = 405;
    case HTTP_NOT_ACCEPTABLE = 406;
    case HTTP_PROXY_AUTHENTICATION_REQUIRED = 407;
    case HTTP_REQUEST_TIMEOUT = 408;
    case HTTP_CONFLICT = 409;
    case HTTP_GONE = 410;
    case HTTP_LENGTH_REQUIRED = 411;
    case HTTP_PRECONDITION_FAILED = 412;
    case HTTP_REQUEST_ENTITY_TOO_LARGE = 413;
    case HTTP_REQUEST_URI_TOO_LONG = 414;
    case HTTP_UNSUPPORTED_MEDIA_TYPE = 415;
    case HTTP_REQUESTED_RANGE_NOT_SATISFIABLE = 416;
    case HTTP_EXPECTATION_FAILED = 417;
    case HTTP_I_AM_A_TEAPOT = 418; // RFC2324
    case HTTP_MISDIRECTED_REQUEST = 421; // RFC7540
    case HTTP_NON_PROCESSABLE_ENTITY = 422; // RFC4918
    case HTTP_LOCKED = 423; // RFC4918
    case HTTP_FAILED_DEPENDENCY = 424; // RFC4918
    case HTTP_UNORDERED_COLLECTION = 425; // RFC3648
    case HTTP_UPGRADE_REQUIRED = 426; // RFC2817
    case HTTP_PRECONDITION_REQUIRED = 428; // RFC6585
    case HTTP_TOO_MANY_REQUESTS = 429; // RFC6585
    case HTTP_REQUEST_HEADER_FIELDS_TOO_LARGE = 431; // RFC6585
    case HTTP_UNAVAILABLE_FOR_LEGAL_REASONS = 451; // RFC7725

    // 5XX Server Errors
    case HTTP_INTERNAL_SERVER_ERROR = 500;
    case HTTP_NOT_IMPLEMENTED = 501;
    case HTTP_BAD_GATEWAY = 502;
    case HTTP_SERVICE_UNAVAILABLE = 503;
    case HTTP_GATEWAY_TIMEOUT = 504;
    case HTTP_VERSION_NOT_SUPPORTED = 505;
    case HTTP_VARIANT_ALSO_NEGOTIATES = 506; // RFC2295
    case HTTP_INSUFFICIENT_STORAGE = 507; // RFC4918
    case HTTP_LOOP_DETECTED = 508; // RFC5842
    case HTTP_NOT_EXTENDED = 510; // RFC2774
    case HTTP_NETWORK_AUTHENTICATION_REQUIRED = 511; // RFC6585

    public static function getAllDescriptions(): array
    {
        return [
            self::HTTP_BAD_REQUEST->name => 'Bad Request',
            self::HTTP_UNAUTHORIZED->name => 'Unauthorized',
            self::HTTP_PAYMENT_REQUIRED->name => 'Payment Required',
            self::HTTP_FORBIDDEN->name => 'Forbidden',
            self::HTTP_NOT_FOUND->name => 'Not Found',
            self::HTTP_METHOD_NOT_ALLOWED->name => 'Method Not Allowed',
            self::HTTP_NOT_ACCEPTABLE->name => 'Not Acceptable',
            self::HTTP_PROXY_AUTHENTICATION_REQUIRED->name => 'Proxy Authentication Required',
            self::HTTP_REQUEST_TIMEOUT->name => 'Request Timeout',
            self::HTTP_CONFLICT->name => 'Conflict',
            self::HTTP_GONE->name => 'Gone',
            self::HTTP_LENGTH_REQUIRED->name => 'Length Required',
            self::HTTP_PRECONDITION_FAILED->name => 'Precondition Failed',
            self::HTTP_REQUEST_ENTITY_TOO_LARGE->name => 'Request Entity Too Large',
            self::HTTP_REQUEST_URI_TOO_LONG->name => 'Request-URI Too Large',
            self::HTTP_UNSUPPORTED_MEDIA_TYPE->name => 'Unsupported Media Type',
            self::HTTP_REQUESTED_RANGE_NOT_SATISFIABLE->name => 'Requested range not satisfiable',
            self::HTTP_EXPECTATION_FAILED->name => 'Expectation Failed',
            self::HTTP_I_AM_A_TEAPOT->name => 'I\'m a teapot',
            self::HTTP_MISDIRECTED_REQUEST->name => 'Misdirected Request',
            self::HTTP_NON_PROCESSABLE_ENTITY->name => 'Unprocessable Entity',
            self::HTTP_LOCKED->name => 'Locked',
            self::HTTP_FAILED_DEPENDENCY->name => 'Failed Dependency',
            self::HTTP_UNORDERED_COLLECTION->name => 'Unordered Collection',
            self::HTTP_UPGRADE_REQUIRED->name => 'Upgrade Required',
            self::HTTP_PRECONDITION_REQUIRED->name => 'Precondition Required',
            self::HTTP_TOO_MANY_REQUESTS->name => 'Too Many Requests',
            self::HTTP_REQUEST_HEADER_FIELDS_TOO_LARGE->name => 'Request Header Fields Too Large',
            self::HTTP_UNAVAILABLE_FOR_LEGAL_REASONS->name => 'Unavailable For Legal Reasons',
            self::HTTP_INTERNAL_SERVER_ERROR->name => 'Internal Server Error',
            self::HTTP_NOT_IMPLEMENTED->name => 'Not Implemented',
            self::HTTP_BAD_GATEWAY->name => 'Bad Gateway',
            self::HTTP_SERVICE_UNAVAILABLE->name => 'Service Unavailable',
            self::HTTP_GATEWAY_TIMEOUT->name => 'Gateway Timeout',
            self::HTTP_VERSION_NOT_SUPPORTED->name => 'HTTP Version not supported',
            self::HTTP_VARIANT_ALSO_NEGOTIATES->name => 'Variant Also Negotiates',
            self::HTTP_INSUFFICIENT_STORAGE->name => 'Insufficient Storage',
            self::HTTP_LOOP_DETECTED->name => 'Loop Detected',
            self::HTTP_NOT_EXTENDED->name => 'Not Extended',
            self::HTTP_NETWORK_AUTHENTICATION_REQUIRED->name => 'Network Authentication Required',
        ];
    }
}
