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
class Configuration implements \Symfony\Component\Config\Definition\ConfigurationInterface
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

        // Retrieve the application configuration
        $processor = new \Symfony\Component\Config\Definition\Processor();
        $this->application = $processor->processConfiguration(
            $this,
            include $file
        );
    }

    /**
     * Returns the configuration tree for validation.
     *
     * @return TreeBuilder $treeBuilder
     */
    public function getConfigTreeBuilder()
    {
        // Create the tree builder
        $treeBuilder = new \Symfony\Component\Config\Definition\Builder\TreeBuilder();
        $rootNode = $treeBuilder->root('application');

        // Declare the configuration tree
        $rootNode->children()
            ->scalarNode('baseUri')->isRequired()->cannotBeEmpty()->end()
            ->scalarNode('namespace')->isRequired()->cannotBeEmpty()->end()
            ->scalarNode('views')->isRequired()->cannotBeEmpty()->end()
            ->booleanNode('production')->isRequired()->defaultFalse()->end()
            ->arrayNode('routes')->prototype('variable')->end()
            ->end();

        return $treeBuilder;
    }
}
