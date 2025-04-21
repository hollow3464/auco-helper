<?php

declare(strict_types=1);

namespace Hollow3464\AucoHelper\Document;

final class SignProfile implements \JsonSerializable
{
    /**
     * @param array<SignProfilePosition> $position
     */
    public function __construct(
        public string $name,
        public string $email,
        public string $phone = '',
        public string $order = '',
        public string $type = '',
        public string $label = '',
        public array $position = [],
    ) {}

    public function jsonSerialize(): mixed
    {
        $out = (array) $this;

        $out = array_filter($out, fn($value) => (bool) $value);

        return $out;
    }
}
