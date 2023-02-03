<?php

namespace Hollow3464\AucoHelper;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Query;
use GuzzleHttp\Psr7\Uri;
use GuzzleHttp\Psr7\UriResolver as URL;
use Hollow3464\AucoHelper\Company\CompanyResponse;
use Hollow3464\AucoHelper\Company\CompanyUpdate;
use Hollow3464\AucoHelper\Document\Create\Many;
use Hollow3464\AucoHelper\Document\Create\Prebuild;
use Hollow3464\AucoHelper\Document\Create\Save;
use Hollow3464\AucoHelper\Document\Create\Upload;

final class AucoHelper
{
    private Uri $uri;

    public function __construct(
        private readonly Client $client,
        private readonly string $public_key,
        private readonly string $private_key,
        bool                    $devel = false
    ) {
        $uri = match ($devel) {
            true  => "https://dev.auco.ai/v1/ext/",
            false => "https://api.auco.ai/v1/ext/"
        };

        $this->uri = new Uri($uri);
    }

    /**
     * Consultar compañía
     *
     * @throws GuzzleException
     * @throws ClientException
     */
    public function getCompany(): CompanyResponse
    {
        $uri = URL::resolve($this->uri, new Uri('company'));

        $res = $this->client->get($uri, ['headers' => ['Authorization' => $this->public_key]]);

        return CompanyResponse::fromJson($res->getBody());
    }

    /**
     * Actualizar Compañía
     *
     * @return array{"message":"OK"}
     *
     * @throws GuzzleException
     * @throws ClientException
     */
    public function updateCompany(CompanyUpdate $data): ?array
    {
        $uri = URL::resolve($this->uri, new Uri('company'));

        $res = $this->client->put($uri, [
            'body'    => $data,
            'headers' => [
                'Authorization' => $this->private_key,
                'Content-type'  => 'application/json'
            ]
        ]);

        return json_decode($res->getBody(), true);
    }

    /**
     * @throws GuzzleException
     * @throws ClientException
     */
    public function documentUpload(Upload $data): ?string
    {
        $uri = URL::resolve($this->uri, new Uri('document/upload'));

        $res = $this->client->post($uri, [
            'body'    => json_encode($data),
            'headers' => ['Authorization' => $this->private_key, 'Content-type' => 'application/json']
        ]);

        return json_decode($res->getBody(), true)['document'] ?? null;
    }

    /**
     * @throws GuzzleException
     */
    public function documentSave(Save $data): ?string
    {
        $uri = URL::resolve($this->uri, new Uri('document/save'));

        $res = $this->client->post($uri, [
            'body'    => $data,
            'headers' => ['Authorization' => $this->private_key, 'Content-type' => 'application/json']
        ]);

        return json_decode($res->getBody(), true)['code'] ?? null;
    }

    /**
     * @throws GuzzleException
     */
    public function documentPrebuild(Prebuild $data): ?string
    {
        $uri = URL::resolve($this->uri, new Uri('document/prebuild'));

        $res = $this->client->post($uri, [
            'body'    => $data,
            'headers' => ['Authorization' => $this->private_key, 'Content-type' => 'application/json']
        ]);

        return json_decode($res->getBody(), true)['document'] ?? null;
    }

    /**
     * @throws GuzzleException
     */
    public function documentMany(Many $data): array
    {
        $uri = URL::resolve($this->uri, new Uri('document/many'));

        $res = $this->client->post($uri, [
            'body'    => $data,
            'headers' => ['Authorization' => $this->public_key, 'Content-type' => 'application/json']
        ]);

        return json_decode($res->getBody(), true)['documents'] ?? [];
    }

    /**
     * @throws GuzzleException
     */
    public function getDocument(string $code): ?array
    {
        $uri = URL::resolve($this->uri, new Uri('document'))
            ->withQuery(Query::build(['code' => $code]));

        $res = $this->client->get($uri, ['headers' => ['Authorization' => $this->public_key]]);

        return json_decode($res->getBody(), true);
    }

    /**
     * @throws GuzzleException
     */
    public function getCustomDocuments(string $code)
    {
        $uri = URL::resolve($this->uri, new Uri('document'))
            ->withQuery(Query::build(['code' => $code, 'custom' => 'true']));

        $res = $this->client->get($uri, ['headers' => ['Authorization' => $this->public_key]]);

        return json_decode($res->getBody(), true);
    }

    /**
     * @throws GuzzleException
     */
    public function getTemplates()
    {
        $uri = URL::resolve($this->uri, new Uri('document'));

        $res = $this->client->get($uri, ['headers' => ['Authorization' => $this->public_key]]);

        return json_decode($res->getBody(), true);
    }

    /**
     * @throws GuzzleException
     */
    public function updateDocumentEmail(string $code, string $email)
    {
        $uri = URL::resolve($this->uri, new Uri('document/email'));

        $res = $this->client->put($uri, [
            'body'    => ['code' => $code, 'email' => $email],
            'headers' => ['Authorization' => $this->private_key]
        ]);

        return json_decode($res->getBody(), true);
    }

    /**
     * @throws GuzzleException
     */
    public function addDocumentApprover(string $custom_document_id, Approver $approver)
    {
        $uri = URL::resolve($this->uri, new Uri('document/approver'));

        $res = $this->client->put($uri, [
            'body'    => ['documentId' => $custom_document_id, 'approver' => $approver],
            'headers' => ['Authorization' => $this->private_key, 'Content-type' => 'application/json']
        ]);

        return json_decode($res->getBody(), true);
    }
}
