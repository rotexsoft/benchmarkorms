<?php
/**
 * This file was generated by Atlas. Changes will be overwritten.
 */
declare(strict_types=1);

namespace Benchmark\AtlasOrm\Blog\Summary;

use Atlas\Table\Table;

/**
 * @method SummaryRow|null fetchRow($primaryVal)
 * @method SummaryRow[] fetchRows(array $primaryVals)
 * @method SummaryTableSelect select(array $whereEquals = [])
 * @method SummaryRow newRow(array $cols = [])
 * @method SummaryRow newSelectedRow(array $cols)
 */
class SummaryTable extends Table
{
    const DRIVER = 'sqlite';

    const NAME = 'summaries';

    const COLUMNS = [
        'summary_id' => [
            'name' => 'summary_id',
            'type' => 'INTEGER',
            'size' => null,
            'scale' => null,
            'notnull' => true,
            'default' => null,
            'autoinc' => true,
            'primary' => true,
            'options' => null,
        ],
        'post_id' => [
            'name' => 'post_id',
            'type' => 'INTEGER',
            'size' => null,
            'scale' => null,
            'notnull' => true,
            'default' => null,
            'autoinc' => false,
            'primary' => false,
            'options' => null,
        ],
        'view_count' => [
            'name' => 'view_count',
            'type' => 'INTEGER',
            'size' => null,
            'scale' => null,
            'notnull' => true,
            'default' => null,
            'autoinc' => false,
            'primary' => false,
            'options' => null,
        ],
        'comment_count' => [
            'name' => 'comment_count',
            'type' => 'INTEGER',
            'size' => null,
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
        'summary_id',
        'post_id',
        'view_count',
        'comment_count',
        'm_timestamp',
        'date_created',
    ];

    const COLUMN_DEFAULTS = [
        'summary_id' => null,
        'post_id' => null,
        'view_count' => null,
        'comment_count' => null,
        'm_timestamp' => 'CURRENT_TIMESTAMP',
        'date_created' => 'CURRENT_TIMESTAMP',
    ];

    const PRIMARY_KEY = [
        'summary_id',
    ];

    const AUTOINC_COLUMN = 'summary_id';

    const AUTOINC_SEQUENCE = null;
}
