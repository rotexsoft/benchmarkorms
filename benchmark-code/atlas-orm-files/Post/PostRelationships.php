<?php
declare(strict_types=1);

namespace Rotexsoft\PhpOrmBenchmarks\AtlasOrm\Blog\Post;

use Atlas\Mapper\MapperRelationships;
use Rotexsoft\PhpOrmBenchmarks\AtlasOrm\Blog\Author\Author;
use Rotexsoft\PhpOrmBenchmarks\AtlasOrm\Blog\Summary\Summary;
use Rotexsoft\PhpOrmBenchmarks\AtlasOrm\Blog\Comment\Comment;
use Rotexsoft\PhpOrmBenchmarks\AtlasOrm\Blog\PostsTag\PostsTag;
use Rotexsoft\PhpOrmBenchmarks\AtlasOrm\Blog\Tag\Tag;

class PostRelationships extends MapperRelationships
{
    protected function define()
    {
        $this->manyToOne(
          'author',
          Author::class,
            [
                'author_id' => 'author_id'
            ]
        );
        
        $this->oneToOne(
            'summary', 
            Summary::class,
            [
                'post_id' => 'post_id',
            ]
        );
        
        $this->oneToMany(
            'comments',
            Comment::class,
            [
                'post_id' => 'post_id'
            ]
        );
        
        // the "through" relationship that joins post and tags
        $this->oneToMany(
            'posts_tags', 
            PostsTag::class,
            [
                'post_id' => 'post_id',
            ]
        );
        
        // the "foreign" relationship "through" posts_tags
        $this->manyToMany(
            'tags', 
            Tag::class, 
            'posts_tags',
            [
               'tag_id' => 'tag_id',
            ]
        );
    }
}
