<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title> <!-- Sets the title of the webpage -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"> <!-- Imports Bootstrap CSS -->
</head>
<body>
<div class="container">
    <h1>Add Product</h1> <!-- Heading for the add product section -->
    <form id="addProductForm"> <!-- Form for adding a product with id "addProductForm" -->
        <div class="mb-3">
            <label for="name" class="form-label">Name:</label> <!-- Label and input field for product name -->
            <input type="text" class="form-control" id="name" name="name">
        </div>
        <div class="mb-3">
            <label for="quantity" class="form-label">Quantity:</label> <!-- Label and input field for product quantity -->
            <input type="number" class="form-control" id="quantity" name="quantity">
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Price:</label> <!-- Label and input field for product price -->
            <input type="number" step="0.01" class="form-control" id="price" name="price">
        </div>
        <button type="submit" class="btn btn-primary">Add</button> <!-- Submit button to add the product -->
    </form>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> <!-- Import jQuery library -->
<script src="../public/js/script.js"></script> <!-- Import custom JavaScript file -->
</body>
</html>
