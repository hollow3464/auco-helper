<?php

declare(strict_types=1);

namespace Hollow3464\AucoHelper;

use Hollow3464\AucoHelper\Company\CompanyResponse;
use Hollow3464\AucoHelper\Company\CompanyUpdate;
use Hollow3464\AucoHelper\Document\Create\Many;
use Hollow3464\AucoHelper\Document\Create\Prebuild;
use Hollow3464\AucoHelper\Document\Create\Save;
use Hollow3464\AucoHelper\Document\Create\Upload;
use Hollow3464\AucoHelper\Exceptions\CompanyNotFoundException;
use Hollow3464\AucoHelper\Exceptions\UnauthorizedException;
use Hollow3464\AucoHelper\Exceptions\Messages\UnauthorizedMessage;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamFactoryInterface;

final class AucoHelper
{
    private string $baseUrl;

    public function __construct(
        private readonly ClientInterface $http,
        private readonly RequestFactoryInterface $reqs,
        private readonly StreamFactoryInterface $streams,
        private readonly string $pubKey,
        private readonly string $prvKey,
        bool $devel = true
    ) {
        $this->baseUrl = 'https://api.auco.ai/v1/ext';
        if ($devel) {
            $this->baseUrl = 'https://dev.auco.ai/v1/ext';
        }
    }

    /**
     * Consultar compañía
     *
     * @throws UnauthorizedException
     * @throws CompanyNotFoundException
     * @throws ClientExceptionInterface
     */
    public function getCompany(): CompanyResponse
    {
        $req = $this->withPubKey(
            $this->reqs->createRequest('GET', $this->baseUrl . '/company')
        );

        $res = $this->http->sendRequest($req);

        if ($res->getStatusCode() === 401) {
            $this->handlerUnauthorized($req, $res);
        }

        if ($res->getStatusCode() >= 400) {
            throw new CompanyNotFoundException($req, $res);
        }

        return CompanyResponse::fromJson($res->getBody()->getContents());
    }

