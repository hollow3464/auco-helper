<?php

namespace Hollow3464\AucoHelper\Document;

class Options
{
    public function __construct(
        public readonly string    $camera,
        public readonly OTPOption $otpCode,
        public readonly bool      $whatsapp,
    )
    {
    }
}