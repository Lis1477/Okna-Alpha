<?php
// проверяем легальность загрузки файла
if(!defined('CONTROL_INC')) {
	$protocol = stripos($_SERVER['SERVER_PROTOCOL'],'https') === true ? 'https://' : 'http://';
	header ("Location: $protocol$_SERVER[SERVER_NAME]");
	exit;
}

// выводим админов
if (!isset($adm)) {
	$res_adm = mysqli_query ($db, "SELECT * FROM adm WHERE id_adm != 1");
	$row_adm = mysqli_fetch_array ($res_adm);
	do {
		echo "
	<div>
		<h3>".$row_adm['nm_adm']."</h3>
		<p>Логин: <strong>".$row_adm['log_adm']."</strong></p>
		<p>Пароль: <strong>".$row_adm['pas_adm']."</strong></p>
		<p class='adkn'><a href='index.php?redadm=1&adm=".$row_adm['id_adm']."'>Изменить</a></p>
	</div>
	<br>
	<hr>
		";
	}
	while ($row_adm = mysqli_fetch_array ($res_adm));
}
else {
	// выводим форму редактирования админа
	if (!isset($_POST['red_adm'])) {
		$res_adm = mysqli_query ($db, "SELECT * FROM adm WHERE id_adm = $adm");
		$row_adm = mysqli_fetch_array ($res_adm);
?>
<h2>Отредактируйте данные администратора &laquo;<?=$row_adm['nm_adm']?>&raquo;:</h2>
<p>Для Логина и Пароля НЕ используйте кириллические символы!</p>
<p>Поля, помеченные &laquo;<span class='zvezd'>*</span>&raquo; - обязательны для заполнения.</p><hr>

<script>
	function validate_custinfo()	{ //валидация формы
		if (document.custinfo_form.nm_adm.value=="")	{
			alert("Заполните поле формы - ИМЯ");
			return false;
		}
		if (document.custinfo_form.log_adm.value=="")	{
			alert("Заполните поле формы - ЛОГИН");
			return false;
		}
		if (document.custinfo_form.pas_adm.value=="")	{
			alert("Заполните поле формы - ПАРОЛЬ");
			return false;
		}
		return true;
	}
</script>

<form method='post' name='custinfo_form' onSubmit='return validate_custinfo(this);'>
	<p>Имя (до 30 символов): <span class='zvezd'>*</span><br>
		<input type='text' name='nm_adm' value='<?=$row_adm['nm_adm']?>' maxlength='30' size='30' onkeypress='if(event.keyCode == 13) return false;'>
	</p>

	<br>

	<p>Логин (до 10 символов): <span class='zvezd'>*</span><br>
		<input type='text' name='log_adm' value='<?=$row_adm['log_adm']?>' maxlength='10' size='10' onkeypress='if(event.keyCode == 13) return false;'>
	</p>

	<br>

	<p>Пароль (до 10 символов): <span class='zvezd'>*</span><br>
		<input type='text' name='pas_adm' value='<?=$row_adm['pas_adm']?>' maxlength='10' size='10' onkeypress='if(event.keyCode == 13) return false;'>
	</p>

	<br>

	<p>
		<input type='submit' name='red_adm' value='Подтвердить'>
	</p>
</form>
<?php
	}
	else {
		// проверяем переменные
		if (isset($_POST['nm_adm'])) {$nm_adm = substr(htmlspecialchars(trim($_POST['nm_adm']), ENT_QUOTES, 'utf-8'), 0, 60); unset($_POST['nm_adm']);}
		if (isset($_POST['log_adm'])) {$log_adm = substr(htmlspecialchars(trim($_POST['log_adm']), ENT_QUOTES, 'utf-8'), 0, 20);	unset($_POST['log_adm']);}
		if (isset($_POST['pas_adm'])) {$pas_adm = substr(htmlspecialchars(trim($_POST['pas_adm']), ENT_QUOTES, 'utf-8'), 0, 20);	unset($_POST['pas_adm']);}

		$result = mysqli_query ($db, "UPDATE adm SET nm_adm='$nm_adm', log_adm='$log_adm', pas_adm='$pas_adm' WHERE id_adm=$adm");
		if ($result) {echo "<p>Данные администратора <strong>&laquo;$nm_adm&raquo;</strong> обновлены!</p>";} 
	}
}
?>
