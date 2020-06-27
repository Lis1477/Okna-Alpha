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
<h2>Для удаления галереи жмите на кнопку Удалить.</h2>
<hr>
	";
	$res_gal = mysqli_query ($db, "SELECT id_gal, name_gal FROM galleries ORDER BY order_gal");
	$row_gal = mysqli_fetch_array ($res_gal);

	do {
		echo "
<div>
	<h3 style='display:inline-block;'>".$row_gal['name_gal']."</h3>
	<a href='?delgal=1&del=".$row_gal['id_gal']."' class='del_button'>Удалить</a>
</div>
		";
	}
	while($row_gal = mysqli_fetch_array ($res_gal));
}
else
{
	if (isset($del))
	{
		if (!isset($_POST['del_gal'])) {
			// берем из базы имя галереи
			$res_head_gal = mysqli_query ($db, "SELECT name_gal FROM galleries WHERE id_gal=$del");
			$row_head_gal = mysqli_fetch_array ($res_head_gal);
			// выводим предупреждение
			echo "
<h3><span style='color:red'>Действие не обратимо!</span></h3>
<h3>Вы уверены, что хотите <strong>УДАЛИТЬ</strong> галерею &laquo;".$row_head_gal['name_gal']."&raquo;?</h3>

<div class='da_net'>

	<form action='?delgal=1' method='post' onkeypress='if(event.keyCode == 13) return false;'>
		<input type='submit' value='НЕТ'>
	</form>

	<form method='post'>
		<input type='submit' name='del_gal' value='ДА'>
	</form>

</div>
			";
		}
		else {
			// берем из базы данные для удаления
			$res_head_gal = mysqli_query ($db, "SELECT name_gal, pic_gal FROM galleries WHERE id_gal=$del");
			$row_head_gal = mysqli_fetch_array ($res_head_gal);
			// удалеяем галереи из базы
			$res_del = mysqli_query ($db, "DELETE FROM galleries WHERE id_gal=$del");
			if ($res_del) {
				// удаляем главное изображение галереи
				@unlink("../gal_img/".$row_head_gal['pic_gal']);
				// удаляем все изображения галери
				$res_gal = mysqli_query ($db, "SELECT big_pic, sm_pic FROM gal_{$del}");
				$row_gal = mysqli_fetch_array ($res_gal);
				do {
					@unlink("../gal_img/".$row_gal['big_pic']);
					@unlink("../gal_img/".$row_gal['sm_pic']);
				}
				while($row_gal = mysqli_fetch_array ($res_gal));
				// удаляем таблицу изображений галереи 
				$res_del_gal = mysqli_query ($db, "DROP TABLE gal_{$del}");
				// выдаем сообщение
				echo "<p>Галерея &laquo;".$row_head_gal['name_gal']."&raquo; удалена из базы данных!";
			}
		}
	}
}
?>
