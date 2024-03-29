<?php
declare(strict_types=1);

namespace Rotexsoft\PhpOrmBenchmarks;

use kbATeam\MarkdownTable\{Column, Table};
use FormatPHP\{Config, FormatPHP, Intl};

/**
 * Description of Utils
 *
 * @author rotimi
 */
class Utils {
    
    private final function __construct() { }
    
    public static function printDbInfo(\PDO $pdo): void {
        
        echo \LeanOrmCli\SchemaUtils::getCurrentConnectionInfo(
            $pdo
        ) . PHP_EOL;
    }
    
    public static function showOrmVersion(string $package_name): void {
        
        echo $package_name . ': ' 
            . \Composer\InstalledVersions::getVersion($package_name) 
            . ' installed'. PHP_EOL . PHP_EOL;
    }
    
    protected static function fetchBenchmarkResults(
        string $shell_script_start_time,
        array $cols_to_fetch = [
            'orm_vendor', 'short_desc', 'strategy', 
            'chunk_size', 'execution_duration', 'memory_used', 
            'execution_duration_in_seconds', 'memory_used_in_bytes',
        ]
    ): array {
        include __DIR__ . DIRECTORY_SEPARATOR . '../load-lean.php'; // $leanArgs is declared in load-lean.php
        
        $benchmarkResultsModel = new \Rotexsoft\PhpOrmBenchmarks\LeanOrm\Blog\BenchmarksResults\BenchmarksResultsModel(...$leanArgs);
        
        $view_data = [];
        $view_data['test_results'] = $benchmarkResultsModel->fetchRowsIntoArray(
            $benchmarkResultsModel->getSelect()
                                  ->cols($cols_to_fetch)
                                  ->where(' shell_script_start_time = ? ', $shell_script_start_time)
        );

        foreach($view_data['test_results'] as $key=>$val) {

            if($val['chunk_size'] === null) { 
                
                $view_data['test_results'][$key]['chunk_size'] = 'No limit clause'; 
            }
        }
        
        $operating_system = ''; // $distro['name'] will report this for non-Linux
        $distro = [
            'name' => php_uname('s'),
            'version' => php_uname('r') . ' - ' . php_uname('v') . ' - ' . php_uname('m'),
        ];
        
        if(PHP_OS === 'Linux') {

            // use linfo to get detailed linux os info
            $linfo = new \Linfo\Linfo();
            $parser = $linfo->getParser();
            $operating_system = $parser->getOS() . ' -';
            $distro = $parser->getDistro();
        }
        
        $view_data['operating_system'] = $operating_system;
        $view_data['distro'] = $distro;
        
        $view_data['db_version'] = 
            $benchmarkResultsModel->getPDO()->getAttribute(\PDO::ATTR_DRIVER_NAME) 
            . ' - ' 
            . $benchmarkResultsModel->getPDO()->getAttribute(\PDO::ATTR_SERVER_VERSION);
        
        $view_data['date_generated'] = date('Y-m-d h:i:s');
        
        return $view_data;
    }

