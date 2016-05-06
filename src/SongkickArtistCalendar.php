<?php

namespace Songkick;

use GuzzleHttp\Client;

class SongkickArtistCalendar {
  private $client;

  public function __construct($client)
  {
    $this->client = $client;
  }

  public function getCalendar($artistID)
  {
    return $this->client->get("artists/$artistID/calendar.json");
  }
}
