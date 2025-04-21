<?php

declare(strict_types=1);

namespace Hollow3464\AucoHelper\Exceptions\Messages;

final class UnauthorizedMessage
{
    public function __construct(
        public readonly string $message,
    ) {}
}
