<?php
class User {
    private $conn;
    private $table_name = "readlists";

    public $user_id;
    public $book_olid;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = "INSERT INTO $this->table_name (user_id, book_olid) VALUES (\"$this->user_id\", \"$this->book_olid\")";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    public function read_all() {
        $query = "SELECT * FROM $this->table_name";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    public function read() {
        $query = "SELECT * FROM $this->table_name WHERE user_id = $this->user_id";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    public function delete() {
        $query = "DELETE FROM $this->table_name WHERE book_olid = \"$this->book_olid\"";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }
}

?>
