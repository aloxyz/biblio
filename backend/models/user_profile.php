<?php
class UserProfile {
    private $conn;
    private $table_name = "user_profiles";

    public $user_id;
    public $readlist_id;
    public $name;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function read() {
        $query = "SELECT * FROM $this->table_name";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    public function create() {
        $query = "INSERT INTO $this->table_name (user_id, readlist_id, name) VALUES (\"$this->user_id\", \"$this->readlist_id\", \"$this->name\")";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    public function update() {
        $query = "UPDATE $this->table_name SET readlist_id = \"$this->readlist_id\", name = \"$this->name\" WHERE user_id = \"$this->user_id\"";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }
}

?>
