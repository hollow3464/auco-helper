<?php

declare(strict_types=1);

namespace Hollow3464\AucoHelper\Webhook;

final class Response
{
    public function __construct(
        public string $code,
        public string $name,
        public string $url,
        public DocumentStatus $status,
    ) {}
}
