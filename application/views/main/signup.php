<div class="signup-container">
	<form name="signup" method="post" action="" accept-charset="utf-8" novalidate>
		<div class="row g-3 mb-3">
			<div class="col-12 col-sm-4">
		    	<div class="form-floating">
			      <input type="text" name="firstname" class="form-control" id="floatingFN" placeholder="Имя" required>
			      <label for="floatingFN">Имя</label>
			      <div class="invalid-feedback">Введите имя</div>
			    </div>
			</div>
			<div class="col-12 col-sm-4">
			    <div class="form-floating">
			      <input type="text" name="secondname" class="form-control" id="floatingSN" placeholder="Фамилия" required>
			      <label for="floatingSN">Фамилия</label>
			      <div class="invalid-feedback">Введите фамилию</div>
			    </div>
		    </div>
		    <div class="col-12 col-sm-4">
			    <div class="form-floating">
			      <input type="text" name="patronymic" class="form-control" id="floatingTN" placeholder="Отчество">
			      <label for="floatingTN">Отчество</label>
			    </div>
		    </div>
		</div>
		<div class="mb-3">
			<div class="row g-2 mb-3">
				<div class="col-12 col-sm-9">
				    <div class="form-floating">
				        <input type="text" name="phone1" class="form-control" id="floatingPhone1" placeholder="Номер телефона" data-bs-toggle="tooltip" data-bs-placement="top" title="8xxxxxxxxxx или +7xxxxxxxxxx" required>
				        <label for="floatingPhone1">Номер телефона</label>
				        <div class="invalid-feedback">Введите верный номер телефона</div>
				    </div>
			    </div>
			    <div class="col-12 col-sm-3">
			    	<button class="btn btn-outline-dark w-100 text-centered" style="height: calc(3.5rem + 2px); align-items: center; " id="vercodeBtn">Подтвердить</button>
			    </div>
			</div>
		    <div class="form-floating">
		        <input type="password" name="password1" class="form-control" id="floatingPassword1" placeholder="Пароль" data-bs-toggle="tooltip" data-bs-placement="top" title="6-16 символов, кирилица и латиница, строчные и пропесные буквы, цифры и нижнее подчёркивание" required>
		        <label for="floatingPassword1">Пароль</label>
		        <div class="invalid-feedback">Введите правильный пароль</div>
		    </div>
		</div>
		<div class="mb-3 form-check">
		    <input type="checkbox" name="accept" class="form-check-input" id="acceptCheck">
		    <label class="form-check-label" for="acceptCheck">Я подтверждаю, что прочитал и принял <a href="/terms" style="text-decoration: underline;">пользовательское соглашение</a> и <a href="/privacy-policy" style="text-decoration: underline;">политику конфиденциальности</a>.</label>
		</div>
		<div class="mb-5 form-check">
		    <input type="checkbox" name="rememberme1" class="form-check-input" id="remembermeCheck1">
		    <label class="form-check-label" for="remembermeCheck1">Запомнить</label>
		</div>
		<div class="row mb-3" id="vercodeInput" style="display: none;">
			<div class="col col-8">
				<div class="form-floating">
			        <input type="text" name="passcode" class="form-control" id="floatingPasscode" placeholder="Код подтверждения" required>
			        <label for="floatingPasscode">Код подтверждения</label>
			        <div class="invalid-feedback">Введите код</div>
			    </div>
			</div>
			<div class="col col-4">
				Rjlb hkgfbjkbfg jknbn
			</div>
		</div>
		<button type="submit" class="btn btn-outline-dark" disabled id="submitBtn">Зарегестрироваться</button>
	</form>
	<script src="https://cdn.jsdelivr.net/npm/uuid@latest/dist/umd/uuidv4.min.js"></script>
	<script src="/assets/js/signup.js"></script>
</div>