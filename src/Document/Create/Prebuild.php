<?php

declare(strict_types=1);

namespace Hollow3464\AucoHelper\Document\Create;

final class Prebuild
{
    /**
     * @param array<string> $preBuild
     */
    public function __construct(
        public readonly string $document,
        public readonly string $name,
        public readonly ?string $email = null,
        public readonly ?string $emailTo = null,
        public readonly ?array $preBuild = null,
        public readonly ?string $parentId = null,
        public readonly ?bool $sign = null,
        public readonly ?int $remember = null,
    ) {}
}
