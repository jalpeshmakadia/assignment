# Assignment Backend

This project was generated with [Symfony](https://symfony.com/doc/current/index.html) version 6.1.

## Install Dependency

Run `composer install` for install the dependencies and framework bundles.

## Update Database Access

Open `.env` and update your credential in below line.

## Run Below command

Run Below command for migration and load default user into database.
### Create Database
```sh
  php bin/console doctrine:database:create
```
### Load Migration
```sh
  php bin/console doctrine:migrations:migrate
```

### Load Default Data

```sh
  php bin/console doctrine:fixtures:load
```
It will create one dummy user in the database with below email and password.

| Email | Password |
| ------ | ------ |
| admin@example.com | Admin@123 |

### Generate PEM file for JWT authentication. 
  it will generate in `config\jwt\private.pem` and `config\jwt\public.pem`. 
  While generating the private, you will be asked for a passphrase. Enter a strong passphrase and note it somewhere as we will need it later to update the configuration. As an example, we’ll use ThisIsThePassPhrase as our passphrase

```sh
  openssl genrsa -out config/jwt/private.pem -aes256 4096
  openssl rsa -pubout -in config/jwt/private.pem -out config/jwt/public.pem
```
Open `.env` file and configure passphrase to `JWT_PASSPHRASE=ThisIsThePassPhrase` parameter.

## REST API Reference

Get api document.

```http
  GET /api/doc
```

Enjoy