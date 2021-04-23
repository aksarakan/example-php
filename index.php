<?php
require './vendor/autoload.php';

/**
 * path to file
 */
$path = '';

/**
 * token generated from profile
 */
$token = "";

/**
 * document type 'ktp', 'npwp', 'sim-2019'
 */
$type = 'ktp';

$url = 'https://api.aksarakan.com/document';


if(!$path) {
    throw new Error('path not set');
}

if(!$token) {
    throw new Error('path not set');
}

$client = new \GuzzleHttp\Client();

$response = $client->request('PUT', "$url/$type", [
    'headers' => ['Authentication' => "bearer $token"],
    'multipart' => [
        [
            'name'     => 'file',
            'contents' => fopen($path, 'rb'),
            'filename' => basename($path)
        ],
    ]
]);

var_dump(json_decode($response->getBody()->getContents(), true));