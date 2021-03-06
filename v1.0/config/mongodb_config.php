<?php
/*
 * MongoDb Library for Codeigniter v1.01
 * release date 07/12/2012
 * Author Erwin Setiawan
 * visit http://erwinsetiawan.com
 * Feel free to use it and please do not remove this text.
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

$development = array(
    'host' => 'localhost',
    'port' => 27017,
    'dbname' => 'database_name',
    'user' => '',
    'pass' => '',
    'persist' => TRUE,
    'persist_key' => 'ci_mongo_persist',
    'return' => 'array',
    'query_safety' => 'safe'
);

$live = array(
    'host' => 'localhost',
    'port' => 27017,
    'dbname' => 'database_name',
    'user' => '',
    'pass' => '',
    'persist' => TRUE,
    'persist_key' => 'ci_mongo_persist',
    'return' => 'array',
    'query_safety' => 'safe'
);

$config['mongodb']['default'] = $development;

/* End of file mongodb_config.php */
/* Location: ./application/libraries/mongodb_library.php */