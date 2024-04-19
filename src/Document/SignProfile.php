<?php

declare(strict_types=1);

namespace Hollow3464\AucoHelper\Document;

final class SignProfile
{
    /**
     * @param array<SignProfilePosition> $position
     */
    public function __construct(
        public readonly string $name,
        public readonly string $email,
        public readonly string $phone,
        public readonly array $position,
        public readonly string $order = '',
        public readonly string $type = '',
    ) {}
}
