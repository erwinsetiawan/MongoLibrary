<?php
/*
 * MongoDb Library for Codeigniter v1.0
 * release date 07/12/2012
 * Author Erwin Setiawan 
 * visit http://erwinsetiawan.com
 * Feel free to use it and please do not remove this text.
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mongodb_library extends CI_Config {
    private $CI;
    private $config_file = "mongodb_config";
    private $mongodb_config;
    private $collection;
    private $host;
    private $port;
    private $dbname;
    private $user;
    private $pass;
    private $persist;
    private $persist_key;
    private $database;
    function __construct() {
        $this->CI = & get_instance();
        $this->CI->config->load($this->config_file);
        $this->mongodb_config = $this->CI->config->item('mongodb');
    }

    public function init_db($setting_name = 'default') {
        $options = array();
        $value = $this->mongodb_config["$setting_name"];
        try {
            if (empty($GLOBALS['mongo_db_' . $setting_name])) {
                $this->host = trim($value['host']);
                $this->port = trim($value['port']);
                $this->dbname = trim($value['dbname']);
                $this->user = trim($value['user']);
                $this->pass = trim($value['pass']);
                $this->persist = trim($value['persist']);
                $this->persist_key = trim($value['persist_key']);
                $options['persist'] = $this->persist_key;
                $GLOBALS['mongo_db_' . $setting_name] = new Mongo($this->host . ':' . $this->port, $options);
            }
            $this->{$setting_name} = $GLOBALS['mongo_db_' . $setting_name];
            $this->database = $this->{$setting_name}->selectDB($this->dbname);
        } catch (MongoConnectionException $e) {
            log_message('info', 'Mongo Connection problem : ' . $e->getMessage());
            echo 'Cannot connect to MongoDb. There is error in connection.';
            exit;
        }
    }

    public function get_server($setting_name = 'default') {
        return $this->{$setting_name};
    }

    public function get_database($setting_name = 'default') {
        return $this->{$setting_name}->selectDB($this->dbname);
    }

    public function set_collection($collection) {
        $this->collection = $this->database->selectCollection($collection);
    }

    public function get_collection() {
        return $this->collection;
    }

    public function get_mongodb_config($setting_name = 'default') {
        return $this->mongodb_config["$setting_name"];
    }

}

/* End of file mongodb_library.php */
/* Location: ./application/libraries/mongodb_library.php */