# Orchestra

[![Build Status](https://img.shields.io/travis/akufenstudio/orchestra/master.svg)](https://travis-ci.org/akufenstudio/orchestra)
[![Latest Version](https://img.shields.io/badge/Latest%20Version-0.2.0-blue.svg)](https://packagist.org/packages/akufen/orchestra)

Orchestra is a minimalist object-oriented superset that uses [Symfony](https://symfony.com/) as a framework and [Doctrine](http://www.doctrine-project.org/) as an ORM to help make robust and scalable websites or applications with [WordPress](https://wordpress.org/).

## Installation
Orchestra can be installed inside your theme with [Composer](https://getcomposer.org/) using this command:
```sh
composer require akufen/orchestra v0.2.0
```

## Usage
To bootstrap Orchestra, add this to your `functions.php` file.

    // Bootstrap Orchestra
    require __DIR__ . '/vendor/autoload.php';
    add_action('wp', function() {
        $app = new \Akufen\Orchestra\Application();
        $app->handle()->leave();
    });

This allows Orchestra to take over WordPress and makes it much faster and object-oriented.

## Resources
* Access the API indice [here](http://akufenstudio.github.io/orchestra/).
* Documentation on how to use the library can be found in the [wiki](https://github.com/akufenstudio/orchestra/wiki).
* Module skeleton can be found [here](https://github.com/akufenstudio/orchestra-skeleton)

## License
Please see the [license file](https://github.com/akufenstudio/orchestra/blob/master/LICENSE) for more information.
