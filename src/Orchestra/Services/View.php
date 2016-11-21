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

use Symfony\Component\Templating\PhpEngine;
use Symfony\Component\Templating\TemplateNameParser;
use Symfony\Component\Templating\Loader\FilesystemLoader;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

/**
 * Akufen\Orchestra\Services\View
 *
 * Orchestra application view service.
 *
 * @package Orchestra
 */
class View extends PhpEngine
{
    use ContainerAwareTrait;

    public function __construct()
    {
        $config = $this->container->get('config')->getApplication();

        $loader = new FilesystemLoader(
            get_template_directory() . $config['views'] . '/'
        );

        parent::__construct(
            new TemplateNameParser(),
            $loader
        );
    }

}
