<?php
// проверяем легальность загрузки файла
if(!defined('CONTROL_INC')) {
	$protocol = stripos($_SERVER['SERVER_PROTOCOL'],'https') === true ? 'https://' : 'http://';
	header ("Location: $protocol$_SERVER[SERVER_NAME]");
	exit;
}


if (!isset($_POST['dob_adm'])) {
?>

<h2>Добавьте нового администратора:</h2>
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

<form method='post' name='custinfo_form' onSubmit='return validate_custinfo(this);' onkeypress='if(event.keyCode == 13) return false;'>

	<p>Имя (до 30 символов): <span class='zvezd'>*</span><br>
		<input type='text' name='nm_adm' maxlength='30' size='30'>
	</p>

	<br>

	<p>Логин (до 10 символов): <span class='zvezd'>*</span><br>
		<input type='text' name='log_adm' maxlength='10' size='10'>
	</p>

	<br>

	<p>Пароль (до 10 символов): <span class='zvezd'>*</span><br>
		<input type='text' name='pas_adm' maxlength='10' size='10'>
	</p>

	<br>

	<p>
		<input type='submit' name='dob_adm' value='Подтвердить'>
	</p>

</form>

<?php
}
else {
	if (isset($_POST['nm_adm'])) {$nm_adm = substr(htmlspecialchars(trim($_POST['nm_adm']), ENT_QUOTES, 'utf-8'), 0, 60); unset($_POST['nm_adm']);}
	if (isset($_POST['log_adm'])) {$log_adm = substr(htmlspecialchars(trim($_POST['log_adm']), ENT_QUOTES, 'utf-8'), 0, 20);	unset($_POST['log_adm']);}
	if (isset($_POST['pas_adm'])) {$pas_adm = substr(htmlspecialchars(trim($_POST['pas_adm']), ENT_QUOTES, 'utf-8'), 0, 20);	unset($_POST['pas_adm']);}

	$result = mysqli_query ($db, "INSERT INTO adm (nm_adm, log_adm, pas_adm) VALUES ('$nm_adm', '$log_adm', '$pas_adm')");
	if ($result) {echo "<p>Новый администратор - <strong>&laquo;$nm_adm&raquo;</strong> - добавлен!</p>";} 
}
?>