<?php
/**
 * This file was generated by Atlas. Changes will be overwritten.
 */
declare(strict_types=1);

namespace Rotexsoft\PhpOrmBenchmarks\AtlasOrm\Blog\BenchmarkResult;

use Atlas\Table\Table;

/**
 * @method BenchmarkResultRow|null fetchRow($primaryVal)
 * @method BenchmarkResultRow[] fetchRows(array $primaryVals)
 * @method BenchmarkResultTableSelect select(array $whereEquals = [])
 * @method BenchmarkResultRow newRow(array $cols = [])
 * @method BenchmarkResultRow newSelectedRow(array $cols)
 */
class BenchmarkResultTable extends Table
{
    const DRIVER = 'mysql';

    const NAME = 'benchmark_results';

    const COLUMNS = [
        'id' => [
            'name' => 'id',
            'type' => 'int unsigned',
            'size' => 10,
            'scale' => 0,
            'notnull' => true,
            'default' => null,
            'autoinc' => true,
            'primary' => true,
            'options' => null,
        ],
        'orm_vendor' => [
            'name' => 'orm_vendor',
            'type' => 'varchar',
            'size' => 255,
            'scale' => null,
            'notnull' => true,
            'default' => null,
            'autoinc' => false,
            'primary' => false,
            'options' => null,
        ],
        'short_desc' => [
            'name' => 'short_desc',
            'type' => 'text',
            'size' => 65535,
            'scale' => null,
            'notnull' => true,
            'default' => null,
            'autoinc' => false,
            'primary' => false,
            'options' => null,
        ],
        'strategy' => [
            'name' => 'strategy',
            'type' => 'text',
            'size' => 65535,
            'scale' => null,
            'notnull' => true,
            'default' => null,
            'autoinc' => false,
            'primary' => false,
            'options' => null,
        ],
        'chunk_size' => [
            'name' => 'chunk_size',
            'type' => 'int unsigned',
            'size' => 10,
            'scale' => 0,
            'notnull' => false,
            'default' => null,
            'autoinc' => false,
            'primary' => false,
            'options' => null,
        ],
        'execution_duration' => [
            'name' => 'execution_duration',
            'type' => 'text',
            'size' => 65535,
            'scale' => null,
            'notnull' => true,
            'default' => null,
            'autoinc' => false,
            'primary' => false,
            'options' => null,
        ],
        'memory_used' => [
            'name' => 'memory_used',
            'type' => 'text',
            'size' => 65535,
            'scale' => null,
            'notnull' => true,
            'default' => null,
            'autoinc' => false,
            'primary' => false,
            'options' => null,
        ],
        'shell_script_start_time' => [
            'name' => 'shell_script_start_time',
            'type' => 'text',
            'size' => 65535,
            'scale' => null,
            'notnull' => true,
            'default' => null,
            'autoinc' => false,
            'primary' => false,
            'options' => null,
        ],
        'm_timestamp' => [
            'name' => 'm_timestamp',
            'type' => 'timestamp',
            'size' => null,
            'scale' => null,
            'notnull' => true,
            'default' => null,
            'autoinc' => false,
            'primary' => false,
            'options' => null,
        ],
        'date_created' => [
            'name' => 'date_created',
            'type' => 'timestamp',
            'size' => null,
            'scale' => null,
            'notnull' => true,
            'default' => null,
            'autoinc' => false,
            'primary' => false,
            'options' => null,
        ],
    ];

    const COLUMN_NAMES = [
        'id',
        'orm_vendor',
        'short_desc',
        'strategy',
        'chunk_size',
        'execution_duration',
        'memory_used',
        'shell_script_start_time',
        'm_timestamp',
        'date_created',
    ];

    const COLUMN_DEFAULTS = [
        'id' => null,
        'orm_vendor' => null,
        'short_desc' => null,
        'strategy' => null,
        'chunk_size' => null,
        'execution_duration' => null,
        'memory_used' => null,
        'shell_script_start_time' => null,
        'm_timestamp' => null,
        'date_created' => null,
    ];

    const PRIMARY_KEY = [
        'id',
    ];

    const AUTOINC_COLUMN = 'id';

    const AUTOINC_SEQUENCE = null;
}