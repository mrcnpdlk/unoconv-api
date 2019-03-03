[![Latest Stable Version](https://img.shields.io/github/release/mrcnpdlk/unoconv-api.svg)](https://packagist.org/packages/mrcnpdlk/unoconv-api)
[![Latest Unstable Version](https://poser.pugx.org/mrcnpdlk/unoconv-api/v/unstable.png)](https://packagist.org/packages/mrcnpdlk/unoconv-api)
[![Total Downloads](https://img.shields.io/packagist/dt/mrcnpdlk/unoconv-api.svg)](https://packagist.org/packages/mrcnpdlk/unoconv-api)
[![Monthly Downloads](https://img.shields.io/packagist/dm/mrcnpdlk/unoconv-api.svg)](https://packagist.org/packages/mrcnpdlk/unoconv-api)
[![License](https://img.shields.io/packagist/l/mrcnpdlk/unoconv-api.svg)](https://packagist.org/packages/mrcnpdlk/unoconv-api)    

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/mrcnpdlk/unoconv-api/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/mrcnpdlk/unoconv-api/?branch=master) 
[![Build Status](https://scrutinizer-ci.com/g/mrcnpdlk/unoconv-api/badges/build.png?b=master)](https://scrutinizer-ci.com/g/mrcnpdlk/unoconv-api/build-status/master)
[![Code Coverage](https://scrutinizer-ci.com/g/mrcnpdlk/unoconv-api/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/mrcnpdlk/unoconv-api/?branch=master)

[![Code Climate](https://codeclimate.com/github/mrcnpdlk/unoconv-api/badges/gpa.svg)](https://codeclimate.com/github/mrcnpdlk/unoconv-api) 
[![Issue Count](https://codeclimate.com/github/mrcnpdlk/unoconv-api/badges/issue_count.svg)](https://codeclimate.com/github/mrcnpdlk/unoconv-api)


[![Build Status](https://travis-ci.com/mrcnpdlk/unoconv-api.svg?branch=master)](https://travis-ci.com/mrcnpdlk/unoconv-api)

# Unoconv API

This API is object oriented PHP overlay for `unoconv` binary.

## Installation

Install `unoconv` and required libraries

```bash
sudo apt-get install unoconv
```

Install the latest version with [composer](https://packagist.org/packages/mrcnpdlk/unoconv-api)
```bash
composer require mrcnpdlk/unoconv-api
```

## Basic usage

```php
<?php

require __DIR__ . '/../vendor/autoload.php';

// Set default value for handler
$oConfig = new \Mrcnpdlk\Api\Unoconv\Config([
    'binary' => '/usr/bin/unoconv'
]);
$oApi    = new \Mrcnpdlk\Api\Unoconv\Api($oConfig);
```

### Config option

| Property  | Default value                     | Type            | Description                             |
| --------- | --------------------------------- | --------------- | --------------------------------------- |
| `binary`  | `/usr/bin/unoconv`                | string          | executable `unoconv` library            |
| `host`    | `localhost`                       | string          | Host where libreoffice server is listen |
| `port`    | `2002`                            | int             | Port where libreoffice server is listen |
| `docType` | `DocType::DOCUMENT()`             | DocType         | Document type                           |
| `format`  | `FormatType::PDF()`               | FormatType      | Output format                           |
| `timeout` | `60`                              | int             | Connection timeout                      |
| `options` | `urp;StarOffice.ComponentContext` | string          | Connection option                       |
| `logger`  | `NullLogger` instance             | LoggerInterface | Logger                                  |

Detailed documentation you can find [here](https://linux.die.net/man/1/unoconv).

### Create document

```php
$res     = $oApi->transcode($from, $format, $output);
var_dump($res);
```

Parameters:

| Parameter | Type                | Description                                                  |
| --------- | ------------------- | ------------------------------------------------------------ |
| `from`    | `string`            | Valid path of input file. Otherwise `InvalidFileArgumentException` is thrown. |
| `format`  | `FormatType`|`NULL` | If `NULL` default value form Config object is taken.         |
| `to`      | `string`|`NULL`     | If `NULL` directory of input file and default extension for Format is taken. If `to` is valid directory path then output file is saved into this directory. |

## License

Released under the MIT license