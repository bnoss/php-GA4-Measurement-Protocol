# Google Analytics 4 Measurement Protocol PHP Library
[![Coverage Status](https://coveralls.io/repos/github/br33f/php-GA4-Measurement-Protocol/badge.svg?branch=master)](https://coveralls.io/github/br33f/php-GA4-Measurement-Protocol?branch=master)
[![Latest Stable Version](https://poser.pugx.org/br33f/php-ga4-mp/v/stable.png)](https://packagist.org/packages/br33f/php-ga4-mp)
[![Total Downloads](https://poser.pugx.org/br33f/php-ga4-mp/downloads.png)](https://packagist.org/packages/br33f/php-ga4-mp)
## Overview
This is a PHP Library making it easier to utilize  Google Analytics 4 (GA4) Measurement Protocol. Measurement Protocol allows developers to send events directly from server-side PHP to Google Analytics. 

Please note that GA4 Measurement Protocol is in alpha and might encounter breaking changes. Full documentation is available here:
https://developers.google.com/analytics/devguides/collection/protocol/ga4

## Requirements
- PHP >= 7.1
- ext-json
- guzzlehttp/guzzle: ^6.5.5

dev:
- phpunit/phpunit: "^9.5"
- fakerphp/faker: "^1.14"
- php-coveralls/php-coveralls: "^2.4"

## Installation
The recommended way to install this library is via [Composer](https://getcomposer.org/ "Composer") (packagist package: [br33f/php-ga4-mp](https://packagist.org/packages/br33f/php-ga4-mp "br33f/php-ga4-mp")).

Install by composer command:

```
composer require br33f/php-ga4-mp
```

or `package.json`
```
{
    "require": {
        "br33f/php-ga4-mp": "^0.1.0"
    }
}
```

## Usage

Send View Item Event
```php
use Br33f\Ga4\MeasurementProtocol\Service;
use Br33f\Ga4\MeasurementProtocol\Dto\Request\BaseRequest;
use Br33f\Ga4\MeasurementProtocol\Dto\Event\PurchaseEvent;
use Br33f\Ga4\MeasurementProtocol\Dto\Parameter\ItemParameter;

// Create service instance
$ga4Service = new Service('MEASUREMENT_PROTOCOL_API_SECRET', 'MEASUREMENT_ID");

// Create base request with required client_id
$baseRequest = new BaseRequest('CLIENT_ID');

// Create Event Data
$viewItemEventData = new ViewItemEvent();
$viewItemEventData
    ->setValue(51.10)
    ->setCurrency('EUR');

// Create Item
$viewedItem = new ItemParameter();
$viewedItem
    ->setItemId('ITEM_ID')
    ->setItemName('ITEM_NAME')
    ->setPrice(25.55)
    ->setQuantity(2);
    
// Add this item to viewItemEventData   
$viewItemEventData->addItem($viewedItem)

// Add event to base request (you can add up to 25 events to single request)
$baseRequest->addEvent($viewItemEventData);

// We have all the data we need. Just send the request.
$ga4Service->send($baseRequest);

```

## Setup & Options

## Unit Testing
Unit Testing for this module is done using PHPUnit 9.

Running unit tests:
```
composer install
php vendor/bin/phpunit
```