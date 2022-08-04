<?php
/**
 * This file is part of the Akufen Backend module. (http://akufen.ca)
 */

namespace App;
use Phalcon\Di\DiInterface;
/**
 * Module
 *
 * @uses \Phalcon\Mvc\ModuleDefinitionInterface
 * @copyright Akufen Atelier Creatif
 * @author Nicholas Charbonneau <nicholas@akufen.ca>
 */
class Module implements \Phalcon\Mvc\ModuleDefinitionInterface
{
    /**
     * Register the module's autoloader.
     *
     * @return void
     */
    public function registerAutoloaders(DiInterface $di = null)
    {
        // Auto-loaders configuration
        $loader = new \Phalcon\Loader();
        $loader->registerNamespaces(array(
            'App' => __DIR__
        ));

        // Register auto-loaders
        $loader->register();
    }

    /**
     * Register the module's services.
     *
     * @param \Phalcon\DI\FactoryDefault $di The dependency injector.
     * @return void
     */
    public function registerServices(DiInterface $di)
    {
        // Store local instance of the configuration
        $config = $di->getConfig();

        // Dispatcher configuration
        $di->set('dispatcher', function () use ($di) {
            // Add a custom dispatcher to the dispatch loop
            $customDispatcher = new \Akufen\Orchestra\Services\Dispatcher();
            $eventsManager = $di->getEventsManager();
            $eventsManager->attach('dispatch', $customDispatcher);

            // Create default dispatcher and attach custom events
            $dispatcher = new \Phalcon\Mvc\Dispatcher();
            $dispatcher->setDefaultNamespace("App\Controllers");
            $dispatcher->setEventsManager($eventsManager);

            return $dispatcher;
        });

        // View configuration
        $di->set('view', function () use ($di, $config) {
            // Create default view and attach custom events
            $view = new \Phalcon\Mvc\View();
            $view->setViewsDir(__DIR__ . $config->application->viewsDir);

            return $view;
        });

        // Cookies configuration
        $di->set('cookies', function () {
            $cookies = new \Phalcon\Http\Response\Cookies();
            $cookies->useEncryption(true);
            return $cookies;
        });

        // Crypting configuration
        $di->set('crypt', function () use ($config) {
            $crypt = new \Phalcon\Crypt();
            $crypt->setKey($config->application->cryptSalt);
            return $crypt;
        });
    }
}
