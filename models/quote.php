<?php

class Quote {
    private $conn;
    private $table = 'quotes';
    public $id;
    public $theQuote;
    public $theAuthor;
    public $theCategory;
    public $authorId;
    public $categoryId;

    public function __construct($db) {
        $this->conn = $db;
    }

    function create() {
        $query = 'INSERT INTO ' . $this->table . ' (quote, author_id, category_id) 
            VALUES (:quote, :authorId, :categoryId);';

        $stmt = $this->conn->prepare($query);

        $this->theQuote = htmlspecialchars(strip_tags($this->theQuote));
        $this->authorId = htmlspecialchars(strip_tags($this->authorId));
        $this->categoryId = htmlspecialchars(strip_tags($this->categoryId));

        $stmt->bindParam(':quote', $this->theQuote);
        $stmt->bindParam(':authorId', $this->authorId);
        $stmt->bindParam(':categoryId', $this->categoryId);

        if ($stmt->execute()) {
            $this->id = $this->conn->lastInsertId();
            return true;
        }

        printf("ErrorL %s.\n", $stmt->error);
        return false;

    }

    function read() {
        $query = 'SELECT q.id, q.quote, a.author, c.category 
            FROM ' . $this->table . ' q 
            LEFT JOIN authors a ON q.author_id = a.id
            LEFT JOIN categories c ON q.category_id = c.id;';

        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        return $stmt;
    }

    function read_author() {
        $query = 'SELECT q.id, q.quote, a.author, c.category
            FROM ' . $this->table . ' q
            LEFT JOIN authors a ON q.author_id = a.id
            LEFT JOIN categories c ON q.category_id = c.id
            WHERE a.id = :authorId';

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':authorId', $this->authorId);

        $stmt->execute();

        return $stmt;
    }

    function read_category() {
        $query = 'SELECT q.id, q.quote, a.author, c.category
            FROM ' . $this->table . ' q
            LEFT JOIN authors a ON  q.author_id = a.id
            LEFT JOIN categories c ON q.category_id = c.id
            WHERE c.id = :categoryId';

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':categoryId', $this->categoryId);

        $stmt->execute();

        return $stmt;
    }

    function read_author_and_category() {
        $query = 'SELECT q.id, q.quote, a.author, c.category
            FROM ' . $this->table . ' q
            LEFT JOIN authors a ON q.author_id = a.id
            LEFT JOIN categories c on q.category_id = c.id
            WHERE a.id = :authorId AND c.id = :categoryId';

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':categoryId', $this->categoryId);
        $stmt->bindParam(':authorId', $this->authorId);
        $stmt->execute();

        return $stmt;
    }

    function read_single() {
        $query = 'SELECT q.id, q.quote, a.author, c.category
            FROM ' . $this->table . ' q
            LEFT JOIN authors a ON  q.author_id = a.id
            LEFT JOIN categories c ON q.category_id = c.id
            WHERE q.id = :id;';

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $this->id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) { 
            $this->theQuote = $row['quote'];
            $this->theAuthor = $row['author'];
            $this->theCategory = $row['category'];
        }
    }

    function update() {
        $query = 'UPDATE ' . $this->table . ' 
            SET quote = :quote, 
                author_id = :authorId, 
                category_id = :categoryId
            WHERE id = :id;';

        $stmt = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->theQuote = htmlspecialchars(strip_tags($this->theQuote));
        $this->authorId = htmlspecialchars(strip_tags($this->authorId));
        $this->categoryId = htmlspecialchars(strip_tags($this->categoryId));

        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':quote', $this->theQuote);
        $stmt->bindParam(':authorId', $this->authorId);
        $stmt->bindParam(':categoryId', $this->categoryId);

        if ($stmt->execute()) {
            return true;
        }

        printf("Error: %s.\n", $stmt->error);
        return false;
    }

    function delete() {
        $query = 'DELETE FROM ' . $this->table . '
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