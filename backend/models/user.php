<?php
class User {
    private $conn;
    private $table_name = "users";

    public $id;
    public $email;
    public $password;
    public $name;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = "INSERT INTO $this->table_name (email, password, name) VALUES (\"$this->email\", \"$this->password\", \"$this->name\")";

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
        $query = "SELECT * FROM $this->table_name WHERE id = \"$this->id\"";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    public function update() {
        $query = "UPDATE $this->table_name SET email = \"$this->email\", password = \"$this->password\", name = \"$this->name\" WHERE id = \"$this->id\"";

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
