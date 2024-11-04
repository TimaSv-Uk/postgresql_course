<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Request;

class PowerBIController extends Controller
{
    private $clientId;
    private $clientSecret;
    private $tenantId;

    public function __construct()
    {
        $this->clientId =  env('POWER_BI_CLIENT_ID');
        $this->clientSecret = env('POWERBI_CLIENT_SECRET_VALUE');
        $this->tenantId =env("POWERBI_TENANT_ID");
        }
    public function getAccessToken(Request $request)
    {
        $client = new Client();

        try {
            $response = $client->post(
                "https://login.windows.net/{$this->tenantId}/oauth2/token",
                [
                    'headers' => [
                        'Accept' => 'application/json',
                    ],
                    'form_params' => [
                        'resource' => 'https://analysis.windows.net/powerbi/api',
                        'client_id' => $this->clientId,
                        'client_secret' => $this->clientSecret,
                        'scope' => 'openid',
                    ],
                ]
            );

            $body = json_decode($response->getBody()->getContents(), true);
            return $body['access_token'];
        } catch (ClientException $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function pushDataToPowerBI(Request $request)
    {
        $token = $this->getAccessToken($request);

        $client = new Client();

        $data = $request->input('data'); // Your data to send

        try {
            $client->post(
                "https://api.powerbi.com/v1.0/myorg/groups/<group-id>/datasets/<dataset-id>/tables/<table-name>/rows",
                [
                    'headers' => [
                        'Accept' => 'application/json',
                        'Authorization' => sprintf('Bearer %s', $token),
                    ],
                    'json' => $data,
                ]
            );

            return response()->json(['success' => true]);
        } catch (ClientException $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
