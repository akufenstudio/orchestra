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

namespace Akufen\Orchestra\Mvc;

use Akufen\Orchestra\Services\Dispatcher;
use Akufen\Orchestra\Mvc\Models\Posts;

/**
 * Akufen\Orchestra\Mvc\Controller
 *
 * A base controller for the application.
 *
 * @uses    \Phalcon\Mvc\Controller
 * @package Mvc
 */
class Controller extends \Phalcon\Mvc\Controller
{
    /**
     * Initialization function for the controller.
     *
     * @return void
     */
    protected function initialize()
    {
        // Retrieve the post from the dispatcher
        $post = Dispatcher::$post;

        // Create a post model for controller use
        if ($post) {
            $this->post = new Posts();
            $this->post->fromObject($post);
        }
    }

    /**
     * Renders a template as our main content.
     *
     * @param String $template The relative path to the template.
     * @param Array  $params   The parameters to pass to the view.
     * @retun void
     */
    protected function render($template, array $params = array())
    {
        // Render a template as our main content
        $this->view->content = $this->view->getPartial(
            $template,
            $params
        );
    }
}
