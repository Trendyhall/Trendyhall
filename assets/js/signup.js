/* logic response for signup*/

function SignupInit(){
	let btn = document.getElementById('vercodeBtn');
	btn.onclick = SendVercode;

	var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
	var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
  		return new bootstrap.Tooltip(tooltipTriggerEl)
	})

	InitInputRules();

	document.signup.accept.onclick = () => {
		if (document.signup.accept.checked) document.getElementById('submitBtn').removeAttribute("disabled");
		else document.getElementById('submitBtn').setAttribute("disabled", '');
	}

	document.signup.addEventListener("submit", (event) => {
		let form = document.signup;
		event.preventDefault();
		event.stopPropagation();

		if (/[a-zA-Zа-яА-Я]/.test(form.firstname.value) & /[a-zA-Zа-яА-Я]/.test(form.secondname.value))
			if (/\+7\d{10}|8\d{10}/.test(form.phone1.value) & ((form.phone1.value[0] == '8' & form.phone1.value.length == 11) | (form.phone1.value[0] == '+' & form.phone1.value.length == 12)))
				if (/[0-9a-zA-Zа-яА-Я_]/.test(form.password1.value) & form.password1.value.length >= 6 & form.password1.value.length <= 16)
					if (form.passcode.value.length == 6) {
						Signup();
					}
	});
}

function InitInputRules() {
	let form = document.signup;
	form.firstname.oninput = () => {
		let input = form.firstname;
		input.parentNode.classList.add('was-validated');
		if(/[^a-zA-Zа-яА-Я]/.test(input.value)) {
			let Selection = input.selectionStart-1;
			input.value = input.value.replace(/[^a-zA-Zа-яА-Я]/g,'');
			input.setSelectionRange(Selection, Selection);
		}
	}

	form.secondname.oninput = () => {
		let input = form.secondname;
		input.parentNode.classList.add('was-validated');
		if(/[^a-zA-Zа-яА-Я]/.test(input.value)) {
			let Selection = input.selectionStart-1;
			input.value = input.value.replace(/[^a-zA-Zа-яА-Я]/g,'');
			input.setSelectionRange(Selection, Selection);
		}
	}

	form.patronymic.oninput = () => {
		let input = form.patronymic;
		if(/[^a-zA-Zа-яА-Я]/.test(input.value)) {
			let Selection = input.selectionStart-1;
			input.value = input.value.replace(/[^a-zA-Zа-яА-Я]/g,'');
			input.setSelectionRange(Selection, Selection);
		}
	}


	form.passcode.oninput = () => {
		let input = form.passcode;
		
		input.value = input.value.replace(/[^0-9]/g,'');
		if (input.value.length > 6) input.value = input.value.substring(0,6);
		if (input.value.length == 6) {
			input.classList.add('is-valid');
			input.classList.remove('is-invalid');
		}
		else {
			input.classList.add('is-invalid');
			input.classList.remove('is-valid');
		}
	}


	let NumberSave = form.phone1.value;
	form.phone1.oninput = () => {
		let input = form.phone1;

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

	let PasswordSave = form.password1.value;
	form.password1.oninput = () => {
		let input = form.password1;

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
}



function SendVercode(event) {
	event.preventDefault();
	event.stopPropagation();

	let form = document.signup;
    let	input = form.phone1;
	let re = /\+7\d{10}|8\d{10}/;
	if (re.test(input.value) & ((input.value[0] == '8' & input.value.length == 11) | (input.value[0] == '+' & input.value.length == 12))) {
		console.log('Succes');
		document.getElementById('vercodeInput').removeAttribute("style");
		input.classList.add('is-valid');
		input.classList.remove('is-invalid');
	}
	else {
		input.classList.add('is-invalid');
		input.classList.remove('is-valid');
	}
}

function Signup() {
	let uuid = uuidv4();
	let form = document.signup;
	const dbRef = firebase.database().ref();
	dbRef.child("Users").child(uuid).get().then((snapshot) => {
	    if (snapshot.exists()) {
	  		Signup();
	    } else {
			if (form.rememberme1.checked)
				setCookie('user-id', uuid, {'max-age': 864000});
			else
				setCookie('user-id', uuid);

			writeUserData(uuid, form.firstname.value, form.secondname.value, form.patronymic.value, form.phone1.value, form.password1.value);
	  	
	  		window.location.replace('/');
	    }
	}).catch((error) => {
	    console.error(error);
	    
	});	
}

function writeUserData(userId, name, secondname, patronymic, phone, password) {

	firebase.database().ref('Phones/').child(phone).child(password).set(userId);

	firebase.database().ref('Users/' + userId + '/Data').set({
		Name: name,
		Password: password,
		Patronymic: patronymic,
		Phone: phone,
		Secondname: secondname
	});
}


document.addEventListener("DOMContentLoaded", SignupInit);