# Babook Backend - POC - Using Zend Expressive and Doctrine2 ORM


*Basic Backend Implementation to manager Users at this moment no Authentication Provided*


## Getting Started

Start installing composer packages:

```bash
$ composer install
```
After installing the packages, go to the
`<project-path>/config/autoload` and create new file
named: doctrine.local.php
```php
<?php
return [
    'doctrine' => [
        'connection' => [
            'orm_default' => [
                'params' => [
                    'url' => 'mysql://root:root@127.0.0.1/customers', // Update with your DB settings
                ],
            ],
        ],
        'driver' => [
            'orm_default' => [
                'class' => \Doctrine\Common\Persistence\Mapping\Driver\MappingDriverChain::class,
                'drivers' => [
                    'Babook\Entity' => 'my_entity',
                ],
            ],
            'my_entity' => [
                'class' => \Doctrine\ORM\Mapping\Driver\AnnotationDriver::class,
                'cache' => 'array',
                'paths' => __DIR__ . '/../../src/Babook/src/Entity',
            ],
        ],
    ],
];

```
## Optional Step To Use Built-In Server
After installing the packages, go to the
`<project-path>` and start PHP's built-in web server to verify installation:

```bash
$ composer run --timeout=0 serve
```

You can then browse to http://localhost:9000.

## Note

This is a VIP POC some blocks of code have to be refactored to remove some workaround  