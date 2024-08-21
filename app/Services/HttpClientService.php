<?php
use GuzzleHttp\Client;

class HttpClientService
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function get($url)
    {
        $response = $this->client->request('GET', $url);
        return json_decode($response->getBody()->getContents(), true);
    }
}
