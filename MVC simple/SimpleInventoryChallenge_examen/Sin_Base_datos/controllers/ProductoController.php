<?php
require_once dirname(__DIR__) . '/models/Producto.php';

class ProductoController {
    public function index() {
        // Load the add product view
        include __DIR__ . '/../views/add_product.php';
    }

    public function addProduct() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Validate data received from the form
            $name = $_POST['name'];
            $quantity = $_POST['quantity'];
            $price = $_POST['price'];

            // Create a new Producto object
            $product = new Producto($name, $quantity, $price);

            // Save the product in local storage (here you could implement logic to save in a database)
            // For simplicity, we store products in a session
            session_start();
            if (!isset($_SESSION['products'])) {
                $_SESSION['products'] = array();
            }
            array_push($_SESSION['products'], $product);

            // Redirect the user to the list products page
            header('Location: index.php?action=list');
            exit();
        }
    }

    public function deleteProduct() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Validate data received from the form
            $name = $_POST['name'];

            // Find and remove the product from local storage
            session_start();
            if (isset($_SESSION['products'])) {
                foreach ($_SESSION['products'] as $key => $product) {
                    if ($product->getName() === $name) {
                        unset($_SESSION['products'][$key]);
                        break;
                    }
                }
            }

            // Redirect the user to the list products page
            header('Location: index.php?action=list');
            exit();
        }
    }

    public function searchProduct() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Validate data received from the form
            $name = $_POST['name'];

            // Search for the product in local storage
            $foundProduct = null;
            session_start();
            if (isset($_SESSION['products'])) {
                foreach ($_SESSION['products'] as $product) {
                    if ($product->getName() === $name) {
                        $foundProduct = $product;
                        break;
                    }
                }
            }

            // Get all products from the session
            $products = isset($_SESSION['products']) ? $_SESSION['products'] : array();

            // Show the search result
            include __DIR__ . '/../views/search_product.php';
        }
    }

    public function listProducts() {
        // Get all products from local storage and display them
        session_start();
        $products = isset($_SESSION['products']) ? $_SESSION['products'] : array();
        include __DIR__ . '/../views/list_products.php';
    }
}
?>
