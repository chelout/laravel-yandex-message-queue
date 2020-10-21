# Laravel Yandex Message Queue

[![Latest Version on Packagist](https://img.shields.io/packagist/v/chelout/laravel-yandex-message-queue.svg?style=flat-square)](https://packagist.org/packages/chelout/laravel-yandex-message-queue)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/chelout/laravel-yandex-message-queue/run-tests?label=tests)](https://github.com/chelout/laravel-yandex-message-queue/actions?query=workflow%3Arun-tests+branch%3Amaster)
[![Total Downloads](https://img.shields.io/packagist/dt/chelout/laravel-yandex-message-queue.svg?style=flat-square)](https://packagist.org/packages/chelout/laravel-yandex-message-queue)

Этот модуль расширяет стандартную реализацию работы с очередями SQS и сделан специально для работы с реализацией SQS от команды [Яндекс.Облако](https://cloud.yandex.ru/services/message-queue).

Главный недостаток реализации SQS со стороны Яндекс.Облако - непереносимость между средами, названия очередей содержат их идентификатор, например, вместо стандартного названия очереди `default` в Яндекс.Облаке такая очередь будет называться `dj6000000002a9pq22in/default`

## Installation

You can install the package via composer:

```bash
composer require chelout/laravel-yandex-message-queue
```

В файле `config/queue.php` необходимо описать соединение, которое будет использоваться: 

```php
<?php

return [
    // ...

    'connections' => [
        // ...

        'ymq' => [
            'driver'    => 'ymq',
            'key'       => env('YANDEX_MESSAGE_QUEUE_KEY'),
            'secret'    => env('YANDEX_MESSAGE_QUEUE_SECRET'),
            'prefix'    => env('YANDEX_MESSAGE_QUEUE_PREFIX', 'https://message-queue.api.cloud.yandex.net/your-account-id'),
            'queue'     => env('YANDEX_MESSAGE_QUEUE_QUEUE', 'default'),
            'suffix'    => env('YANDEX_MESSAGE_QUEUE_SUFFIX'),
            'region'    => env('YANDEX_MESSAGE_QUEUE_REGION', 'ru-central1'),
            'queue_map' => [
                'default' => env('YANDEX_MESSAGE_QUEUE_DEFAULT'),
            ],
        ],
    ],

    // ...
];
```

В `queue_map` описывается массив соответствия алиасов названий очередей и их реальных названий.

## Usage

``` php
TestJob::dispatch(['foo' => 'bar'])
    ->onConnection('ymq')
    ->onQueue('default');
```

## TODO
- tests

## Credits

- [Viacheslav Ostrovskiy](https://github.com/chelout)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
