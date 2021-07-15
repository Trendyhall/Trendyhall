let isItemPage = false;

function addToCart(goodID, count){
	let cart = JSON.parse(localStorage.getItem('cart'));
	if (cart == null) cart = {};
	cart[goodID] += count;
	localStorage.setItem('cart', JSON.stringify(cart));
}

function removeFromCart(goodID, count){
	let cart = JSON.parse(localStorage.getItem('cart'));
	cart[goodID] -= count;
	if (cart[goodID] <= 0) delete cart[goodID];
	localStorage.setItem('cart', JSON.stringify(cart));
}

function checkInCart(goodID){
	let cart = JSON.parse(localStorage.getItem('cart'));
	return cart[goodID] != undefined;
}

function itemPageInit(){
	/*Size select*/
	for (var i = 0; i < document.getElementById("sizeList").children.length; i++) {
		let sizeList = document.getElementById("sizeList");
		sizeList.children[i].setAttribute("data-lt-index", i);
        sizeList.children[i].onclick = (event) => {
        	if (sizeList.getAttribute("data-lt-target") > -1){
	      		sizeList.children[sizeList.getAttribute("data-lt-target")].classList.remove('active');
	      	}
	      	else {
        		document.getElementById("addToCart").removeAttribute("disabled");
        		document.getElementById("addToCartBadge").remove();
	      	}
	      	sizeList.children[event.currentTarget.getAttribute("data-lt-index")].classList.add('active');
	      	sizeList.setAttribute("data-lt-target", event.currentTarget.getAttribute("data-lt-index"));
	      	document.getElementById("sizeOffcanvasBtn").innerHTML = sizeList.children[event.currentTarget.getAttribute("data-lt-index")].firstChild.textContent + "<span>&#10095;</span>";
	    }
    }
    /*cart button*/

}

document.addEventListener("DOMContentLoaded", itemPageInit);