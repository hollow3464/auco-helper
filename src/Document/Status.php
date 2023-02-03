<?php

namespace Hollow3464\AucoHelper\Document;

enum Status: int
{
    case SENT   = 0;
    case CREATE = 1;
    case FINISH = 2;

    public static function fromString(string $status)
    {
        return match ($status) {
            'CREATE' => static::CREATE,
            'FINISH' => static::FINISH,
            default  => static::SENT
        };
    }
}
