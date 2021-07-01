DtabseInit();

IfUser();





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
	dbRef.child("Users").child(userid).child("Data").child("Name").get().then((snapshot) => {
	  if (snapshot.exists()) {
	  	document.querySelector('.icon-profile').setAttribute('data-qty', snapshot.val()[0]);
	  } else {
	    console.log("No data");
	  }
	}).catch((error) => {
	  console.error(error);
	});

	dbRef.child("Carts").child(userid).child("Count").get().then((snapshot) => {
	  if (snapshot.exists()) {
	  	document.querySelector('.icon-cart').setAttribute('data-qty', snapshot.val());
	  } else {
	    console.log("No data");
	  }
	}).catch((error) => {
	  console.error(error);
	});
}

function LoginInit(){
	let form = document.forms['login'];
	form.addEventListener('submit', function (event) {
		event.preventDefault();
		event.stopPropagation();

		if (form.checkValidity()) {
			UserLogin(form['phone'].value, form['password'].value);
		}
		else {
			/*event.preventDefault();
			event.stopPropagation();*/
		}

	form.classList.add('was-validated');
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
		iconProfile = document.querySelector('.icon-cart');
		iconProfile.removeAttribute('data-bs-toggle');
		iconProfile.removeAttribute('data-bs-target');
		iconProfile.setAttribute('onclick', 'location.href="/cart"');

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