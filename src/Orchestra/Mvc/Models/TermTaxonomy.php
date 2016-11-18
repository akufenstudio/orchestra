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
 * Akufen\Orchestra\Mvc\Models\TermTaxonomy
 *
 * A model for WordPress term taxonomy.
 *
 * @package Models
 * @uses    \Akufen\Orchestra\Mvc\Model
 */
class TermTaxonomy extends \Akufen\Orchestra\Mvc\Model
{
    /**
     * Initialize a term's taxonomy source & relationships
     *
     * @return void
     */
    public function initialize()
    {
        global $table_prefix;

        $this->setSource($table_prefix . 'term_taxonomy');

        // Term taxonomy have many relationships
        $this->hasMany(
            'term_taxonomy_id',
            'Akufen\Orchestra\Mvc\Models\TermRelationships',
            'term_taxonomy_id',
            array('alias' => 'relationships')
        );

        // Term taxonomy belong to a term
        $this->belongsTo(
            'term_id',
            'Akufen\Orchestra\Mvc\Models\Terms',
            'term_id',
            array('alias' => 'term')
        );

        // Term taxonomy belong to a parent
        $this->belongsTo(
            'parent',
            'Akufen\Orchestra\Mvc\Models\TermTaxonomy',
            'term_taxonomy_id',
            array('alias' => 'parent')
        );
    }
}
