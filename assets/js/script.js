//========================================================================
//||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
//============================= GLOBAL CLASES ============================

class Cart {
	#onChanged = [];

	constructor(){
		if (localStorage.getItem('cart') == null) {
			localStorage.setItem('cart', JSON.stringify({}));
		}
		addOnChangedHandler(() =>{
			setCartCount();
			showToast();
			animationPlay();
		});
	}

	callOnChanged() {
		for (k in this.#onChanged) this.#onChanged[k]();
	}

	addOnChangedHandler(f){
		this.#onChanged.push(f);
	}

	// support f
	animationPlay()  {
		document.querySelector(".icon-cart svg").classList.add('add-to-cart-animation');	
		setTimeout(() => {
			document.querySelector(".icon-cart svg").classList.remove('add-to-cart-animation');
		}, 2100);
	}

	showToast()  {
		let a = new bootstrap.Toast(document.getElementById('cartChangeToast'));
	    a.show();
	}

	setCartCount() {
		let a = 0;
		for (let k in JSON.parse(localStorage.getItem('cart'))) a++;
		if (a > 0) localStorage.setItem('user-cart-count', a); 
		else localStorage.setItem('user-cart-count', '');
		document.querySelector('.icon-cart').setAttribute('data-qty', localStorage.getItem('user-cart-count'));
	}

	//main f
	set(goodID, count) {
		let cart = JSON.parse(localStorage.getItem('cart'));
		if (cart[goodID] == undefined) {
			cart[goodID] = count;
		}
		else {
			cart[goodID] = count;
		}
		
		localStorage.setItem('cart', JSON.stringify(cart));
		callOnChanged();
	}

	remove(goodID) {
		let cart = JSON.parse(localStorage.getItem('cart'));
		if (cart[goodID] != undefined) {
			delete cart[goodID];
		}
		localStorage.setItem('cart', JSON.stringify(cart));
		callOnChanged();
	}

	check(goodID) {
		let cart = JSON.parse(localStorage.getItem('cart'));
		return cart[goodID] != undefined;
	}

	get(goodID) {
		let cart = JSON.parse(localStorage.getItem('cart'));
		if (cart[goodID] != undefined) return cart[goodID];
		else return 0;
	}

	delete() {
		localStorage.setItem('cart', JSON.stringify({}));
		callOnChanged();
	}
};

class Like {
	#onChanged = [];

	constructor(){
		if (localStorage.getItem('cart') == null) localStorage.setItem('cart', JSON.stringify({}));
	}

	callOnChanged() {
		for (k in this.#onChanged) this.#onChanged[k]();
	}

	addOnChangedHandler(f){
		this.#onChanged.push(f);
	}

    add(goodID) {
		let like = JSON.parse(localStorage.getItem('like'));
		like[goodID] = "";
		localStorage.setItem('like', JSON.stringify(like));
	}

	remove(goodID) {
		let like = JSON.parse(localStorage.getItem('like'));
		delete like[goodID];
		localStorage.setItem('like', JSON.stringify(like));
	}

	check(goodID) {
		let like = JSON.parse(localStorage.getItem('like'));
		return like[goodID] != undefined;
	}

};

class User {
	constructor() {
		this.cart = new Cart();

		this.like = new Like();
		this.uuid = getCookie('uuid');


	}

	hasUUID() {
		return this.uuid != undefined;
	}

	init() {
		function setLeter() {
			let iconProfile = document.querySelector('.icon-profile');
			iconProfile.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16"><path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/></svg>';
			iconProfile.removeAttribute('data-bs-toggle');
			iconProfile.removeAttribute('data-bs-target');
			iconProfile.setAttribute('onclick', 'location.href="/profile"');

			document.querySelector('.icon-profile').setAttribute('data-qty', localStorage.getItem('user-first-leter'));
		};

		let ufl = localStorage.getItem('user-first-leter');
		if (ufl != null) {
			setLeter();
		} else {
			post('/user/get-user-name',
				JSON.stringify({uuid: this.uuid}), 
				(result) => {
				  	localStorage.setItem('user-first-leter', result);
				  	setLeter();
				}, 
				(error) => {
				    setLeter();
				  	console.error(error);
				});
		}
	}


	userCartSync() {

	}

	userLikeSync() {
		
	}


	Login(phone, password) {
		let form = document.forms['login'];
		post('/user/login', 
			JSON.stringify({phone: form['phone'].value, password: form['password'].value}), 
			(result) => {
				if (result) {
					if (form['rememberme'].checked)
						setCookie('uuid', snapshot, {'max-age': 864000});
					else
						setCookie('uuid', snapshot);

					form.submit();
				}
				else {
					alert("Неправильный телефон или пароль");
				}
			}, 
			(error) => {
				console.error(error);
				alert("Что-то пошло не так, попробуйте повторить позже");
			});
	}

	Logout() {
		setCookie('uuid', 1, {'max-age': 0});
		localStorage.removeItem('user-first-leter');

		window.location.replace('/');
	}

};

//========================================================================
//||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
//============================ GLOBAL FUNCTIONS ==========================
function setCookie(name, value, options = {}) {

  options = {
    path: '/',
    // при необходимости добавьте другие значения по умолчанию
    ...options
  };

  if (options.expires instanceof Date) {
    options.expires = options.expires.toUTCString();
  }

  let updatedCookie = encodeURIComponent(name) + "=" + encodeURIComponent(value);

  for (let optionKey in options) {
    updatedCookie += "; " + optionKey;
    let optionValue = options[optionKey];
    if (optionValue !== true) {
      updatedCookie += "=" + optionValue;
    }
  }

  document.cookie = updatedCookie;
}

function getCookie(name) {
  let matches = document.cookie.match(new RegExp(
    "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
  ));
  return matches ? decodeURIComponent(matches[1]) : undefined;
}

function post(URI, BODY, success_callback, error_callback) {
  	fetch(URI, {
	    method: 'POST',
	    headers: {
	      'Content-Type': 'application/json;charset=utf-8'
	    },
	    body: BODY
	})
	.then(response => {
    	if (response.ok) success_callback(response.text());
    	else error_callback(response.text());
    });
}

//========================================================================
//||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
//========================== MAIN|POIN OF ENTER ==========================
const user = new User();

document.addEventListener("DOMContentLoaded", () => {
	// Your web app's Firebase configuration
	// For Firebase JS SDK v7.20.0 and later, measurementId is optional
	const firebaseConfig = {
		apiKey: "AIzaSyBk0QIQKsrOwNwbjrClrS0kinGEY_I4YzE",
		authDomain: "trendyhall-37f5c.firebaseapp.com",
		databaseURL: "https://trendyhall-37f5c-default-rtdb.europe-west1.firebasedatabase.app",
		projectId: "trendyhall-37f5c",
		storageBucket: "trendyhall-37f5c.appspot.com",
		messagingSenderId: "1035638959257",
		appId: "1:1035638959257:web:2b871ccf8c8162750e9c08",
		measurementId: "G-9WZXTDWNGS"
	};
	// Initialize Firebase
	firebase.initializeApp(firebaseConfig);
	firebase.analytics();

	//========================================================================
	//||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
	//========================================================================

	if (user.hasUUID()) {
		user.init();	
	}
	else {
		LoginInit();
	}



});