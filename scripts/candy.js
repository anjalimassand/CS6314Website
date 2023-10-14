document.addEventListener("DOMContentLoaded", function() {
    const products = [
        { name: "Snickers", price: 4.49, imageSrc: "images/snickers.png", mainCat: "Candy"},
        { name: "KitKat", price: 4.49, imageSrc: "images/kitkat.png", mainCat: "Candy"},
        { name: "Jolly Rancher", price: 3.49, imageSrc: "images/jollyrancher.png", mainCat: "Candy"},
        { name: "Nerds", price: 1.25, imageSrc: "images/nerds.png", mainCat: "Candy"},
        { name: "Reeses", price: 4.49, imageSrc: "images/reeses.png", mainCat: "Candy"},
        { name: "Butterfinger", price: 4.49, imageSrc: "images/butterfinger.png", mainCat: "Candy"},

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
