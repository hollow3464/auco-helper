<?php

namespace Hollow3464\AucoHelper\Document;

class SignProfilePosition
{
    public function __construct(
        public readonly int $page,
        public readonly int $x,
        public readonly int $y,
        public readonly int $w,
        public readonly int $h
    )
    {
    }
}