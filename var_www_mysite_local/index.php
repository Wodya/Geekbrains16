<?php
require_once('vendor/autoload.php');
error_reporting(E_ALL);
ini_set('display_errors',1);
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class MyLog{
    public function __construct()
    {
        $this->log = new Logger('name');
        $this->log->pushHandler(new StreamHandler('log/my.log', Logger::INFO));
    }
    public  $log;
    public $lastMemoryUsage;
}


$log = new MyLog();

myLog($log, "Start");

for ($i=0; $i < 1000; $i ++) {
    echo "<b3> Число {$i} </b3>";
}
myLog($log, "Stop");

function myLog(MyLog $log, string $str){
    $memoryChange = '';
    // Вывод изменение в использованной памяти
    if(isset($log->lastMemoryUsage)){
        $change = memory_get_usage() - $log->lastMemoryUsage;
        $memoryChange = ". Memory change {$change}";
    }
    $log->log->info($str . $memoryChange);
    $log->lastMemoryUsage = memory_get_usage();
}
