<!DOCTYPE html>
<html lang="en"> <!-- Document language set to English -->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title> <!-- Page title -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Add Product</h2> <!-- Heading for the add product form -->
    <form id="addProductForm" action="index.php?action=add" method="POST">
        <div class="mb-3">
            <label for="nombre" class="form-label">Name:</label> <!-- Label for product name input -->
            <input type="text" class="form-control" id="name" name="name" required> <!-- Product name input -->
        </div>
        <div class="mb-3">
            <label for="cantidad" class="form-label">Quantity:</label> <!-- Label for quantity input -->
            <input type="number" class="form-control" id="quantity" name="quantity" required> <!-- Quantity input -->
        </div>
        <div class="mb-3">
            <label for="precio" class="form-label">Price per Unit:</label> <!-- Label for price input -->
            <input type="number" step="0.01" class="form-control" id="price" name="price" required> <!-- Price input with step for decimals -->
        </div>
        <button type="submit" class="btn btn-primary">Add Product</button> <!-- Submit button -->
    </form>
</div>
<script src="../public/js/jquery.min.js"></script> <!-- jQuery library -->
<script src="../public/js/scripts.js"></script> <!-- Custom JavaScript file -->
</body>
</html>
