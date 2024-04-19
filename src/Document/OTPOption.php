<?php

declare(strict_types=1);

namespace Hollow3464\AucoHelper\Document;

enum OTPOption: string
{
    case SMS = 'sms';
    case WHATSAPP = 'whatsapp';
}
