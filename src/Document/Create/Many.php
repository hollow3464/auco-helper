<?php

declare(strict_types=1);

namespace Hollow3464\AucoHelper\Document\Create;

use Hollow3464\AucoHelper\Document\Options;

final class Many
{
    /**
     * @param array<string> $documents
     */
    public function __construct(
        public readonly string $name,
        public readonly string $subject,
        public readonly string $message,
        public readonly array $documents,
        public readonly bool $camera = false,
        public readonly int $remember = 0,
        public readonly ?Options $options = null
    ) {}
}
