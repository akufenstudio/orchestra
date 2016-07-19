# Orchestra

[![Build Status](https://img.shields.io/travis/akufenstudio/orchestra/master.svg)](https://travis-ci.org/akufenstudio/orchestra)
[![Latest Version](https://img.shields.io/badge/Latest%20Version-0.1.3-blue.svg)](https://packagist.org/packages/akufen/orchestra)

Orchestra is a minimalist object-oriented superset that uses [Phalcon](https://phalconphp.com/) as a framework to bootstrap [WordPress](https://wordpress.org/) with an MVC environment and Object-Relational Mapping.

## Installation
Orchestra can be installed inside your theme with [Composer](https://getcomposer.org/) using this command:
```sh
composer require akufen/orchestra v0.1.2
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

This allows Orchestra to take over WordPress at the rendering level thus making it much faster and object-oriented. Application can be instantiated outside the action in order to register project specific services.

## Resources
* Access the API indice [here](http://akufenstudio.github.io/orchestra/).
* Documentation on how to use the library can be found in the [wiki](https://github.com/akufenstudio/orchestra/wiki).
* Module skeleton can be found [here](https://github.com/akufenstudio/orchestra-skeleton)

## License
Please see the [license file](https://github.com/akufenstudio/orchestra/blob/master/LICENSE) for more information.
