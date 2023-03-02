<?php
/**
 * This file was generated by Atlas. Changes will be overwritten.
 */
declare(strict_types=1);

namespace Rotexsoft\PhpOrmBenchmarks\AtlasOrm\Blog\Author;

use Atlas\Table\Table;

/**
 * @method AuthorRow|null fetchRow($primaryVal)
 * @method AuthorRow[] fetchRows(array $primaryVals)
 * @method AuthorTableSelect select(array $whereEquals = [])
 * @method AuthorRow newRow(array $cols = [])
 * @method AuthorRow newSelectedRow(array $cols)
 */
class AuthorTable extends Table
{
    const DRIVER = 'sqlite';

    const NAME = 'authors';

    const COLUMNS = [
        'author_id' => [
            'name' => 'author_id',
            'type' => 'INTEGER',
            'size' => null,
            'scale' => null,
            'notnull' => true,
            'default' => null,
            'autoinc' => true,
            'primary' => true,
            'options' => null,
        ],
        'name' => [
            'name' => 'name',
            'type' => 'VARCHAR',
            'size' => 255,
            'scale' => null,
            'notnull' => true,
            'default' => null,
            'autoinc' => false,
            'primary' => false,
            'options' => null,
        ],
        'm_timestamp' => [
            'name' => 'm_timestamp',
            'type' => 'TIMESTAMP_TEXT',
            'size' => null,
            'scale' => null,
            'notnull' => true,
            'default' => 'CURRENT_TIMESTAMP',
            'autoinc' => false,
            'primary' => false,
            'options' => null,
        ],
        'date_created' => [
            'name' => 'date_created',
            'type' => 'TIMESTAMP_TEXT',
            'size' => null,
            'scale' => null,
            'notnull' => true,
            'default' => 'CURRENT_TIMESTAMP',
            'autoinc' => false,
            'primary' => false,
            'options' => null,
        ],
    ];

    const COLUMN_NAMES = [
        'author_id',
        'name',
        'm_timestamp',
        'date_created',
    ];

    const COLUMN_DEFAULTS = [
        'author_id' => null,
        'name' => null,
        'm_timestamp' => 'CURRENT_TIMESTAMP',
        'date_created' => 'CURRENT_TIMESTAMP',
    ];

    const PRIMARY_KEY = [
        'author_id',
    ];

    const AUTOINC_COLUMN = 'author_id';

    const AUTOINC_SEQUENCE = null;
}
