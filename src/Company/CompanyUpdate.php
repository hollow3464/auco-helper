<?php

namespace Hollow3464\AucoHelper\Company;

use JsonSerializable;

final class CompanyUpdate implements JsonSerializable
{
    public function __construct(
        public readonly ?string     $webhook = null,
        public readonly ?array      $webhookHeader = null,
        public readonly ?string     $image = null,
        public readonly ?UxOptions  $uxOptions = null,
    ) {
    }

    public function jsonSerialize(): object
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

        return (object) $out;
    }
}
