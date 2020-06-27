<?php
// проверяем легальность загрузки файла
if(!defined('CONTROL_INC')) {
	$protocol = stripos($_SERVER['SERVER_PROTOCOL'],'https') === true ? 'https://' : 'http://';
	header ("Location: $protocol$_SERVER[SERVER_NAME]");
	exit;
}

// удаление изображения
// выдаем предупреждение
if (isset($del)) {
	// берем из базы имя изображения
	$res_name_pic = mysqli_query ($db, "SELECT name_pic FROM gal_{$gal} WHERE id_pic=$del");
	$row_name_pic = mysqli_fetch_array ($res_name_pic);
	// выводим предупреждение
	echo "
<h3 style='color:red'>Действие не обратимо!<br>
Вы уверены, что хотите <strong>УДАЛИТЬ</strong> изображение &laquo;".$row_name_pic['name_pic']."&raquo;?</h3>

<div class='da_net'>

	<form action='?uplpic=1&gal={$gal}' method='post' onkeypress='if(event.keyCode == 13) return false;'>
		<input type='submit' value='НЕТ'>
	</form>

	<form method='post' action='?uplpic=1&gal={$gal}'>
		<input type='hidden' name='id_pic' value='{$del}'>
		<input type='submit' name='del_pic' value='ДА'>
	</form>

</div>
<hr>
<br>
	";
}
// удаляем
if (isset($_POST['del_pic'])) {
	// определяем id изображения
	$id_pic = intval($_POST['id_pic']);
	unset($_POST['id_pic']);
	// берем из базы данные удаляемого изображения
	$res_name_pic = mysqli_query ($db, "SELECT name_pic, big_pic, sm_pic FROM gal_{$gal} WHERE id_pic=$id_pic");
	$row_name_pic = mysqli_fetch_array ($res_name_pic);
	// удалеяем галереи из базы
	$res_del = mysqli_query ($db, "DELETE FROM gal_{$gal} WHERE id_pic=$id_pic");
	if ($res_del) {
		// удаляем файлы изображений
		unlink("../gal_img/".$row_name_pic['big_pic']);
		unlink("../gal_img/".$row_name_pic['sm_pic']);
		// выдаем сообщение
		$mess = "<p style='color:red;'>Изображение &laquo;".$row_name_pic['name_pic']."&raquo; удалено!";
	}
	// удаляем переменную
	unset($id_pic);
}

// если есть запрос на изменение имени изображения, меняем
if(isset($_POST['upd_name'])) {
	// определяем id изображения 
	$id_pic = intval(key($_POST['upd_name']));
	// определяем новое имя
	$name_pic = substr(mysqli_real_escape_string($db, trim($_POST['name_pic'][$id_pic])), 0, 200);
	// обновляем в базе
	$res = mysqli_query ($db, "UPDATE gal_{$gal} SET name_pic='$name_pic' WHERE id_pic=$id_pic");

	$mess = "<p style='color:red;'>Имя обновлено.</p>";
}

// если есть запрос на изменение веса изображения, меняем
if(isset($_POST['upd_order'])) {
	// определяем id изображения 
	$id_pic = intval(key($_POST['upd_order']));
	// определяем новое значение веса
	$order_pic = intval($_POST['order_pic'][$id_pic]);
	// обновляем в базе
	$res = mysqli_query ($db, "UPDATE gal_{$gal} SET order_pic=$order_pic WHERE id_pic=$id_pic");

	$mess = "<p style='color:red;'>Вес обновлен.</p>";
}

// если есть запрос на изменение всех данных, меняем
if(isset($_POST['upd_all'])) {
	foreach($_POST['id_pic'] as $id_pic) {
		// определяем новое имя
		$name_pic = substr(mysqli_real_escape_string($db, trim($_POST['name_pic'][$id_pic])), 0, 200);
		// определяем новое значение веса
		$order_pic = intval($_POST['order_pic'][$id_pic]);
		// обновляем в базе
		$res = mysqli_query ($db, "UPDATE gal_{$gal} SET name_pic='$name_pic', order_pic=$order_pic WHERE id_pic=$id_pic");
	}
	$mess = "<p style='color:red;'>Все данные обновлены.</p>";
}

