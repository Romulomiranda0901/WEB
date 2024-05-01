<?php
require_once '../config.php';
class Database {
    private $db; // Database connection variable

    public function __construct() {
        $this->connect(); // Establish database connection upon object creation
    }

    // Method to establish database connection
    private function connect() {
        try {
            $this->db = new PDO("pgsql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD); // Connect to the database using PDO
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Set error mode to exception
        } catch (PDOException $e) {
            echo "Connection error: " . $e->getMessage(); // Display error message if connection fails
        }
    }

    // Method to execute a SELECT query
    public function select($table, $columns = "*", $where = null) {
        $sql = "SELECT $columns FROM $table"; // Construct the SELECT query
        if ($where) {
            $sql .= " WHERE $where"; // Add WHERE clause if specified
        }
        $stmt = $this->db->query($sql); // Execute the query
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch and return the result set as an associative array
    }

    // Method to execute an INSERT query
    public function insert($table, $data) {
        $columns = implode(", ", array_keys($data)); // Extract column names from the data array
        $values = ":" . implode(", :", array_keys($data)); // Create placeholders for values
        $sql = "INSERT INTO $table ($columns) VALUES ($values)"; // Construct the INSERT query
        $stmt = $this->db->prepare($sql); // Prepare the query
        return $stmt->execute($data); // Execute the query with data values
    }

    // Method to execute an UPDATE query
    public function update($table, $data, $where) {
        $setClause = "";
        foreach ($data as $key => $value) {
            $setClause .= "$key = :$key, "; // Construct the SET clause for UPDATE query
        }
        $setClause = rtrim($setClause, ", "); // Remove trailing comma and space
        $sql = "UPDATE $table SET $setClause WHERE $where"; // Construct the UPDATE query
        $stmt = $this->db->prepare($sql); // Prepare the query
        return $stmt->execute($data); // Execute the query with data values
    }

    // Method to execute a DELETE query
    public function delete($table, $where) {
        $sql = "DELETE FROM $table WHERE $where"; // Construct the DELETE query
        return $this->db->exec($sql); // Execute the query and return the number of affected rows
    }

    // Method to execute a batch INSERT query
    public function insertMultiple($table, $data) {
        $columns = implode(", ", array_keys($data[0])); // Extract column names from the first row of data
        $values = "";
        foreach ($data as $row) {
            $placeholders = ":" . implode(", :", array_keys($row)); // Create placeholders for values in each row
            $values .= "($placeholders), "; // Append placeholders for each row
        }
        $values = rtrim($values, ", "); // Remove trailing comma and space
        $sql = "INSERT INTO $table ($columns) VALUES $values"; // Construct the batch INSERT query
        $stmt = $this->db->prepare($sql); // Prepare the query
        foreach ($data as $row) {
            $stmt->execute($row); // Execute the query for each row of data
        }
    }
}
?>
