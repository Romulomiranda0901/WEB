$(document).ready(function() {
    // Variable to check if the product list has been loaded
    var productListLoaded = false;

    // Function to load the product list via AJAX
    function loadProductList() {
        $.ajax({
            type: 'POST',
            url: '/Inventario_Base_datos/controllers/Rutas.php/?action=list',
            dataType: 'json', // Specify that we expect JSON as a response
            success: function(response) {
                console.log(response);
                // Check if there's an error in the response
                if (response.success) {
                    // Build HTML to display the product list
                    var productListHTML = '';

                    response.products.forEach(function(product) {
                        productListHTML += '<tr>';
                        productListHTML += '<td>' + product.name + '</td>';
                        productListHTML += '<td> ' + product.quantity + '</td>';
                        productListHTML += '<td> ' + product.price + '</td>';
                        productListHTML += '</tr>';
                    });

                    $('#productList').html(productListHTML);
                    productListLoaded = true;
                } else {
                    console.error('Error:', response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error('Error loading the product list:', error);
            }
        });
    }

    // Load the product list when the page loads, only if it hasn't been loaded before
    if (!productListLoaded) {
        loadProductList();
    }

    // Submit handler for the add product form
    $('#addProductForm').submit(function(event) {
        event.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
            type: 'POST',
            url: '/Inventario_Base_datos/controllers/Rutas.php/?action=add',
            data: formData,
            success: function(response) {
                $('#addProductForm')[0].reset();
                window.location = '/Inventario_Base_datos/';
            },
            error: function(xhr, status, error) {
                console.error('Error adding product:', error);
            }
        });
    });

    // Submit handler for the delete product form
    $('#deleteProductForm').submit(function(event) {
        event.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
            type: 'POST',
            url: '/Inventario_Base_datos/controllers/Rutas.php/?action=delete',
            data: formData,
            success: function(response) {
                $('#deleteProductForm')[0].reset();
                window.location = '/Inventario_Base_datos/';
            },
            error: function(xhr, status, error) {
                console.error('Error deleting product:', error);
            }
        });
    });

    // Submit handler for the search product form
    $('#searchProductForm').submit(function(event) {
        event.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
            type: 'GET',
            url: '/Inventario_Base_datos/controllers/Rutas.php/?action=search',
            data: formData,
            success: function(response) {
                if (response.success) {
                    var productListHTML = '<table>';
                    response.product.forEach(function(product) {
                        productListHTML += '<tr>';
                        productListHTML += '<td>Name: ' + product.name + '</td>';
                        productListHTML += '<td>Quantity: ' + product.quantity + '</td>';
                        productListHTML += '<td>Price: ' + product.price + '</td>';
                        productListHTML += '</tr>';
                    });
                    productListHTML += '</table>';
                    $('#searchResult').html(productListHTML);
                } else {
                    console.error('Error searching for product:', response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error('Error searching for product:', error);
            }
        });
    });

});
