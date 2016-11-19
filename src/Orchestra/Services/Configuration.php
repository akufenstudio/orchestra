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

/**
 * Akufen\Orchestra\Services\Configuration
 *
 * Orchestra application configuration service.
 *
 * @package Orchestra
 */
class Configuration
{
    use \Akufen\Orchestra\Traits\AccessibleTrait;

    /** @var Array The application configuration arrray. */
    private $application = null;

    /**
     * Configuration service class constructor
     */
    public function __construct()
    {
        // Build path to the configuration file
        $file = get_template_directory() . '/config.php';

        // Configuration is mandatory
        if (!file_exists($file)) {
            throw new \Exception(
                'Unable to locate configuration file.'
            );
        }

        // Build our configuration processor
        $processor = new \Symfony\Component\Config\Definition\Processor();

        // Retrieve the application configuration
        $validator = new \Akufen\Orchestra\Config\Application();
        $this->application = $processor->processConfiguration(
            $validator,
            include $file
        );
    }
}
