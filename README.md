# Parsing Document Tool API

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