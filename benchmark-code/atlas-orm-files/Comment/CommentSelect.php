<?php
declare(strict_types=1);

namespace Benchmark\AtlasOrm\Blog\Comment;

use Atlas\Mapper\MapperSelect;

/**
 * @method CommentRecord|null fetchRecord()
 * @method CommentRecord[] fetchRecords()
 * @method CommentRecordSet fetchRecordSet()
 */
class CommentSelect extends MapperSelect
{
}
