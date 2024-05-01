<?php
// Include the ProductoController class
require_once 'controllers/ProductoController.php';

// Create an instance of the ProductoController
$controller = new ProductoController();

// Check if the 'action' parameter is set in the URL and is not empty
if (isset($_GET['action']) && !empty($_GET['action'])) {
    $action = $_GET['action']; // Get the value of the 'action' parameter

    // Handle different actions based on the value of the 'action' parameter
    switch ($action) {
        case 'add': // If the action is 'añadir' (add)
            $controller->addProduct(); // Call the method to add a product
            break;
        case 'delete': // If the action is 'eliminar' (delete)
            $controller->deleteProduct(); // Call the method to delete a product
            break;
        case 'search': // If the action is 'buscar' (search)
            $controller->searchProduct(); // Call the method to search for a product
            break;
        case 'list': // If the action is 'listar' (list)
            $controller->listProducts(); // Call the method to list all products
            break;
        default:
            echo 'Invalid action'; // Display a message for invalid actions
            break;
    }
} else {
    // If no 'action' parameter is provided, display the default view (index)
    $controller->index();
}
?>
