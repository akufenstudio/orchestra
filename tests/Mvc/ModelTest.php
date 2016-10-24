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
 * @version     0.1.4
 * @link        https://github.com/akufenstudio/orchestra
 */

namespace Akufen\Orchestra\Tests\Mvc;

use PHPUnit\Framework\TestCase;

class ModelTest extends TestCase
{
    /**
     * Model tests setup
     */
    protected function setUp()
    {
        $this->model = new \Akufen\Orchestra\Mvc\Model();
    }

    /**
     * Test Accessible trait get function
     */
    public function testGet()
    {
        // Getting the variables should fail
        $this->setExpectedException('Exception');
        $this->model->getTestVariable();
        $this->model->getAnotherVariable();

        // Initialize underscored & camel cased
        $this->model->test_variable = 'test';
        $this->model->anotherVariable = 'test';

        // Getting the variables should succeed
        $this->assertEquals('test', $this->model->getTestVariable());
        $this->assertEquals('test', $this->model->getAnotherVariable());
    }

    /**
     * Test accessible trait set function
     */
    public function testSet()
    {
        // Initialize
        $this->model->setTestVariable('test');

        // Setting the variable should work
        $this->assertEquals('test', $this->model->testVariable);
    }

    /**
     * Test assignable from object trait.
     * TODO: Extend testing, test behaviour with numerical array.
     */
    public function testFromObject()
    {
        // Name should not exist
        $this->assertFalse(isset($this->model->name));

        // Initialize
        $object = new \stdClass();
        $object->name = 'test';

        // Assign object to model
        $this->model->fromObject($object);

        // Name should be set and have the good value
        $this->assertTrue(isset($this->model->name));
        $this->assertEquals('test', $this->model->name);
    }

    /**
     * Test assignable from array trait
     */
    public function testFromArray()
    {
        // Name should not exist
        $this->assertFalse(isset($this->model->name));

        // Initialize
        $array = array('name' => 'test');

        // Assign array to model
        $this->model->fromArray($array);

        // Name should be set and have the good value
        $this->assertTrue(isset($this->model->name));
        $this->assertEquals('test', $this->model->name);
    }
}
