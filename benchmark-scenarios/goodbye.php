<?php
include __DIR__ .DIRECTORY_SEPARATOR. '../vendor/autoload.php';
include __DIR__ . DIRECTORY_SEPARATOR . '../load-lean.php';

$benchmarkResultsModel = new \Rotexsoft\PhpOrmBenchmarks\LeanOrm\Blog\BenchmarksResults\BenchmarksResultsModel(...$leanArgs);
$test_results = $benchmarkResultsModel->fetchRowsIntoArray(
    $benchmarkResultsModel->getSelect()
                          ->cols(['orm_vendor', 'short_desc', 'strategy', 'chunk_size', 'execution_duration', 'memory_used'])
                          ->where(' shell_script_start_time = ? ', $_SERVER['argv'][1])
);

foreach($test_results as $key=>$val) {
    
    if($val['chunk_size'] === null) {
        
        $test_results[$key]['chunk_size'] = 'No limit clause';
    }
}

$climate = new League\CLImate\CLImate;
$climate->bold()->backgroundDarkGray()->border('==');
$climate->backgroundGreen('All benchmark scripts have been executed.');
$climate->backgroundGreen('Printing Results:');
$climate->bold()->backgroundDarkGray()->border('==');

echo PHP_EOL . PHP_EOL;

$climate->yellowTable($test_results);

echo PHP_EOL . PHP_EOL;

$climate->lightRed('NOTE: the chunk_size means that the records were fetched in batches of chunk_size, all the records always get fetched.');

echo PHP_EOL . PHP_EOL;

$climate->backgroundGreen('Goodbye!!!');

echo PHP_EOL . PHP_EOL;