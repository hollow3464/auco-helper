<?php

use Psr\Http\Message\ServerRequestInterface;
use React\Http\HttpServer;
use React\Socket\SocketServer;

function initServer(): void
{
    $socket = new SocketServer('0.0.0.0:8000');
    $server = new HttpServer(function (ServerRequestInterface $req) {
        $body = null;

        if ($req->getHeader('content-type') == 'application/json') {
            $body = json_decode($req->getBody());
        } else {
            $body = $req->getParsedBody();
        }

        return \React\Http\Message\Response::json([
            'uri'     => $req->getUri(),
            'query'   => $req->getQueryParams(),
            'body'    => $body,
            'headers' => $req->getHeaders()
        ]);
    });

    $server->listen($socket);
}

$helper = new \Hollow3464\AucoHelper\AucoHelper(
    new GuzzleHttp\Client(),
    'localhost:8000',
    'public_key',
    'private_key'
);

$sample_upload = null;
