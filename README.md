# Orchestra

[![Build Status](https://img.shields.io/travis/akufenstudio/orchestra/master.svg)](https://travis-ci.org/akufenstudio/orchestra)
[![Latest Version](https://img.shields.io/badge/Latest%20Version-0.1.0-blue.svg)](https://packagist.org/packages/facebook/php-sdk-v4)

Orchestra is a minimalist object-oriented superset that uses [Phalcon](https://phalconphp.com/) as a framework to bootstrap [WordPress](https://wordpress.org/) with an MVC environment and Object-Relational Mapping.

## Installation
Orchestra can be installed inside your theme with [Composer](https://getcomposer.org/) using this command:
```sh
composer require akufen/orchestra v0.1.0
```

## Usage
To bootstrap Orchestra, add this to your `functions.php` file.

    // Bootstrap Orchestra
    require __DIR__ . '/vendor/autoload.php';
    add_action('template_redirect', function() {
        $app = new \Akufen\Orchestra\Application();
        $app->handle();
        exit;
    });

## Resources
* Access the API indice [here](http://akufenstudio.github.io/orchestra/).
* Documentation on how to use the library can be found in the [wiki](https://github.com/akufenstudio/orchestra/wiki).
* Module skeleton can be found [here](https://github.com/akufenstudio/orchestra-skeleton)

## License
Please see the [license file](https://github.com/akufenstudio/orchestra/blob/master/LICENSE) for more information.
