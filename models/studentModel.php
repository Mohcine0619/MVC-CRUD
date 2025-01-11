<?php
require 'database.php';

class StudentModel {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function getAllStudents() {
        $result = $this->db->query("SELECT * FROM students");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getStudentById($id) {
        $stmt = $this->db->prepare("SELECT * FROM students WHERE id = ?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function addStudent($name, $email) {
        $stmt = $this->db->prepare("INSERT INTO students (name, email) VALUES (?, ?)");
        $stmt->bind_param('ss', $name, $email);
        $stmt->execute();
    }

    public function updateStudent($id, $name, $email) {
        $stmt = $this->db->prepare("UPDATE students SET name = ?, email = ? WHERE id = ?");
        $stmt->bind_param('ssi', $name, $email, $id);
        $stmt->execute();
    }

    public function deleteStudent($id) {
        $stmt = $this->db->prepare("DELETE FROM students WHERE id = ?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
    }
}
?>
