

/* all logi response for manipulation with cart and like */
document.addEventListener("DOMContentLoaded", () => {


	// ============ DATABASE FUNCTIONS DEFINE ===================
  	function newOrder(event) {
  		event.preventDefault();
		event.stopPropagation();
		let order = document.forms.order;

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

				order.passcode.value = passcode[0];

				let data = {
					passcode: passcode[0], 
					name: order.name.value, 
					phone: order.phone.value, 
					address: order.address.value,
					deliverytype: order.DeliveryType.value,
					orderbody: user.cart.str_cart, 
					comment: order.comment.value,
					ordertime: GetFormattedDate()
				};

				document.getElementById("modalBody").classList.toggle('d-none');
				document.getElementById("modalBodySpinner").classList.toggle('d-none');

				post("/orders/new-order", 
					JSON.stringify(data),
					(result) => {
						user.cart.delete();
						let randomV = new Uint16Array(1);
						window.crypto.getRandomValues(randomV);
						firebase.database().ref('NewOrders').set(randomV[0])
						.then((v) => {
							document.location = "/buy?id="+result+"&passcode="+passcode[0];
						})
						.catch((error) => {
							document.location = "/buy?id="+result+"&passcode="+passcode[0];
						});
						
				    },
		        	(err) => {
		        		document.getElementById("modalBody").classList.toggle('d-none');
						document.getElementById("modalBodySpinner").classList.toggle('d-none');
		        		err_log(err);
		        	});
			}
		}
	}
	

	/*======== ORDER INPUT RULES INIT ============*/
	function orderInputRulesInit() {
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
	}

	/*============ COUNT OVERVIEW ================*/
	function countOverview(){
		// set overview information
    	let overview = document.getElementById("cartOverview");
    	overview.innerHTML = "";
    	if (user.cart.countCart() > 0) {
    		document.getElementById("BuyBtn").parentNode.classList.remove('d-none');

    		let sale = user.cart.countCart();
    		if (sale > 3) sale = 3;

    		sale = sale * 10;

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

	function cardsInit() {
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

    	countOverview();
	}



//========================================================================
//|||||||||||||||||||||||||||||||  MAIN ||||||||||||||||||||||||||||||||||
//========================================================================
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
	        	document.getElementById("cartCardsContainer").innerHTML = card;
	        	cardsInit();
	        });
    else{
    	document.getElementById("BuyBtn").parentNode.classList.add('d-none');
    	document.getElementById("cartCardsContainer").innerHTML = "<h2>Корзина пуста</h2>";
	    document.getElementById("cartOverview").innerHTML = "";
    }

    orderInputRulesInit();

    document.forms.order.addEventListener('submit', newOrder);
});