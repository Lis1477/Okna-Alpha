<?php
// проверяем легальность загрузки файла
if(!defined('CONTROL_INC')) {
	$protocol = stripos($_SERVER['SERVER_PROTOCOL'],'https') === true ? 'https://' : 'http://';
	header ("Location: $protocol$_SERVER[SERVER_NAME]");
	exit;
}

if (!isset($del) && !isset($_POST['del_nov']))
{
	echo "
<h2>Для удаления статьи жмите на кнопку Удалить.</h2>
<hr>
	";
	$res_news = mysqli_query ($db, "SELECT id_nov, date_nov, head_nov FROM news ORDER BY date_nov");
	$row_news = mysqli_fetch_array ($res_news);

	do {
		echo "
<div>
	<h3 style='display:inline-block;'>".date("d.m.Y", strtotime($row_news['date_nov'])).". ".$row_news['head_nov']."</h3>
	<a href='?delnov=1&del=".$row_news['id_nov']."' class='del_button'>Удалить</a>
</div>
		";
	}
	while($row_news = mysqli_fetch_array ($res_news));
}
else
{
	if (isset($del))
	{
		if (!isset($_POST['del_nov'])) {
			// берем из базы заголовок статьи
			$res_head_news = mysqli_query ($db, "SELECT head_nov FROM news WHERE id_nov=$del");
			$row_head_news = mysqli_fetch_array ($res_head_news);
			// выводим предупреждение
			echo "
<h3><span style='color:red'>Действие не обратимо!</span></h3>
<h3>Вы уверены, что хотите <strong>УДАЛИТЬ</strong> новость &laquo;".$row_head_news['head_nov']."&raquo;?</h2>

<div class='da_net'>

	<form action='index.php?delnov=1' method='post' onkeypress='if(event.keyCode == 13) return false;'>
		<input type='submit' value='НЕТ'>
	</form>

	<form method='post'>
		<input type='submit' name='del_nov' value='ДА'>
	</form>

</div>
			";
		}
		else {
			// берем из базы заголовок статьи
			$res_head_news = mysqli_query ($db, "SELECT head_nov, pic_nov FROM news WHERE id_nov=$del");
			$row_head_news = mysqli_fetch_array ($res_head_news);
			// удалеяем новость из базы
			$res_del = mysqli_query ($db, "DELETE FROM news WHERE id_nov=$del");
			if ($res_del) {
				// удаляем изображение новости
				unlink("../img/".$row_head_news['pic_nov']);
				// выдаем сообщение
				echo "<p>Новость &laquo;".$row_head_news['head_nov']."&raquo; удалена из базы данных!";
			}
		}
	}
}
?>
