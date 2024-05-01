$(document).ready(function() {
    // Function to validate the add product form
    $('#addProductForm').submit(function(event) {
        event.preventDefault(); // Prevent the default form submission behavior
        var quantity = $('#quantity').val(); // Get the quantity input value
        var price = $('#price').val(); // Get the price input value
        // Check if quantity is not a number or is less than or equal to 0
        if (isNaN(quantity) || quantity <= 0) {
            alert('Quantity must be a positive number.');
            return; // Exit the function if validation fails
        }
        // Check if price is not a number or is less than or equal to 0
        if (isNaN(price) || price <= 0) {
            alert('Price must be a positive number.');
            return; // Exit the function if validation fails
        }
        this.submit(); // Submit the form if validation passes
    });

    // Function to validate the delete product form
    $('#deleteProductForm').submit(function(event) {
        event.preventDefault(); // Prevent the default form submission behavior
        this.submit(); // Submit the form
    });

    // Function to validate the search product form
    $('#searchProductForm').submit(function(event) {
        event.preventDefault(); // Prevent the default form submission behavior
        this.submit(); // Submit the form
    });

    // You can add more jQuery functions for other views here if needed
});
