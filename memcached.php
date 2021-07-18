<?php
$m = new Memcached();
$m->addServer('localhost',11211);

$m->set('example_int',1976);
$m->set('example_string', 'test memcached');
//$m->set('example_array', [5,4,3,2,1], time() + 5);
$m->set('example_object', new stdClass(), time()+10);

var_dump($m->get('example_int'));
var_dump($m->get('example_string'));
var_dump($m->get('example_array'));
var_dump($m->get('example_object'));