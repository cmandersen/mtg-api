# Magic the Gathering API #

[![Build Status](https://travis-ci.org/cmandersen/mtg-api.png?branch=development)](https://travis-ci.org/cmandersen/mtg-api)

This is my version of a Magic the Gathering [REST](http://en.wikipedia.org/wiki/REST) API, utilizing [MTGJSON](http://mtgjson.com/) for the raw data and [MTGImage](http://mtgimage.com/) for links to the images.

As with all (actual) REST API's, if you add the id of an item to the url ([.../api/v1/cards/1](http://api.cmandersen.com/mtg/v1/cards/1), you will get the item with that specific id.


## Getting the cards ##

**Link**: [.../api/v1/cards](http://api.cmandersen.com/mtg/v1/cards)

### Options ###

| Param    | Function                                      | Accepts    | Default   |
| -------- | --------------------------------------------- |:----------:| ---------:|
| `limit`  | Limits the number of items fetched            | Integer    |      `50` |
| `offset` | Defines the index of where to start fetching  | Integer    |       `0` |
| `type`   | The type of card to search for                | String     |    `null` |
| `begins` | The start of the name of the cards            | String     |    `null` |
| `text`   | A part of text on the cards                   | String     |    `null` |
| `colors` | The color of the cards to fetch               | String     |    `null` |
| `rarity` | The rarity of the cards to fetch              | String     |    `null` |

**Warning**: If you set the limit too high, you query will fail. The maximum limit varies from server to server.


## Getting the planes ##

**Link**: [.../api/v1/planes](http://api.cmandersen.com/mtg/v1/planes)

### Options ###

| Param        | Function                                      | Accepts    | Default   |
| ------------ | --------------------------------------------- |:----------:| ---------:|
| `randomize`  | Randomizes the order of the planes returned   | Integer    |       `0` |
