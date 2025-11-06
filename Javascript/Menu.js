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
    console.log('Loaded')
    

    let productData;

    loadProducts().then(data => {
        productData = data; // assign the loaded data to a variable
        console.log("Products loaded:", productData);
        const CafeDiv = document.getElementById('cafe');
        const BakeryDiv = document.getElementById('Bakery');


        const TestDiv = document.getElementById('test');
        TestDiv.innerHTML = ''; // Clear cart display

        let total = 0;

        // Display each item in the cart
        productData.cafe.forEach((item, index) => {
            const itemDiv = document.createElement('div');
            
            itemDiv.innerHTML = `
            <img class="menu_image"  src="#">
            <h3 style="font-size: 40pt; white-space: wrap;">${item.name}</h3>
            <p>£${item.price}</p>
            <button  onclick="addToCart(${item.name}, ${item.price})">Add to cart</button>
            `.trim();
            TestDiv.appendChild(itemDiv);
            itemDiv.classList.add('menu_item');
        });
    });
}
