<?php

class UserModel extends Model {
    // Define a tabela que esse model representa
    public $_tabela = "users";

    /**
     * Exemplo de método customizado
     * Buscar todos os usuários ativos
     */
    public function getAtivos() {
        // Usando o Medoo ($this->db) diretamente para queries específicas
        return $this->db->select($this->_tabela, "*", [
            "status" => 1
        ]);
    }
}
