DtabseInit();

IfUser();


function UserLogout() {
	setCookie('user-id', 1, {'max-age': 0});
	setCookie('user-first-leter', 1, {'max-age': 0});
	setCookie('user-cart-count', 1, {'max-age': 0});

	window.location.replace('/');

}


function UserLogin(phone, password) {
	let form = document.forms['login'];
	const dbRef = firebase.database().ref();
	dbRef.child("Phones").child(phone).child(password).get().then((snapshot) => {
	  if (snapshot.exists()) {
			if (form['rememberme'].checked)
				setCookie('user-id', snapshot.val(), {'max-age': 864000});
			else
				setCookie('user-id', snapshot.val());

			form.submit();
	  	
	  } else {
	    console.log("No data");
	    
	  }
	}).catch((error) => {
	    console.error(error);
	    
	});
}

function UserData(userid){
	const dbRef = firebase.database().ref();
	dbRef.child("Users").child(userid).get().then((snapshot) => {
	  if (snapshot.exists()) {
	  	console.log(snapshot.val());
	  } else {
	    console.log("No data");
	  }
	}).catch((error) => {
	  console.error(error);
	});
}

function SetUserTemplateData(userid){
	const dbRef = firebase.database().ref();
	let ufl = getCookie('user-first-leter');
	if (ufl) {
		document.querySelector('.icon-profile').setAttribute('data-qty', ufl);
	} else {
		dbRef.child("Users").child(userid).child("Data").child("Name").get().then((snapshot) => {
		  if (snapshot.exists()) {
		  	document.querySelector('.icon-profile').setAttribute('data-qty', snapshot.val()[0]);
		  	setCookie('user-first-leter', snapshot.val()[0], {'max-age': 864000});
		  } else {
		    console.log("No data");
		  }
		}).catch((error) => {
		  console.error(error);
		});
	}

	ufl = getCookie('user-cart-count');
	if (ufl) {
		document.querySelector('.icon-cart').setAttribute('data-qty', ufl);
	} else {
		dbRef.child("Carts").child(userid).child("Count").get().then((snapshot) => {
		  if (snapshot.exists()) {
		  	document.querySelector('.icon-cart').setAttribute('data-qty', snapshot.val());
		  	setCookie('user-cart-count', snapshot.val(), {'max-age': 864000});
		  } else {
		  	setCookie('user-cart-count', '', {'max-age': 864000});
		  }
		}).catch((error) => {
		  console.error(error);
		});
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