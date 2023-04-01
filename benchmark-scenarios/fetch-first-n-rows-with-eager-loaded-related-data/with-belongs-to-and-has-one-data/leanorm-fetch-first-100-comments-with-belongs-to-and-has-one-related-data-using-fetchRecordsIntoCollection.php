<?php
include __DIR__ .DIRECTORY_SEPARATOR. '../../../load-lean.php';

$scenario = ucfirst(str_replace( ['-','.php'], [' ', ''], basename(__FILE__) ));

echo \Rotexsoft\PhpOrmBenchmarks\Ubench\MessageResources::RUNNING_SCENARIO 
    . $scenario . PHP_EOL . PHP_EOL;

$runner = new \Rotexsoft\PhpOrmBenchmarks\Ubench\LeanOrmBelongsToOrHasOneRunner();

$runner(
    new Ubench(), 'comments', [ 'post' => 'title'], 'name', 0, 100,
    \Rotexsoft\PhpOrmBenchmarks\LeanOrm\LeanOrmFetchStrategies::FETCH_RECORDS_INTO_COLLECTION,
    $leanArgs, $_SERVER['argv'][1], true
);

echo \Rotexsoft\PhpOrmBenchmarks\Ubench\MessageResources::SCENARIO_ENDED
    . $scenario . PHP_EOL 
    . str_repeat('=========================================================', 2)
    . PHP_EOL . PHP_EOL;
