<?php

declare(strict_types=1);

namespace Hollow3464\AucoHelper\Company;

use JsonSerializable;

final class CompanyUpdate implements JsonSerializable
{
    public function __construct(
        public readonly ?string $image = null,
        public readonly ?string $webhook = null,
        public readonly ?WebhookHeader $webhookHeader = null,
        public readonly ?UxOptions $uxOptions = null,
    ) {}

    public function jsonSerialize(): mixed
    {
        $out = [];

        if ($this->webhook) {
            $out['webhook'] = $this->webhook;
        }

        if ($this->image) {
            $out['image'] = $this->image;
        }

        if ($this->uxOptions) {
            $out['uxOptions'] = $this->uxOptions;
        }

        if ($this->webhookHeader) {
            $out['webhookHeader'] = $this->webhookHeader;
        }

        return $out;
    }
}
