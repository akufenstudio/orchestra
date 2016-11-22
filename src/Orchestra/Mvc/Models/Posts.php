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
    /** @Id @Column(type="bigint", name="ID") @GeneratedValue */
    public $id;

    /**
     * @ManyToOne(targetEntity="Users")
     * @JoinColumn(name="post_author", referencedColumnName="ID")
     */
    public $author;

    /** @Column(type="datetime", name="post_date") */
    public $date;

    /** @Column(type="datetime", name="post_date_gmt") */
    public $dateGmt;

    /** @Column(type="text", name="post_content") */
    public $content;

    /** @Column(type="text", name="post_title") */
    public $title;

    /** @Column(type="text", name="post_excerpt") */
    public $excerpt;

    /** @Column(type="string", length=20, name="post_status") */
    public $status;

    /** @Column(type="string", length=20, name="comment_status") */
    public $commentStatus;

    /** @Column(type="string", length=20, name="ping_status") */
    public $pingStatus;

    /** @Column(type="string", length=20, name="post_password") */
    public $password;

    /** @Column(type="string", length=200, name="post_name") */
    public $name;

    /** @Column(type="text", name="to_ping") */
    public $toPing;

    /** @Column(type="text") */
    public $pinged;

    /** @Column(type="datetime", name="post_modified") */
    public $modified;

    /** @Column(type="datetime", name="post_modified_gmt") */
    public $modifiedGmt;

    /** @Column(type="text", name="post_content_filtered") */
    public $contentFiltered;

    /** @Column(type="bigint", name="post_parent") */
    public $parent;

    /** @Column(type="string") */
    public $guid;

    /** @Column(type="integer", name="menu_order") */
    public $menuOrder;

    /** @Column(type="string", length=20, name="post_type") */
    public $type;

    /** @Column(type="string", length=100, name="post_mime_type") */
    public $mimeType;

    /** @Column(type="bigint", name="comment_count") */
    public $commentCount;

    /** @var string The permalink of the post. */
    public $permalink;

    /**
     * Retrieve the post's permalink.
     *
     * @return string $permalink The post's permalink.
     */
    public function getPermalink()
    {
        return ($this->permalink === null)? $this->permalink :
            $this->permalink = get_permalink($this->ID);
    }
}
