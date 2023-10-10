    const searchInput = document.getElementById("searchInput");
    const foodContainer = document.getElementById("foodContainer");
    const errorMessage = document.getElementById("error-message");

    // Add an event listener to the search button
    document.getElementById("searchButton").addEventListener("click", filterProducts);

    // Add an event listener to the form submit event
    document.querySelector(".search").addEventListener("submit", function(event) {
        event.preventDefault(); // Prevent the form from submitting and refreshing the page
        filterProducts(); // Call your filter function
    });

    // Function to filter products based on search input
    function filterProducts() { 
        errorMessage.style.display = "none";
        const searchTerm = searchInput.value.toLowerCase();
        let noResultsFound = true; // Flag to check if any results are found
        // Loop through all the product cards
        const cards = foodContainer.getElementsByClassName("card");
        var letters = /^[A-Za-z ]+$/;
        
        for (const card of cards) {
            const productName = card.getAttribute("name").toLowerCase();
            
            
            if (productName.includes(searchTerm)) {
                card.style.display = "block"; // Display the matching product
                noResultsFound = false; // Found at least one result
                console.log("displayed");
                console.log(searchTerm);
                console.log(productName);
                errorMessage.style.display = "none";
            } else {
                card.style.display = "none"; // Hide non-matching products
            }
        }

            // Display an error message if no results were found
            if (noResultsFound) {
                if (!searchTerm.match(letters)) {
                    errorMessage.textContent = "Do not include numbers in search.";
                } else {
                    errorMessage.textContent = "No matching products found.";
                }
                errorMessage.style.display = "block";
            }
            
            
        
    }

