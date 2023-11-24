document.addEventListener("DOMContentLoaded", function() {

    // Update the path to the XML file
    const xmlFilePath = "xml/freshproduce.xml";

    // Fetch the XML data from the specified file
    fetch(xmlFilePath)
        .then(response => response.text())
        .then(xmlData => {
            // Parse the XML data
            const parser = new DOMParser();
            const xmlDoc = parser.parseFromString(xmlData, "application/xml");
            const products = xmlDoc.getElementsByTagName("product");

            const productCardsContainer = document.getElementById("productCards");

            const uniqueProducts = {}; // Keep track of unique products

            for (let i = 0; i < products.length; i++) {
                const product = products[i];
                const name = product.querySelector("name").textContent;
                const price = parseFloat(product.querySelector("price").textContent);
                const imageSrc = product.querySelector("imageSrc").textContent;
                const categoryElements = product.querySelectorAll("category");
                const categories = Array.from(categoryElements).map(category => category.textContent);

                if (!uniqueProducts[name]) {
                    categories.forEach(category => {
                        const card = document.createElement("div");
                        card.classList.add("columnCard");
                        card.classList.add("card");
                        card.classList.add("filterDiv");
                        card.classList.add(category);
                        card.setAttribute("name", name);

                        card.innerHTML = `
                            <img src="${imageSrc}" alt="Avatar" width="100%" height="180">
                            <div class="container">
                                <h4><b>${name}</b></h4>
                                <p id="${name.toLowerCase()}-price">$${price.toFixed(2)}</p>
                                <input type="number" class="center" id="${name.toLowerCase()}-quantity" min="1" max="10" value="1">
                                <button type="button" class="center" onclick="addToCart('${name}')">Add to Cart</button>
                                <p class="out-of-stock-message" id="${name.toLowerCase()}-out-of-stock" style="display:none;"></p>
                            </div>
                        `;

                        productCardsContainer.appendChild(card);
                    });

                    // Add the product to the uniqueProducts list
                    uniqueProducts[name] = true;
                }
            }

            filterSelection("all");
        })
        .catch(error => console.error("Error fetching XML data:", error));
});
