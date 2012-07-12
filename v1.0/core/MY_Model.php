<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class MY_Model extends CI_Model {
    public $database;
    public $collection;
    public $mongodb_config;
    public $setting_name = 'default';
    
    function __construct() {
        parent::__construct();
        $this->mongodb_library->init_db($this->setting_name);
        $this->mongodb_config = $this->mongodb_library->get_mongodb_config();
        $this->database = $this->mongodb_library->get_database($this->setting_name);
        date_default_timezone_set('Asia/Singapore');
    }

    public function set_collection($collection) {
        $this->mongodb_library->set_collection($collection);
        $this->collection = $this->mongodb_library->get_collection();
    }

    public function get_collection_name() {
        return $this->mongodb_library->get_collection();
    }

    public function get_last_oid() {
        $oid = null;
        $results = $this->collection->find()->sort(array('_id' => -1))->limit(1);
        while ($results->hasNext()) {
            $result = $results->getNext();
            $oid = $result['_id']->{'$id'};
        }
        return $oid;
    }

    public function get_all_asc() {
        $result = null;
        $results = $this->collection->find()->sort(array('_id' => 1));
        return $results;
    }

    public function get_all_dsc() {
        $result = null;
        $results = $this->collection->find()->sort(array('_id' => -1));
        return $results;
    }

    public function get_last() {
        $result = null;
        $result = $this->collection->findOne();
        return $result;
    }

    public function get_by_oid($oid) {
        $result = null;
        $oid = new MongoId($oid);
        $criteria = array('_id' => $oid);
        $result = $this->collection->findOne($criteria);
        return $result;
    }

    public function insert($data) {
        $result = false;
        $result = $this->collection->insert($data);
        if (isset($data['_id'])) {
            $result = $data['_id'];
        }
        return $result; // result oid
    }
    
    public function update($data, $criteria, $options = array("upsert" => false)) {
        $options = array_merge($options, array($this->mongodb_config['query_safety'] => true, 'multiple' => false));
        $result = $this->collection->update($criteria, $data, $options);
        return $result; // result true or false
    }
    
    public function update_multiple($data, $criteria, $options = array("upsert" => false)) {
        $options = array_merge($options, array($this->mongodb_config['query_safety'] => true, 'multiple' => true));
        $result = $this->collection->update($criteria, $data, $options);
        return $result; // result true or false
    }

    public function delete($criteria) {
        $result = $this->collection->remove($criteria);
        return $result; // result true or false
    }

    public function count() {
        $result = $this->collection->count();
        return $result;
    }

    //key {"username":1}, option {"unique":true}
    public function add_index($keys = array(), $option = array()) {
        $result = $this->collection->ensureIndex($keys, $option);
        return $result;
    }

    public function remove_index($keys = array(), $option = array()) {
        $result = $this->collection->deleteIndex($keys, $options);
        return $result; // result true or false
    }

    public function delete_all($criteria = array()) {
        $result = $this->collection->remove($criteria, array($this->mongodb_config['query_safety'] => TRUE, 'justOne' => FALSE));
        return $result; // result true or false
    }

    public function drop() {
        $result = $this->collection->drop();
        return $result; // result true or false
    }
    
    public function do_command($data){
        $results = null;
        $results = $this->database->command($data);
        return $results;        
    }
    
    public function find_and_modifiy($data, $criteria, $model_name){
        $results = null;
        $results = $this->database->command(
            array(
                "findAndModify"  => $model_name,
                "query"      => $criteria,
                "update"     => $data
            )
        );
        return $results;
    }
}

/* End of file My_Model.php */
/* Location: ./application/libraries/My_Model.php */
