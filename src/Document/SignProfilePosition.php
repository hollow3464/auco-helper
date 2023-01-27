<?php

namespace Hollow3464\AucoHelper\Document;

class SignProfilePosition
{
    /** @throws \Exception */
    public function __construct(
        public readonly int $page,
        public readonly int $x,
        public readonly int $y,
        public readonly int $w,
        public readonly int $h
    ) {
        if ($page <= 0) {
            throw new \Exception("The page must be at least 1");
        }
    }
}
