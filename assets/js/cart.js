

function addToCart(goodID){
	let cart = JSON.parse(localStorage.getItem('cart'));
	if (cart == null) cart = [];
	cart.push(goodID);
	localStorage.setItem('cart', JSON.stringify(cart));
}

function removeFromCart(goodID){
	let cart = JSON.parse(localStorage.getItem('cart'));
	if (cart == null) cart = [];
	let index = cart.indexOf(goodID);
	if (index > -1) {
	  array.splice(index, 1);
	}
	localStorage.setItem('cart', JSON.stringify(cart));
}

function checkInCart(goodID){
	let cart = JSON.parse(localStorage.getItem('cart'));
	if (cart == null) cart = [];
	cart.includes(goodID);
	localStorage.setItem('cart', JSON.stringify(cart));
}