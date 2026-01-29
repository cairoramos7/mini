<?php

use Medoo\Medoo;

class Model {
    protected $db;
    public $table;
    protected $fillable = [];

    public function __construct(){
        $this->db = new Medoo([
            'type' => 'mysql',
            'host' => DB_HOST,
            'database' => DB_NAME,
            'username' => DB_USER,
            'password' => DB_PASS
        ]);
    }

    protected function filterFillable(Array $data) {
        if (empty($this->fillable)) {
            return $data;
        }

        // Return only keys that are in $fillable
        return array_intersect_key($data, array_flip($this->fillable));
    }

    public function insert(Array $data){
        $data = $this->filterFillable($data);
        return $this->db->insert($this->table, $data);
    }

    public function read($where = null, $columns = "*") {
        if(is_numeric($where)){
            return $this->db->get($this->table, $columns, ['id' => $where]);
        }
        return $this->db->select($this->table, $columns, $where);
    }

    public function update(Array $data, $where){
        $data = $this->filterFillable($data);
        return $this->db->update($this->table, $data, $where);
    }

    public function delete($where){
        return $this->db->delete($this->table, $where);
    }
}
