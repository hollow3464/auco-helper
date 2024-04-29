<?php

declare(strict_types=1);

namespace Hollow3464\AucoHelper\Webhook;

enum DocumentStatus: string
{
    case CREATE = 'CREATE';
    case FINISH = 'FINISH';
    case NOTIFICATION = 'NOTIFICATION';
    case REJECT = 'REJECT';
    case BLOCKED = 'BLOCKED';
    case NO_STATUS = '';
}
