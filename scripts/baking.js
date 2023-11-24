$(document).ready(function() {
    // Update the path to the JSON file
    const jsonFilePath = "json/baking.json";

    const productCardsContainer = $("#productCards");

    // Fetch the JSON data from the specified file
    $.getJSON(jsonFilePath, function(products) {
        // Iterate over the products and create HTML cards dynamically
        $.each(products, function(index, product) {
            const card = $("<div>").addClass("columnCard card")
                .attr("name", product.name)
                .html(`
                    <img src="${product.imageSrc}" alt="Avatar" width="100%" height="180">
                    <div class="container">
                        <h4><b>${product.name}</b></h4>
                        <p id="${product.name.toLowerCase()}-price">$${product.price.toFixed(2)}</p>
                        <input type="number" class="center" id="${product.name.toLowerCase()}-quantity" min="1" max="10" value="1">
                        <button type="button" class="center" onclick="addToCart('${product.name}')">Add to Cart</button>
                        <p class="out-of-stock-message" id="${product.name.toLowerCase()}-out-of-stock" style="display:none;"></p>
                    </div>
                `);

            productCardsContainer.append(card);
        });
    })
    .fail(function(error) {
        console.error("Error fetching JSON data:", error);
    });
});
