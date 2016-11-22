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

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Templating\TemplateNameParser;
use Symfony\Component\Templating\Loader\FilesystemLoader;

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
    use \Akufen\Orchestra\Traits\InjectionAwareTrait;

    /** @const The application database configuration. */
    const DB_CONFIG = array(
        'driver' => 'pdo_mysql',
        'user' => DB_USER,
        'password' => DB_PASSWORD,
        'dbname' => DB_NAME,
        'charset' => DB_CHARSET
    );

    /**
     * Application class constructor
     */
    public function __construct()
    {
        // Create dependency injector container
        $di = new \Symfony\Component\DependencyInjection\ContainerBuilder();

        // Register basic services
        $di->set('config', $config = new Configuration());
        $di->set('request', Request::createFromGlobals());
        $di->set('response', new Response());

        // Register the request dispatcher
        $di->register('dispatcher', new Dispatcher())
            ->addMethodCall('setContainer', array($di));

        // Register the view rendering object
        $viewsDir = get_template_directory().$config->getApplication()['views'].'/%name%.phtml';
        $view = new View(new TemplateNameParser(), new FilesystemLoader($viewsDir));
        $view->setContainer($di);
        $di->set('view', $view);

        // Register our entity manager
        $di->set('database', EntityManager::create(
            Application::DB_CONFIG,
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
        $this->setContainer($di);
    }

    /**
     * Bootstrap the orchestra application.
     *
     * @params String $uri The uri to handle
     * @return $this Daisy chaining
     */
    public function handle($uri = null)
    {
        global $pagenow;

        // Set the data url for the router
        if ($uri === null) {
            $uri = $this->di->get('request')->getPathInfo();
        }

        // Handle the request & paste rendered html
        if (!is_admin() && $pagenow !== 'wp-login.php') {
            status_header(200);
            $this->di->get('dispatcher')->handle($uri);
        }

        return $this;
    }

    /**
     * Send the exit signal to avoid wordpress rendering.
     *
     * @return void
     */
    public function leave()
    {
        global $pagenow;

        // Leave the application
        if (!is_admin() && $pagenow !== 'wp-login.php') {
            exit();
        }
    }
}
