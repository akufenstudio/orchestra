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
 * @version   0.1.4
 * @link      https://github.com/akufenstudio/orchestra
 */

namespace Akufen\Orchestra\Mvc\Models;

/**
 * Akufen\Orchestra\Mvc\Models\TermRelationships
 *
 * A model for WordPress term relationships.
 *
 * @package Models
 * @uses    \Akufen\Orchestra\Mvc\Model
 */
class TermRelationships extends \Akufen\Orchestra\Mvc\Model
{
    /**
     * Initialize a term's relationship source & relationships
     *
     * @return void
     */
    public function initialize()
    {
        global $table_prefix;

        $this->setSource($table_prefix . 'term_relationships');

        // Term relationships have term taxonomies
        $this->hasMany(
            'term_taxonomy_id',
            'Akufen\Orchestra\Mvc\Models\TermTaxonomy',
            'term_taxonomy_id',
            array('alias' => 'taxonomy')
        );

        // Term relationships have a post
        $this->hasOne(
            'object_id',
            'Akufen\Orchestra\Mvc\Models\Posts',
            'ID',
            array('alias' => 'post')
        );
    }
}
