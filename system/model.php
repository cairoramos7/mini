<?php

use Medoo\Medoo;

class Model {
    protected $db;
    public $_tabela;

    public function __construct(){
        $this->db = new Medoo([
            'type' => 'mysql',
            'host' => DB_HOST,
            'database' => DB_NAME,
            'username' => DB_USER,
            'password' => DB_PASS
        ]);
    }

    public function insert(Array $dados){
        return $this->db->insert($this->_tabela, $dados);
    }

    public function read($where = null, $columns = "*") {
        if(is_numeric($where)){
            return $this->db->get($this->_tabela, $columns, ['id' => $where]);
        }
        return $this->db->select($this->_tabela, $columns, $where);
    }

    public function update(Array $dados, $where){
        return $this->db->update($this->_tabela, $dados, $where);
    }

    public function delete($where){
        return $this->db->delete($this->_tabela, $where);
    }
}
