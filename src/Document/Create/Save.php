<?php

declare(strict_types=1);

namespace Hollow3464\AucoHelper\Document\Create;

use Hollow3464\AucoHelper\Document\Options;

final class Save
{
    /**
     * @param array<string,array<string,string>> $data
     */
    public function __construct(
        public readonly string $document,
        public readonly string $name,
        public readonly string $email,
        public readonly array $data,
        public readonly bool $sign = false,
        public readonly int $remember = 0,
        public readonly ?Options $options = null,
    ) {}
}
