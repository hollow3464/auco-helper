<?php

require __DIR__ . '/vendor/autoload.php';

use Psr\Http\Message\ServerRequestInterface;
use React\Http\HttpServer;
use React\Socket\SocketServer;

$socket = new SocketServer('0.0.0.0:8000');

$server = new HttpServer(function (ServerRequestInterface $req) {
    $body = $req->getParsedBody();

    if ($req->getHeader('Content-Type') == 'application/json') {
        $body = json_decode($req->getBody());
    }

    echo "path: " . $req->getUri()->getPath() . PHP_EOL;

    return \React\Http\Message\Response::json([
        'uri' => (string)$req->getUri(),
        'path' => $req->getUri()->getPath(),
        'query' => $req->getQueryParams(),
        'body' => $body,
        'headers' => $req->getHeaders()
    ]);
});

$socket->on('connection', function (React\Socket\ConnectionInterface $connection) {
    echo 'Plaintext connection from ' . $connection->getRemoteAddress() . PHP_EOL;
});

$socket->on('error', function (Exception $e) {
    echo 'error: ' . $e->getMessage() . PHP_EOL;
});

$server->listen($socket);
