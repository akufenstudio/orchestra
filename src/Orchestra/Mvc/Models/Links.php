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

namespace Akufen\Orchestra\Mvc\Models;

/**
 * Akufen\Orchestra\Mvc\Models
 *
 * A model for WordPress links
 *
 * @package Models
 * @uses    \Akufen\Orchestra\Mvc\Model
 * @Entity @Table(name="wp_links")
 */
class Links extends \Akufen\Orchestra\Mvc\Model
{
    /** @Id @Column(type="bigint", name="link_id") @GeneratedValue */
    public $id;

    /** @Column(type="string", name="link_url") */
    public $url;

    /** @Column(type="string", name="link_name") */
    public $name;

    /** @Column(type="string", name="link_image") */
    public $image;

    /** @Column(type="string", length=25, name="link_target") */
    public $target;

    /** @Column(type="string", name="link_description") */
    public $description;

    /** @Column(type="string", length=20, name="link_visible") */
    public $visible;

    /** @Column(type="bigint", name="link_owner") */
    public $owner;

    /** @Column(type="integer", name="link_rating") */
    public $rating;

    /** @Column(type="datetime", name="link_updated") */
    public $updated;

    /** @Column(type="string", name="link_rel") */
    public $rel;

    /** @Column(type="text", name="link_notes") */
    public $notes;

    /** @Column(type="string", name="link_rss") */
    public $rss;
}
