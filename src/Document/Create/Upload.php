<?php

namespace Hollow3464\AucoHelper\Document\Create;

use Hollow3464\AucoHelper\Document\Options;
use Hollow3464\AucoHelper\Document\SignProfile;
use Hollow3464\AucoHelper\Document\SignProfileIterator;
use JsonSerializable;

class Upload implements JsonSerializable
{
    public function __construct(
        public readonly string   $name,
        public readonly string   $message,
        public readonly string   $subject,
        public readonly string   $email,
        public readonly string   $file,
        public readonly SignProfileIterator    $signProfile,
        public readonly ?string   $document = null,
        public readonly ?string   $folder = null,
        public readonly ?bool    $camera = null,
        public readonly ?bool    $otpCode = null,
        public readonly ?int     $remember = null,
        public readonly ?Options $options = null,

    ) {
    }

    public function jsonSerialize(): array
    {
        $data = [
            'name' => $this->name,
            'message' => $this->message,
            'subject' => $this->subject,
            'email' => $this->email,
            'file' => $this->file,
            'signProfile' => $this->signProfile,    
        ];

        if ($this->document){
            $data['document'] = $this->document;
        }

        if ($this->folder){
            $data['folder'] = $this->folder;
        }
        if ($this->camera){
            $data['camera'] = $this->camera;
        }

        if ($this->otpCode){
            $data['otpCode'] = $this->otpCode;
        }

        if ($this->remember){
            $data['remember'] = $this->remember;
        }

        if ($this->options){
            $data['options'] = $this->options;
        }
        
        return $data;
    }    
}
