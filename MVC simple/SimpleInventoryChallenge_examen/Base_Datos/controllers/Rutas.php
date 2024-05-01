<?php
// Include the ProductController class
require_once 'ProductController.php';

// Create an instance of ProductController
$product = new ProductController();

// Check if 'action' parameter is set in the URL
if(isset($_GET['action'])) {
    $action = $_GET['action']; // Get the value of 'action'

    // Call the corresponding function based on the value of 'action'
    switch ($action) {
        case 'list':
            $product->list(); // Call the list method to list all products
            break;
        case 'add':
            // Check if all required parameters are set
            if (isset($_POST['name'], $_POST['quantity'], $_POST['price'])) {
                $product->add($_POST['name'], $_POST['quantity'], $_POST['price']); // Call the add method to add a product
            }
            break;
        case 'delete':
            // Check if the 'name' parameter is set
            if (isset($_POST['name'])) {
                $product->delete($_POST['name']); // Call the delete method to delete a product
            }
            break;
        case 'search':
            // Check if the 'name' parameter is set
            if (isset($_GET['name'])) {
                $product->search($_GET['name']); // Call the search method to search for a product
            }
            break;
        // Add other cases for other actions if needed
        default:
            // Invalid action
            echo json_encode(['error' => 'Invalid action']);
            break;
    }
}
?>
