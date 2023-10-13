document.addEventListener("DOMContentLoaded", function() {
    const products = [
        { name: "Hummus", price: 3.50, imageSrc: "images/hummus.png", mainCat: "Pantry", category: "spread" },
        { name: "Butter", price: 3.99, imageSrc: "images/butter.png", mainCat: "Pantry", category: "spread" },
        { name: "Guacamole", price: 3.99, imageSrc: "images/guac.png", mainCat: "Pantry", category: "spread" },
        { name: "Ketchup", price: 3.29, imageSrc: "images/ketchup.png", mainCat: "Pantry", category:["condiments", "rollbacks"]},
        { name: "Penne Pasta", price: 1.25, imageSrc: "images/penne.png", mainCat: "Pantry", category: ["pasta", "rollbacks"]},
        { name: "Spaghetti Pasta", price: 1.50, imageSrc: "images/spaghetti.png", mainCat: "Pantry", category: ["pasta", "rollbacks"]},
        { name: "Rotini Pasta", price: 1.50, imageSrc: "images/rotini.png", mainCat: "Pantry", category: "pasta"},
        { name: "Canned Grean Beans", price: 0.89, imageSrc: "images/cannedbeans.png", mainCat: "Pantry", category: ["cannedvegetables"]},
        { name: "Canned Corn", price: 0.89, imageSrc: "images/cannedcorn.png", mainCat: "Pantry", category: ["cannedvegetables"]},
        { name: "Canned Peas", price: 1.59, imageSrc: "images/cannedpeas.png", mainCat: "Pantry", category: ["cannedvegetables"]},
        { name: "Alfredo Sauce", price: 2.99, imageSrc: "images/alfredosauce.png", mainCat: "Pantry", category: ["cannedgoods"]},
        { name: "Beef Soup", price: 2.00, imageSrc: "images/beefsoup.png", mainCat: "Pantry", category: ["cannedgoods"]},
        { name: "Tomato Basil Soup", price: 2.19, imageSrc: "images/tomatobasil.png", mainCat: "Pantry", category: ["cannedgoods"]},
        { name: "Mustard", price: 0.99, imageSrc: "images/mustard.png", mainCat: "Pantry", category: ["condiments"]},
        { name: "Mayonnaise", price: 3.99, imageSrc: "images/mayo.png", mainCat: "Pantry", category: ["condiments"]},
       
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
                <p class="out-of-stock-message" id="${product.name.toLowerCase()}-out-of-stock"></p>
            </div>
        `;

        productCardsContainer.appendChild(card);
        filterSelection("all");
    });
});
