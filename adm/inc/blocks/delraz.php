<?php
// проверяем легальность загрузки файла
if(!defined('CONTROL_INC')) {
	$protocol = stripos($_SERVER['SERVER_PROTOCOL'],'https') === true ? 'https://' : 'http://';
	header ("Location: $protocol$_SERVER[SERVER_NAME]");
	exit;
}

if (!isset($del) && !isset($_POST['del_gal']))
{
	echo "
<h2>Для удаления подраздела жмите на кнопку Удалить.</h2>
<p style='color:red;'><strong>Внимание!</strong> При удалении материнского раздела будут также удалены все подчиненные разделы!</p>
<hr>
	";
	//выводим материнские разделы
	$res_maincat = mysqli_query ($db, "SELECT id_cat, name_cat FROM product_categories WHERE parent_cat = 0 ORDER BY order_cat");
	$row_maincat = mysqli_fetch_array ($res_maincat);

	do {
		echo "
	<h3>".$row_maincat['name_cat']." &nbsp;<a href='?delraz=1&del=".$row_maincat['id_cat']."' class='del_button'>Удалить</a></h3>
		";
		// выводим подчиненные разделы
		$res_subcat = mysqli_query ($db, "SELECT id_cat, name_cat FROM product_categories WHERE parent_cat = ".$row_maincat['id_cat']." ORDER BY order_cat");
		$row_subcat = mysqli_fetch_array ($res_subcat);
		if(!empty($row_subcat)) {
			do {
				echo "
	<p>&nbsp;&nbsp;&nbsp;<strong>{$row_subcat['name_cat']}</strong>&nbsp;<a href='?delraz=1&del=".$row_subcat['id_cat']."' class='del_button'>Удалить</a></p>
				";
			}
			while ($row_subcat = mysqli_fetch_array ($res_subcat));
		}
		echo "<br>";
	}
	while ($row_maincat = mysqli_fetch_array ($res_maincat));
}
else
{
	if (isset($del)) {
		if (!isset($_POST['del_cat'])) {
			// берем из базы имя раздела
			$res_cat = mysqli_query ($db, "SELECT name_cat, parent_cat FROM product_categories WHERE id_cat=$del");
			$row_cat = mysqli_fetch_array ($res_cat);
			// выводим предупреждение
			echo "
<h3><span style='color:red'>Действие не обратимо!</span></h3>
			";
			if($row_cat['parent_cat'] == 0) echo "<p style='color:red;'>Будут также удалены все подчиненные разделы.</p>";
			echo "
<h3>Вы уверены, что хотите <strong>УДАЛИТЬ</strong> раздел <strong>&laquo;".$row_cat['name_cat']."&raquo;</strong>?</h3>

<div class='da_net'>

	<form action='?delraz=1' method='post' onkeypress='if(event.keyCode == 13) return false;'>
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
			$res_cat = mysqli_query ($db, "SELECT id_cat, name_cat, parent_cat, pic_cat FROM product_categories WHERE id_cat = $del");
			$row_cat = mysqli_fetch_array ($res_cat);

			// удалеяем раздел из базы
			$res_del = mysqli_query ($db, "DELETE FROM product_categories WHERE id_cat = $del");
			if ($res_del) {
				// удаляем изображение раздела
				unlink("../img/".$row_cat['pic_cat']);
				// если удаляется материнский раздел, удаляем подчиненные
				if($row_cat['parent_cat'] == 0) {
					// 
					$res_mat = mysqli_query ($db, "SELECT id_cat, pic_cat FROM product_categories WHERE parent_cat = {$row_cat['id_cat']}");
					$row_mat = mysqli_fetch_array ($res_mat);
					if(!empty($row_mat)) {
						do {
							$res = mysqli_query ($db, "DELETE FROM product_categories WHERE id_cat = {$row_mat['id_cat']}");
							// удаляем изображение раздела
							if(!empty($row_mat['pic_cat'])) unlink("../img/".$row_mat['pic_cat']);
						}
						while($row_mat = mysqli_fetch_array ($res_mat));
					}
				}
				// выдаем сообщение
				echo "<p>Подраздел <strong>&laquo;".$row_cat['name_cat']."&raquo;</strong> удален из базы данных!";
			}
		}
	}
}
?>
