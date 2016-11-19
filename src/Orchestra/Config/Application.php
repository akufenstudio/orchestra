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

namespace Akufen\Orchestra\Config;

use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;

/**
 * Akufen\Orchestra\Config\Application
 *
 * Orchestra application configuration.
 *
 * @package Orchestra
 * @uses Symfony\Component\Config\Definition\ConfigurationInterface
 */
class Application implements ConfigurationInterface
{
    /**
     * Returns the configuration tree for validation.
     *
     * @return TreeBuilder $treeBuilder
     */
    public function getConfigTreeBuilder()
    {
        // Create the tree builder
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('application');

        // Declare the configuration tree
        $rootNode->children()
            ->scalarNode('baseUri')
                ->isRequired()
                ->cannotBeEmpty()
                ->end()
            ->booleanNode('production')
                ->isRequired()
                ->defaultFalse()
                ->end()
            ->arrayNode('routes')
                ->requiresAtLeastOneElement()
                ->prototype('variable')
                ->end()
            ->end();

        return $treeBuilder;
    }
}
