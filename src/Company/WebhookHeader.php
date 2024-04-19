<?php

declare(strict_types=1);

namespace Hollow3464\AucoHelper\Company;

final class WebhookHeader
{
    public function __construct(
        public readonly string $key,
        public readonly string $value
    ) {}
}
