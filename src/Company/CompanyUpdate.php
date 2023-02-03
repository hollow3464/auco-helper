<?php

namespace Hollow3464\AucoHelper\Company;

final class CompanyUpdate
{
    public function __construct(
        public readonly string $webhook,
        public readonly array  $webhookHeader,
        public readonly string $image,
        public readonly UxOptions  $uxOptions,
    ) {
    }
}
