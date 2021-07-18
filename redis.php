<?php
class redisCacheProvider {
    private $connection = null;
    private function getConnection(){
        if($this->connection===null){
            $this->connection = new Redis();
            $this->connection->connect('localhost');
        }
        return $this->connection;
    }
    public function get($key){
        $result = false;
        if($c = $this->getConnection()){
            $result = unserialize($c->get($key));
        }
        return $result;
    }
    public function set($key, $value, $time=0){
        if($c=$this->getConnection()){
            $c->set($key, serialize($value), $time);
        }
    }
    public function del($key){
        if($c=$this->getConnection()){
            $c->del($key);
        }
    }
    public function clear(){
        if($c=$this->getConnection()){
            $c->flushDB();
        }
    }
}
$time1 = microtime(true);
$fileStr = file_get_contents("demo.txt");
$time2 = microtime(true);

$redis = new redisCacheProvider();
$redis->set('fileCash',$fileStr, 10);

$time3 = microtime(true);
$cashStr = $redis->get('fileCash');
$time4 = microtime(true);

echo 'Загрузка из файла = ' . 1000000.0*($time2 - $time1) . " мкс<BR>";
echo 'Загрузка из кэша = ' . 1000000.0*($time4 - $time3) . " мкс<BR>";

$redis->del('key1');

