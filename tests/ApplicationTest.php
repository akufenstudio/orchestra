<?php

/**
 * Orchestra: A minimalist object-oriented superset for WordPress using Symfony.
 *
 * This source file is subject to the MIT license that is bundled
 * with this package in the file LICENSE and is available through
 * the world-wide-web at the following URI:
 * http://opensource.org/licenses/MIT
 *
 * @copyright   Akufen Atelier Creatif
 * @author      Nicholas Charbonneau <nicholas@akufen.ca>
 * @license     http://opensource.org/licenses/MIT
 * @version     0.2.0
 * @link        https://github.com/akufenstudio/orchestra
 */

namespace Akufen\Orchestra\Tests;

use PHPUnit\Framework\TestCase;
use Akufen\Orchestra\Application;

class ApplicationTest extends TestCase
{
    /**
     * Application tests setup
     */
    protected function setUp()
    {
        // Create a copy of a configuration file
        copy(__DIR__ . '/assets/config.sample.php', __DIR__ . '/config.php');

        // Initialize application object for tests
        $this->application = new Application();
        $this->application->handle();
    }

    /**
     * Application tests tear down
     */
    protected function tearDown()
    {
        // Clean up after ourselves
        if (file_exists(__DIR__ . '/config.php')) {
            unlink(__DIR__ . '/config.php');
        }
    }

    /**
     * Test url service
     */
    public function testUrlService()
    {
        // Initialize
        $url = $this->application->getDi()->get('url');
        $config = $this->application->getDi()->getConfig();

        // Base uri should always match config or root if it's not set
        if (isset($config->application->baseUri)) {
            $this->assertEquals(
                $config->application->baseUri,
                $url->getBaseUri()
            );
        } else {
            $this->assertEquals('/', $url->getBaseUri());
        }
    }

    /**
     * Test router service
     */
    public function testRouterService()
    {
        // Initialize
        $config = $this->application->getDi()->getConfig();
        $defaults = $this->application->getDi()->getRouter()->getDefaults();

        // Default module should always match config if it's set
        if (isset($config->application->defaultModule)) {
            $this->assertEquals(
                $config->application->defaultModule,
                $defaults['module']
            );
        }
    }

    /**
     * Test the dispatcher
     */
    public function testDispatcherService()
    {
        // Simulate before dispatch loop even/*t*/
        $dispatcher = $this->application->getDi()->getDispatcher();
        $dispatcher->getEventsManager()->fire(
            'dispatch:beforeDispatchLoop',
            $dispatcher
        );

        // Default dispatch environment should be error controller
        $this->assertEquals('error', $dispatcher->getControllerName());
        $this->assertEquals('show404', $dispatcher->getActionName());

        // TODO: Simulate correctly url_to_postid
        // Figure out a way to find a post in the db

        // TODO: Test static routes environment.
        // I haven't been able to reproduce an
        // environment that Symfony can match.
    }

    /**
     * Test module service.
     */
    public function testModuleService()
    {
        // Initialize
        $modules = $this->application->getDi()->getModules();

        // Default module should have 1 key and it should be named map
        $this->assertCount(1, $modules);
        $this->assertArrayHasKey('app', $modules);
    }

    /**
     * Test configuration service
     */
    public function testConfigService()
    {
        // Application should not raise exception with config
        try {
            $this->application->handle();
        } catch (\Exception $e) {
            $this->fail();
        }

        $this->assertTrue(true);

        // Application should raise exception without config
        unlink(__DIR__.'/config.php');
        $this->setExpectedException('Exception');
        $this->application = new Application();
    }
}
