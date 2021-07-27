/* all logi response for manipulation with cart and like */

/* cart */
function setToCart(goodID, count){
	let cart = JSON.parse(localStorage.getItem('cart'));
	if (cart == null) cart = {};
	if (cart[goodID] == undefined) {
		localStorage.setItem('user-cart-count', Number(localStorage.getItem('user-cart-count'))+1);
		document.querySelector('.icon-cart').setAttribute('data-qty', localStorage.getItem('user-cart-count'));
		cart[goodID] = count;
	}
	else {
		cart[goodID] = count;
	}
	
	localStorage.setItem('cart', JSON.stringify(cart));
}

function removeFromCart(goodID){
	let cart = JSON.parse(localStorage.getItem('cart'));
	if (cart == null) cart = {};
	if (cart[goodID] != undefined) {
		localStorage.setItem('user-cart-count', Number(localStorage.getItem('user-cart-count'))-1);
		document.querySelector('.icon-cart').setAttribute('data-qty', localStorage.getItem('user-cart-count'));
		delete cart[goodID];
	}
	localStorage.setItem('cart', JSON.stringify(cart));
}

function checkInCart(goodID){
	let cart = JSON.parse(localStorage.getItem('cart'));
	if (cart == null) cart = {};
	return cart[goodID] != undefined;
}

function getFromCart(goodID){
	let cart = JSON.parse(localStorage.getItem('cart'));
	if (cart == null) cart = {};
	if (cart[goodID] != undefined) return cart[goodID];
	else return 0;
}

/* like */
function addToLike(goodID){
	let like = JSON.parse(localStorage.getItem('like'));
	if (like == null) like = {};
	like[goodID] = "";
	localStorage.setItem('like', JSON.stringify(like));
}

function removeFromLike(goodID){
	let like = JSON.parse(localStorage.getItem('like'));
	if (like == null) like = {};
	delete like[goodID];
	localStorage.setItem('like', JSON.stringify(like));
}

function checkInLike(goodID){
	let like = JSON.parse(localStorage.getItem('like'));
	if (like == null) like = {};
	return like[goodID] != undefined;
}


/* support func */
function cartAnimation() {
	document.querySelector(".icon-cart svg").classList.add('add-to-cart-animation');	
	setTimeout(() => {
		document.querySelector(".icon-cart svg").classList.remove('add-to-cart-animation');
	}, 2100);
}

function showToast() {
	let a = new bootstrap.Toast(document.getElementById('Toast'));
    a.show();
}

function addToCartSelect() {

}



/* init */
function itemPageInit(){

	/*Size select*/
	for (var i = 0; i < document.getElementById("sizeList").children.length; i++) {
		let sizeList = document.getElementById("sizeList");
		sizeList.children[i].setAttribute("data-lt-index", i);

		//chouse size event
        sizeList.children[i].onclick = (event) => {
        	//change size select offCanvas
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
	    	

	    	//set select if this good in cart
	    	if (checkInCart(sizeList.children[sizeList.getAttribute("data-lt-target")].getAttribute("data-lt-id"))) {
	    		let cartSelect = document.getElementById("cartSelect");
	    		for (var i = 2; i < cartSelect.children.length; i++) {
	    			cartSelect.children[i].remove();
	    		}
	    		
	    		for (var i = 2; i <= Number(sizeList.children[sizeList.getAttribute("data-lt-target")].children[0].textContent); i++) {
	    			cartSelect.insertAdjacentHTML('beforeend', '<option value="'+i+'">'+i+'</option>');
	    		}
	    		cartSelect.value = getFromCart(sizeList.children[sizeList.getAttribute("data-lt-target")].getAttribute("data-lt-id"));

	    		cartSelect.classList.remove('d-none');
	    		document.getElementById("addToCart").classList.add('d-none');
	    	}
	    	else {
	    		document.getElementById("cartSelect").classList.add('d-none');
	    		document.getElementById("addToCart").classList.remove('d-none');
	    	}

	    	//click to button event
	    	document.getElementById("addToCart").onclick = () => {
	    		setToCart(sizeList.children[sizeList.getAttribute("data-lt-target")].getAttribute("data-lt-id"), 1); 

	    		//addToCartSelect();

	    		cartAnimation()
	    	};
	    }
    }
    /*cart button*/
    


    /*like button*/
    let likeBtn = document.getElementById("addToLike");
    if (checkInLike(likeBtn.getAttribute("data-likeid"))) {
    	likeBtn.classList.add('active');
    	likeBtn.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M8 4.41c1.387-1.425 4.854 1.07 0 4.277C3.146 5.48 6.613 2.986 8 4.412z"/><path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5V2zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1H4z"/></svg>';
    }
    likeBtn.onclick = () => {
    	if (checkInLike(likeBtn.getAttribute("data-likeid"))) {
    		likeBtn.classList.remove('active');
	    	removeFromLike(likeBtn.getAttribute("data-likeid"));
	    	likeBtn.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16"><path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5V2zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1H4z"/></svg>';
	    }	
	    else {
	    	likeBtn.classList.add('active');
	    	addToLike(likeBtn.getAttribute("data-likeid"));
	    	likeBtn.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M8 4.41c1.387-1.425 4.854 1.07 0 4.277C3.146 5.48 6.613 2.986 8 4.412z"/><path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5V2zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1H4z"/></svg>';
	    }
    }

}

function cartPageInit() {
    let cart = JSON.parse(localStorage.getItem('cart'));
    if (cart == null) cart = {};
	fetch("/cart-cards", {
		    method: 'POST',
		    headers: {
		      'Content-Type': 'application/json;charset=utf-8'
		    },
		    body: JSON.stringify(cart)
		})
        .then(response => response.text())
        .then(card => {
        	document.getElementById("cartCardsContainer").insertAdjacentHTML('beforeend', card);
        	for (let btn of document.querySelectorAll("[data-closeid]")) {
        		btn.onclick = () => {
        			removeFromCart(btn.getAttribute('data-closeid'));
        			btn.parentNode.parentNode.parentNode.remove();
        		};
        	}
        	likeButtonsInit();
        });
}

function likePageInit() {
    let like = JSON.parse(localStorage.getItem('like'));
    if (like == null) like = {};
	fetch("/like-cards", {
		    method: 'POST',
		    headers: {
		      'Content-Type': 'application/json;charset=utf-8'
		    },
		    body: JSON.stringify(like)
		})
        .then(response => response.text())
        .then(card => {
        	document.getElementById("likeCardsContainer").insertAdjacentHTML('beforeend', card);
        	likeButtonsInit();
        });
}

function likeButtonsInit() {
	let likeButtons = document.querySelectorAll('[data-likeid]:not(#addToLike)');
	for (let likeBtn of likeButtons) {
	    if (checkInLike(likeBtn.getAttribute("data-likeid"))) {
	    	likeBtn.classList.add('active');
	    }
	    likeBtn.onclick = () => {
	    	if (checkInLike(likeBtn.getAttribute("data-likeid"))) {
	    		likeBtn.classList.remove('active');
		    	removeFromLike(likeBtn.getAttribute("data-likeid"));
		    }	
		    else {
		    	likeBtn.classList.add('active');
		    	addToLike(likeBtn.getAttribute("data-likeid"));
		    }
	    }
	}
}

document.addEventListener("DOMContentLoaded", () => {
	if (document.getElementById("sizeOffcanvasBtn")) itemPageInit();
	if (document.getElementById("likeCardsContainer")) likePageInit();
	if (document.getElementById("cartCardsContainer")) cartPageInit();

	likeButtonsInit();
});