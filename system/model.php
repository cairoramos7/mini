<?php
class Model{
	protected $db;
	public $_tabela;

	public function __construct(){
		$this->db = new PDO('mysql:host=localhost;dbname=framework', 'root', 'root');
	}

	public function insert(Array $dados){
		$campos = implode(', ', array_keys($dados));
		$valores = "'" . implode("', '", array_values($dados)) . "'";
		return $this->db->query(" INSERT  INTO {$this->_tabela} ({$campos}) VALUES ({$valores});");
	}

	public function read($where = null){
		$where = ($where != null ? "where {$where}" : "");
		$q = $this->db->query("SELECT * FROM {$this->_tabela} {$where}");
		$q->setFetchMode(PDO::FETCH_ASSOC);
		return $q->fetchAll();
	}

	public function update(Array $dados, $where){
		foreach ($dados as $ind => $val){
			$campos[] = "{$ind} = '{$val}'";
		}
		$campos = implode(', ', $campos);
		return $this->db->query("UPDATE {$this->_tabela} SET {$campos} WHERE {$where}");
	}

	public function delete($where){
		return $this->db->query("DELETE FROM {$this->_tabela} WHERE {$where};");
	}
}
