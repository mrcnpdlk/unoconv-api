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
use Monolog\Handler\ErrorLogHandler;
use Psr\Log\LogLevel;

require __DIR__ . '/../vendor/autoload.php';

// Logger instance
$logger = new \Monolog\Logger('unoconv-api');
$logger->pushHandler(new ErrorLogHandler(ErrorLogHandler::OPERATING_SYSTEM, LogLevel::DEBUG));

// Set default value for handler
$oConfig = new \Mrcnpdlk\Api\Unoconv\Config([
    'binary' => '/usr/bin/unoconv',
    'logger' => $logger,
    'timeout'=> 300
]);
$oApi    = new \Mrcnpdlk\Api\Unoconv\Api($oConfig);
```

### Config option

| Property     | Default value                     | Type            | Description                                                  |
| ------------ | --------------------------------- | --------------- | ------------------------------------------------------------ |
| `binary`     | `/usr/bin/unoconv`                | string          | executable `unoconv` library                                 |
| `host`       | `localhost`                       | string          | Host where libreoffice server is listen                      |
| `port`       | `2002`                            | int             | Port where libreoffice server is listen                      |
| `docType`    | `DocType::DOCUMENT()`             | DocType         | Document type                                                |
| `format`     | `FormatType::PDF()`               | FormatType      | Output format                                                |
| `timeout`    | `60`                              | int             | Connection timeout                                           |
| `options`    | `urp;StarOffice.ComponentContext` | string          | Connection option                                            |
| `logger`     | `NullLogger` instance             | LoggerInterface | Logger                                                       |
| `webservice` | `http://localhost:3000`           | string          | External WebService url, [see](https://github.com/zrrrzzt/docker-unoconv-webservice) |

Detailed documentation you can find [here](https://linux.die.net/man/1/unoconv).

### Create document

```php
$res     = $oApi->transcode($sourceFile, $format, $destination, $exportOpts);
var_dump($res);
```

Parameters `transcode` method:

| Parameter     | Type                | Description                                                  |
| ------------- | ------------------- | ------------------------------------------------------------ |
| `sourceFile`  | `string`            | Valid path of input file. Otherwise `InvalidFileArgumentException` is thrown. |
| `format`      | `FormatType`\|`NULL` | If `NULL` default value form Config object is taken.         |
| `destination` | `string`\|`NULL`     | If `NULL` directory of input file and default extension for Format is taken. If `sourceFile` is valid directory path then output file is saved into this directory. |
| `exportOpts` | `array` | Array of export options. See [the list](https://github.com/unoconv/unoconv/blob/master/doc/filters.adoc) |

Example:

```php
$oApi    = new \Mrcnpdlk\Api\Unoconv\Api($oConfig);

$from = __DIR__ . '/../devel/test.docx';
$res  = $oApi->transcode($from, null, __DIR__, [
    ExportType::PageRange              => '1-1', // page range (string)
    ExportType::Watermark              => 'FOO bar BAZ', // watermark text (string)
    ExportType::Printing               => 0, // printing permission (int)
    ExportType::RestrictPermissions    => true, // restrict permission (bool)
    ExportType::PermissionPassword     => 'password1',
    ExportType::EnableCopyingOfContent => false, // copy permission (bool)
    ExportType::Changes                => 0, // changes permission (int)
    ExportType::DocumentOpenPassword   => 'password2', // password to open file (string)
]);
var_dump($res);
```

## Webservice

Api supports dockerized unoconv webservice for generating simple PDF file.

To start container write`docker-compose.yml` and just `docker-compose up -d`

```
version: "3.7"
services:
  app:
    image: zrrrzzt/docker-unoconv-webservice:10.14.0
    ports:
      - 3000:3000
    environment:
      - PAYLOAD_MAX_SIZE=5242880
    restart: unless-stopped
```

```php
$res     = $oApi->wsGetPdf($sourceFile, $destination);
var_dump($res);
```



## License

Released under the MIT license
