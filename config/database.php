<?php
    class Database {
        // DB parameters
        private $host = 'localhost';
        private $db_name = 'INF653_Midterm_Project';
        private $username = 'postgres';
        private $password = 'postgres';
        private $conn;

        public function __construct() {
            $this->username;
            $this->password;
        }

        // DB connect
        public function connect() {
            $this->conn = null;

            try {
                $dsn = 'pgsql:host=' . $this->host . ';dbname=' . $this->db_name;
                $this->conn = new PDO($dsn, $this->username, $this->password);

                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            } catch(PDOException $e) {
                echo 'Connection Error: ' . $e->getMessage();
            }

            return $this->conn;
        }
    }