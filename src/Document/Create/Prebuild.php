<?php

namespace Hollow3464\AucoHelper\Document\Create;

class Prebuild
{
    public function __construct(
        public readonly string  $document,
        public readonly string  $name,
        public readonly ?string $email = null,
        public readonly ?string $emailTo = null,
        public readonly ?array  $preBuild = null,
        public readonly ?string $parentId = null,
        public readonly ?bool   $sign = null,
        public readonly ?int    $remember = null,
    )
    {
    }
}