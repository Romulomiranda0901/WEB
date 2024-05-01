<!DOCTYPE html>
<html lang="en"> <!-- Document language set to English -->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Result</title> <!-- Page title -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .producto-encontrado {
            background-color: #ffe6b3; /* Background color to highlight */
            font-weight: bold; /* Bold text to highlight */
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <h2>Search Product</h2> <!-- Heading for the search product form -->
    <form id="searchProductForm" action="/Inventario/index.php?action=search" method="POST">
        <div class="mb-3">
            <label for="nombre" class="form-label">Product Name:</label> <!-- Label for product name input -->
            <input type="text" class="form-control" id="name" name="name" required> <!-- Product name input -->
        </div>
        <button type="submit" class="btn btn-primary">Search Product</button> <!-- Submit button -->
    </form>

    <?php if (isset($foundProduct)): ?> <!-- Check if a product was found -->
        <h2>Search Result</h2> <!-- Heading for the search result -->
        <?php if ($foundProduct): ?> <!-- Check if a product was found -->
            <div class="alert alert-success" role="alert">
                <strong>Product found:</strong> <!-- Success alert with product details -->
                <ul>
                    <li>Name: <?php echo htmlspecialchars($foundProduct->getName()); ?></li> <!-- Display product name -->
                    <li>Quantity: <?php echo htmlspecialchars($foundProduct->getQuantity()); ?></li> <!-- Display product quantity -->
                    <li>Price per Unit: <?php echo htmlspecialchars($foundProduct->getPrice()); ?></li> <!-- Display price per unit -->
                </ul>
            </div>
        <?php else: ?> <!-- If no product was found -->
            <div class="alert alert-warning" role="alert">
                <strong>No products found with that name.</strong> <!-- Warning alert for no product found -->
            </div>
        <?php endif; ?>

        <h3>Product List</h3> <!-- Heading for the product list -->
        <table class="table">
            <thead>
            <tr>
                <th>Name</th> <!-- Table header for product name -->
                <th>Quantity</th> <!-- Table header for product quantity -->
                <th>Price per Unit</th> <!-- Table header for price per unit -->
            </tr>
            </thead>
            <tbody>
            <?php if (!empty($products)): ?> <!-- Check if there are products to display -->
                <?php foreach ($products as $producto): ?> <!-- Loop through each product -->
                    <tr <?php if ($foundProduct && $producto->getName() === $foundProduct->getName()) echo 'class="producto-encontrado"'; ?>>
                        <!-- Highlight the found product -->
                        <td><?php echo $producto->getName(); ?></td> <!-- Display product name -->
                        <td><?php echo $producto->getQuantity(); ?></td> <!-- Display product quantity -->
                        <td><?php echo $producto->getPrice(); ?></td> <!-- Display price per unit -->
                    </tr>
                <?php endforeach; ?>
            <?php else: ?> <!-- If no products are available -->
                <tr>
                    <td colspan="3" class="text-center">No products available.</td> <!-- Display a message -->
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>
<script src="../public/js/jquery.min.js"></script> <!-- jQuery library -->
<script src="../public/js/scripts.js"></script> <!-- Custom JavaScript file -->
</body>
</html>
