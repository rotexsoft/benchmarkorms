<?php
declare(strict_types=1);

namespace Rotexsoft\PhpOrmBenchmarks\LeanOrm\Blog\Posts;

use Rotexsoft\PhpOrmBenchmarks\LeanOrm\Blog\Authors\{AuthorRecord, AuthorsModel, AuthorsCollection};
use Rotexsoft\PhpOrmBenchmarks\LeanOrm\Blog\Comments\{CommentRecord, CommentsModel, CommentsCollection};
use Rotexsoft\PhpOrmBenchmarks\LeanOrm\Blog\Summaries\{SummaryRecord, SummariesModel, SummariesCollection};
use Rotexsoft\PhpOrmBenchmarks\LeanOrm\Blog\Tags\{TagRecord, TagsModel, TagsCollection};
use Rotexsoft\PhpOrmBenchmarks\LeanOrm\Blog\PostsTags\PostsTagsModel;

/**
 * @method PostsCollection createNewCollection(\GDAO\Model\RecordInterface ...$list_of_records)
 * @method PostRecord createNewRecord(array $col_names_n_vals = [])
 * @method ?PostRecord fetchOneRecord(?object $select_obj=null, array $relations_to_include=[])
 * @method PostRecord[] fetchRecordsIntoArray(?object $select_obj=null, array $relations_to_include=[])
 * @method PostRecord[] fetchRecordsIntoArrayKeyedOnPkVal(?\Aura\SqlQuery\Common\Select $select_obj=null, array $relations_to_include=[])
 * @method PostsCollection fetchRecordsIntoCollection(?object $select_obj=null, array $relations_to_include=[])
 * @method PostsCollection fetchRecordsIntoCollectionKeyedOnPkVal(?\Aura\SqlQuery\Common\Select $select_obj=null, array $relations_to_include=[])
 */
class PostsModel extends \LeanOrm\CachingModel {
    
    protected ?string $collection_class_name = PostsCollection::class;
    
    protected ?string $record_class_name = PostRecord::class;
    
    protected ?string $created_timestamp_column_name = 'date_created';
    
    protected ?string $updated_timestamp_column_name = 'm_timestamp';
    
    protected string $primary_col = 'post_id';
    
    protected string $table_name = 'posts';
    
    public function __construct(
        string $dsn = '', 
        string $username = '', 
        string $passwd = '', 
        array $pdo_driver_opts = [], 
        string $primary_col_name = '', 
        string $table_name = ''
    ) {
        $this->table_cols = include(__DIR__ . DIRECTORY_SEPARATOR . 'PostsFieldsMetadata.php');
        
        parent::__construct($dsn, $username, $passwd, $pdo_driver_opts, $primary_col_name, $table_name);
        
        // Define relationships below here
        
        $this->belongsTo(
                'author',    // The property or field name via which related data will be 
                             // accessed on each post record or on each array of posts table data

                'author_id', // Foreign key column in this Model's db table (i.e. posts table)

                'authors',   // Foreign db table from which related data will be fetched

                'author_id', // Foreign key column in foreign Model's db table (i.e. authors table)

                'author_id', // Primary key column in foreign Model's db table (i.e. authors table)

                AuthorsModel::class // Foreign Model Class, defaults to \LeanOrm\Model
            )
            ->hasOne(
                'summary',    // The property or field name via which related data will be 
                              // accessed on each post record or on each array of posts table data

                'post_id',    // Foreign key column in this Model's db table (i.e. posts table)

                'summaries',  // Foreign db table from which related data will be fetched

                'post_id',    // Foreign key column in foreign Model's db table (i.e. summaries table)

                'summary_id', // Primary key column in foreign Model's db table (i.e. summaries table)

                SummariesModel::class // Foreign Model Class, defaults to \LeanOrm\Model
            )
            ->hasMany(
                'comments', // The property or field name via which related data will be 
                            // accessed on each post record or on each array of posts table data

                'post_id',  // Foreign key column in this Model's db table (i.e. posts table)

                'comments', // Foreign db table from which related data will be fetched

                'post_id',  // Foreign key column in foreign Model's db table (i.e. comments table)

                'comment_id', // Primary key column in foreign Model's db table (i.e. comments table)

                CommentsModel::class // Foreign Model Class, defaults to \LeanOrm\Model
            )
            ->hasMany(
                'posts_tags',   // The property or field name via which related data will be 
                                // accessed on each post record or on each array of posts table data

                'post_id',  // Foreign key column in this Model's db table (i.e. posts table)

                'posts_tags', // Foreign db table from which related data will be fetched

                'post_id',  // Foreign key column in foreign Model's db table (i.e. posts_tags table)

                'posts_tags_id', // Primary key column in foreign Model's db table (i.e. posts_tags table)

                PostsTagsModel::class // Foreign Model Class, defaults to \LeanOrm\Model
            )
            ->hasManyThrough(
                'tags',         // The property or field name via which related data will be 
                                // accessed on each post record or on each array of posts table data
                
                'post_id',      // Foreign key column in this Model's db table (i.e. posts table)
                
                'posts_tags',   // Foreign JOIN db table from which contains the associations between records in this
                                // model's db table (i.e. the posts table) and the records in the foreign db table
                                // (i.e. the tags table)
                
                'post_id',      // Join column in this Model's db table (i.e. posts table) linked to the 
                                // foreign JOIN db table (i.e. posts_tags)
                
                'tag_id',       // Join column in foreign Model's db table (i.e. tags table) linked to the 
                                // foreign JOIN db table (i.e. posts_tags)
                
                'tags',         // Foreign db table from which related data will be fetched
                
                'tag_id',       // Foreign key column in foreign Model's db table (i.e. tags table)
                
                'tag_id',       // Primary key column in foreign Model's db table (i.e. tags table)

                TagsModel::class // Foreign Model Class, defaults to \LeanOrm\Model
            );
    }
}
