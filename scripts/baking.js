document.addEventListener("DOMContentLoaded", function() {
    const products = [
        { name: "Pumpkin Mix", price: 3.99, imageSrc: "images/pumpkinmix.png", mainCat: "Baking"},
        { name: "Pie Crust", price: 3.49, imageSrc: "images/crust.png", mainCat: "Baking"},
        { name: "Pie Crusts", price: 5.29, imageSrc: "images/crust2.png", mainCat: "Baking"},
        { name: "Pan", price: 7.99, imageSrc: "images/pan.png", mainCat: "Baking"},
        { name: "Circular Pan", price: 4.99, imageSrc: "images/pan2.png", mainCat: "Baking"},
        { name: "Pudding/Pie Filling Mix", price: 1.67, imageSrc: "images/pudding.png", mainCat: "Baking"},
        
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
