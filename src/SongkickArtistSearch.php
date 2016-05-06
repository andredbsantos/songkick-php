<?php

namespace Songkick;

use GuzzleHttp\Client;

class SongkickArtistSearch {
  private $client;

  public function __construct($client)
  {
    $this->client = $client;
  }

  public function getArtists($artistName)
  {
    return $this->client->get("search/artists.json?query=$artistName");
  }

}