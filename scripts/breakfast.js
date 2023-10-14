document.addEventListener("DOMContentLoaded", function() {
    const products = [
        { name: "Cheerios Cereal", price: 4.99, imageSrc: "images/cheerios.jpeg", mainCat: "Breakfast", category: "cereal" },
        { name: "Crunch Berries", price: 3.99, imageSrc: "images/crunchberries.png", mainCat: "Breakfast", category: "cereal" },
        { name: "Raisin Bran", price: 2.50, imageSrc: "images/raisinbran.png", mainCat: "Breakfast", category: ["cereal", "rollbacks"] },
        { name: "Pancake Mix", price: 4.99, imageSrc: "images/pancakemix.png", mainCat: "Breakfast", category: "pancakes" },
        { name: "Waffle Mix", price: 2.89, imageSrc: "images/wafflemix.png", mainCat: "Breakfast", category: "pancakes" },
        { name: "Maple Syrup", price: 6.49, imageSrc: "images/maplesyrup.png", mainCat: "Breakfast", category: "pancakes" },
        { name: "Strawberry Oatmeal", price: 1.67, imageSrc: "images/oatmeal.png", mainCat: "Breakfast", category: ["oatmeal", "rollbacks"] },
        { name: "Caramel Oatmeal", price: 7.99, imageSrc: "images/carameloatmeal.png", mainCat: "Breakfast", category: ["oatmeal"] },
        { name: "Granola Bars", price: 10.99, imageSrc: "images/granolabar.png", mainCat: "Breakfast", category: ["oatmeal"] },
        { name: "Croissants", price: 4.99, imageSrc: "images/croissant.png", mainCat: "Breakfast", category: "breads" }, 
        { name: "Bagels", price: 4.79, imageSrc: "images/bagel.png", mainCat: "Breakfast", category: "breads" },
        { name: "Muffins", price: 4.99, imageSrc: "images/muffin.png", mainCat: "Breakfast", category: ["breads", "rollbacks"] },
        
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
