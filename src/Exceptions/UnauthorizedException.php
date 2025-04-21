<?php

declare(strict_types=1);

namespace Hollow3464\AucoHelper\Exceptions;

use Exception;
use Hollow3464\AucoHelper\Exceptions\Messages\UnauthorizedMessage;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

final class UnauthorizedException extends Exception
{
    public function __construct(
        public readonly RequestInterface $request,
        public readonly ResponseInterface $response,
        public readonly UnauthorizedMessage $responseMessage,
    ) {
        parent::__construct($responseMessage->message);
    }
}
