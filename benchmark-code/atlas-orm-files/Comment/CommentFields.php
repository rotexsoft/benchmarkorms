<?php
/**
 * This file was generated by Atlas. Changes will be overwritten.
 */
declare(strict_types=1);

namespace Rotexsoft\PhpOrmBenchmarks\AtlasOrm\Blog\Comment;

/**
 * @property mixed $comment_id int(10,0) NOT NULL
 * @property mixed $post_id int(10,0) NOT NULL
 * @property mixed $datetime timestamp
 * @property mixed $name varchar(255) NOT NULL
 * @property mixed $email varchar(255) NOT NULL
 * @property mixed $website varchar(255) NOT NULL
 * @property mixed $body text(65535)
 * @property mixed $m_timestamp timestamp NOT NULL
 * @property mixed $date_created timestamp NOT NULL
 * @property null|false|\Rotexsoft\PhpOrmBenchmarks\AtlasOrm\Blog\Post\PostRecord $post
 */
trait CommentFields
{
}
