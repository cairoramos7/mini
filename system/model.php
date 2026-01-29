<?php

use Medoo\Medoo;

class Model {
    protected $db;
    public $table;

    public function __construct(){
        $this->db = new Medoo([
            'type' => 'mysql',
            'host' => DB_HOST,
            'database' => DB_NAME,
            'username' => DB_USER,
            'password' => DB_PASS
        ]);
    }

    public function insert(Array $data){
        return $this->db->insert($this->table, $data);
    }

    public function read($where = null, $columns = "*") {
        if(is_numeric($where)){
            return $this->db->get($this->table, $columns, ['id' => $where]);
        }
        return $this->db->select($this->table, $columns, $where);
    }

    public function update(Array $data, $where){
        return $this->db->update($this->table, $data, $where);
    }

    public function delete($where){
        return $this->db->delete($this->table, $where);
    }
}
