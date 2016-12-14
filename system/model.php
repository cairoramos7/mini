<?php

class Model{
	protected $db;

	public function __construct(){
		$this->db = new PDO('mysql:host=localhost;dbname=framework', 'root', 'root');
	}

	public function insert($tabela, Array $dados)
	{
		# code...
		foreach ( $dados as $inds => $vals )
		{
			$campos[] = $inds;
			$valores[] = $vals;
		}
		$campos = implode(', ', $campos);
		$valores = "'" . implode("', '", $valores) . "'";
		return $this->db->query(" INSERT  INTO {$tabela} ({$campos}) VALUES ({$valores});");
	}

	public function read( $tabela, $where = null)
	{
		# code...
		$where = ($where != null ? "where {$where}" : "");
		$q = $this->db->query(" SELECT * FROM {$tabela} {$where} ");
		$q->setFetchMode(PDO::FETCH_ASSOC);
		return $q->fetchAll();
	}

	public function update( $tabela, Array $dados, $where)
	{
		# code...
		// $sql = "UPDATE tabela SET nome = 'novo nome' WHERE id = 1";
		foreach ( $dados as $ind => $val )
		{
			$campos[] = "{$ind} = '{$val}'";
		}
		$campos = implode(', ', $campos);
		return $this->db->query(" UPDATE {$tabela} SET {$campos} WHERE {$where}");
	}

	public function delete( $tabela, $where )
	{
		# code...
		return $this->db->query(" DELETE FROM {$tabela} WHERE {$where}; ");
	}
}
