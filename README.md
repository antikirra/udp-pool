# Simple UPD Pool for PHP

![Packagist Dependency Version](https://img.shields.io/packagist/dependency-v/antikirra/udp-pool/php)
![Packagist Version](https://img.shields.io/packagist/v/antikirra/udp-pool)

## Install

```console
composer require antikirra/udp-pool:^0.0.2
```

## Basic usage

```php
<?php

require __DIR__ . '/vendor/autoload.php';

$client = new \Antikirra\UdpPool\Client();

$client->add('logs', '127.0.0.1', 9081);
$client->add('stats', '127.0.0.1', 9082);

$client->send('logs', '66.249.65.159 - - [06/Nov/2014:19:10:38 +0600] "GET /news/53f8d72920ba2744fe873ebc.html HTTP/1.1" 404 177 "-" "Mozilla/5.0 (iPhone; CPU iPhone OS 6_0 like Mac OS X) AppleWebKit/536.26 (KHTML, like Gecko) Version/6.0 Mobile/10A5376e Safari/8536.25 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)"')
$client->send('stats', '66.249.65.159;1739716182;1;0;1;0;0')
```
