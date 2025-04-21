<?php

declare(strict_types=1);

use Hollow3464\AucoHelper\AucoHelper;

describe("AucoHelperTest", function () {
    $httpFactory = new GuzzleHttp\Psr7\HttpFactory();
    $httpClient = new GuzzleHttp\Client(['http_errors' => false]);

    $handler = new AucoHelper(
        http: $httpClient,
        reqs: $httpFactory,
        streams: $httpFactory,
        pubKey: $_ENV['PUBKEY'],
        prvKey: $_ENV['PRVKEY'],
        devel: false,
    );

    it("should get company", function () use ($handler) {
        $res = $handler->getCompany();
        expect($res)->not()->toBeNull();
    });
});
