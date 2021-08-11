<!-- Тип кодирования данных, enctype, ДОЛЖЕН БЫТЬ указан ИМЕННО так -->
<form enctype="multipart/form-data" action="http://trendyhall.ru/admin/database-upload1" method="POST">
    <!-- Поле MAX_FILE_SIZE должно быть указано до поля загрузки файла -->
    <input type="hidden" name="MAX_FILE_SIZE" value="105000000" />
    <!-- Название элемента input определяет имя в массиве $_FILES 
    Отправить этот файл: -->
    <div class="row mb-3">
	    <div class="mb-3">
		  <label for="formFile" class="form-label">Database file input:</label>
		  <input name="userfile" class="form-control" type="file" id="formFile">
		</div>
	</div>
	<input type="submit" class="btn btn-primary" value="Отправить файл">
</form>