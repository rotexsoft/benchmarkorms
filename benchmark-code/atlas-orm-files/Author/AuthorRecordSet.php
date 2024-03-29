<?php
declare(strict_types=1);

namespace Rotexsoft\PhpOrmBenchmarks\AtlasOrm\Blog\Author;

use Atlas\Mapper\RecordSet;

/**
 * @method AuthorRecord offsetGet($offset)
 * @method AuthorRecord appendNew(array $fields = [])
 * @method AuthorRecord|null getOneBy(array $whereEquals)
 * @method AuthorRecordSet getAllBy(array $whereEquals)
 * @method AuthorRecord|null detachOneBy(array $whereEquals)
 * @method AuthorRecordSet detachAllBy(array $whereEquals)
 * @method AuthorRecordSet detachAll()
 * @method AuthorRecordSet detachDeleted()
 */
class AuthorRecordSet extends RecordSet
{
}
