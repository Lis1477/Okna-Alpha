<?php
// проверяем легальность загрузки файла
if(!defined('CONTROL_INC')) {
	$protocol = stripos($_SERVER['SERVER_PROTOCOL'],'https') === true ? 'https://' : 'http://';
	header ("Location: $protocol$_SERVER[SERVER_NAME]");
	exit;
}

if (!isset($del) && !isset($_POST['del_adm']))
{
	echo "
<h2>Для удаления администратора жмите на кнопку Удалить.</h2>
<hr>
	";

	$res_adm = mysqli_query ($db, "SELECT id_adm, nm_adm FROM adm WHERE (id_adm != 1 && id_adm != 2)");
	$row_adm = mysqli_fetch_array ($res_adm);
	if(!empty($row_adm)) {
		do {
			echo "
<div>
	<h3 style='display:inline-block;'>".$row_adm['nm_adm']."</h3>
	<a href='index.php?deladm=1&del=".$row_adm['id_adm']."' class='del_button'>Удалить</a>
</div>
			";
		}
		while ($row_adm = mysqli_fetch_array ($res_adm));
	}
	else echo "<p>Пока удалять некого...</p>";
}
else {
	if (isset($del)) 	{
		if (!isset($_POST['del_adm'])) {
			// берем из базы имя амина
			$res_name = mysqli_query ($db, "SELECT nm_adm FROM adm WHERE id_adm=$del");
			$row_name = mysqli_fetch_array ($res_name);
			// выводим предупреждение
			echo "
<h2><span style='color:red'>Действие не обратимо!</span><br>Вы уверены, что хотите <strong>УДАЛИТЬ</strong> администратора &laquo;".$row_name['nm_adm']."&raquo;?</h2>

<div class='da_net'>

	<form action='index.php?deladm=1' method='post'>
		<input type='submit' value='НЕТ'>
	</form>

	<form method='post'>
		<input type='submit' name='del_adm' value='ДА'>
	</form>

</div>
			";
		}
		else {
			// удаление админа из базы
			// определяем имя удаляемого админа
			$res_name = mysqli_query ($db, "SELECT nm_adm FROM adm WHERE id_adm=$del");
			$row_name = mysqli_fetch_array ($res_name);

			$res = mysqli_query ($db, "DELETE FROM adm WHERE id_adm=$del");
			if ($res) {echo "<p style='color:red; font-weight:bold;'>Администратор &laquo;".$row_name['nm_adm']."&raquo; удален!";}
		}
	}
}
?>
