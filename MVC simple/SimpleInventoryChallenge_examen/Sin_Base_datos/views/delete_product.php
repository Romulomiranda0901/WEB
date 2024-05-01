<!DOCTYPE html>
<html lang="en"> <!-- Document language set to English -->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Product</title> <!-- Page title -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Delete Product</h2> <!-- Heading for the delete product form -->
    <form id="deleteProductForm" action="/Inventario/index.php?action=delete" method="POST">
        <div class="mb-3">
            <label for="nombre" class="form-label">Name of Product to Delete:</label> <!-- Label for product name input -->
            <input type="text" class="form-control" id="name" name="name" required> <!-- Product name input -->
        </div>
        <button type="submit" class="btn btn-danger">Delete Product</button> <!-- Submit button -->
    </form>
</div>
<script src="../public/js/jquery.min.js"></script> <!-- jQuery library -->
<script src="../public/js/scripts.js"></script> <!-- Custom JavaScript file -->
</body>
</html>
