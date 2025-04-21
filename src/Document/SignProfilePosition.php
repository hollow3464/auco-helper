<?php

declare(strict_types=1);

namespace Hollow3464\AucoHelper\Document;

use Exception;

final readonly class SignProfilePosition
{
    /** @throws Exception */
    public function __construct(
        public int $page,
        public int $x,
        public int $y,
        public int $w,
        public int $h,
    ) {
        if ($page <= 0) {
            throw new Exception('The page must be at least 1');
        }
    }
}