// выводим список галерей
if (!isset($gal))
{
	echo "
<h2>Для добавления (редактирования) изображений галереи жмите на соответствующую.</h2>
<hr>
	";
	$res_gal = mysqli_query ($db, "SELECT id_gal, name_gal FROM galleries ORDER BY order_gal");
	$row_gal = mysqli_fetch_array ($res_gal);
	do {
		echo "
	<h3><a href='index.php?uplpic=1&gal=".$row_gal['id_gal']."'>".$row_gal['name_gal']."</a></h3>
		";
	}
	while ($row_gal = mysqli_fetch_array ($res_gal));
}
else {

// если есть запрос удаления, удаляем изображение
if (isset($_POST['delpic']))
{
//	unlink('../img/news/id_'.$art.'/big/'.$_POST['pic']);
//	unlink('../img/news/id_'.$art.'/sml/'.$_POST['pic']);
}

// блок загрузки и редактирования изображений
// определяем имя галереи
$res_gal = mysqli_query ($db, "SELECT name_gal FROM galleries WHERE id_gal = $gal");
$row_gal = mysqli_fetch_array ($res_gal);

// выводим форму загрузки изображения
?>

<h2>Добавление изображений галереи &laquo;<?=$row_gal['name_gal']?>&raquo;</h3>
<p>Поля, помеченные &laquo;<span class='zvezd'>*</span>&raquo; - обязательны для заполнения.</p>
<hr>
<br>

<script>
	function validate_custinfo()	{ //валидация формы
		if (document.custinfo_form.upfl.value=="")	{
			alert("Необходимо загрузить ИЗОБРАЖЕНИЕ");
			return false;
		}
		if (document.custinfo_form.name_pic.value=="")	{
			alert("Заполните поле формы - ИМЯ");
			return false;
		}
		return true;
	}
</script>

<form method="post" enctype="multipart/form-data" name="custinfo_form" onSubmit="return validate_custinfo(this);">

	<p>Выберите изображение: <span class="zvezd">*</span> (формат .jpg, .jpeg, .gif, .png, не более 5 мегабайт, размер 4:3 , но не менее 350 на 262 пикселя..)<br>
	<input type="file" name="upfl" onkeypress="if(event.keyCode == 13) return false;"></p>

	<br>
  
	<p>Имя для изображения: <span class="zvezd">*</span><br>
	<input type="text" name="name_pic" size="100" maxlength="100" onkeypress="if(event.keyCode == 13) return false;"></p>

	<br>
  
	<p>Вес:<br>
	<span class="form_rem">* - Влияет на порядок выдачи на странице. Чем выше значение, тем больше вес и тем ниже опускается в выдаче.</span><br>
	<input type="number" name="order_pic" value="1" min="1" max="99" style="width:40px;" onkeypress="if(event.keyCode == 13) return false;"></p>

	<br>

	<p><input type='submit' name='subm' value='Загрузить'></p>
  
</form>

<?php
// если есть запрос на загрузку изображения, обрабатываем
if (isset($_POST['subm'])) {
	// узнаем id последнего загруженного файла
	$res_last_id = mysqli_query ($db, "SELECT id_pic FROM gal_{$gal} ORDER BY id_pic DESC LIMIT 1");
	$row_last_id = mysqli_fetch_array ($res_last_id);
	if(!empty($row_last_id['id_pic'])) $id_pic = $row_last_id['id_pic']; else $id_pic = 0;
	// назначаем номер для файла
	$num_fl = $id_pic + 1;

	// определяем alias галереи для формирования имени файла
	$res_alias = mysqli_query ($db, "SELECT alias_gal FROM galleries WHERE id_gal = $gal");
	$row_alias = mysqli_fetch_array ($res_alias);
	$alias = $row_alias['alias_gal'];

	// загружаем
	if (is_uploaded_file($_FILES['upfl']['tmp_name'])) {
		// исходные параметры
		$raz_fl = 5000000; // максимальный размер файла в байтах
		$gor_stor_big = "1500"; // желаемая ширина большого файла
		$gor_stor_sm = "350"; // желаемая ширина маленького файла
		$ver_stor_sm = "262"; // желаемая высота маленького файла
		$file_srs = $_FILES['upfl']['tmp_name']; // исходный файл с изображением
		$path_im = '../gal_img'; // путь к папке с изображениями
		// запоминаем имя файла
		$name_file = $_FILES['upfl']['name'];

		// проверяем, не превышает ли размер файла требуемый параметр
		$sz = filesize ($file_srs);
		if ($sz > $raz_fl) {echo "<p>Размер файла <strong>$name_file</strong> превышает максимальный ($sz байт, требуется не  более $raz_fl байт)</p>"; exit;};
		// проверяем, является ли файл изображением
		$prop = getimagesize($file_srs);
		if (!preg_match('{image/(.*)}is', $prop['mime'], $p)) {echo "<p>Файл <strong>$name_file</strong> не является 	изображением.</p>"; exit;};

		// узнаем мим тип изображения
		$mim = image_type_to_mime_type($prop[2]);
		// трансформируем изображение и записываем его в каталог 
		list($width_orig, $height_orig) = $prop;
		switch ($mim)
		{
			case "image/jpeg":
			$image = imagecreatefromjpeg($file_srs);  
			// для горизонтального изобажения
			if($width_orig <= $gor_stor_big) $new_width = $width_orig; else $new_width = $gor_stor_big;
			// для большого изображения
			$new_height = $new_width * $height_orig / $width_orig;
			$big_pic = imagecreatetruecolor($new_width, $new_height);  
			imagecopyresampled($big_pic, $image, 0, 0, 0, 0, $new_width, $new_height, $width_orig, $height_orig);
			imagejpeg($big_pic, $path_im."/".$alias."_".$num_fl."_big.jpg");
			// для маленького изображения
			$small_pic = imagecreatetruecolor($gor_stor_sm, $ver_stor_sm);  
			imagecopyresampled($small_pic, $image, 0, 0, 0, 0, $gor_stor_sm, $ver_stor_sm, $width_orig, $height_orig);
			imagejpeg($small_pic, $path_im."/".$alias."_".$num_fl."_sm.jpg");
			// определяем имена загруженных файлов для таблицы бд
			$b_pic = $alias."_".$num_fl."_big.jpg";
			$s_pic = $alias."_".$num_fl."_sm.jpg";
			break;  

			case "image/gif":	
			$image = imagecreatefromgif($file_srs);  
			// для горизонтального изобажения
			if($width_orig <= $gor_stor_big) $new_width = $width_orig; else $new_width = $gor_stor_big;
			// для большого изображения
			$new_height = $new_width * $height_orig / $width_orig;
			$big_pic = imagecreatetruecolor($new_width, $new_height);  
			imagecopyresampled($big_pic, $image, 0, 0, 0, 0, $new_width, $new_height, $width_orig, $height_orig);
			imagegif($big_pic, $path_im."/".$alias."_".$num_fl."_big.gif");
			// для маленького изображения
			$small_pic = imagecreatetruecolor($gor_stor_sm, $ver_stor_sm);  
			imagecopyresampled($small_pic, $image, 0, 0, 0, 0, $gor_stor_sm, $ver_stor_sm, $width_orig, $height_orig);
			imagegif($small_pic, $path_im."/".$alias."_".$num_fl."_sm.gif");
			// определяем имена загруженных файлов для таблицы бд
			$b_pic = $alias."_".$num_fl."_big.gif";
			$s_pic = $alias."_".$num_fl."_sm.gif";
			break;  

			case "image/png":
			$image = imagecreatefrompng($file_srs);  
			// для горизонтального изобажения
			if($width_orig <= $gor_stor_big) $new_width = $width_orig; else $new_width = $gor_stor_big;
			// для большого изображения
			$new_height = $new_width * $height_orig / $width_orig;
			$big_pic = imagecreatetruecolor($new_width, $new_height);  
			imagealphablending($big_pic, false);
			imagesavealpha($big_pic, true);
			imagecopyresampled($big_pic, $image, 0, 0, 0, 0, $new_width, $new_height, $width_orig, $height_orig);
			imagepng($big_pic, $path_im."/".$alias."_".$num_fl."_big.png");
			// для маленького изображения
			$small_pic = imagecreatetruecolor($gor_stor_sm, $ver_stor_sm);  
			imagealphablending($small_pic, false);
			imagesavealpha($small_pic, true);
			imagecopyresampled($small_pic, $image, 0, 0, 0, 0, $gor_stor_sm, $ver_stor_sm, $width_orig, $height_orig);
			imagepng($small_pic, $path_im."/".$alias."_".$num_fl."_sm.png");
			// определяем имена загруженных файлов для таблицы бд
			$b_pic = $alias."_".$num_fl."_big.png";
			$s_pic = $alias."_".$num_fl."_sm.png";
			break;  

			default:
			die("Не удалось создать изображение.");
		}
	}
	else {echo "<p style='color:red; font-size:0.7em; font-weight:bold;'>Для загрузки изображения воспользуйтесь кнопкой &laquo;Выберите файл&raquo;</p>";}

	// проверяем переменные
	if (isset($_REQUEST['name_pic']))	{$name_pic = substr(mysqli_real_escape_string($db, trim($_REQUEST['name_pic'])), 0, 200);	unset($_REQUEST['name_pic']);}
	if (isset($_REQUEST['order_pic']))	{$order_pic = intval($_REQUEST['order_pic']);	unset($_REQUEST['order_gal']);}

	//загружаем в бд
	$res = mysqli_query ($db, "INSERT INTO gal_{$gal} (name_pic, big_pic, sm_pic, order_pic) VALUES ('$name_pic', '$b_pic', '$s_pic', $order_pic)");
}
?>
<hr>
<br>


<?php
// выводим сообщение, если что-то меняли
if(isset($mess)) echo $mess;

// выводим уже загруженные изображения
$res_pics = mysqli_query ($db, "SELECT * FROM gal_{$gal} ORDER BY order_pic");
$row_pics = mysqli_fetch_array ($res_pics);

if (!empty($row_pics)) {
?>

<h2>Редактирование изображений галереи &laquo;<?=$row_gal['name_gal']?>&raquo;</h3>

<div>

<?php
	do {
?>
<form method="post">

	<img src="../gal_img/<?=$row_pics['sm_pic']?>" style="display:inline-block; width:210px; margin-right:20px;">

	<div style="display:inline-block; width:700px;">

		<p><input type="text" name="name_pic[<?=$row_pics['id_pic']?>]" value="<?=$row_pics['name_pic']?>" size="70"onkeypress="if(event.keyCode == 13) return false;">
		<input type="submit" name="upd_name[<?=$row_pics['id_pic']?>]" value="Изменить имя"></p>

		<br>

		<p><input type="number" name="order_pic[<?=$row_pics['id_pic']?>]" min="1" max="99" value="<?=$row_pics['order_pic']?>" style="width:40px;" onkeypress="if(event.keyCode == 13) return false;">
		<input type="submit" name="upd_order[<?=$row_pics['id_pic']?>]" value="Изменить вес"></p>

		<br>

		<a href="?uplpic=1&gal=<?=$gal?>&del=<?=$row_pics['id_pic']?>" class='del_button' style="margin-left:0;">Удалить</a>

		<input type="hidden" name="id_pic[]" value="<?=$row_pics['id_pic']?>">

	</div>

	<div style="clear:both;"></div>
	<hr>
<?php
	}
	while($row_pics = mysqli_fetch_array ($res_pics));

?>
	<hr>
	<input type="submit" name="upd_all" value="ИЗМЕНИТЬ ВСЁ"></p>

</form>
</div>
<?php
}
}
?>
