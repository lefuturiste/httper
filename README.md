# Httper

A file_get_contents based, PSR-7 http client.

## Installation

`composer require lefuturiste/httper`

## Usage

```php
//execute a simple GET request to google.com
$client = new Httper\Client();
$response = $client->request("GET", "https://google.com")
```

## Tests

`composer test`

or

`composer run test`

or

`composer run phpunit`