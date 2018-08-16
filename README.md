# Parsing Document Tool API

[![Build Status](https://travis-ci.org/salamonrafal/pdt-api.svg?branch=production)](https://travis-ci.org/salamonrafal/pdt-api) [![Coverage Status](https://coveralls.io/repos/github/salamonrafal/pdt-api/badge.svg?branch=production)](https://coveralls.io/github/salamonrafal/pdt-api?branch=production) [![Minimum PHP Version](https://img.shields.io/badge/php-%3E%3D%207.1-8892BF.svg?style=flat-square)](https://php.net/)  


## Index
* [Run server](#run-server)
* [Unit testing](#unit-testing)
* [Endpoints](#endpoints)

## Run server
```bash 
    php bin/console server:run 
```

> If you're using a VM, you may need to tell the server to bind to all IP addresses:
>
> ```bash 
>    php bin/console server:start 0.0.0.0:8000 
> ```

## Unit testing

```bash 
    php bin/phpunit 
```

## Endpoints
* **/api/v1/info** - Displaying information about health status for service.
* **/api/v1/convert/{docId}** - Parsing uploaded PDF/DOC file and return HTML content
* **/api/v1/convert** - Uploaded and convert PDF/DOC file and return HTML content
* **/api/v1/upload/** - Upload file on storage