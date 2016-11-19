<?php

/**
 * Orchestra: A minimalist object-oriented superset for WordPress using Symfony.
 *
 * This source file is subject to the MIT license that is bundled
 * with this package in the file LICENSE and is available through
 * the world-wide-web at the following URI:
 * http://opensource.org/licenses/MIT
 *
 * @copyright Akufen Atelier Creatif
 * @author    Nicholas Charbonneau <nicholas@akufen.ca>
 * @license   http://opensource.org/licenses/MIT
 * @version   0.2.0
 * @link      https://github.com/akufenstudio/orchestra
 */

namespace Akufen\Orchestra;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;
use Symfony\Component\HttpFoundation\Request;

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

/**
 * Akufen\Orchestra\Application
 *
 * Orchestra application entry point.
 *
 * @package Orchestra
 */
class Application
{
    use ContainerAwareTrait;

    /**
     * Application class constructor
     */
    public function __construct()
    {
        // Create dependency injector container
        $container = new ContainerBuilder();

        // Register the configuration service
        $container->register('config', '\Akufen\Orchestra\Services\Configuration');

        // Retrieve our configuration
        $config = $container->get('config');

        // Register the dispatching service
        $container->register('dispatcher', '\Akufen\Orchestra\Services\Dispatcher')
            ->addMethodCall('setContainer', array($container));

        // Register the request service
        $container->register('request', Request::createFromGlobals());

        // Register the database service
        $container->register('database', EntityManager::create(
            array(
                'driver' => 'pdo_mysql',
                'user' => DB_USER,
                'password' => DB_PASSWORD,
                'dbname' => DB_NAME,
            ),
            Setup::createAnnotationMetadataConfiguration(
                __DIR__ . '/Mvc/Models',
                !$config->getApplication()['production']
            )
        ));

                // Report all errors in development mode
        if (!$config->getApplication()['production'] === true) {
            error_reporting(E_ALL);
        }

        // TODO: Create router, database services

        //// Session service configuration
        //$di->setShared('session', function () {

            //// Create session adapter and start it
            //$session = new \Phalcon\Session\Adapter\Files();
            //$session->start();

            //return $session;
        //});

        //// Configure router
        //$di->setShared('router', function () use ($config) {

            //// Create the main router
            //$router = new \Phalcon\Mvc\Router();

            //// Remove route extra slashes
            //$router->removeExtraSlashes(true);

            //// Add a default module if specified
            //if (isset($config->application->defaultModule)) {
                //$router->setDefaultModule(
                    //$config->application->defaultModule
                //);
            //}

            //// Iterate and mount router groups from the configuration
            //if (isset($config->application->routers)) {
                //foreach ($config->application->routers as $info) {
                    //include_once get_template_directory() . '/' . $info->path;
                    //$group = new $info->className;
                    //$router->mount($group);
                //}
            //}

            //return $router;
        //});

        //// Database configuration
        //$di->setShared('db', function () {
            //return new \Phalcon\Db\Adapter\Pdo\Mysql(
                //array(
                                    //)
            //);
        //});

        // Set the application dependency injector
        $this->setContainer($container);

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
        if($uri === null) {
            $uri = $this->container->get('request')->getPathInfo();
        }

        // Handle the request & paste rendered html
        if (!is_admin() && $pagenow !== 'wp-login.php') {
            status_header(200);
            var_dump($this->container->get('dispatcher')->handle($uri)); die;
        }
    }
}
