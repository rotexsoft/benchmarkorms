<?php
/**
 * This file was generated by Atlas. Changes will be overwritten.
 */
declare(strict_types=1);

namespace Rotexsoft\PhpOrmBenchmarks\AtlasOrm\Blog\Comment;

/**
 * @property mixed $comment_id INTEGER NOT NULL
 * @property mixed $post_id INTEGER NOT NULL
 * @property mixed $datetime TIMESTAMP_TEXT
 * @property mixed $name VARCHAR(255) NOT NULL
 * @property mixed $email VARCHAR(255) NOT NULL
 * @property mixed $website VARCHAR(255) NOT NULL
 * @property mixed $body TEXT
 * @property mixed $m_timestamp TIMESTAMP_TEXT NOT NULL
 * @property mixed $date_created TIMESTAMP_TEXT NOT NULL
 * @property null|false|\Rotexsoft\PhpOrmBenchmarks\AtlasOrm\Blog\Post\PostRecord $post
 */
trait CommentFields
{
}
