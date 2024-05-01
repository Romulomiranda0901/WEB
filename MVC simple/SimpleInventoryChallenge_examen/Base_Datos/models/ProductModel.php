<?php
require_once 'Database.php'; // Include the Database class

class ProductModel extends Database {
    // Method to get all products from the database
    public function getAllProducts() {
        return $this->select("products"); // Call the select method from the Database class
    }

    // Method to get product by name from the database
    public function getProductByName($name) {
        return $this->select("products", "*", "name = '$name'"); // Call the select method from the Database class
    }

    // Method to add a product to the database
    public function addProduct($name, $quantity, $price) {
        return $this->insert("products", ["name" => $name, "quantity" => $quantity, "price" => $price]); // Call the insert method from the Database class
    }

    // Method to delete a product from the database
    public function deleteProduct($name) {
        return $this->delete("products", "name = '$name'"); // Call the delete method from the Database class
    }

    // Method to update a product in the database
    public function updateProduct($name, $data) {
        return $this->update("products", $data, "name = '$name'"); // Call the update method from the Database class
    }

    // Method to add multiple products to the database in a single query
    public function addMultipleProducts($products) {
        return $this->insertMultiple("products", $products); // Call the insertMultiple method from the Database class
    }
}
?>
