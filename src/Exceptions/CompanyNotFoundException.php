<?php

declare(strict_types=1);

namespace Hollow3464\AucoHelper\Exceptions;

use Exception;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

final class CompanyNotFoundException extends Exception
{
    public function __construct(
        public readonly RequestInterface $request,
        public readonly ResponseInterface $response
    ) {
        parent::__construct('Company not found');
    }
}
