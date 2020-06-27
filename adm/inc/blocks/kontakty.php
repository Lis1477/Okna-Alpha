<?php
// проверяем легальность загрузки файла
if(!defined('CONTROL_INC')) {
	$protocol = stripos($_SERVER['SERVER_PROTOCOL'],'https') === true ? 'https://' : 'http://';
	header ("Location: $protocol$_SERVER[SERVER_NAME]");
	exit;
}

	if (!isset($_POST['red_txt']))
	{
		$result = mysql_query ("SELECT * FROM kontakty",$db);
		$myrow = mysql_fetch_array ($result);

		echo "
<h2>Отредактируйте контакты:</h2>
<hr>
<form method='post' onkeypress='if(event.keyCode == 13) return false;'>

	<p>Адрес:<br>
		<input type='text' name='adr' value='".$myrow['adr']."' size='60'>
	</p>

	<br>

	<p>Дни работы:<br>
		<input type='text' name='dny' value='".$myrow['dny']."' size='60'>
	</p>

	<br>

	<p>Время работы:<br>
		<input type='text' name='vrem' value='".$myrow['vrem']."' size='60'>
	</p>

	<br>

	<p>Выходные:<br>
		<input type='text' name='vyh' value='".$myrow['vyh']."' size='60'>
	</p>

	<br>

	<p>Телефон 1:<br>
		<input type='text' name='tel1' value='".$myrow['tel1']."' size='60'>
	</p>

	<br>

	<p>Телефон 2:<br>
		<input type='text' name='tel2' value='".$myrow['tel2']."' size='60'>
	</p>

	<br>

	<p>Телефон 3:<br>
		<input type='text' name='tel3' value='".$myrow['tel3']."' size='60'>
	</p>

	<br>

	<p>E-mail:<br>
		<input type='text' name='mail' value='".$myrow['mail']."' size='60'>
	</p>

	<br>

	<p>
		<input type='submit' name='red_txt' value='Подтвердить'>
	</p>

</form>
		";
	}
	else
	{
		if (isset($_POST['adr']))		{$adr = substr(htmlspecialchars(trim($_POST['adr']), ENT_QUOTES, 'cp1251'), 0, 300);	unset($_POST['adr']);}
		if (isset($_POST['dny']))		{$dny = substr(htmlspecialchars(trim($_POST['dny']), ENT_QUOTES, 'cp1251'), 0, 200);	unset($_POST['dny']);}
		if (isset($_POST['vrem']))	{$vrem = substr(htmlspecialchars(trim($_POST['vrem']), ENT_QUOTES, 'cp1251'), 0, 100);	unset($_POST['vrem']);}
		if (isset($_POST['vyh']))		{$vyh = substr(htmlspecialchars(trim($_POST['vyh']), ENT_QUOTES, 'cp1251'), 0, 200);	unset($_POST['vyh']);}
		if (isset($_POST['tel1']))	{$tel1 = substr(htmlspecialchars(trim($_POST['tel1']), ENT_QUOTES, 'cp1251'), 0, 100);	unset($_POST['tel1']);}
		if (isset($_POST['tel2']))	{$tel2 = substr(htmlspecialchars(trim($_POST['tel2']), ENT_QUOTES, 'cp1251'), 0, 100);	unset($_POST['tel2']);}
		if (isset($_POST['tel3']))	{$tel3 = substr(htmlspecialchars(trim($_POST['tel3']), ENT_QUOTES, 'cp1251'), 0, 100);	unset($_POST['tel3']);}
		if (isset($_POST['mail']))	{$mail = substr(htmlspecialchars(trim($_POST['mail']), ENT_QUOTES, 'cp1251'), 0, 100);	unset($_POST['mail']);}

		// записываем данные из формы в базу данных
		$result = mysql_query ("UPDATE kontakty SET adr='$adr', dny='$dny', vrem='$vrem', vyh='$vyh', tel1='$tel1', tel2='$tel2', tel3='$tel3', mail='$mail' WHERE id = 1",$db);
		if ($result) {echo "<p>Контакты обновлены!</p>";} 
	}





	


?>
