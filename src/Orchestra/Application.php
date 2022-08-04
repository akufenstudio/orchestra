<?php

/**
 * Orchestra: A minimalist object-oriented superset for WordPress using Phalcon.
 *
 * This source file is subject to the MIT license that is bundled
 * with this package in the file LICENSE and is available through
 * the world-wide-web at the following URI:
 * http://opensource.org/licenses/MIT
 *
 * @copyright Akufen Atelier Creatif
 * @author    Nicholas Charbonneau <nicholas@akufen.ca>
 * @license   http://opensource.org/licenses/MIT
 * @version   0.1.4
 * @link      https://github.com/akufenstudio/orchestra
 */

namespace Akufen\Orchestra;

/**
 * Akufen\Orchestra\Application
 *
 * Orchestra application entry point.
 *
 * @package Orchestra
 */
class Application extends \Phalcon\Mvc\Application
{
    /**
     * {@inheritdoc}
     */
    public function __construct()
    {
        // Create dependency injector
        $di = new \Phalcon\DI\FactoryDefault();

        // Configuration file
        $di->setShared('config', function () {

            // Prepare the configuration filename
            $file = get_template_directory() . '/config.php';

            // Configuration is mandatory
            if (!file_exists($file)) {
                throw new \Exception('Unable to locate configuration file.');
            }

            return include $file;
        });

        // Retrieve instance of configuration
        $config = $di->getConfig();

        // Set development flags
        if (!$config->application->production) {
            // Report all error
            error_reporting(E_ALL);

            // Create a new debug listener
            $debug = new \Phalcon\Debug();
            $debug->listen();
        }

        // Url service configuration
        $di->setShared('url', function () use ($config) {

            // Create url service with configuration base uri
            $url = new \Phalcon\Url();

            // Prepare the base uri for our application
            $baseUri = isset($config->application->baseUri)?
                $config->application->baseUri : '/';

            // Set the base uri
            $url->setBaseUri($baseUri);

            return $url;
        });

        // Session service configuration
        $di->setShared('session', function () {

            // Create session adapter and start it
            $session = new \Phalcon\Session\Adapter\Files();
            $session->start();

            return $session;
        });

        // Configure router
        $di->setShared('router', function () use ($config) {

            // Create the main router
            $router = new \Phalcon\Mvc\Router();

            // Remove route extra slashes
            $router->removeExtraSlashes(true);

            // Add a default module if specified
            if (isset($config->application->defaultModule)) {
                $router->setDefaultModule(
                    $config->application->defaultModule
                );
            }

            // Iterate and mount router groups from the configuration
            if (isset($config->application->routers)) {
                foreach ($config->application->routers as $info) {
                    include_once get_template_directory() . '/' . $info->path;
                    $group = new $info->className;
                    $router->mount($group);
                }
            }

            return $router;
        });

        // Database configuration
        $di->setShared('db', function () {
            return new \Phalcon\Db\Adapter\Pdo\Mysql(
                array(
                    'host' => DB_HOST,
                    'username' => DB_USER,
                    'password' => DB_PASSWORD,
                    'dbname' => DB_NAME,
                    'charset' => DB_CHARSET
                )
            );
        });

        // Dispatcher configuration
        $di->setShared('dispatcher', function () use ($di, $config) {

            // Add a custom dispatcher to the dispatch loop
            $customDispatcher = new \Akufen\Orchestra\Services\Dispatcher();
            $eventsManager = $di->getEventsManager();
            $eventsManager->attach('dispatch', $customDispatcher);

            // Create default dispatcher and attach custom events
            $dispatcher = new \Phalcon\Mvc\Dispatcher();
            $dispatcher->setDefaultNamespace($config->application->defaultNamespace);
            $dispatcher->setEventsManager($eventsManager);

            return $dispatcher;
        });

        // Modules configuration
        $di->set('modules', function () use ($config) {

            // Initialize modules array
            $modules = array();

            foreach ($config->modules->toArray() as $module) {
                // Find out if the module is a composer package
                $modulePath = substr($module['path'], 0, 1) == '/'?
                get_template_directory() : get_template_directory() . '/vendor/';

                // Add the module path
                $modulePath .= $module['path'];

                // Build the module configuration array
                $modules[$module['name']] = array(
                'className' => ucfirst($module['name']). '\\Module',
                'path' => $modulePath . '/Module.php'
                );
            }

            return $modules;
        });

        // Set the application dependency injector & register modules
        $this->setDI($di);
        $this->registerModules($di->getModules());
    }

    /**
     * Bootstrap the orchestra application.
     *
     * @params String $uri The uri to handle
     * @return void
     */
    public function handle($uri = null)
    {
        global $pagenow;

        // Set the data url for the router
        $_GET['_url'] = ($uri)? $uri : $this->di->getRequest()->getUri();

        // Handle the request & paste rendered html
        if (!is_admin() && $pagenow !== 'wp-login.php') {
            status_header(200);
            exit(parent::handle($_GET['_url'])->getContent());
        }
    }
}
