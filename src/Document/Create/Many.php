<?php

namespace Hollow3464\AucoHelper\Document\Create;

use Hollow3464\AucoHelper\Document\Options;

class Many
{
    public function __construct(
        public readonly string           $name,
        public readonly string           $subject,
        public readonly string           $message,
        public readonly array            $documents,
        public readonly bool             $camera = false,
        public readonly int              $remember = 0,
        public readonly ?Options $options = null
    ) {
    }
}
