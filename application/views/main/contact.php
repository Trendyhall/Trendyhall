<h6>Наш телефон: +7(499)638-74-44</h6>
<h6>Наш e-mail: ............@gmail.com</h6>
<!--<h6>Наш WhatsApp: +7(499)638-74-44</h6>-->


<form name="Message" method="post" action="" accept-charset="utf-8" class="signup-container" novalidate>
	<!-- <div class="form-floating mb-2">
    <input type="text" name="name" class="form-control" id="floatingN" placeholder="Имя Фамилия Отчество" required>
    <label for="floatingN">Имя Фамилия Отчество</label>
    <div class="invalid-feedback">Введите Имя Фамилия Отчество</div>
  </div> -->
  <div class="form-floating mb-2">
    <input type="text" name="emailphone" class="form-control" id="floatingEP" placeholder="Почта или Номер телефона" required>
    <label for="floatingEP">Почта или Номер телефона</label>
    <div class="invalid-feedback">Введите Почту или Номер телефона</div>
  </div>
  <div class="form-floating mb-2">
    <textarea name="patronymic" class="form-control" id="floatingM" placeholder="Сообщение" style="height: 35vh;" required></textarea>
    <label for="floatingM">Сообщение</label>
  </div>
	<button type="submit" class="btn btn-outline-dark" disabled id="SendBTN">Отправить</button>
</form>

<h4>Отзывы:</h4>
<ul>
<?php
foreach ($feedbacks as $feedback) {
    echo '<li>'.$feedback['name'].' ('.$feedback['email'].') - "'.$feedback['text'].'"</li>';
}
?>
</ul>
