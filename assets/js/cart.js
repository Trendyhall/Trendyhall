
/* cart */
function addToCart(goodID, count){
	let cart = JSON.parse(localStorage.getItem('cart'));
	if (cart == null) cart = {};
	cart[goodID] += count;
	localStorage.setItem('cart', JSON.stringify(cart));
}

function removeFromCart(goodID, count){
	let cart = JSON.parse(localStorage.getItem('cart'));
	if (cart == null) cart = {};
	cart[goodID] -= count;
	if (cart[goodID] <= 0) delete cart[goodID];
	localStorage.setItem('cart', JSON.stringify(cart));
}

function checkInCart(goodID){
	let cart = JSON.parse(localStorage.getItem('cart'));
	if (cart == null) cart = {};
	return cart[goodID] != undefined;
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
/* init */

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


    /*like button
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
    }*/

}

function cartPageInit() {
    let like = JSON.parse(localStorage.getItem('cart'));
    if (like == null) like = {};
	let query = "?id[]=0"
    for(var k in like) {
	   query += "&id[]="+k;
	}
	fetch("/card"+query)
        .then(response => response.text())
        .then(card => {
        	document.getElementById("cartCardsContainer").insertAdjacentHTML('beforeend', card);
        	likeButtonsInit();
        });
}

function likePageInit() {
    let like = JSON.parse(localStorage.getItem('like'));
    if (like == null) like = {};
	let query = "?id[]=0"
    for(var k in like) {
	   query += "&id[]="+k;
	}
	fetch("/card"+query)
        .then(response => response.text())
        .then(card => {
        	document.getElementById("likeCardsContainer").insertAdjacentHTML('beforeend', card);
        	likeButtonsInit();
        });
}

function likeButtonsInit() {
	let likeButtons = document.querySelectorAll('[data-likeid]');
	for (let likeBtn of likeButtons) {
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
}

document.addEventListener("DOMContentLoaded", () => {
	if (document.getElementById("sizeOffcanvasBtn")) itemPageInit();
	if (document.getElementById("likeCardsContainer")) likePageInit();
	if (document.getElementById("cartCardsContainer")) cartPageInit();

	likeButtonsInit();
});