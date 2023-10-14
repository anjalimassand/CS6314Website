document.addEventListener("DOMContentLoaded", function() {
    const products = [
        { name: "Oreo Cookies", price: 3.49, imageSrc: "images/oreo.png", mainCat: "Snacks"},
        { name: "Lays Chips", price: 3.99, imageSrc: "images/lays.jpeg", mainCat: "Snacks"},
        { name: "Animal Crackers", price: 3.59, imageSrc: "images/crackers.png", mainCat: "Snacks"},
        { name: "Pretzel Crips", price: 3.99, imageSrc: "images/pretzel.png", mainCat: "Snacks"},
        { name: "KitKat", price: 4.49, imageSrc: "images/kitkat.png", mainCat: "Snacks"},
        { name: "Gelato", price: 5.99, imageSrc: "images/gelato.png", mainCat: "Snacks"},

    ];

    const productCardsContainer = document.getElementById("productCards");

    products.forEach(product => {
        const card = document.createElement("div");
        card.classList.add("columnCard");
        card.classList.add("card");
      //  card.classList.add("filterDiv");
      //  card.classList.add(product.category); 
        card.setAttribute("name", product.name);

        card.innerHTML = `
            <img src="${product.imageSrc}" alt="Avatar" width="100%" height="180">
            <div class="container">
                <h4><b>${product.name}</b></h4>
                <p id="${product.name.toLowerCase()}-price">$${product.price.toFixed(2)}</p>
                <input type="number" class="center" id="${product.name.toLowerCase()}-quantity" min="1" max="10" value="1">
                <button type="button" class="center" onclick="addToCart('${product.name}')">Add to Cart</button>
                <p class="out-of-stock-message" id="${product.name.toLowerCase()}-out-of-stock" style="display:none;></p>
            </div>
        `;

        productCardsContainer.appendChild(card);
    });
});
