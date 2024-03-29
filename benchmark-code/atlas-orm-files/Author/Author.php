<?php
declare(strict_types=1);

namespace Rotexsoft\PhpOrmBenchmarks\AtlasOrm\Blog\Author;

use Atlas\Mapper\Mapper;
use Atlas\Table\Row;

/**
 * @method AuthorTable getTable()
 * @method AuthorRelationships getRelationships()
 * @method AuthorRecord|null fetchRecord($primaryVal, array $with = [])
 * @method AuthorRecord|null fetchRecordBy(array $whereEquals, array $with = [])
 * @method AuthorRecord[] fetchRecords(array $primaryVals, array $with = [])
 * @method AuthorRecord[] fetchRecordsBy(array $whereEquals, array $with = [])
 * @method AuthorRecordSet fetchRecordSet(array $primaryVals, array $with = [])
 * @method AuthorRecordSet fetchRecordSetBy(array $whereEquals, array $with = [])
 * @method AuthorSelect select(array $whereEquals = [])
 * @method AuthorRecord newRecord(array $fields = [])
 * @method AuthorRecord[] newRecords(array $fieldSets)
 * @method AuthorRecordSet newRecordSet(array $records = [])
 * @method AuthorRecord turnRowIntoRecord(Row $row, array $with = [])
 * @method AuthorRecord[] turnRowsIntoRecords(array $rows, array $with = [])
 */
class Author extends Mapper
{
}
