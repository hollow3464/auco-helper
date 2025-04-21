<?php

declare(strict_types=1);

namespace Hollow3464\AucoHelper\Document;

use Exception;

final class SignProfilePosition
{
    /** @throws Exception */
    public function __construct(
        public readonly int $page,
        public readonly int $x,
        public readonly int $y,
        public readonly int $w,
        public readonly int $h,
    ) {
        if ($page <= 0) {
            throw new Exception('The page must be at least 1');
        }
    }
}
