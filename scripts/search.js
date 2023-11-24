$(document).ready(function() {
    const searchInput = $("#searchInput");
    const foodContainer = $("#foodContainer");
    const errorMessage = $("#error-message");

    // Add an event listener to the search button
    $("#searchButton").on("click", filterProducts);

    // Add an event listener to the form submit event
    $(".search").on("submit", function(event) {
        event.preventDefault();
        filterProducts();
    });

    // Function to filter products based on search input
    function filterProducts() {
        errorMessage.hide();
        const searchTerm = searchInput.val().toLowerCase();
        let noResultsFound = true;
        const cards = foodContainer.find(".card");
        var letters = /^[A-Za-z ]+$/;

        cards.each(function() {
            const productName = $(this).attr("name").toLowerCase();

            if (productName.includes(searchTerm)) {
                $(this).show(); // Display the matching product
                noResultsFound = false; // Found at least one result
                errorMessage.hide();
            } else {
                $(this).hide(); // Hide non-matching products
            }
        });

        // Display an error message if no results were found
        if (noResultsFound) {
            if (!searchTerm.match(letters)) {
                errorMessage.text("Do not include numbers in search.");
            } else {
                errorMessage.text("No matching products found.");
            }
            errorMessage.show();
        }
    }
});

