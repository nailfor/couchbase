# PHP Couchbase client for Laravel

Couchbase client for Eloquent ORM

## Features
All models are inherited from Illuminate\Database\Eloquent\Model so most methods work natively

## Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
composer require nailfor/couchbase
```
or add

```json
"nailfor/couchbase" : "*"
```
to the require section of your application's `composer.json` file.

## Configure

Add config/app.php

```php
    'providers' => [
        ...
        nailfor\Couchbase\CouchbaseServiceProvider::class,

```
and config/database.php
```php
    'connections' => [
        ...
        'couchbase' => [ //the name of connection in your models(default)
            'driver' => 'couchbase',
            'username' => 'username',
            'password' => 'password',
        ],

```

## Credits

- [nailfor](https://github.com/nailfor)

License
-------

The GNU License (GNU). Please see [License File](LICENSE.md) for more information.
