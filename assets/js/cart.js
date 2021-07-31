/* all logi response for manipulation with cart and like */
document.addEventListener("DOMContentLoaded", () => {
	// ============ DATABASE CLASS DEFINE ===================
	class Database {
		constructor(){}

	  	NewOrder (orderbody, comment, data, ordertime, callback, error_callback) {
			fetch("/orders/new-order", {
				    method: 'POST',
				    headers: {
				      'Content-Type': 'application/json;charset=utf-8'
				    },
				    body: JSON.stringify({orderbody: orderbody, comment: comment, data: data, ordertime: ordertime})
				})
		    .then(response => {
		    	if (response.ok) return response.text();
		    	else error_callback(response.text());
		    })
	      .then(result => {
	      	if (result != false) callback(result);
	      });
		}
	};

	let database = new Database();

	/*===================== FUNCTIONS DEFINE =============================*/
	/* cart */
	function setToCart(goodID, count) {
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
		showToast();
		cartAnimation()
	}

	function removeFromCart(goodID) {
		let cart = JSON.parse(localStorage.getItem('cart'));
		if (cart == null) cart = {};
		if (cart[goodID] != undefined) {
			localStorage.setItem('user-cart-count', Number(localStorage.getItem('user-cart-count'))-1);
			document.querySelector('.icon-cart').setAttribute('data-qty', localStorage.getItem('user-cart-count'));
			delete cart[goodID];
		}
		localStorage.setItem('cart', JSON.stringify(cart));
		showToast();
		cartAnimation()
	}

	function checkInCart(goodID) {
		let cart = JSON.parse(localStorage.getItem('cart'));
		if (cart == null) cart = {};
		return cart[goodID] != undefined;
	}

	function getFromCart(goodID) {
		let cart = JSON.parse(localStorage.getItem('cart'));
		if (cart == null) cart = {};
		if (cart[goodID] != undefined) return cart[goodID];
		else return 0;
	}

	/* like */
	function addToLike(goodID) {
		let like = JSON.parse(localStorage.getItem('like'));
		if (like == null) like = {};
		like[goodID] = "";
		localStorage.setItem('like', JSON.stringify(like));
	}

	function removeFromLike(goodID) {
		let like = JSON.parse(localStorage.getItem('like'));
		if (like == null) like = {};
		delete like[goodID];
		localStorage.setItem('like', JSON.stringify(like));
	}

	function checkInLike(goodID) {
		let like = JSON.parse(localStorage.getItem('like'));
		if (like == null) like = {};
		return like[goodID] != undefined;
	}


	/* support func */
	function cartAnimation()  {
		document.querySelector(".icon-cart svg").classList.add('add-to-cart-animation');	
		setTimeout(() => {
			document.querySelector(".icon-cart svg").classList.remove('add-to-cart-animation');
		}, 2100);
	}

	function showToast()  {
		let a = new bootstrap.Toast(document.getElementById('cartChangeToast'));
	    a.show();
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




	/*===========  ITEM PAGE INIT  ===============*/
	if (document.getElementById("sizeOffcanvasBtn")) {
		let sizeList = document.getElementById("sizeList");
		let cartSelect = document.getElementById("cartSelect");


		//set select if this good in cart
		function setSelect() {
	    	if (checkInCart(sizeList.children[sizeList.getAttribute("data-lt-target")].getAttribute("data-lt-id"))) {
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
		}


		/*add To Cart Select*/
		cartSelect.onchange = () => {
		    let goodID = sizeList.children[sizeList.getAttribute("data-lt-target")].getAttribute("data-lt-id");
		    if (cartSelect.value == 0) {
		    	removeFromCart(goodID);
		    	setSelect(); 
		    }

		    if (cartSelect.value > 0) setToCart(goodID, cartSelect.value);
		}

		/*Size select*/
		for (var i = 0; i < sizeList.children.length; i++) {
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
		    	
		    	setSelect();

		    	//click to button event
		    	document.getElementById("addToCart").onclick = () => {
		    		setToCart(sizeList.children[sizeList.getAttribute("data-lt-target")].getAttribute("data-lt-id"), 1); 

		    		setSelect();
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


	/*===========  LIKE PAGE INIT  ===============*/
	if (document.getElementById("likeCardsContainer")) {
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
	        	document.getElementById("likeCardsContainer").innerHTML = card;
	        	likeButtonsInit();
	        });
	}

	/*===========  CART PAGE INIT  ===============*/
	if (document.getElementById("cartCardsContainer")) {
	    let cart = JSON.parse(localStorage.getItem('cart'));
	    if (cart == null) cart = {};
	    let a = false;
    	for (let k in cart) {
    		a = true;
    		break;
    	}
    	if (a)
		fetch("/cart-cards", {
			    method: 'POST',
			    headers: {
			      'Content-Type': 'application/json;charset=utf-8'
			    },
			    body: JSON.stringify(cart)
			})
	        .then(response => response.text())
	        .then(card => {
	        	function countOverview(){
	        		cart = JSON.parse(localStorage.getItem('cart'));
	    			if (cart == null) cart = {};
	        		// set overview information
		        	let overview = document.getElementById("cartOverview");
		        	overview.innerHTML = "";
		        	let a = false;
		        	for (let k in cart) {
		        		a = true;
		        		break;
		        	}
		        	if (a) {
		        		document.getElementById("BuyBtn").parentNode.classList.remove('d-none');

			        	for (obj of document.getElementById("cartCardsContainer").children){
				        	let line =
				        	'<div class="d-flex">'+
			                '<div class="col-2"><img src="'+obj.querySelector('img').src+'" alt="" class="w-100"></div>'+
			                '<div class="col-10 pe-0 ps-2 align-self-center">'+obj.querySelector('.card-name').innerHTML+'</div>'+
			            	'</div>'+
			            	'<div class="col-12 p-0">'+obj.querySelector('.card-price').innerHTML+' x <span>'+
			            	obj.querySelector('select').value+'</span> = <span>'+
			            	((Number(obj.querySelector('.card-price').innerHTML.replace(/₽| /g, '')) * Number(obj.querySelector('select').value))+'').split( /(?=(?:\d{3})+$)/ ).join(' ')
			            	+'</span> ₽</div>'+
			            	'<hr class="mt-1 mb-1">';
			            	overview.insertAdjacentHTML('beforeend', line);
		            	}
		        		let k = 0;
		            	document.querySelectorAll('#cartOverview span:last-child').forEach((obj) => {
		            		k+=Number(obj.innerHTML.replace(/₽| /g, ''));
		            	});
		            	k=(k+'').split( /(?=(?:\d{3})+$)/ ).join(' ');
		            	overview.parentNode.querySelector('h4').innerHTML = 'Сумма: '+k+' ₽';

		            	// set buy button
			    		let link = '';
			    		for (k in cart) link+='d'+k+'c'+cart[k];
			    		document.forms.order.orderBody.value = link;
			    	}
			    	else {
			    		document.getElementById("BuyBtn").parentNode.classList.add('d-none');
			    		document.getElementById("cartCardsContainer").innerHTML = "<h2>Корзина пуста</h2>";
			    		document.getElementById("cartOverview").innerHTML = "";
			    	}
	        	}

	        	// set card
	        	document.getElementById("cartCardsContainer").innerHTML = card;
	        	// set close btn onclick
	        	for (let btn of document.querySelectorAll("[data-closeid]")) {
	        		btn.onclick = () => {
	        			removeFromCart(btn.getAttribute('data-closeid'));
	        			btn.parentNode.parentNode.parentNode.remove();
	        			countOverview();
	        		};
	        	}
	        	// set select options
	        	document.querySelectorAll('select').forEach((obj) => {
					obj.value = getFromCart(obj.parentNode.parentNode.querySelector('[data-closeid]').getAttribute('data-closeid'));
					obj.onchange = (e) => {
					    let goodID = e.currentTarget.parentNode.parentNode.querySelector('[data-closeid]').getAttribute('data-closeid');
					    setToCart(goodID, e.currentTarget.value);
					    countOverview();
					}
			    });
			    // set like options
	        	likeButtonsInit();

	        	// set overview information
            	countOverview();


	        });
	        else{
	        	document.getElementById("BuyBtn").parentNode.classList.add('d-none');
	        	document.getElementById("cartCardsContainer").innerHTML = "<h2>Корзина пуста</h2>";
			    document.getElementById("cartOverview").innerHTML = "";
	        }

	    //set order form
	    let order = document.forms.order;

	    document.querySelectorAll('input[type=radio]').forEach((obj) => {
	    	obj.onclick = () => {
	    		let myCollapse = document.getElementById('DeliveryTypeCollapse1');
	            if (order.DeliveryType.value == "1") myCollapse.classList.remove('d-none');
	            else myCollapse.classList.add('d-none');	            
	            myCollapse = document.getElementById('DeliveryTypeCollapse2');
	            if (order.DeliveryType.value == "2") myCollapse.classList.remove('d-none');
	            else myCollapse.classList.add('d-none');
	    	};
        });


        order.addEventListener('submit', function (event) {
        	event.preventDefault();
			event.stopPropagation();

			function GetFormattedDate() {
				var date = new Date();
			    var month = ("0" + (date.getMonth() + 1)).slice(-2);
			    var day  = ("0" + (date.getDate())).slice(-2);
			    var year = date.getFullYear();
			    var hour =  ("0" + (date.getHours())).slice(-2);
			    var min =  ("0" + (date.getMinutes())).slice(-2);
			    var seg = ("0" + (date.getSeconds())).slice(-2);
			    return year + "-" + month + "-" + day + " " + hour + ":" +  min + ":" + seg;
			}


			let passcode = new Uint32Array(1);
			window.crypto.getRandomValues(passcode);

			order.ordertime.value = GetFormattedDate();
			order.passcode.value = passcode[0];

			order.submit();
		});
	}


	likeButtonsInit();
});