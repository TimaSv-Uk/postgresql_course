<?php

namespace App\Services;

use GuzzleHttp\Client;

class PowerBIService
{
    private $clientId;
    private $clientSecret;
    private $tenantId;

    public function __construct()
    {
        $this->clientId = env('POWERBI_CLIENT_ID');
        $this->clientSecret = env('POWERBI_CLIENT_SECRET');
        $this->tenantId = env('POWERBI_TENANT_ID');
    }

    public function getAccessToken()
    {
        $client = new Client();

        $response = $client->post("https://login.microsoftonline.com/{$this->tenantId}/oauth2/v2.0/token", [
            'form_params' => [
                'grant_type' => 'client_credentials',
                'client_id' => $this->clientId,
                'client_secret' => $this->clientSecret,
                'scope' => 'https://analysis.windows.net/powerbi/api/.default',
            ],
        ]);

        $data = json_decode($response->getBody()->getContents());

        return $data->access_token ?? null;
    }
}
