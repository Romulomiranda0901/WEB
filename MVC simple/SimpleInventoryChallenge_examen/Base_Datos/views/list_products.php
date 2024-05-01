<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Products</title> <!-- Sets the title of the webpage -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"> <!-- Imports Bootstrap CSS -->
</head>
<body>
<div class="container">
    <h1>List Products</h1> <!-- Heading for the list products section -->
    <table class="table"> <!-- Table to display the list of products -->
        <thead>
        <tr>
            <th>Name</th> <!-- Table headers for product name, quantity, and price -->
            <th>Quantity</th>
            <th>Price</th>
        </tr>
        </thead>
        <tbody id="productList"> <!-- Table body where the list of products will be displayed -->

        </tbody>
    </table>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> <!-- Import jQuery library -->
<script src="../public/js/script.js"></script> <!-- Import custom JavaScript file -->
</body>
</html>
