<h4>Имя: <?php echo $user['name']; ?></h4>
<h4>Фамилия: <?php echo $user['secondname']; ?></h4>
<h4>Отчество: <?php echo $user['patronymic']; ?></h4>
<h4>Телефон: <?php echo $user['phone']; ?></h4>

<button type="button" class="btn btn-outline-dark w-100" onclick="user.Logout()">Выйти</button>