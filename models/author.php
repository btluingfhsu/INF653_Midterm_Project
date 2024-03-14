<?php

class Author {
    private $conn;
    private $table = 'authors';
    public $id;
    public $name;
    public function __construct($db) {
        $this->conn = $db;
    }

    function create() {
        $query = 'INSERT INTO ' . $this->table. '
            SET author = :name';

        $stmt = $this->conn->prepare($query);

        $this->name = htmlspecialchars(strip_tags($this->name));

        $stmt->bindParam(':name', $this->name);

        if ($stmt->execute()) {
            $this->id = $this->conn->lastInsertId();
            return true;
        }

        printf("Error: %s.\n", $stmt->error);
        return false;
    }

    function read() {
        $query = 'SELECT *
            FROM ' . $this->table . '
            ORDER BY id';

        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        return $stmt;
    }

    function read_single() {
        $query = 'SELECT *
            FROM ' . $this->table . '
            WHERE id = :id';

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':id', $this->id);

        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) { $this->name = $row['author']; }
    }

    function update() {
        $query = 'UPDATE ' . $this->table . '
            SET author = :author
            WHERE id = :id';

        $stmt = $this->conn->prepare($query);

        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(':author', $this->name);
        $stmt->bindParam(':id', $this->id);

        if ($stmt->execute()) {
            return true;
        }

        printf("Error: %s.\n", $stmt->error);
        return false;
    }

    function delete()
    {
        $query = '  DELETE FROM ' . $this->table . '
        WHERE id = :id';

        $stmt = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(':id', $this->id);

        if ($stmt->execute()) {
            return true;
        }

        printf("Error: %s.\n", $stmt->error);
        return false;
    }

}
?>