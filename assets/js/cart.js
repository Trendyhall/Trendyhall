

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
	

	function likeButtonsInit() {
		let likeButtons = document.querySelectorAll('[data-like-id]'); //[data-like-id]:not(#addToLike)
		for (let likeBtn of likeButtons) {
		    if (user.like.check(likeBtn.getAttribute("data-like-id"))) {
		    	likeBtn.classList.add('active');
		    }
		    likeBtn.onclick = () => {
		    	if (user.like.check(likeBtn.getAttribute("data-like-id"))) {
		    		likeBtn.classList.remove('active');
			    	user.like.remove(likeBtn.getAttribute("data-like-id"));
			    }	
			    else {
			    	likeBtn.classList.add('active');
			    	user.like.add(likeBtn.getAttribute("data-like-id"));
			    }
		    }
		}
	}




	/*===========  ITEM PAGE INIT  ===============*/
	if (document.getElementById("sizeOffcanvasBtn")) {
		let sizeList = document.getElementById("sizeList");
		let cartSelect = document.getElementById("cartSelect");
		let sizeOffcanvas = new bootstrap.Offcanvas(document.getElementById('SizeOffcanvas'));


		//set select if this good in cart
		function setSelect() {
	    	if (user.cart.check(sizeList.children[sizeList.getAttribute("data-lt-target")].getAttribute("data-lt-id"))) {
	    		for (var i = 2; i < cartSelect.children.length; i++) {
	    			cartSelect.children[i].remove();
	    		}
	    		
	    		for (var i = 2; i <= Number(sizeList.children[sizeList.getAttribute("data-lt-target")].children[0].textContent); i++) {
	    			cartSelect.insertAdjacentHTML('beforeend', '<option value="'+i+'">'+i+'</option>');
	    		}
	    		cartSelect.value = user.cart.get(sizeList.children[sizeList.getAttribute("data-lt-target")].getAttribute("data-lt-id"));

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
		    	user.cart.remove(goodID);
		    	setSelect(); 
		    }

		    if (cartSelect.value > 0) user.cart.set(goodID, cartSelect.value);
		}

		/*Size select*/
		for (var i = 0; i < sizeList.children.length; i++) {
			sizeList.children[i].setAttribute("data-lt-index", i);

			//chouse size event
	        sizeList.children[i].onclick = (event) => {
	        	//hide offcanvas
	        	sizeOffcanvas.hide();

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
		    		user.cart.set(sizeList.children[sizeList.getAttribute("data-lt-target")].getAttribute("data-lt-id"), 1); 

		    		setSelect();
		    	};
		    }
	    }
	    /*cart button*/
	    
	}


	/*===========  LIKE PAGE INIT  ===============*/
	if (document.getElementById("likeCardsContainer")) {
		fetch("/like-cards", {
			    method: 'POST',
			    headers: {
			      'Content-Type': 'application/json;charset=utf-8'
			    },
			    body: user.like.str_like		
			})
	        .then(response => response.text())
	        .then(card => {
	        	document.getElementById("likeCardsContainer").innerHTML = card;
	        	likeButtonsInit();
	        });
	}

	/*===========  CART PAGE INIT  ===============*/
	if (document.getElementById("cartCardsContainer")) {

    	if (user.cart.countCart() > 0)
		fetch("/cart-cards", {
			    method: 'POST',
			    headers: {
			      'Content-Type': 'application/json;charset=utf-8'
			    },
			    body: user.cart.str_cart
			})
	        .then(response => response.text())
	        .then(card => {
	        	function countOverview(){
	        		// set overview information
		        	let overview = document.getElementById("cartOverview");
		        	overview.innerHTML = "";
		        	if (user.cart.countCart() > 0) {
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
			    		document.forms.order.orderBody.value = user.cart.str_cart;
			    	}
			    	else {
			    		document.getElementById("BuyBtn").parentNode.classList.add('d-none');
			    		document.getElementById("cartCardsContainer").innerHTML = "<h2>Корзина пуста</h2>";
			    		document.getElementById("cartOverview").innerHTML = "";
			    	}
	        	}

	        	// set card
	        	document.getElementById("cartCardsContainer").innerHTML = card;

	        	// remove from cart
	        	document.querySelectorAll('[data-delete-id]').forEach((obj) => {
	        		user.cart.remove(obj.getAttribute('data-delete-id'));
	        		obj.remove();
	        	});

	        	// set close btn onclick
	        	for (let btn of document.querySelectorAll("[data-closeid]")) {
	        		btn.onclick = () => {
	        			user.cart.remove(btn.getAttribute('data-closeid'));
	        			btn.parentNode.parentNode.parentNode.remove();
	        			countOverview();
	        		};
	        	}
	        	// set select options
	        	document.querySelectorAll('select').forEach((obj) => {
					obj.value = user.cart.get(obj.parentNode.parentNode.querySelector('[data-closeid]').getAttribute('data-closeid'));
					obj.onchange = (e) => {
					    let goodID = e.currentTarget.parentNode.parentNode.querySelector('[data-closeid]').getAttribute('data-closeid');
					    user.cart.set(goodID, e.currentTarget.value);
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

		order.name.oninput = () => {
			let input = order.name;
			input.parentNode.classList.add('was-validated');
			if(/[^a-zA-Zа-яА-Я ]/.test(input.value)) {
				let Selection = input.selectionStart-1;
				input.value = input.value.replace(/[^a-zA-Zа-яА-Я ]/g,'');
				input.setSelectionRange(Selection, Selection);
			}
		}

		let NumberSave = order.phone.value;
		order.phone.oninput = () => {
			let input = order.phone;

			if(/[^0-9+]/.test(input.value)) {
				let Selection = input.selectionStart-1;
				input.value = input.value.replace(/[^0-9+]/g,'');
				input.setSelectionRange(Selection, Selection);
			}

			if (input.value[0] == '+') {
				if (input.value.length <= 12) NumberSave = input.value;
			}
			else {
				if (input.value.length <= 11) NumberSave = input.value;
			}


			input.value = NumberSave;


			let re = /\+7\d{10}|8\d{10}/;
			
			if (re.test(input.value) & ((input.value[0] == '8' & input.value.length == 11) | (input.value[0] == '+' & input.value.length == 12))) {
				input.classList.add('is-valid');
				input.classList.remove('is-invalid');
			}
			else {
				input.classList.add('is-invalid');
				input.classList.remove('is-valid');
			}
		}



        order.addEventListener('submit', function (event) {
        	event.preventDefault();
			event.stopPropagation();

			if (/[a-zA-Zа-яА-Я ]/.test(order.name.value)) {
				let re = /\+7\d{10}|8\d{10}/;
				let input = order.phone;
				if (re.test(input.value) & ((input.value[0] == '8' & input.value.length == 11) | (input.value[0] == '+' & input.value.length == 12))) {
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


					let passcode = new Uint16Array(1);
					while (passcode[0] < 1000) window.crypto.getRandomValues(passcode);


					order.ordertime.value = GetFormattedDate();
					order.passcode.value = passcode[0];

					order.submit();
				}
			}
		});
	}


	likeButtonsInit();
});