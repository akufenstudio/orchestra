<?php

/**
 * Orchestra: A minimalist object-oriented superset for WordPress using Phalcon.
 *
 * This source file is subject to the MIT license that is bundled
 * with this package in the file LICENSE and is available through
 * the world-wide-web at the following URI:
 * http://opensource.org/licenses/MIT
 *
 * @copyright Akufen Atelier Creatif
 * @author    Nicholas Charbonneau <nicholas@akufen.ca>
 * @license   http://opensource.org/licenses/MIT
 * @version   0.1.5
 * @link      https://github.com/akufenstudio/orchestra
 */

namespace Akufen\Orchestra\Mvc\Models;

/**
 * Akufen\Orchestra\Mvc\Models\Terms
 *
 * A model for WordPress terms.
 *
 * @package Models
 * @uses    \Akufen\Orchestra\Mvc\Model
 */
class Terms extends \Akufen\Orchestra\Mvc\Model
{
    /**
     * Initialize a term's source & relationships
     *
     * @return void
     */
    public function initialize()
    {
        global $table_prefix;

        $this->setSource($table_prefix . 'terms');

        // Terms have many metas
        $this->hasMany(
            'term_id',
            'Akufen\Orchestra\Mvc\Models\TermMeta',
            'term_id',
            array('alias' => 'metas')
        );

        // Terms have term taxonomies
        $this->hasMany(
            'term_id',
            'Akufen\Orchestra\Mvc\Models\TermTaxonomy',
            'term_id',
            array('alias' => 'taxonomy')
        );
    }
}
