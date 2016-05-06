# Songkick API client built on top of Guzzle 6

This is currently **under construction**!

I've made this to suit [Tradiio](https://tradiio.com)'s needs, but will probably finish this sometime soon...or maybe not (I dunno yet).

Powered by [Songkick](http://www.songkick.com/)

## Client

```php
// Get API Key here: http://www.songkick.com/developer
$client = new SongkickClient(apiKey);
```

## Artists Search

```php
// http://www.songkick.com/developer/artist-search
// Find artists by name (ex: 'O Quarto Fantasma')
$client->artists->getArtists(artistName);
```

## Artist Calendar

```php
// http://www.songkick.com/developer/upcoming-events-for-artist
// Get Artist calendar (upcoming events)
// You get the artistID by searching the artist getArtists
$client->calendar->getCalendar(artistID);
```

## Pagination

You can grab the next page of results using the client:

```php
$client->nextPage(response['pages']);
```

## Copyleft and License :poop:

Copyleft 2016 (No Fucks are given to what you do with this code)

This project is licensed under the **["THE BEER-WARE LICENSE" (Revision 42)](https://en.wikipedia.org/wiki/Beerware)**.