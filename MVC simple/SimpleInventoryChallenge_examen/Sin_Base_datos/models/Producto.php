<?php
class Producto {
    private $name; // Product name
    private $quantity; // Quantity
    private $price; // Price

    public function __construct($name, $quantity, $price) {
        $this->name = $name;
        $this->quantity = $quantity;
        $this->price = $price;
    }

    // Getters and setters
    public function getName() {
        return $this->name;
    }

    public function getQuantity() {
        return $this->quantity;
    }

    public function getPrice() {
        return $this->price;
    }
}
?>
