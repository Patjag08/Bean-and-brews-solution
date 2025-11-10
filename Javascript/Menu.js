async function loadProducts() {

    const response = await fetch('Database/products.json');
    const products = await response.json();

    // Now products is available here
    console.log(products.bakery);
    console.log(products.cafe);

    return products;
}

document.addEventListener("DOMContentLoaded", () => {
  console.log("Menu.js running — DOM is ready");
  Main();
});


function Main() {
    console.log('Loaded');
    

    let productData;

    loadProducts().then(data => {
        productData = data; // assign the loaded data to a variable
        console.log("Products loaded:", productData);
        const DrinksDiv = document.getElementById('drinks');
        const TreatsDiv = document.getElementById('treats');
        let total = 0;

        // This is for the index specificly
        productData.cafe.forEach((item, index) => {
            if (item.favourite == true)
            {
                const itemDiv = document.createElement('div');
            
                itemDiv.innerHTML = `
                <img class="menu_image"  src="https://static.vecteezy.com/system/resources/previews/016/916/479/non_2x/placeholder-icon-design-free-vector.jpg">
                <p style="font-size: 25pt; white-space: no-wrap;">${item.name}<p>
                <p>£${item.price.toFixed(2)}</p>
                <button class="Add_to_cart_button" onclick="addToCart(${item.name}, ${item.price})">Add to cart</button>
                `.trim();
                DrinksDiv.appendChild(itemDiv);
                itemDiv.classList.add('menu_item');
            }
        });
        productData.bakery.forEach((item, index) => {
            if (item.favourite == true)
            {
                const itemDiv = document.createElement('div');
            
                itemDiv.innerHTML = `
                <img class="menu_image"  src="https://static.vecteezy.com/system/resources/previews/016/916/479/non_2x/placeholder-icon-design-free-vector.jpg">
                <p style="font-size: 25pt; white-space: no-wrap;">${item.name}<p>
                <p>£${item.price.toFixed(2)}</p>
                <button class="Add_to_cart_button" onclick="addToCart(${item.name}, ${item.price})">Add to cart</button>
                `.trim();
                TreatsDiv.appendChild(itemDiv);
                itemDiv.classList.add('menu_item');
            }
        });
    });
}
