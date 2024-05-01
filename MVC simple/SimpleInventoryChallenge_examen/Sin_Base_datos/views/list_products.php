<!DOCTYPE html>
<html lang="en"> <!-- Document language set to English -->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Products</title> <!-- Page title -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>List of Products</h2> <!-- Heading for the list of products -->
    <div class="row mb-3">
        <div class="col-md-6">
            <a href="views/search_product.php" class="btn btn-primary float-end">Search Product</a> <!-- Button to search for a product -->
        </div>
        <div class="col-md-6">
            <a href="views/delete_product.php" class="btn btn-danger float-end">Delete Product</a> <!-- Button to delete a product -->
        </div>
    </div>
    <table class="table">
        <thead>
        <tr>
            <th>Name</th> <!-- Table header for product name -->
            <th>Quantity</th> <!-- Table header for product quantity -->
            <th>Price per Unit</th> <!-- Table header for price per unit -->
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($products as $producto): ?> <!-- Loop through each product -->
            <tr>
                <td><?php echo $producto->getName(); ?></td> <!-- Display product name -->
                <td><?php echo $producto->getQuantity(); ?></td> <!-- Display product quantity -->
                <td><?php echo $producto->getPrice(); ?></td> <!-- Display price per unit -->
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
<script src="../public/js/jquery.min.js"></script> <!-- jQuery library -->
<script src="../public/js/scripts.js"></script> <!-- Custom JavaScript file -->
</body>
</html>
