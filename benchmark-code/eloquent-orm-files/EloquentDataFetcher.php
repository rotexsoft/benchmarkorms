<?php
declare(strict_types=1);

namespace Rotexsoft\PhpOrmBenchmarks\Eloquent;

/**
 * Description of EloquentDataFetcher
 *
 * @author rotimi
 */
class EloquentDataFetcher {
    
    public const TABLE_TO_MODEL_MAP = [
        'authors'       => Blog\Author::class,
        'comments'      => Blog\Comment::class,
        'posts'         => Blog\Post::class,
        'posts_tags'    => Blog\PostsTag::class,
        'summaries'     => Blog\Summary::class,
        'tags'          => Blog\Tag::class,
    ];
    
    public const DEFAULT_LIMIT = 999;
    
    public static function fetchAll(
        string $table_name, 
        array $relation_names,
        int $offset = 0,                       // only applicable to the get strategy, lazy & chunk don't need it
        ?int $limit = self::DEFAULT_LIMIT,   //only applicable to the get & chunk strategies, lazy  doesn't need it
        string $strategy = EloquentFetchStrategies::CHUNK // chunk, get or lazy
    ) {
        \Rotexsoft\PhpOrmBenchmarks\BootstrapEloquent::setup();
        
        /** @var \Illuminate\Database\Eloquent\Model $model_class */
        $model_class = static::TABLE_TO_MODEL_MAP[$table_name];
        
        $result = new \Illuminate\Database\Eloquent\Collection();
        
        if($strategy === EloquentFetchStrategies::GET) {
            
            return is_null($limit) 
                    ? $model_class::with($relation_names)->get()
                    : $model_class::with($relation_names)->offset($offset)->limit($limit)->get();
            
        } elseif($strategy === EloquentFetchStrategies::LAZY) {
            
            return $model_class::with($relation_names)->lazy();
            
        } else {
            
            // Default: EloquentFetchStrategies::CHUNK 
            $model_class::with($relation_names)->chunk($limit ?? static::DEFAULT_LIMIT, function ($records)use($result) {

                foreach ($records as $record) {

                    $result[] = $record;
                }
            });
            
            return $result;
        }
    }
}
