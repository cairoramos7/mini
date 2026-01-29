<?php
class Model{
    protected $db;
    public $_tabela;

    public function __construct(){
        try {
            $this->db = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASS);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Connection Error: " . $e->getMessage());
        }
    }

    public function insert(Array $dados){
        $campos = implode(', ', array_keys($dados));
        $keys = ':' . implode(', :', array_keys($dados));
        
        $sql = "INSERT INTO {$this->_tabela} ({$campos}) VALUES ({$keys})";
        $stmt = $this->db->prepare($sql);
        
        foreach ($dados as $key => $value) {
            $stmt->bindValue(":{$key}", $value);
        }
        
        return $stmt->execute();
    }

    public function read($where = null, $limit = null, $offset = null, $orderby = null) {
        $where_clause = "";
        $params = [];
        
        if (!empty($where)) {
            if (is_array($where)) {
                $conditions = [];
                foreach ($where as $key => $value) {
                    $conditions[] = "{$key} = :w_{$key}";
                    $params[":w_{$key}"] = $value;
                }
                $where_clause = "WHERE " . implode(' AND ', $conditions);
            } else {
                 // Warning: Passing raw SQL strings is vulnerable to SQL Injection. Prefer arrays.
                 $where_clause = "WHERE {$where}"; 
            }
        }
        
        $limit_clause = ($limit) ? "LIMIT {$limit}" : "";
        $offset_clause = ($offset) ? "OFFSET {$offset}" : "";
        $orderby_clause = ($orderby) ? "ORDER BY {$orderby}" : "";
        
        $sql = "SELECT * FROM {$this->_tabela} {$where_clause} {$orderby_clause} {$limit_clause} {$offset_clause}";
        $q = $this->db->prepare($sql);
        
        foreach ($params as $key => $value) {
            $q->bindValue($key, $value);
        }
        
        $q->execute();
        $q->setFetchMode(PDO::FETCH_ASSOC);
        return $q->fetchAll();
    }

    public function update(Array $dados, $where){
        $set = [];
        $params = [];
        
        foreach ($dados as $key => $value) {
            $set[] = "{$key} = :d_{$key}";
            $params[":d_{$key}"] = $value;
        }
        
        $where_clause = "";
        if (is_array($where)) {
            $conditions = [];
            foreach ($where as $key => $value) {
                $conditions[] = "{$key} = :w_{$key}";
                $params[":w_{$key}"] = $value;
            }
            $where_clause = implode(' AND ', $conditions);
        } else {
             $where_clause = $where;
        }

        $sql = "UPDATE {$this->_tabela} SET " . implode(', ', $set) . " WHERE {$where_clause}";
        $stmt = $this->db->prepare($sql);
        
        foreach ($params as $key => $value) {
            $stmt->bindValue($key, $value);
        }
        
        return $stmt->execute();
    }

    public function delete($where){
        $params = [];
        $where_clause = "";

        if (is_array($where)) {
            $conditions = [];
            foreach ($where as $key => $value) {
                $conditions[] = "{$key} = :w_{$key}";
                $params[":w_{$key}"] = $value;
            }
            $where_clause = implode(' AND ', $conditions);
        } else {
            $where_clause = $where;
        }

        $sql = "DELETE FROM {$this->_tabela} WHERE {$where_clause}";
        $stmt = $this->db->prepare($sql);
        
        foreach ($params as $key => $value) {
            $stmt->bindValue($key, $value);
        }
        
        return $stmt->execute();
    }
}
