<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
    
    $development = array(
        'host'          => 'localhost',
        'port'          => 27017,
        'dbname'        => 'thelostlove_ktg',
        'user'          => '',
        'pass'          => '',
        'persist'       => TRUE,
        'persist_key'   => 'ci_mongo_persist',
        'return'        => 'array',
        'query_safety'  => 'safe'
    );

    $live = array(
        'host'          => 'localhost',
        'port'          => 27017,
        'dbname'        => 'thelostlove_ktg',
        'user'          => '',
        'pass'          => '',
        'persist'       => TRUE,
        'persist_key'   => 'ci_mongo_persist',
        'return'        => 'array',
        'query_safety'  => 'safe'
    );
    
    $config['mongodb']['default'] = $development;
    
/* End of file mongodb_config.php */
/* Location: ./application/libraries/mongodb_library.php */