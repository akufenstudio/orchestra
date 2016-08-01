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
 * @version   0.1.3
 * @link      https://github.com/akufenstudio/orchestra
 */

namespace Akufen\Orchestra\Services;

use Akufen\Orchestra\Mvc\Models\Posts;

/**
 * Akufen\Orchestra\Dispatcher
 *
 * A custom dispatcher for WordPress architecture
 *
 * @package Services
 */
class Dispatcher extends \Phalcon\Mvc\User\Plugin
{
    /** @var \Akufen\Orchestra\Mvc\Models\Posts A post that match the request url. */
    public static $post = null;

    /**
     * Attempts to find a controller & action that matches the request.
     *
     * @param  \Phalcon\Events\Event   $event      Contextual information of the event produced.
     * @param  \Phalcon\Mvc\Dispatcher $dispatcher The dispatcher service.
     * @return void
     */
    public function beforeDispatchLoop(\Phalcon\Events\Event $event, \Phalcon\Mvc\Dispatcher $dispatcher)
    {
        // Require some services
        $router = $this->getDI()->getRouter();
        $request = $this->getDI()->getRequest();

        // Build the fully qualified url
        $url = 'http://' . $request->getHttpHost() . $request->getUri();

        // Send to a 404 by default
        $dispatcher->setControllerName('error');
        $dispatcher->setActionName('show404');

        // Get paths if router matched
        if ($router->wasMatched()) {
            $paths = $router->getMatchedRoute()->getPaths();
        }

        // Attempt to redirect to a controller & action
        if (isset($paths) && is_string($paths['controller'])) {
            $dispatcher->setModuleName($paths['module']);
            $dispatcher->setNamespaceName($paths['namespace']);
            $dispatcher->setControllerName($paths['controller']);
            $dispatcher->setActionName($paths['action']);
        } else if (($postId = url_to_postid($url)) > 0) {
            // Retrive the post from the matched id
            if (!static::$post = Posts::findFirst(array("ID = '{$postId}'"))) {
                return;
            }

            // Set the correct controller & action
            $dispatcher->setControllerName(static::$post->getPostType());

            // Retrieve page slug, taxonomy or single action
            $template = get_page_template_slug(static::$post->get('ID'));
            if (!empty($template)) {
                $dispatcher->setActionName(str_replace('.php', '', $template));
            } else {
                $dispatcher->setActionName(
                    is_post_type_archive(static::$post->getPostType())?
                        'index' : 'single'
                );
            }
        } else {
            global $wp_rewrite;

            // Attempt to match personalized url structure
            if (preg_match('#^'.$request->getUri().'#', $wp_rewrite->front)) {
                $dispatcher->setControllerName('post');
                $dispatcher->setActionName('index');
            } else {
                // Attempt to match a custom post type archive
                $slug = strtok(rtrim($request->getUri(), '/'), '?');
                foreach ($wp_rewrite->extra_permastructs as $postType => $params) {
                    if (preg_match("{$slug}\/\%{$postType}\%/", $params['struct'])) {
                        $dispatcher->setControllerName($postType);
                        $dispatcher->setActionName('index');
                    }
                }
            }
        }
    }
}
