<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class TrackController extends Controller
{
    private $client;
    private $headers;

    public function __construct() {
        $auth_client = new Client();
        $response = $auth_client->request('POST', 'https://accounts.spotify.com/api/token',[
            'auth' => [
                '833dcdbd64d8413a8223980a304a4ad4',
                '0d53ef9b185440698bd44765243eaa2f'
            ],
            'form_params' => [
                'grant_type' => 'client_credentials'
            ]
        ]);
        $data = json_decode($response->getBody()->getContents());
        $this->headers = [
            'Authorization' => 'Bearer ' . $data->access_token,
            'Accept' => 'application/json'
        ];
        $this->client = new Client([
            'base_uri' => 'https://api.spotify.com'
        ]);
    }
    function search($type, $query) {
        $parameters = "?q=$query&type=$type";
        $response = $this->client->request('GET', "v1/search$parameters", [
            'headers' => $this->headers
        ]);
        $data = json_decode($response->getBody()->getContents());
        return response()->json($data);
    }
    function getTrack($id) {
        $response = $this->client->request('GET', "/v1/tracks/$id", [
            'headers' => $this->headers
        ]);
        $data = json_decode($response->getBody()->getContents());
        return response()->json($data);
    }
}
