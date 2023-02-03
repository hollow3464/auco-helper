<?php

namespace Hollow3464\AucoHelper\Document;

enum OTPOption: string
{
    case SMS      = 'sms';
    case WHATSAPP = 'whatsapp';
}
