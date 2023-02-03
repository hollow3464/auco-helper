<?php

namespace Hollow3464\AucoHelper;

class WebhookResponse
{
    public function __construct(
        public string $code,
        public string $name,
        public string $status,
        public string $url
    ) {
    }

    public static function fromJson(string $data): static
    {
        $data = json_decode($data);

        return new static(
            $data->code,
            $data->name,
            $data->status,
            $data->url
        );
    }
}
