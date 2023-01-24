<?php

namespace Hollow3464\AucoHelper\Document;

class SignProfile
{

    public function __construct(
        public readonly string                      $name,
        public readonly string                      $email,
        public readonly string                      $phone,
        public readonly string                      $order,
        public readonly string                      $type,
        public readonly SignProfilePositionIterator $position,
    )
    {
    }
}