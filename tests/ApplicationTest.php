<?php

/**
 * Orchestra: A minimalist object-oriented superset for WordPress using Phalcon.
 *
 * This source file is subject to the MIT license that is bundled
 * with this package in the file LICENSE and is available through
 * the world-wide-web at the following URI:
 * http://opensource.org/licenses/MIT
 *
 * @copyright   Akufen Atelier Creatif
 * @author      Nicholas Charbonneau <nicholas@akufen.ca>
 * @license     http://opensource.org/licenses/MIT
 * @version     0.1.0
 * @link        https://github.com/akufenstudio/orchestra
 */

namespace Akufen\Orchestra\Tests;

use \Akufen\Orchestra\Application;

class ApplicationTest extends \PHPUnit_Framework_TestCase
{
    protected function setUp()
    {
        $this->application = new Application();
        copy(__DIR__ . '/assets/config.sample.php', __DIR__ . '/config.php');
        $this->application->handle();
    }

    protected function tearDown()
    {
        if (file_exists(__DIR__ . '/config.php')) {
            unlink(__DIR__ . '/config.php');
        }
    }

    public function testUrlService()
    {
        $url = $this->application->getDi()->get('url');
        $config = $this->application->getDi()->getConfig();

        $this->assertEquals(
            $config->application->baseUri,
            $url->getBaseUri()
        );
    }

    public function testRouterService()
    {
        $config = $this->application->getDi()->getConfig();
        $router = $this->application->getDi()->getRouter();
        $defaults = $router->getDefaults();

        $this->assertEquals(
            $config->application->defaultModule,
            $defaults['module']
        );
    }

    public function testModuleService()
    {
        $modules = $this->application->getDi()->getModules();

        $this->assertArrayHasKey('app', $modules);
        $this->assertCount(1, $modules);
    }

    public function testConfigService()
    {
        try {
            $this->application->handle();
        } catch (\Exception $e) {
            $this->fail();
        }

        $this->assertTrue(true);

        unlink(__DIR__.'/config.php');
        $this->setExpectedException('Exception');
        $this->application->handle();
    }
}
