<?php
class User {
    private $conn;
    private $table_name = "readlists";

    public $id;
    public $book_olid;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = "INSERT INTO $this->table_name (book_olid) VALUES (\"$this->book_olid\"";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    public function read() {
        $query = "SELECT * FROM $this->table_name";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    public function update() {
        $query = "UPDATE $this->table_name SET book_olid = \"$this->book_olid\" WHERE id = \"$this->id\"";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    public function delete() {
        $query = "DELETE FROM $this->table_name WHERE id = \"$this->id\"";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }
}

?>
