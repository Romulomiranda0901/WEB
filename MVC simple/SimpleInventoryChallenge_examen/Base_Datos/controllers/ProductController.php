<?php
require_once dirname(__DIR__) . '/models/ProductModel.php'; // Include the ProductModel class

class ProductController
{
    private $productModel; // Instance variable to hold the ProductModel object

    public function __construct()
    {
        $this->productModel = new ProductModel(); // Instantiate the ProductModel object
    }

    // Method to add a new product
    public function add($name,$quantity,$price)
    {
        try {
            if ($this->validateInputs($name, $quantity, $price)) { // Validate input data
                $this->productModel->addProduct($name, $quantity, $price); // Call the add method in ProductModel
                $response = ["success" => true, "message" => "Product added successfully."];
            } else {
                $response = ["success" => false, "message" => "Please fill out all fields correctly."];
            }
            echo json_encode($response); // Return response in JSON format

        }catch (Exception $e){
            var_dump($e->getMessage());
            exit();
        }

    }

    // Method to delete a product
    public function delete($name)
    {
        try {

            if ($this->validateInput($name)) { // Validate input data
                $this->productModel->deleteProduct($name); // Call the delete method in ProductModel
                $response = ["success" => true, "message" => "Product deleted successfully."];
            } else {
                $response = ["success" => false, "message" => "Please enter the name of the product to delete."];
            }
            echo json_encode($response); // Return response in JSON format

        }catch (Exception $e){
            var_dump($e->getMessage());
            exit();
        }
    }

    // Method to search for a product
    public function search($name)
    {
        try {

            if ($this->validateInput($name)) { // Validate input data
                $product = $this->productModel->getProductByName($name); // Call the search method in ProductModel
                if ($product) {
                    $response = ["success" => true, "product" => $product];
                } else {
                    $response = ["success" => false, "message" => "Product not found."];
                }
            } else {
                $response = ["success" => false, "message" => "Please enter the name of the product to search."];
            }
            echo json_encode($response); // Return response in JSON format
        }catch (Exception $e){
            var_dump($e->getMessage());
        }

    }

    // Method to list all products
    public function list()
    {
        try {

            $products = $this->productModel->getAllProducts(); // Get all products from ProductModel
            $response = ["success" => true, "products" => $products];
            echo json_encode($response); // Return response in JSON format
        } catch (Exception $e) {
            $response = ["success" => false, "message" => $e->getMessage()];
            echo json_encode($response); // Return response in JSON format
        }
    }

    // Method to sanitize input data
    private function sanitizeInput($input)
    {
        return htmlspecialchars(strip_tags(trim($input)));
    }

    // Method to validate input data
    private function validateInputs($name, $quantity, $price)
    {
        return !empty($name) && !empty($quantity) && !empty($price);
    }

    // Method to validate input
    private function validateInput($input)
    {
        return !empty($input);
    }
}

?>
