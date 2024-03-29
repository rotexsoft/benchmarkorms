<?php
declare(strict_types=1);

namespace Rotexsoft\PhpOrmBenchmarks\AtlasOrm\Blog\Post;

use Atlas\Mapper\Record;

/**
 * @method PostRow getRow()
 */
class PostRecord extends Record
{
    use PostFields;
}
