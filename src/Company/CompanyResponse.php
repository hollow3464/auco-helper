<?php

namespace Hollow3464\AucoHelper\Company;

class CompanyResponse
{
    public function __construct(
        public string $name,
        public string $webhook,
        public string $webhookHeader,
        public string $image,        
        public UxOptions $uxOptions
    ) {
    }

    public static function fromJson(string $data): static
    {
        $data = json_decode($data);

        return new static(
            $data->name,
            $data->webhook,
            $data->webhookHeader,
            $data->image,            
            new UxOptions(
                $data->uxOptions->primaryColor,
                $data->uxOptions->redirectUrl
            )
        );
    }
}
