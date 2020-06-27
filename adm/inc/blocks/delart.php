<?php
// проверяем легальность загрузки файла
if(!defined('CONTROL_INC')) {
	$protocol = stripos($_SERVER['SERVER_PROTOCOL'],'https') === true ? 'https://' : 'http://';
	header ("Location: $protocol$_SERVER[SERVER_NAME]");
	exit;
}

if (!isset($del) && !isset($_POST['del_art']))
{
	echo "
<h2>Для удаления материала жмите на кнопку Удалить.</h2>
<hr>
	";
	//выводим главные категории
	$res_maincat = mysqli_query ($db, "SELECT id_cat, name_cat FROM categories WHERE parent_cat = 0 && id_cat != 1 && id_cat != 6 && id_cat != 7 ORDER BY order_cat");
	$row_maincat = mysqli_fetch_array ($res_maincat);

	do {
		echo "
	<h3>".$row_maincat['name_cat']."</h3>
		";
		// выводим подкатегории
		$res_subcat = mysqli_query ($db, "SELECT id_cat, name_cat FROM categories WHERE parent_cat = ".$row_maincat['id_cat']." ORDER BY order_cat");
		$row_subcat = mysqli_fetch_array ($res_subcat);

		do {
			echo "
	<p><strong>&nbsp;&nbsp;&nbsp;".$row_subcat['name_cat']."</strong></p>
			";
			// выводим материалы
			$res_mat = mysqli_query ($db, "SELECT id_art, name_art FROM articles WHERE category_art = ".$row_subcat['id_cat']." ORDER BY order_art");
			$row_mat = mysqli_fetch_array ($res_mat);
			if(!empty($row_mat)) {
				do {
					echo "
	<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$row_mat['name_art']." &nbsp;<a href='?delart=1&del=".$row_mat['id_art']."' class='del_button'>Удалить</a></p>
					";
				}
				while ($row_mat = mysqli_fetch_array ($res_mat));
			}
		}
		while ($row_subcat = mysqli_fetch_array ($res_subcat));

		echo "<br>";
	}
	while ($row_maincat = mysqli_fetch_array ($res_maincat));
}
else
{
	if (isset($del)) {
		if (!isset($_POST['del_cat'])) {
			// берем из базы имя материала
			$res_art = mysqli_query ($db, "SELECT name_art FROM articles WHERE id_art=$del");
			$row_art = mysqli_fetch_array ($res_art);
			// выводим предупреждение
			echo "
<h3><span style='color:red'>Действие не обратимо!</span></h3>
<h3>Вы уверены, что хотите <strong>УДАЛИТЬ</strong> материал <strong>&laquo;".$row_art['name_art']."&raquo;</strong>?</h3>

<div class='da_net'>

	<form action='?delart=1' method='post' onkeypress='if(event.keyCode == 13) return false;'>
		<input type='submit' value='НЕТ'>
	</form>

	<form method='post'>
		<input type='submit' name='del_cat' value='ДА'>
	</form>

</div>
			";
		}
		else {
			// берем из базы данные для удаления
			$res_art = mysqli_query ($db, "SELECT name_art FROM articles WHERE id_art = $del");
			$row_art = mysqli_fetch_array ($res_art);
			// удалеяем материал из базы
			$res_del = mysqli_query ($db, "DELETE FROM articles WHERE id_art = $del");
			if ($res_del) {
				// выдаем сообщение
				echo "<p>Материал <strong>&laquo;".$row_art['name_art']."&raquo;</strong> удален из базы данных!";
			}
		}
	}
}
?>
