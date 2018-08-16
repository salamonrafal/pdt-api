# Parsing Document Tool API

[![Codacy Badge](https://api.codacy.com/project/badge/Grade/d2abd9d9b77f43d4bde561f7c18eb076)](https://app.codacy.com/app/salamonrafal/pdt-api?utm_source=github.com&utm_medium=referral&utm_content=salamonrafal/pdt-api&utm_campaign=badger)
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