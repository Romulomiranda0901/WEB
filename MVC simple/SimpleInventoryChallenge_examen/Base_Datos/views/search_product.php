<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Product</title> <!-- Sets the title of the webpage -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"> <!-- Imports Bootstrap CSS -->
</head>
<body>
<div class="container">
    <h1>Search Product</h1> <!-- Heading for the search product section -->
    <form id="searchProductForm"> <!-- Form for searching a product with id "searchProductForm" -->
        <div class="mb-3">
            <label for="name" class="form-label">Product Name:</label> <!-- Label and input field for product name -->
            <input type="text" class="form-control" id="name" name="name">
        </div>
        <button type="submit" class="btn btn-primary">Search</button> <!-- Submit button to search for the product -->
    </form>
    <div id="searchResult"></div> <!-- Container for displaying search results -->
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> <!-- Import jQuery library -->
<script src="../public/js/script.js"></script> <!-- Import custom JavaScript file -->
</body>
</html>
