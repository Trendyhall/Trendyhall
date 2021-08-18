//========================================================================
//||||||||||||||||||||||||||||| GLOBAL CLASSES ||||||||||||||||||||||||||||
//========================================================================

//========================================================================
//|||||||||||||||||||||||||||||||| CART CLASS ||||||||||||||||||||||||||||
//========================================================================
class Cart {
	#onChanged = [];

	constructor(){
		if (localStorage.getItem('cart') == null) {
			localStorage.setItem('cart', JSON.stringify({}));
		}
		this.addOnChangedHandler(this.showToast);
		this.addOnChangedHandler(this.animationPlay);
		this.addOnChangedHandler(this.setCartCount);
		this.setCartCount();
	}

	get cart() {
		return JSON.parse(localStorage.getItem('cart'));
	}

	get str_cart() {
		return localStorage.getItem('cart');
	}


	callOnChanged() {
		for (let k in this.#onChanged) this.#onChanged[k]();
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

	countCart() {
		let a = 0;
		let cart = JSON.parse(localStorage.getItem('cart'));
		for (let k in cart) a += Number(cart[k]);
		return a;
	}

	setCartCount() {
		let a = 0;
		let cart = JSON.parse(localStorage.getItem('cart'));
		for (let k in cart) a += Number(cart[k]);

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
		this.callOnChanged();
	}

	remove(goodID) {
		let cart = JSON.parse(localStorage.getItem('cart'));
		if (cart[goodID] != undefined) {
			delete cart[goodID];
		}
		localStorage.setItem('cart', JSON.stringify(cart));
		this.callOnChanged();
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
		this.callOnChanged();
	}


};

//========================================================================
//|||||||||||||||||||||||||||||||| LIKE CLASS ||||||||||||||||||||||||||||
//========================================================================
class Like {
	#onChanged = [];

	constructor(){
		if (localStorage.getItem('like') == null) {
			localStorage.setItem('like', JSON.stringify({}));
		}
	}

	get like() {
		return JSON.parse(localStorage.getItem('like'));
	}

	get str_like() {
		return localStorage.getItem('like');
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
		this.callOnChanged();
	}

	remove(goodID) {
		let like = JSON.parse(localStorage.getItem('like'));
		delete like[goodID];
		localStorage.setItem('like', JSON.stringify(like));
		this.callOnChanged();
	}

	check(goodID) {
		let like = JSON.parse(localStorage.getItem('like'));
		return like[goodID] != undefined;
	}

};

//========================================================================
//|||||||||||||||||||||||||||||||| USER CLASS ||||||||||||||||||||||||||||
//========================================================================

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
				  	localStorage.setItem('user-first-leter', result[0]);
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


	Login() {
		let form = document.forms['login'];
		post('/user/login', 
			JSON.stringify({phone: form['phone'].value, password: form['password'].value}), 
			(result) => {
				if (result != false) {
					if (form['rememberme'].checked)
						setCookie('uuid', result, {'max-age': 864000});
					else
						setCookie('uuid', result);

					form.submit();
				}
				else {
					alert("Неправильный телефон или пароль");
				}
			}, 
			(error) => err_log(error));
	}

	Logout() {
		setCookie('uuid', 1, {'max-age': 0});
		localStorage.removeItem('user-first-leter');

		window.location.replace('/');
	}


	Signup() {
		let uuid = uuidv4();
		let form = document.signup;
		post('/user/exsist', 
			JSON.stringify({phone: form.phone1.value}), 
			(result) => {
				if (result == false) {
					post('/user/signup', 
						JSON.stringify(
							{
								uuid: uuid, 
								name: form.firstname.value, 
								password: form.secondname.value, 
								patronymic: form.patronymic.value, 
								phone: form.phone1.value, 
								secondname: form.password1.value
							}),
						(result) => {
							if (form.rememberme1.checked)
								setCookie('uuid', uuid, {'max-age': 864000});
							else
								setCookie('uuid', uuid);
							window.location.replace('/');
						}, 
						(error) => err_log(error));
				}
				else {
					alert("Указанный номер телефона уже зарегестрирован");
				}
			}, 
			(error) => err_log(error));
	}


};

//========================================================================
//|||||||||||||||||||||||||||| GLOBAL FUNCTIONS ||||||||||||||||||||||||||
//========================================================================
function err_log(error) {
	console.error(error);
	alert("Что-то пошло не так, попробуйте повторить позже");
}

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
    	if (response.ok) response.text().then(result => success_callback(result));
    	else response.text().then(result => error_callback(result), error => error_callback(error));
    });
}

//========================================================================
//||||||||||||||||||||||||  MAIN|POIN OF ENTER  ||||||||||||||||||||||||||
//========================================================================
const user = new User();

document.addEventListener("DOMContentLoaded", () => {
//========================================================================
//||||||||||||||||||||  DEFINE INPUT RULE FUNCTIONS ||||||||||||||||||||||
//========================================================================

//============== Login Input Rules Init ==========================
	function LoginInputRulesInit(){
		let form = document.forms['login'];

		let NumberSave = form.phone.value;
		form.phone.oninput = () => {
			let input = form.phone;

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

		let PasswordSave = form.password.value;
		form.password.oninput = () => {
			let input = form.password;

			if(/[^0-9a-zA-Zа-яА-Я_]/.test(input.value)) {
				let Selection = input.selectionStart-1;
				input.value = input.value.replace(/[^0-9a-zA-Zа-яА-Я_]/g,'');
				input.setSelectionRange(Selection, Selection);
			}

			if (input.value.length <= 16) NumberSave = input.value;
			
			input.value = NumberSave;

			let re = /[0-9a-zA-Zа-яА-Я_]{6,16}/;
			if (re.test(input.value) & input.value.length >= 6 & input.value.length <= 16) {
				input.classList.add('is-valid');
				input.classList.remove('is-invalid');
			}
			else {
				input.classList.add('is-invalid');
				input.classList.remove('is-valid');
			}
		}


		form.addEventListener('submit', function (event) {
			event.preventDefault();
			event.stopPropagation();


			if (/\+7\d{10}|8\d{10}/.test(form.phone.value) & ((form.phone.value[0] == '8' & form.phone.value.length == 11) | (form.phone.value[0] == '+' & form.phone.value.length == 12)))
					if (/[0-9a-zA-Zа-яА-Я_]/.test(form.password.value) & form.password.value.length >= 6 & form.password.value.length <= 16) {
						user.Login();
					}
		}, false);
	}
	//============== Login Input Rules Init ==========================




//========================================================================
//|||||||||||||||||||||||||||||||  MAIN ||||||||||||||||||||||||||||||||||
//========================================================================

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



	if (user.hasUUID()) {
		user.init();	
	}
	else {
		LoginInputRulesInit();
	}



});