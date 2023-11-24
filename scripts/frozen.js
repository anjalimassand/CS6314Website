$(document).ready(function() {

    // Update the path to the XML file
    const xmlFilePath = "xml/frozen.xml";

    // Fetch the XML data from the specified file
    $.ajax({
        type: "GET",
        url: xmlFilePath,
        dataType: "xml",
        success: function (xmlData) {
            // Parse the XML data
            const products = $(xmlData).find("product");

            const productCardsContainer = $("#productCards");

            const uniqueProducts = {}; // Keep track of unique products

            products.each(function () {
                const name = $(this).find("name").text();
                const price = parseFloat($(this).find("price").text());
                const imageSrc = $(this).find("imageSrc").text();
                const categoryElements = $(this).find("category");
                const categories = categoryElements.map(function () {
                    return $(this).text();
                }).get();

                if (!uniqueProducts[name]) {
                    categories.forEach(function (category) {
                        const card = $("<div>").addClass("columnCard card filterDiv " + category)
                            .attr("name", name)
                            .html(`
                                <img src="${imageSrc}" alt="Avatar" width="100%" height="180">
                                <div class="container">
                                    <h4><b>${name}</b></h4>
                                    <p id="${name.toLowerCase()}-price">$${price.toFixed(2)}</p>
                                    <input type="number" class="center" id="${name.toLowerCase()}-quantity" min="1" max="10" value="1">
                                    <button type="button" class="center" onclick="addToCart('${name}')">Add to Cart</button>
                                    <p class="out-of-stock-message" id="${name.toLowerCase()}-out-of-stock" style="display:none;"></p>
                                </div>
                            `);

                        productCardsContainer.append(card);
                    });

                    // Add the product to the uniqueProducts list
                    uniqueProducts[name] = true;
                }
            });

            filterSelection("all");
        },
        error: function (error) {
            console.error("Error fetching XML data:", error);
        }
    });
});
