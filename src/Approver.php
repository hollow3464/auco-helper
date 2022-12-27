<?php

namespace Hollow3464\AucoHelper;

class Approver
{
    public readonly int $order;

    public function __construct(
        public readonly string $name,
        public readonly string $email,
        int                    $order
    )
    {
        if ($order < 0) {
            $order = 0;
        }

        $this->order = $order;
    }
}