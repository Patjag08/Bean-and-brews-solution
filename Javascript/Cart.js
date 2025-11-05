// --- Cookie helpers ---
function setCookie(name, value, days = 1) {
  const maxAge = days * 24 * 60 * 60; // in seconds
  document.cookie = `${name}=${encodeURIComponent(value)}; path=/; max-age=${maxAge}`;
}

function getCookie(cname) {
  let name = cname + "=";
  let ca = document.cookie.split(';');
  for (let i = 0; i < ca.length; i++) {
    let c = ca[i].trim(); // remove leading/trailing spaces
    if (c.indexOf(name) === 0) {
      return decodeURIComponent(c.substring(name.length));
    }
  }
  return "";
}



function getCookieJSON(name) {
  const cookies = document.cookie.split('; ');
  for (const cookie of cookies) {
    const [key, value] = cookie.split('=');
    if (key === name) {
      if (!value) return null; // cookie exists but empty
      try {
        return JSON.parse(decodeURIComponent(value));
      } catch (e) {
        console.warn(`Cookie "${name}" is not valid JSON:`, value);
        return null;
      }
    }
  }
  return null; // cookie not found
}

//Cart layout:
function checkCookieExists(cookieName) {
   return getCookie(cookieName) !== null;
}
// Create the cookie if it doesnt exist

//Cookie based utility
//Cart system itself:


function addToCart(itemName, itemPrice) {
  // Read the cookie
  let cartCookie = getCookie('cart');
  
  // Safely parse cookie or start empty
  let cart = JSON.parse(decodeURIComponent(cartCookie));
  console.log(cart)

  // Add new item
  cart.push({ item: itemName, price: itemPrice });


  // Save updated cart back to cookie
  setCookie('cart', encodeURIComponent(JSON.stringify(cart)), 365); // path=/ included inside setCookie
  console.log('Cart updated:', cart);
}



function removeFromCart(index) {
  // Remove item from cart
  let cartCookie = getCookie('cart');
  let cart = JSON.parse(decodeURIComponent(cartCookie));
  cart.splice(index, 1);
  setCookie('cart', encodeURIComponent(JSON.stringify(cart)), 365);
  //updateCart();
}

function updateCart() {
    const cartDiv = document.getElementById('cart');
    const totalDiv = document.getElementById('total');
    let cartCookie = getCookie('cart');
    let cart = JSON.parse(decodeURIComponent(cartCookie));
    console.log(cart)
    cartDiv.innerHTML = ''; // Clear cart display

    let total = 0;

    // Display each item in the cart
    cart.forEach((item, index) => {
        const itemDiv = document.createElement('div');
        itemDiv.className = 'cart-item';
        itemDiv.innerHTML = `
        ${item.item} - £${item.price.toFixed(2)}
        <button onclick="removeFromCart(${index})">Remove</button>
        `;
        cartDiv.appendChild(itemDiv);
        total += item.price;
        console.log(item.item)
    });

    // Update total price
    totalDiv.textContent = `Total: £${total.toFixed(2)}`;
}

window.onload = function() {
  if (!getCookie('cart')) {
    //If the cookie doesnt exist make it exist
    setCookie('cart', encodeURIComponent(JSON.stringify([])), 365);
  }
  //updateCart()
}
