/* general logic such as login, database init and cookie func*/
document.addEventListener("DOMContentLoaded", () => {
	class Database {
		constructor(){}

	  UserLogin (phone, password, callback, error_callback) {
			fetch("/user/login", {
				    method: 'POST',
				    headers: {
				      'Content-Type': 'application/json;charset=utf-8'
				    },
				    body: JSON.stringify({phone: phone, password: password})
				})
		    .then(response => {
		    	if (response.ok) return response.text();
		    	else error_callback(response.text());
		    })
	      .then(result => {
	      	if (result != false) callback(result);
	      });
		}

		GetUserFirstLetter (uuid, callback, error_callback) {
			fetch("/user/get-user-name", {
				    method: 'POST',
				    headers: {
				      'Content-Type': 'application/json;charset=utf-8'
				    },
				    body: JSON.stringify({uuid: uuid})
				})
		    .then(response => {
		    	if (response.ok) return response.text();
		    	else error_callback(response.text());
		    })
	      .then(result => {
	      	if (result != false) callback(result[0]);
	      });
		}
	};

	let database = new Database();

	DtabseInit();

	IfUser();



	function UserLogin(phone, password) {
		let form = document.forms['login'];
		database.UserLogin(phone, password, (snapshot) => {
			if (form['rememberme'].checked)
				setCookie('user-id', snapshot, {'max-age': 864000});
			else
				setCookie('user-id', snapshot);

			form.submit();
		}, (error) => {
			console.error(error);
		});
	}

	function UserData(userid){
		database.GetUserFirstLetter(userid, (snapshot) => {
		  	console.log(snapshot.val());
		}, (error) => {
		  console.error(error);
		});
	}

	function SetUserTemplateData(userid){
		let ufl = localStorage.getItem('user-first-leter');
		if (ufl != null) {
			document.querySelector('.icon-profile').setAttribute('data-qty', ufl);
		} else {
			database.GetUserFirstLetter(userid, (snapshot) => {
			  	document.querySelector('.icon-profile').setAttribute('data-qty', snapshot);
			  	localStorage.setItem('user-first-leter', snapshot);
			}, (error) => {
			  console.error(error);
			});
		}

		ufl = localStorage.getItem('user-cart-count');
		if (ufl != null) {
			document.querySelector('.icon-cart').setAttribute('data-qty', ufl);
		} else {
			/*dbRef.child("Users").child(userid).child("CartCount").get().then((snapshot) => {
			  if (snapshot.exists()) {
			  	document.querySelector('.icon-cart').setAttribute('data-qty', snapshot.val());
			  	localStorage.setItem('user-cart-count', snapshot.val());
			  } else {
			  	localStorage.setItem('user-cart-count', '');
			  }
			}).catch((error) => {
			  console.error(error);
			});*/
		}
	}

	function LoginInit(){
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
						UserLogin(form['phone'].value, form['password'].value);
					}
		}, false);
	}

	function DtabseInit(){
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
	}

	function IfUser(){
		document.querySelector('.icon-cart').setAttribute('data-qty', localStorage.getItem('user-cart-count'));
		let userid = getCookie('user-id');
		if (userid) {
			let iconProfile = document.querySelector('.icon-profile');
			iconProfile.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-circle" viewBox="0 0 16 16"><path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/></svg>';
			iconProfile.removeAttribute('data-bs-toggle');
			iconProfile.removeAttribute('data-bs-target');
			iconProfile.setAttribute('onclick', 'location.href="/profile"');

			SetUserTemplateData(userid);
		}
		else LoginInit();
	}

});


function UserLogout() {
		setCookie('user-id', 1, {'max-age': 0});
		localStorage.removeItem('user-first-leter');

		window.location.replace('/');

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