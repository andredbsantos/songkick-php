<?php

namespace Songkick;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use function GuzzleHttp\Psr7\stream_for;

class SongkickClient {

  /** @var Client $http_client */
  private $http_client;

  /** @var string API key */
  protected $apiKey;

  /** @var SongkickArtist $users */
  public $artists;

  /** @var SongkickArtist $calendar */
  public $calendar;

  public function __construct($apiKey)
  {
    $this->setDefaultClient();
    $this->artists = new SongkickArtistSearch($this);
    $this->calendar = new SongkickArtistCalendar($this);

    $this->apiKey = $apiKey;
  }

  private function setDefaultClient()
  {
    $this->http_client = new Client();
  }

  public function setClient($client)
  {
    $this->http_client = $client;
  }

  public function get($query)
  {
    if (strpos($query, '?query=') !== false) {
      $response = $this->http_client->request('GET', "http://api.songkick.com/api/3.0/$query&apikey=".$this->getApiKey(), [
        'headers' => [
          'Accept' => 'application/json'
        ]
      ]);
    } else {
      $response = $this->http_client->request('GET', "http://api.songkick.com/api/3.0/$query?apikey=".$this->getApiKey(), [
        'headers' => [
          'Accept' => 'application/json'
        ]
      ]);
    }
    return $this->handleResponse($response);
  }

  public function nextPage($pages)
  {
    $response = $this->http_client->request('GET', $pages['next'], [
      'apikey' => $this->getApiKey(),
      'headers' => [
        'Accept' => 'application/json'
      ]
    ]);
    return $this->handleResponse($response);
  }

  public function getApiKey()
  {
    return $this->apiKey;
  }

  private function handleResponse(Response $response){
    $stream = stream_for($response->getBody());
    $data = json_decode($stream->getContents());
    return $data;
  }
}