    public static function dumpLatestResultsToMarkdown(
        string $shell_script_start_time, 
        string $header,
        string $result_destination_file_path,
        string $file_name
    ): void {
        
        $benchmark_data = static::fetchBenchmarkResults(
            $shell_script_start_time,
            [
                'orm_vendor', 'short_desc', 'strategy', 
                'chunk_size', 'execution_duration', 'memory_used',
            ]
        );
        $test_results = $benchmark_data['test_results'];

        foreach($test_results as $key=>$val) {

            if($val['chunk_size'] === null) { $test_results[$key]['chunk_size'] = 'No limit clause'; }
        }
        
        $operating_system = $benchmark_data['operating_system']; 
        $distro = $benchmark_data['distro'];
        
        $php_version = '**Benchmarks were run on PHP Version:** '. PHP_VERSION;
        $os_full = "**Operating System:** {$operating_system} {$distro['name']} - {$distro['version']} ";
        $db_version = $benchmark_data['db_version'];
        $date_generated = $benchmark_data['date_generated'];

        $output = "# $header\n\n{$php_version}\n\n{$os_full}\n\n**Database:** {$db_version}\n\n{$date_generated}\n\n\n\n";

        $table = new Table();
        $table->addColumn('orm_vendor', new Column('orm_vendor', Column::ALIGN_LEFT));
        $table->addColumn('short_desc', new Column('short_desc', Column::ALIGN_LEFT));
        $table->addColumn('strategy', new Column('strategy', Column::ALIGN_LEFT));
        $table->addColumn('chunk_size', new Column('chunk_size', Column::ALIGN_LEFT));
        $table->addColumn('execution_duration', new Column('execution_duration', Column::ALIGN_LEFT));
        $table->addColumn('memory_used', new Column('memory_used', Column::ALIGN_LEFT));
        
        foreach ($table->generate($test_results) as $row) {
            
            //printf('%s%s', $row, PHP_EOL);
            $output .= $row . PHP_EOL;
        }
        
        $save_path = \LeanOrmCli\FileIoUtils::concatDirAndFileName(
            $result_destination_file_path, $file_name
        );
        file_put_contents($save_path, $output);
        
        echo "Results have been saved to `{$save_path}`" . PHP_EOL;
    }
    
    public static function dumpLatestResultsToHtml(
        string $shell_script_start_time, 
        string $header, 
        string $result_destination_file_path,
        string $file_name
    ): void {
        
        $view_data = static::fetchBenchmarkResults($shell_script_start_time);
        $view_data['header'] = $header;
        $view_data['graphing_data'] = [];
        
        ///////////////////////
        // Build graphing data
        ///////////////////////

        foreach ($view_data['test_results'] as $test_result) {
            
            if(!array_key_exists($test_result['short_desc'], $view_data['graphing_data'])) {
                
                $view_data['graphing_data'][$test_result['short_desc']] = [];
            }
            
            $view_data['graphing_data'][$test_result['short_desc']][] = [
                'orm_vendor' => $test_result['orm_vendor'],
                'strategy' => $test_result['strategy'],
                'execution_duration' => $test_result['execution_duration'],
                'memory_used' => $test_result['memory_used'],
                'execution_duration_in_seconds' => $test_result['execution_duration_in_seconds'],
                'memory_used_in_bytes' => $test_result['memory_used_in_bytes'],
                'chunk_size' => is_numeric($test_result['chunk_size']) ? number_format((float)$test_result['chunk_size']) : $test_result['chunk_size'],
            ];
        } // foreach ($view_data['test_results'] as $test_result)
        
        $renderer = new \Rotexsoft\FileRenderer\Renderer(
            'results-template.php',
            $view_data,
            [ __DIR__ . DIRECTORY_SEPARATOR . '../benchmark-results' ]
        );
        
        $save_path = \LeanOrmCli\FileIoUtils::concatDirAndFileName(
            $result_destination_file_path, $file_name
        );
        file_put_contents($save_path, $renderer->renderToString());
        
        echo "Results have been saved to `{$save_path}`" . PHP_EOL;
    }
    
    public static function getNumRowsInDbTable(\PDO $pdo, string $table_name) {

        $statement = $pdo->prepare("select count(*) from {$table_name} ");
        $statement->execute();

        return $statement->fetchColumn(0);
    }
    
    public static function createClimateProgressBar(
        \PDO $pdo, string $table_name, 
        ?int $limit, bool $fetch_only_first_set
    ): \League\CLImate\TerminalObject\Dynamic\Progress {
        
        $climate = new \League\CLImate\CLImate();
        
        $expected_total_num_records = \Rotexsoft\PhpOrmBenchmarks\Utils::getNumRowsInDbTable($pdo, $table_name);
        
        if($limit !== null && $fetch_only_first_set) {
            
            $expected_total_num_records = $limit;
        }
        
        return $climate->progress()->total($expected_total_num_records);
    }
}
