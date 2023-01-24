<?php

namespace Hollow3464\AucoHelper\Document\Create;

use Hollow3464\AucoHelper\Document\Options;
use Hollow3464\AucoHelper\Document\SignProfile;
use Hollow3464\AucoHelper\Document\SignProfileIterator;

class Upload
{
    public function __construct(
        public readonly string   $name,
        public readonly string   $message,
        public readonly string   $subject,
        public readonly string   $email,
        public readonly string   $file,
        public readonly string   $document,
        public readonly string   $folder,
        public readonly SignProfileIterator    $signProfile,
        public readonly ?bool    $camera = null,
        public readonly ?bool    $otpCode = null,
        public readonly ?int     $remember = null,
        public readonly ?Options $options = null,

    )
    {
    }
}