<?php

declare(strict_types=1);

namespace Hollow3464\AucoHelper\Document;

use JsonSerializable;

final class Options implements JsonSerializable
{
    /**
     * @param  ?string  $camera
     * Este campo acepta los valores identification
     * para indicar que se validará la identidad del
     * firmante con su foto e identificación.
     *
     * @param  ?OTPOption  $otpCode
     * Este campo acepta los valores phone y email.
     * para indicar por qué medio recibirá el código
     * de firmante en caso de enviar otpCode en true.

     * @param  ?bool  $whatsapp
     * Envíe este campo en true si desea que el flujo de
     * firma se desarrolle a través de whatsapp.
     */
    public function __construct(
        public ?string $camera = null,
        public ?OTPOption $otpCode = null,
        public ?bool $whatsapp = null,
    ) {}

    /**
     * @return array<string,mixed>
     */
    public function jsonSerialize(): array
    {
        $out = [];

        if ($this->camera) {
            $out['camera'] = $this->camera;
        }

        if ($this->otpCode) {
            $out['otpCode'] = $this->otpCode->value;
        }

        if ($this->whatsapp) {
            $out['whatsapp'] = $this->whatsapp;
        }

        return $out;
    }
}
