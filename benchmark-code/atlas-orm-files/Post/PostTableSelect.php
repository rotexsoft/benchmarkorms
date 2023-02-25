<?php
declare(strict_types=1);

namespace Benchmark\AtlasOrm\Blog\Post;

use Atlas\Table\TableSelect;

/**
 * @method PostRow|null fetchRow()
 * @method PostRow[] fetchRows()
 */
class PostTableSelect extends TableSelect
{
}