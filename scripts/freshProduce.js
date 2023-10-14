document.addEventListener("DOMContentLoaded", function() {
    const products = [
        { name: "Strawberries", price: 3.49, imageSrc: "images/strawberry.jpeg", mainCat: "Fresh Produce", category: "fruits"},
        { name: "Grapes", price: 3.99, imageSrc: "images/grapes.webp", mainCat: "Fresh Produce", category: ["fruits", "rollbacks"] },
        { name: "Watermelon", price: 5.00, imageSrc: "images/watermelon.png", mainCat: "Fresh Produce", category: "precut" },
        { name: "Apples", price: 3.99, imageSrc: "images/apple.png", mainCat: "Fresh Produce", category: "precut" },
        { name: "Pineapple", price: 3.99, imageSrc: "images/pineapple.png", mainCat: "Fresh Produce", category: "precut" },
        { name: "Broccoli", price: 1.23, imageSrc: "images/broc.png", mainCat: "Fresh Produce", category: "vegetables" },
        { name: "Lettuce", price: 1.79, imageSrc: "images/lettuce.png", mainCat: "Fresh Produce", category: "vegetables" },
        { name: "Cucumber", price: 0.59, imageSrc: "images/cucumber.webp", mainCat: "Fresh Produce", category: "vegetables" },
        { name: "Tulips", price: 12.00, imageSrc: "images/tulips.png", mainCat: "Fresh Produce", category: "flowers" },
        { name: "Lilies", price: 4.97, imageSrc: "images/lily.png", mainCat: "Fresh Produce", category: "flowers" },
        { name: "Daisies", price: 7.49, imageSrc: "images/daisy.png", mainCat: "Fresh Produce", category: "flowers" },
        { name: "Guacamole", price: 3.99, imageSrc: "images/guac.png", mainCat: "Fresh Produce", category: "salsa" },
        { name: "Hummus", price: 3.50, imageSrc: "images/hummus.png", mainCat: "Fresh Produce", category: "salsa" },
        { name: "Salsa", price: 1.59, imageSrc: "images/salsa.png", mainCat: "Fresh Produce", category: "salsa" },
        { name: "Pumpkin", price: 4.99, imageSrc: "images/pumpkin.png", mainCat: "Fresh Produce", category: ["season", "fruits"] },
        { name: "Gourmet Mushrooms", price: 3.99, imageSrc: "images/mushroom.png", mainCat: "Fresh Produce", category: "new" },

    ];

    const productCardsContainer = document.getElementById("productCards");

    products.forEach(product => {
        const card = document.createElement("div");
        card.classList.add("columnCard");
        card.classList.add("card");
        card.classList.add("filterDiv");
        card.classList.add(product.category); 
        card.setAttribute("name", product.name);

        card.innerHTML = `
            <img src="${product.imageSrc}" alt="Avatar" width="100%" height="180">
            <div class="container">
                <h4><b>${product.name}</b></h4>
                <p id="${product.name.toLowerCase()}-price">$${product.price.toFixed(2)}</p>
                <input type="number" class="center" id="${product.name.toLowerCase()}-quantity" min="1" max="10" value="1">
                <button type="button" class="center" onclick="addToCart('${product.name}')">Add to Cart</button>
                <p class="out-of-stock-message" id="${product.name.toLowerCase()}-out-of-stock" style="display:none;"></p>
            </div>
        `;

        productCardsContainer.appendChild(card);
        filterSelection("all");
    });
});
