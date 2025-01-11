<?php
class Database {
    private $db;

    public function __construct() {
        $this->db = new mysqli('localhost', 'root', '', 'mvc');
        if ($this->db->connect_error) {
            die("Connection failed: " . $this->db->connect_error);
        }
    }

    public function getConnection() {
        return $this->db;
    }
}
?>