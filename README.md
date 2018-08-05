# Parsing Document Tool API

## Index
* [Run server](#run-server)
* [Unit testing](#unit-testing)
* [Endpoints](#endpoints)

## Run server
`` php bin/console server:run ``

> If you're using a VM, you may need to tell the server to bind to all IP addresses:
>
> `` php bin/console server:start 0.0.0.0:8000 ``

## Unit testing

``php bin/phpunit``

## Endpoints

* <b>/api/v1/info</b> - Displaying information about health status for service.
* <b>/api/v1/parse/{docId}</b> - Parsing uploaded PDF/DOC file and return HTML content