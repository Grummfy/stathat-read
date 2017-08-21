# Stathat read library

[![Build Status](https://travis-ci.org/Grummfy/stathat-read.svg?branch=master)](https://travis-ci.org/Grummfy/stathat-read)

[Stathat](https://www.stathat.com/) is SaaS stat tracking tool.
This small library is here to help read stats from it with PHP.

## Usage

```php
use Grummfy\StatHat;
use Grummfy\Stathat\HTTPAdapter\GuzzleAdapter;
use GuzzleHttp\Client;

$stathatToken = 'ABC123'; // get it from https://www.stathat.com/access

$adapter = new GuzzleAdapter($client);
$stathat = new Grummfy\StatHat($adapter, $stathatToken);
var_dump($stathat->listAllStats());
```

## Install
 
```
composer require grummfy/stathat-read
composer require guzzlehttp/guzzle
```

By default, this library came with an implementation of the AdapterInterface made for [Guzzle](http://docs.guzzlephp.org).
If, for any reason, you don't want to use guzzle, just implements a new AdapterInterface.

## Test

```
vendor/bin/atoum
```
