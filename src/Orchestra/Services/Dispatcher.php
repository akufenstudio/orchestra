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

namespace Akufen\Orchestra\Services;

use Akufen\Orchestra\Traits\AccessibleTrait;

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

/**
 * Akufen\Orchestra\Services\Dispatcher
 *
 * Orchestra application dispatching service.
 *
 * @package Orchestra
 */
class Dispatcher extends RouteCollection
{
    use AccessibleTrait;
    use ContainerAwareTrait;

    /**
     * Handle the current url and dispatch the controller.
     *
     * @param string $uri The uri that is being requested.
     * @return void
     */
    public function handle($uri)
    {
        // Retrieve our configuration
        $config = $this->container->get('config');

        /*foreach($router->getRoutes() as $route) {*/
            //$this->add($route['name'], $route);
        /*}*/

        // Create a request context object
        $context = new RequestContext(
            $config->getApplication()['baseUri']
        );

        // Create an url matcher based on context
        $matcher = new UrlMatcher($routes, $context);

        // Attempt to match a route
        return $matcher->match($uri);
    }
}
