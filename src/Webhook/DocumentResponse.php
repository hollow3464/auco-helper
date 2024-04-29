<?php

declare(strict_types=1);

namespace Hollow3464\AucoHelper\Webhook;

final class DocumentResponse
{
    public function __construct(
        public string $code,
        public string $name,
        public string $url,
        public ?DocumentStatus $status = null,
    ) {}
}
