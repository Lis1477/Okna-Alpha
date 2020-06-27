<?php
// проверяем легальность загрузки файла
if(!defined('CONTROL_INC')) {
	$protocol = stripos($_SERVER['SERVER_PROTOCOL'],'https') === true ? 'https://' : 'http://';
	header ("Location: $protocol$_SERVER[SERVER_NAME]");
	exit;
}

// если есть запрос на обновление телефонов, обновляем
if(isset($_POST['red_tel'])) {
	foreach($_POST['id_tel'] as $id_tel) {
		// проверяем переменную
		$prefix_tel = substr(htmlspecialchars(trim($_POST['prefix_tel'][$id_tel]), ENT_QUOTES, 'utf-8'), 0, 16);
		$number_tel = substr(htmlspecialchars(trim($_POST['number_tel'][$id_tel]), ENT_QUOTES, 'utf-8'), 0, 18);
		$provider_tel = substr(htmlspecialchars(trim($_POST['provider_tel'][$id_tel]), ENT_QUOTES, 'utf-8'), 0, 20);
		// обновляем в базе
		$res = mysqli_query ($db, "UPDATE phones SET prefix_tel='$prefix_tel', number_tel='$number_tel', provider_tel='$provider_tel' WHERE id_tel=$id_tel");
	}
	$mess1 = "<p style='color:red; font-size:0.9em; font-weight:bold;'>Телефоны обновлены.</p>";
}

// если есть запрос на обновление email, обновляем
if(isset($_POST['red_ml'])) {
	// проверяем переменную
	$value_ml = substr(htmlspecialchars(trim($_POST['value_ml']), ENT_QUOTES, 'utf-8'), 0, 400);
	// обновляем в базе
	$res = mysqli_query ($db, "UPDATE mail SET value_ml='$value_ml'");
	$mess2 = "<p style='color:red; font-size:0.9em; font-weight:bold;'>E-mail обновлен.</p>";
}

// если есть запрос на обновление адреса, обновляем
if(isset($_POST['red_adr'])) {
	// проверяем переменную
	$value_adr = substr(mysqli_real_escape_string($db, trim($_POST['value_adr'])), 0, 1000);
	// обновляем в базе
	$res = mysqli_query ($db, "UPDATE adress SET value_adr='$value_adr'");
	$mess3 = "<p style='color:red; font-size:0.9em; font-weight:bold;'>Адрес обновлен.</p>";
}

// если есть запрос на обновление режима работы, обновляем
if(isset($_POST['red_wrk'])) {
	// проверяем переменную
	$value_wrk = substr(mysqli_real_escape_string($db, trim($_POST['value_wrk'])), 0, 1000);
	// обновляем в базе
	$res = mysqli_query ($db, "UPDATE regime SET value_wrk='$value_wrk'");
	$mess4 = "<p style='color:red; font-size:0.9em; font-weight:bold;'>Режим работы обновлен.</p>";
}
?>

<h2>Редактирование контактов</h2>
<hr>

<h3>Телефоны:</h3>
<?php 
// выводим сообщение об обновлении
if(isset($mess1)) echo $mess1;
// выбираем из базы данных телефоны
$res_tel = mysqli_query ($db, "SELECT * FROM phones");
$row_tel = mysqli_fetch_array ($res_tel);
?>
<form method="post">
<table class="phones-table">
	<tr>
		<th>Префикс<br>(8 знаков)</th>
		<th>Номер<br>(9 знаков)</th>
		<th>Доп.инфа<br>(10 знаков)</th>
	</tr>

<?php 
do {
?>
		<tr>
			<td><input type="text" name="prefix_tel[<?=$row_tel['id_tel']?>]" value="<?=$row_tel['prefix_tel']?>" maxlength="8" onkeypress="if(event.keyCode == 13) return false;"></td>
			<td><input type="text" name="number_tel[<?=$row_tel['id_tel']?>]" value="<?=$row_tel['number_tel']?>" maxlength="9" onkeypress="if(event.keyCode == 13) return false;"></td>
			<td><input type="text" name="provider_tel[<?=$row_tel['id_tel']?>]" value="<?=$row_tel['provider_tel']?>" maxlength="10" onkeypress="if(event.keyCode == 13) return false;"></td>
		</tr>
	<input type="hidden" name="id_tel[]" value="<?=$row_tel['id_tel']?>">
<?php
}
while($row_tel = mysqli_fetch_array ($res_tel));
?>
</table>
	<input type="submit" name="red_tel" value="Изменить">
</form>
<hr>

<h3>E-mail:</h3>
<?php 
// выводим сообщение об обновлении
if(isset($mess2)) echo $mess2;
// выбираем из базы данных телефоны
$res_ml = mysqli_query ($db, "SELECT value_ml FROM mail");
$row_ml = mysqli_fetch_array ($res_ml);
?>
<form method="post">
	<input type="email" name="value_ml" value="<?=$row_ml['value_ml']?>" onkeypress="if(event.keyCode == 13) return false;">
	<input type="submit" name="red_ml" value="Изменить">
</form>
<hr>

<h3>Адрес (до 1000 знаков):</h3>
<?php 
// выводим сообщение об обновлении
if(isset($mess3)) echo $mess3;
// выбираем из базы данных телефоны
$res_adr = mysqli_query ($db, "SELECT value_adr FROM adress");
$row_adr = mysqli_fetch_array ($res_adr);
?>
<form method="post">
	<textarea name="value_adr" cols="70" rows="2" maxlength="1000"><?=$row_adr['value_adr']?></textarea>
	<p><input type="submit" name="red_adr" value="Изменить"></p>
</form>
<hr>
<h3>Режим работы (до 1000 знаков):</h3>
<p class="form_rem">* - Для установки переноса на новую строку, поставьте в конце строки тег - &lt;br&gt;.</p>
<?php 
// выводим сообщение об обновлении
if(isset($mess4)) echo $mess4;
// выбираем из базы данных телефоны
$res_wrk = mysqli_query ($db, "SELECT value_wrk FROM regime");
$row_wrk = mysqli_fetch_array ($res_wrk);
?>
<form method="post">
	<textarea name="value_wrk" cols="70" rows="2"><?=$row_wrk['value_wrk']?></textarea>
	<p><input type="submit" name="red_wrk" value="Изменить"></p>
</form>
