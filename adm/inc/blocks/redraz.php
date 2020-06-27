<?php
// проверяем легальность загрузки файла
if(!defined('CONTROL_INC')) {
	$protocol = stripos($_SERVER['SERVER_PROTOCOL'],'https') === true ? 'https://' : 'http://';
	header ("Location: $protocol$_SERVER[SERVER_NAME]");
	exit;
}

if (!isset($raz)) {
	echo "
<h2>Для редактирования жмите на соответствующий раздел.</h2>
<hr>
	";
	//выводим главные категории
	$res_maincat = mysqli_query ($db, "SELECT id_cat, name_cat FROM product_categories WHERE parent_cat = 0");
	$row_maincat = mysqli_fetch_array ($res_maincat);

	do {
		echo "
	<h3><a href='index.php?redraz=1&raz=".$row_maincat['id_cat']."'>".$row_maincat['name_cat']."</a></h3>
		";
		// выводим подкатегории
		$res_subcat = mysqli_query ($db, "SELECT id_cat, name_cat FROM product_categories WHERE parent_cat = ".$row_maincat['id_cat']." ORDER BY order_cat");
		$row_subcat = mysqli_fetch_array ($res_subcat);
		if(!empty($row_subcat)) {
			do {
				echo "
	<p style='color:#106DCE;'>&nbsp;&nbsp;&nbsp;<strong><a href='index.php?redraz=1&raz=".$row_subcat['id_cat']."'>".$row_subcat['name_cat']."</a></strong></p>
				";
			}
			while ($row_subcat = mysqli_fetch_array ($res_subcat));
		}
		echo "<br>";
	}
	while ($row_maincat = mysqli_fetch_array ($res_maincat));
}
else {
	if (!isset($_POST['red_txt'])) 	{
		// вызываем данные подкатегории из базы
		$res_sub = mysqli_query ($db, "SELECT * FROM product_categories WHERE id_cat=$raz");
		$row_sub = mysqli_fetch_array ($res_sub);
?>
<h2>Отредактируйте данные раздела &laquo;<?=$row_sub['name_cat']?>&raquo;</strong>:</h2>
<hr>

<form method='post' enctype='multipart/form-data'>

	<p>Имя раздела (до 100 знаков):<br>
		<input type='text' name='name_cat' value='<?=$row_sub['name_cat']?>' size='100'  maxlength='100' onkeypress='if(event.keyCode == 13) return false;'>
	</p>

	<br>

	<p>Псевдоним (до 100 знаков):<br>
	<span class='form_rem'>* - <span style='color:red; font-weight:bold;'>Внимание!</span> Производить смену псевдонима НЕ РЕКОМЕНДУЕТСЯ! Корректировка повлечет за собой изменение псевдонимов всех подчиненных материалов. Это негативно повлияет на рейтинг в поисковых системах в связи с переиндексацией новых (с точки зрения поиска) страниц.</span><br>
		<input type='text' name='alias_cat' value='<?=$row_sub['alias_cat']?>' size='100'  maxlength='100' onkeypress='if(event.keyCode == 13) return false;'>
	</p>

	<br>

	<p>Подчинение:<br>
		<select name='parent_cat'>
<?php
		if($row_sub['id_cat'] == 0) $slc = " selected";
		else $slc = "";

?>
			<option value="0"<?=$slc?>>0 - Материнский раздел</option>
<?php
		// вызываем имена и id материнских категорий
		$res_maincat = mysqli_query ($db, "SELECT id_cat, name_cat FROM product_categories WHERE parent_cat = 0 ORDER BY order_cat");
		$row_maincat = mysqli_fetch_array ($res_maincat);
		do {
			if($row_maincat['id_cat'] == $row_sub['parent_cat']) $slc = " selected";
			else $slc = "";
?>
			<option value='<?=$row_maincat['id_cat']?>'<?=$slc?>><?=$row_maincat['name_cat']?></option>
<?php
		}
		while($row_maincat = mysqli_fetch_array ($res_maincat));
?>
		</select>
	</p>

	<br>

<?php
		// выводим изображение на экран, если имеется
		if(!empty($row_sub['pic_cat'])) $pic_line = "<br><img src='../img/".$row_sub['pic_cat']."' width='700px'><br><strong>".$row_sub['pic_cat']."</strong>";
		else $pic_line = " используется изображение материнского раздела.";
?>

	<p>Изображение раздела: <?=$pic_line?>
	<br>
	<br>
	Выберите изображение для раздела (формат .jpg, .jpeg, .gif, .png, не более 5 мегабайт, размер 1200х375px или более в пропорции.):<br>
	<span class='form_rem'>* - не загружайте, если текущее изображение актуально.</span><br>
	<input type='file' name='upfl'></p>

	<br>

	<p>Текст раздела:<br>
		<textarea name='text_cat' id='editor'cols='100' rows='10'><?=$row_sub['text_cat']?></textarea>
	<script>CKEDITOR.replace( 'editor' ); </script>
	</p>

	<br>

	<p>Заголовок (на ярлыке) страницы (до 150 знаков):<br>
	<span class='form_rem'>* - Требуется для тега title. <strong>Можно оставить пустым</strong>, будет формироваться автоматически.</span><br>
		<input type='text' name='title_cat' value='<?=$row_sub['title_cat']?>' size='100'  maxlength='150' onkeypress='if(event.keyCode == 13) return false;'>
	</p>

	<br>

	<p>Краткое описание (до 300 знаков):<br>
	<span class='form_rem'>* - Краткое описание должно содержать &laquo;главную мысль&raquo; страницы. Требуется только для тега description с целью лучшего отображения в поиске и продвижения в поисковых системах. Можно оставлять пустым.</span><br>
		<textarea name='desc_cat' cols='100' rows='5' maxlength='300'><?=$row_sub['desc_cat']?></textarea>
	</p>

	<br>

	<p>Вес:<br>
	<span class='form_rem'>* - Влияет на порядок выдачи в меню. Чем выше значение, тем больше вес и тем ниже опускается в выдаче.</span><br>
		<input type='number' name='order_cat' value='<?=$row_sub['order_cat']?>' min='1' max='99' style='width:40px;' onkeypress='if(event.keyCode == 13) return false;'>
	</p>

	<br>

	<p>Отображение:<br>
	<span class='form_rem'>* - При значении &laquo;скрыто&raquo; не будет видно для посетителей. Но из базы не удаляется.</span><br>
		<select name='visible_cat'>
			<option value='1' selected>опубликовано</option>
			<option value='0'>скрыто</option>
		</select>
	</p>

	<br>

	<p>
		<input type='submit' name='red_txt' value='Подтвердить'>
	</p>

</form>
<?php
	}
	else
	{
		// проверка глобальных переменных и перезапись в обычные
		if (isset($_REQUEST['name_cat'])) {$name_cat = substr(htmlspecialchars(trim($_REQUEST['name_cat']), ENT_QUOTES, 'utf-8'), 0, 200);	unset($_REQUEST['name_cat']);}
		if (isset($_REQUEST['alias_cat'])) {$alias_cat = substr(htmlspecialchars(trim($_REQUEST['alias_cat']), ENT_QUOTES, 'utf-8'), 0, 200);	unset($_REQUEST['alias_cat']);}
		if (isset($_REQUEST['text_cat'])) {$text_cat = substr(mysqli_real_escape_string($db, trim($_REQUEST['text_cat'])), 0, 15000);	unset($_REQUEST['text_cat']);}
		if (isset($_REQUEST['title_cat'])) {$title_cat = substr(htmlspecialchars(trim($_POST['title_cat']), ENT_QUOTES, 'utf-8'), 0, 300);	unset($_REQUEST['title_cat']);}
		if (isset($_REQUEST['desc_cat'])) {$desc_cat = substr(htmlspecialchars(trim($_POST['desc_cat']), ENT_QUOTES, 'utf-8'), 0, 600);	unset($_REQUEST['desc_cat']);}
		if (isset($_REQUEST['parent_cat'])) {$parent_cat = intval($_REQUEST['parent_cat']);	unset($_REQUEST['parent_cat']);}
		if (isset($_REQUEST['order_cat'])) {$order_cat = intval($_REQUEST['order_cat']);	unset($_POST['order_cat']);}
		if (isset($_REQUEST['visible_cat'])) {$visible_cat = intval($_REQUEST['visible_cat']);	unset($_REQUEST['visible_cat']);}

		// проверка имени подраздела на дубль, если дубль - останавливаем
		$res_dub = mysqli_query ($db, "SELECT id_cat FROM product_categories WHERE (id_cat != $raz && name_cat = '$name_cat')");
		$row_dub = mysqli_fetch_array ($res_dub);
		if(!empty($row_dub)) exit("<p style='color:red;'>Подраздел с таким именем уже существует! Дайте другое имя или обратитесь к разработчику.<br><br><input type='button' onClick='history.go(-1)' value='Вернуться'></p>");

		// формируем псевдоним вкладки
		// транслитерация псевдонима, перевод в нижний регистр
		$rus = array('А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ё', 'Ж', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф', 'Х', 'Ц', 'Ч', 'Ш', 'Щ', 'Ъ', 'Ы', 'Ь', 'Э', 'Ю', 'Я', 'а', 'б', 'в', 'г', 'д', 'е', 'ё', 'ж', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф', 'х', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ы', 'ь', 'э', 'ю', 'я');
		$lat = array('A', 'B', 'V', 'G', 'D', 'E', 'Yo', 'Zh', 'Z', 'I', 'Y', 'K', 'L', 'M', 'N', 'O', 'P', 'R', 'S', 'T', 'U', 'F', 'H', 'Ts', 'Ch', 'Sh', 'Sch', '', 'I', '', 'E', 'Yu', 'Ya', 'a', 'b', 'v', 'g', 'd', 'e', 'yo', 'zh', 'z', 'i', 'y', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'h', 'ts', 'ch', 'sh', 'sch', '', 'i', '', 'e', 'yu', 'ya');
		if (empty($alias_cat)) {
			$alias_cat = str_replace(" ", "-", strtolower(str_replace($rus, $lat, $name_cat)));
		}
		else {
			$alias_cat = str_replace(" ", "-", strtolower(str_replace($rus, $lat, $alias_cat)));
		}
			
		// загружаем изображение
		if (is_uploaded_file($_FILES['upfl']['tmp_name'])) {
			// исходные параметры обработки картинки
			$raz_fl = 5000000; // максимальный размер исходного файла
			$stor_gor = "1200"; // ширина конечного изображения
			$stor_ver = "375"; // высота конечного изображения
			$file_srs = $_FILES['upfl']['tmp_name']; // исходный файл с изображением
			$path_im = '../img/'; // путь к папке для загрузки конечного изображения
			$name_file = $_FILES['upfl']['name']; // запоминаем имя файла
			// назначаем имя конечному файлу (без расширения)
			$name_pic = $alias_cat;

			// скрипт загрузки и обработки изображения
			// проверяем, не превышает ли размер файла требуемый параметр 
			$sz = filesize ($file_srs);
			if ($sz > $raz_fl) {echo "<p style='color:red;'>Размер файла <strong>$name_file</strong> превышает максимальный ($sz байт, требуется не  более $raz_fl байт)</p>"; exit;};
			// проверяем, является ли файл изображением
			$prop = getimagesize($file_srs);
			if (!preg_match('{image/(.*)}is', $prop['mime'], $p)) {echo "<p style='color:red;'>Файл <strong>$name_file</strong> не является 	изображением.</p>"; exit;};
			// узнаем мим тип изображения
			$mim = image_type_to_mime_type($prop[2]);
			// трансформируем изображение 
			list($width_orig, $height_orig) = $prop;
			switch ($mim)	{
				case "image/jpeg":
				$image = imagecreatefromjpeg($file_srs);  
				$newpic = imagecreatetruecolor($stor_gor, $stor_ver);  
				imagecopyresampled($newpic, $image, 0, 0, 0, 0, $stor_gor, $stor_ver, $width_orig, $height_orig);
				imagejpeg($newpic, $path_im.$name_pic.'.jpg');
				$pic = $name_pic.'.jpg'; // имя файла для базы данных
				break; 

				case "image/gif":	
				$image = imagecreatefromgif($file_srs);  
				$newpic = imagecreatetruecolor($stor_gor, $stor_ver);  
				imagecopyresampled($newpic, $image, 0, 0, 0, 0, $stor_gor, $stor_ver, $width_orig, $height_orig);
				imagegif($newpic, $path_im.$name_pic.'.gif');
				$pic = $name_pic.'.gif'; // имя файла для базы данных

				break;  
				case "image/png":
				$image = imagecreatefrompng($file_srs);  
				$newpic = imagecreatetruecolor($stor_gor, $stor_ver);  
				imagealphablending($newpic, false);
				imagesavealpha($newpic, true);
				imagecopyresampled($newpic, $image, 0, 0, 0, 0, $stor_gor, $stor_ver, $width_orig, $height_orig);
				imagepng($newpic, $path_im.$name_pic.'.png');
				$pic = $name_pic.'.png'; // имя файла для базы данных

				break;  
				default:
				die("Не удалось создать изображение.");
			}
			// переменная для запроса
			$pic_querry = ", pic_cat = '$pic'";
		}
		// если картинка не загружена - делаем пустую переменную
		else $pic_querry = "";

		// записываем в базу данных
		$res = mysqli_query ($db, "UPDATE product_categories SET name_cat='$name_cat', alias_cat='$alias_cat', parent_cat='$parent_cat', text_cat='$text_cat', desc_cat='$desc_cat', title_cat='$title_cat', order_cat=$order_cat, visible_cat=$visible_cat $pic_querry WHERE id_cat = $raz");
		if ($res) {
			echo "<p>Данные раздела <strong>&laquo;$name_cat&raquo;</strong> обновлены!</p>";
		}
		else exit("<p style='color:red;'>Упс.. Данные раздела обновить не удалось! Попробуйте еще раз или обратитесь к разработчику.</p>");
	}
}
?>
