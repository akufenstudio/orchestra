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

use Akufen\Orchestra\Services\Configuration;
use Akufen\Orchestra\Services\Dispatcher;
use Akufen\Orchestra\Services\View;

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

        // Register basic services
        $config = new Configuration();
        $container->set('config', $config);
        $container->set('request', Request::createFromGlobals());

        // Register the request dispatcher
        $container->register('dispatcher', new Dispatcher())
            ->addMethodCall('setContainer', array($container));

        // Register the view rendering object
        $container->register('view', new View())
            ->addMethodCall('setContainer', array($container));

        // Register our entity manager
        $container->set('database', EntityManager::create(
            array(
                'driver' => 'pdo_mysql',
                'user' => DB_USER,
                'password' => DB_PASSWORD,
                'dbname' => DB_NAME,
                'charset' => DB_CHARSET
            ),
            Setup::createAnnotationMetadataConfiguration(
                array(__DIR__ . '/Mvc/Models'),
                !$config->getApplication()['production']
            )
        ));

        // Report all errors in development mode
        if (!$config->getApplication()['production'] === true) {
            error_reporting(E_ALL);
        }

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
            echo $this->container->get('dispatcher')->handle($uri);
        }
    }
}