    /**
     * Actualizar Compañía
     *
     * @return array{"message":"OK"}|null
     *
     * @throws ClientExceptionInterface
     */
    public function updateCompany(CompanyUpdate $data): ?array
    {
        $res = $this->http->sendRequest(
            $this->withPrivKey(
                $this->reqs->createRequest('PUT', $this->baseUrl . '/company')
                    ->withHeader('Content-type', 'application/json')
                    ->withBody($this->streams->createStream(
                        (string) json_encode($data)
                    ))
            )
        );

        $out = json_decode($res->getBody()->getContents(), true);
        if (!$out) {
            return null;
        }
        if (!is_array($out)) {
            return null;
        }
        if (!isset($out['message'])) {
            return null;
        }

        return $out;
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function documentUpload(Upload $data): ?string
    {
        $res = $this->http->sendRequest(
            $this->withPrivKey(
                $this->reqs->createRequest('POST', $this->baseUrl . '/document/upload')
                    ->withHeader('Content-type', 'application/json')
                    ->withBody($this->streams->createStream((string) json_encode($data)))
            )
        );

        $out = json_decode($res->getBody()->getContents(), true);
        if (!$out) {
            return null;
        }

        if (!is_array($out)) {
            return null;
        }

        return $out['document'] ?? null;
    }

    public function documentSave(Save $data): ?string
    {
        $res = $this->http->sendRequest(
            $this->withPrivKey(
                $this->reqs->createRequest('POST', $this->baseUrl . '/document/save')
                    ->withHeader('Content-type', 'application/json')
                    ->withBody($this->streams->createStream((string) json_encode($data)))
            )
        );

        $out = json_decode($res->getBody()->getContents(), true);

        if (!$out) {
            return null;
        }

        if (!is_array($out)) {
            return null;
        }

        return $out['code'] ?? null;
    }

    public function documentPrebuild(Prebuild $data): ?string
    {
        $res = $this->http->sendRequest(
            $this->withPrivKey(
                $this->reqs->createRequest('POST', $this->baseUrl . '/document/prebuild')
                    ->withHeader('Content-type', 'application/json')
                    ->withBody($this->streams->createStream((string) json_encode($data)))
            )
        );

        $out = json_decode($res->getBody()->getContents(), true);
        if (!$out) {
            return null;
        }
        if (!is_array($out)) {
            return null;
        }

        return $out['document'] ?? null;
    }

    /**
     * @return array<string,mixed>
     * @throws ClientExceptionInterface
     */
    public function documentMany(Many $data): array
    {
        $res = $this->http->sendRequest(
            $this->withPubKey(
                $this->reqs->createRequest('POST', $this->baseUrl . '/document/many')
                    ->withHeader('Content-type', 'application/json')
                    ->withBody($this->streams->createStream((string) json_encode($data)))
            )
        );

        $out = json_decode($res->getBody()->getContents(), true);
        if (!$out) {
            return [];
        }
        if (!is_array($out)) {
            return [];
        }
        return $out['documents'] ?? [];
    }

    /**
     * @return array<string,mixed>|null
     * @throws ClientExceptionInterface
     */
    public function getDocument(string $code): ?array
    {
        $res = $this->http->sendRequest(
            $this->withPubKey(
                $this->reqs->createRequest('GET', $this->baseUrl . '/document?code=' . $code)
            )
        );

        $out = json_decode($res->getBody()->getContents(), true);
        if (!$out) {
            return null;
        }
        if (!is_array($out)) {
            return null;
        }

        return $out;
    }

    /**
     * @return array<string,mixed>
     * @throws ClientExceptionInterface
     */
    public function getCustomDocuments(string $code): array
    {
        $res = $this->http->sendRequest(
            $this->withPubKey(
                $this->reqs->createRequest('GET', $this->baseUrl . '/document?custom=true&code=' . $code)
            )
        );

        $out = json_decode($res->getBody()->getContents(), true);
        if (!$out) {
            return [];
        }
        if (!is_array($out)) {
            return [];
        }

        return $out;
    }

    /**
     * @return array<string,mixed>
     * @throws ClientExceptionInterface
     */
    public function getTemplates(): array
    {
        $res = $this->http->sendRequest(
            $this->withPubKey(
                $this->reqs->createRequest('GET', $this->baseUrl . '/document')
            )
        );

        $out = json_decode($res->getBody()->getContents(), true);
        if (!$out) {
            return [];
        }
        if (!is_array($out)) {
            return [];
        }

        return $out;
    }

    /**
     * @return string
     * @throws ClientExceptionInterface
     */
    public function updateDocumentEmail(string $code, string $email): string
    {
        $res = $this->http->sendRequest(
            $this->withPrivKey(
                $this->reqs->createRequest('PUT', $this->baseUrl . '/document/email')
                    ->withHeader('Content-type', 'application/json')
                    ->withBody($this->streams->createStream((string) json_encode(
                        ['code' => $code, 'email' => $email]
                    )))
            )
        );
        $out = json_decode($res->getBody()->getContents(), true);
        if (!$out) {
            return '';
        }
        if (!is_string($out)) {
            return '';
        }

        return $out;
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function addDocumentApprover(string $custom_document_id, Approver $approver): mixed
    {
        $res = $this->http->sendRequest(
            $this->withPrivKey(
                $this->reqs->createRequest('PUT', $this->baseUrl . '/document/approver')
                    ->withHeader('Content-type', 'application/json')
                    ->withBody($this->streams->createStream((string) json_encode([
                        'documentId' => $custom_document_id,
                        'approver' => $approver,
                    ])))
            )
        );

        return json_decode($res->getBody()->getContents(), true);
    }

    private function withPubKey(RequestInterface $req): RequestInterface
    {
        return $req->withHeader('Authorization', $this->pubKey);
    }

    private function withPrivKey(RequestInterface $req): RequestInterface
    {
        return $req->withHeader('Authorization', $this->prvKey);
    }

    private function handlerUnauthorized(RequestInterface $req, ResponseInterface $res): never
    {
        /** @var array<string,string> */
        $body = json_decode($res->getBody()->getContents(), true);
        throw new UnauthorizedException($req, $res, new UnauthorizedMessage($body['message']));
    }
}
