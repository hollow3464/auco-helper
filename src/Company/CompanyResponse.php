<?php

declare(strict_types=1);

namespace Hollow3464\AucoHelper\Company;

final class CompanyResponse
{
    public function __construct(
        public string $name,
        public string $image,
        public string $webhook,
        public ?WebhookHeader $webhookHeader,
        public ?UxOptions $uxOptions
    ) {}

    public static function fromJson(string $json): self
    {
        /** @var array{
         *  name: string,
         *  webhook: string,
         *  webhookHeader: string|array{key: string, value: string},
         *  image: string,
         *  uxOptions: array{
         *      primaryColor: string|null,
         *      redirectUrl: string|null,
         *  }|null
         * } $data */
        $data = json_decode($json, true);

        $webhookHeader = null;
        if (!is_string($data['webhookHeader'])) {
            $webhookHeader = new WebhookHeader(
                $data['webhookHeader']['key'],
                $data['webhookHeader']['value']
            );
        }

        $uxOptions = null;
        if (isset($data['uxOptions'])) {
            $uxOptions = new UxOptions(
                $data['uxOptions']['primaryColor'] ?? null,
                $data['uxOptions']['redirectUrl'] ?? null
            );
        }
        return new self(
            name: $data['name'],
            image: $data['image'],
            webhook: $data['webhook'],
            webhookHeader: $webhookHeader,
            uxOptions: $uxOptions
        );
    }
}
