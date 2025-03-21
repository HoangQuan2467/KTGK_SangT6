<?php
class Database {
    private $host = "localhost";
    private $db_name = "test1";
    private $username = "root";
    private $password = "";
    private $conn;

    public function getConnection() {
        $this->conn = null;
        try {
            $this->conn = new PDO(
                "mysql:host=" . $this->host . ";dbname=" . $this->db_name . ";charset=utf8",
                $this->username,
                $this->password
               
            );
        } catch (PDOException $exception) {
            // Ghi log lỗi thay vì hiển thị trực tiếp
            error_log("Lỗi kết nối Database: " . $exception->getMessage(), 3, "error.log");
            die("Không thể kết nối đến Database.");
        }

        return $this->conn;
    }
}
