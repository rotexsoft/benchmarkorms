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
        'authors'           => Blog\Author::class,
        'benchmark_results' => Blog\BenchmarkResult::class,
        'comments'          => Blog\Comment::class,
        'posts'             => Blog\Post::class,
        'posts_tags'        => Blog\PostsTag::class,
        'summaries'         => Blog\Summary::class,
        'tags'              => Blog\Tag::class,
    ];
    
    public const DEFAULT_LIMIT = 999;
    
    /**
     * Note, chunk will always return an empty collection because you are expected
     * to use the callback passed to chunk to manipulate the records returned in 
     * each chunk
     * 
     * @param string $table_name
     * @param array $relation_names
     * @param int $offset
     * @param int|null $limit
     * @param string $strategy
     * @param callable $callback_for_chunk
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function fetchAll(
        string $table_name, 
        array $relation_names,
        int $offset = 0,                       // only applicable to the get strategy, lazy & chunk don't need it
        ?int $limit = self::DEFAULT_LIMIT,   //only applicable to the get & chunk strategies, lazy  doesn't need it
        string $strategy = EloquentFetchStrategies::CHUNK, // chunk, get or lazy
        callable $callback_for_chunk = null // for chunk
    ) {
        \Rotexsoft\PhpOrmBenchmarks\BootstrapEloquent::setup();
        
        /** @var \Illuminate\Database\Eloquent\Model $model_class */
        $model_class = static::TABLE_TO_MODEL_MAP[$table_name];
        
        if($strategy === EloquentFetchStrategies::GET) {
            
            return is_null($limit) 
                    ? $model_class::with($relation_names)->get()
                    : $model_class::with($relation_names)->offset($offset)->limit($limit)->get();
            
        } elseif($strategy === EloquentFetchStrategies::LAZY) {
            
            return is_null($limit)
                    ? $model_class::with($relation_names)->lazy() // will use lazy's default lazy($chunkSize = 1000) 
                    : $model_class::with($relation_names)->lazy($limit);
            
        } else {
            
            // Default: EloquentFetchStrategies::CHUNK 
            $model_class::with($relation_names)->chunk($limit ?? static::DEFAULT_LIMIT, $callback_for_chunk);
            
            // all that needs to be done to the records fetched via chunk should have been
            // done inside $callback_for_chunk, no need to return those records here
            return new \Illuminate\Database\Eloquent\Collection();
        }
    }
    
    public static function insert(
        string $table_name, 
        array $data
    ) {
        
        $model_class = static::TABLE_TO_MODEL_MAP[$table_name];
        
        /** @var \Illuminate\Database\Eloquent\Model $model */
        $model = new $model_class;
        $model->forceFill($data);
        $model->save();
    }
    
    public static function storeBenchmarkResult(array $data) {
        
        $data['m_timestamp'] = date('Y-m-d H:i:s');
        $data['date_created'] = date('Y-m-d H:i:s');
        
        static::insert('benchmark_results', $data);
    }
}
