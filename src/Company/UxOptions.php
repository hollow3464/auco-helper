<?php

declare(strict_types=1);

namespace Hollow3464\AucoHelper\Company;

final class UxOptions
{
    public function __construct(
        public readonly ?string $primaryColor,
        public readonly ?string $redirectUrl,
    ) {}
}
