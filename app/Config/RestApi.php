<?php

namespace Config;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Pool;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;

class RestApi
{
    private $urls = "";
    private $client;

    public function __construct() {
        $this->client = new Client();
    }

    public function findUrls($url) {
        
        $this->urls = '{"url": "'. $url. '"}';
        $body = \GuzzleHttp\Psr7\Utils::streamFor($this->urls);
        $response = $this->client->request( 'POST',
            'http://localhost:3000/findurl',
            ['body' => $body]
        );
        $contents = (string) $response->getBody();
        return $contents;
    }

    public function loadMenu($url) {
        $this->urls = '{"url": "'. $url. '"}';
//        print_r($this->urls);
        $body = \GuzzleHttp\Psr7\Utils::streamFor($this->urls);
        $response = $this->client->request( 'POST',
            'http://localhost:3000/menu',
            ['body' => $body]
        );
        $contents = (string) $response->getBody();
        $contents = str_replace("[", "{\"menu\": [", $contents);
        $contents = str_replace("]", "]}", $contents);
//        print_r(json_decode($contents, true));
//        exit();
        return $contents;
    }
}
