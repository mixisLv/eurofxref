# Euro foreign exchange reference rates

[![Project Status: WIP - Initial development is in progress, but there has not yet been a stable, usable release suitable for the public.](https://www.repostatus.org/badges/latest/wip.svg)](https://www.repostatus.org/#wip)

The reference rates are usually updated by 15:00 CET on every working day, except on TARGET closing days. They are based on a regular daily concertation procedure between central banks across Europe and worldwide, which normally takes place at 14:15 CET. 
[see more](https://www.ecb.europa.eu/stats/exchange/eurofxref/html/index.en.html)

## Requirements

The following PHP extension is required:

* PHP >= 5.4.0
* option allow_url_fopen=On (default)
* libxml

## Installing 

You can install eurofxref via Composer with:

    composer require "mixislv/eurofxref" "^1.0"
    
Or by adding the following to your composer.json:
    
    "require": {
        "mixislv/eurofxref": "^1.0"
    }

## Usage

```php
use mixisLv\eurofxref\Ecb;

$ecb  = new Ecb();

var_dump($ecb->rates->single("USD"));
```

Check out [examples directory](/examples) for usage examples
