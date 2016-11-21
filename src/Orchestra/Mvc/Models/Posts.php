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
 * A model for WordPress posts
 *
 * @package Models
 * @uses    \Akufen\Orchestra\Mvc\Model
 * @Entity @Table(name="wp_posts")
 */
class Posts extends \Akufen\Orchestra\Mvc\Model
{
    /** @Id @Column(type="integer") @GeneratedValue **/
    public $ID = null;

    /** @Column(type="integer") */
    public $post_author;

    /** @Column(type="datetime") */
    public $post_date;

    /** @Column(type="datetime") */
    public $post_date_gmt;

    /** @Column(type="text") */
    public $post_content;

    /** @Column(type="string") */
    public $post_title;

    /** @Column(type="text") */
    public $post_excerpt;

    /** @Column(type="string") */
    public $post_status;

    /** @Column(type="string") */
    public $comment_status;

    /** @Column(type="string") */
    public $ping_status;

    /** @Column(type="string") */
    public $post_password;

    /** @Column(type="string") */
    public $post_name;

    /** @Column(type="text") */
    public $to_ping;

    /** @Column(type="text") */
    public $pinged;

    /** @Column(type="datetime") */
    public $post_modified;

    /** @Column(type="datetime") */
    public $post_modified_gmt;

    /** @Column(type="text") */
    public $post_content_filtered;

    /** @Column(type="integer") */
    public $post_parent;

    /** @Column(type="string") */
    public $guid;

    /** @Column(type="integer") */
    public $menu_order;

    /** @Column(type="string") */
    public $post_type;

    /** @Column(type="string") */
    public $post_mime_type;

    /** @Column(type="integer") */
    public $comment_count;

    /** @var string The permalink of the post. */
    public $permalink = null;

    /**
     * Initialize a post's source & relationships
     *
     * @return void
     */
    /*public function initialize()*/
    //{
        //global $table_prefix;

        //$this->setSource($table_prefix . 'posts');

        //// Posts belong to an author
        //$this->belongsTo(
            //'post_author',
            //'Akufen\Orchestra\Mvc\Models\Users',
            //'ID',
            //array('alias' => 'postAuthor')
        //);

        //// Posts may have parent posts
        //$this->belongsTo(
            //'post_parent',
            //'Akufen\Orchestra\Mvc\Models\Posts',
            //'ID',
            //array('alias' => 'postParent')
        //);

        //// Posts have many post metas
        //$this->hasMany(
            //'ID',
            //'Akufen\Orchestra\Mvc\Models\PostMeta',
            //'post_id',
            //array('alias' => 'metas')
        //);

        //// Posts have many term relationships
        //$this->hasMany(
            //'ID',
            //'Akufen\Orchestra\Mvc\Models\TermRelationships',
            //'object_id',
            //array('alias' => 'termRelationships')
        //);
    /*}*/

    /**
     * Function to get the post's id.
     *
     * @return int $id The post's id.
     */
    public function getId()
    {
        return $this->ID;
    }

    /**
     * Retrieve the post's permalink.
     *
     * @return string $permalink The post's permalink.
     */
    public function getPermalink()
    {
        if ($this->permalink == null) {
            $this->permalink = get_permalink($this->ID);
        }

        return $this->permalink;
    }

    /**
     * Function to set the post's id.
     *
     * @return boolean True if the id has been updated.
     */
    public function setId($id)
    {
        $this->ID = intval($id);
    }
}
