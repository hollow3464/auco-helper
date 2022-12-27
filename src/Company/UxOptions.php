<?php

namespace Hollow3464\AucoHelper\Company;

class UxOptions
{
    public function __construct(
        public readonly string $primaryColor,
        public readonly string $redirectUrl
    )
    {
    }
}