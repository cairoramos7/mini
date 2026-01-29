<?php

class UserModel extends Model {
    // Define table name
    public $table = "users";

    /**
     * Custom method example
     * Get all active users
     */
    public function getActive() {
        // Using Medoo ($this->db) directly for specific queries
        return $this->db->select($this->table, "*", [
            "status" => 1
        ]);
    }
}
