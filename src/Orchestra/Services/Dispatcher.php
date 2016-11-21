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

    /** @var \Akufen\Orchestra\Mvc\Models\Posts A post that match the request url. */
    static $post;

    /** @var string The name of the controller to dispatch. */
    protected $controllerName;

    /** @var string The action to execute in the controller. */
    protected $actionName;

    public function setControllerName($controllerName)
    {
        $this->controllerName = ucfirst($controllerName).'Controller';
    }

    public function setActionName($action)
    {
        $this->actionName = $action.'Action';
    }

    /**
     * Handle the current url and dispatch the controller.
     *
     * @param string $uri The uri that is being requested.
     * @return void
     */
    public function handle($uri)
    {
        // Require some services
        $request = $this->container->get('request');
        $config = $this->container->get('config')->getApplication();

        // Build the fully qualified url
        $url = $request->getSchemeAndHttpHost() . $uri;

        // Attempt to match a route
        try {
            // Create & register the application router
            foreach($config['routes'] as $name => $route) {
                $this->add($name, $route);
            }

            // Create a request context and use it to create a matcher
            $context = new RequestContext($config['baseUri']);
            $matcher = new UrlMatcher($this, $context);

            // Attempt to match with the router
            if($match = $matcher->match($uri)) {
                $this->setControllerName($match['controller']);
                $this->setActionName($match['action']);
            }

        } catch (\Exception $e) {
            if (($postId = url_to_postid($url)) > 0) {
                // Retrieve the posts repository
                $entityManager = $this->container->get('database');
                $postsRepository = $entityManager->getRepository(
                    '\\Akufen\\Orchestra\\Mvc\\Models\\Posts'
                );

                // Attempt to find the post in the database
                if (!static::$post = $postsRepository->findOneBy(array(
                    'ID' => $postId,
                    'post_status' => 'publish'
                ))) return;

                // Set the controller name
                $this->setControllerName(static::$post->getPostType());

                // Retrieve page slug, taxonomy or single action
                $template = get_page_template_slug(static::$post->getId());
                if (!empty($template)) {
                    $this->setActionName(str_replace('.php', '', $template));
                } else {
                    $this->setActionName(
                        is_post_type_archive(static::$post->getPostType())?
                            'index' : 'single'
                    );
                }
            } else {
                global $wp_rewrite;

                // Attempt to match personalized url structure
                if (preg_match('#^'.$request->getPathInfo().'#', $wp_rewrite->front)) {
                    $this->setControllerName('post');
                    $this->setActionName('index');
                } else {
                    // Attempt to match a custom post type archive
                    $slug = strtok(rtrim($request->getPathInfo(), '/'), '?');
                    foreach ($wp_rewrite->extra_permastructs as $postType => $params) {
                        if (preg_match("{$slug}\/\%{$postType}\%/", $params['struct'])) {
                            $this->setControllerName($postType);
                            $this->setActionName('index');
                        }
                    }
                }
            }
        }

        // Create the controller and execute the action
        $controller = $config['namespace'].'\\'.$this->getControllerName();
        $controller = new $controller($this->container);
        $controller->setContainer($this->container);
        $controller->initialize();
        $controller->{$this->getActionName()}();
    }
}
