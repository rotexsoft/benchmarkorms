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

$climate->cyan(
    '<bold>NOTE:</bold> the chunk_size means that the records were fetched in batches of chunk_size, all the records always get fetched. '
    . 'For example if a table contains 5,000 records and the chunk_size is 1,000, this tool will cause each ORM in this scenario to fetch '
    . 'the 1st batch of 1000 records, 2nd batch, up until the 5th / last batch of 1000 records from that database table. '
    . 'Some ORM fetch strategies like Eloquent\'s lazy strategy do not do chunks and only always fetches all the data in one call.'
);

echo PHP_EOL . PHP_EOL;

// TODO:
// Render test results to a latest-test-results.html file containing datatables plugin
// Also render the results in Markdown and put it in a folder and link to it in README.md https://github.com/the-kbA-team/markdown-table

$climate->backgroundGreen('Goodbye!!!');

echo PHP_EOL . PHP_EOL;
