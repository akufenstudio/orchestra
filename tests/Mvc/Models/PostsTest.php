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

namespace Akufen\Orchestra\Tests\Mvc\Models;

use PHPUnit\Framework\TestCase;

class PostsTest extends TestCase
{
    /**
     * Model tests setup
     */
    protected function setUp()
    {
        $this->post = new \Akufen\Orchestra\Mvc\Models\Posts();
    }

    /**
     * Test the getter for the ID property.
     */
    public function testGetId()
    {
        // Initialize
        $this->post->setId(54);

        // The id should be what we've set above
        $this->assertEquals(54, $this->post->getId());
    }

    /**
     * Test the setter for the ID property.
     */
    public function testSetId()
    {
        // Initialize
        $this->post->setId(54);

        // Setting the ID property should work
        $this->assertEquals(54, $this->post->ID);
    }
}
