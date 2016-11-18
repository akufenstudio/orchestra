<?php

/**
 * Orchestra: A minimalist object-oriented superset for WordPress using Phalcon.
 *
 * This source file is subject to the MIT license that is bundled
 * with this package in the file LICENSE and is available through
 * the world-wide-web at the following URI:
 * http://opensource.org/licenses/MIT
 *
 * If you did not receive a copy of the license and are unable to
 * obtain it through the web, please send a note to the author so
 * he can mail you a copy immediately.
 *
 * @copyright   Akufen Atelier Creatif
 * @author      Nicholas Charbonneau <nicholas@akufen.ca>
 * @license     http://opensource.org/licenses/MIT
 * @version     0.1.5
 * @link        https://github.com/akufenstudio/orchestra
 */

namespace Akufen\Orchestra\Tests\Helpers;

use PHPUnit\Framework\TestCase;
use Akufen\Orchestra\Helpers\Strings;

class StringsTest extends TestCase
{
    /**
     * Test underscored function
     */
    public function testUnderscored()
    {
        $this->assertEquals(
            'under_scored',
            Strings::toUnderscores('underScored')
        );
    }
}
