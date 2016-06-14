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

namespace Akufen\Orchestra\Tests\Mvc;

class ModelTest extends \PHPUnit_Framework_TestCase
{
    protected function setUp()
    {
        $this->model = new \Akufen\Orchestra\Mvc\Model();
    }

    public function testGet()
    {
        $this->model->test_variable = 'test';

        $this->assertEquals(
            'test',
            $this->model->getTestVariable()
        );
    }

    public function testSet()
    {
        $this->model->setTestVariable('test');

        $this->assertEquals(
            'test',
            $this->model->testVariable
        );
    }

    public function testFromObject()
    {
        $object = new \stdClass();
        $object->name = 'text object';

        $this->model->fromObject($object);
        $this->assertTrue(isset($this->model->name));
        $this->assertEquals('text object', $this->model->name);
    }

    public function testFromArray()
    {
        $array = array('first' => 'second');

        $this->model->fromArray($array);
        $this->assertTrue(isset($this->model->first));
        $this->assertEquals('second', $this->model->first);
    }
}
