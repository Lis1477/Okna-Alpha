<?php
// проверяем легальность загрузки файла
if(!defined('CONTROL_INC')) {
	$protocol = stripos($_SERVER['SERVER_PROTOCOL'],'https') === true ? 'https://' : 'http://';
	header ("Location: $protocol$_SERVER[SERVER_NAME]");
	exit;
}

if (!isset($_POST['save_gal'])) {
	if (!isset($gal)) {
?>
<h2>Выберите галерею для редактирования:</h2>
<?php
		// выводим все галереи
		$res_gal = mysqli_query ($db, "SELECT id_gal, name_gal FROM galleries ORDER BY order_gal");
		$row_gal = mysqli_fetch_array ($res_gal);

		do {
?>
<h3><a href="?redgal=1&gal=<?=$row_gal['id_gal']?>"><?=$row_gal['name_gal']?></a></h3>
<?php
		}
		while($row_gal = mysqli_fetch_array ($res_gal));
	}
	else {
		// вызываем из базы данные галереи
		$res_gal = mysqli_query ($db, "SELECT * FROM galleries WHERE id_gal = $gal");
		$row_gal = mysqli_fetch_array ($res_gal);
?>

<script>
	function validate_custinfo()	{ //валидация формы
		if (document.custinfo_form.head_nov.value=="")	{
			alert("Заполните поле формы - ИМЯ ГАЛЕРЕИ");
			return false;
		}
		return true;
	}
</script>

<h2>Редактирование галереи: &laquo;<?=$row_gal['name_gal']?>&raquo;.</h2>
<h3>Заполните необходимые данные!</h3><p>Поля, помеченные &laquo;<span class="zvezd">*</span>&raquo; - обязательны для заполнения.</p><hr><br>

<form method="post" enctype="multipart/form-data" name="custinfo_form" onSubmit="return validate_custinfo(this);">

	<p>Имя галереи (до 100 знаков): <span class="zvezd">*</span><br>
		<input type="text" name="name_gal" value="<?=$row_gal['name_gal']?>" size="100" maxlength="100" onkeypress="if(event.keyCode == 13) return false;">
	</p>

	<br>

	<p>Адрес объекта (до 100 знаков): <span class="zvezd">*</span><br>
		<input type="text" name="adr_gal" value="<?=$row_gal['adr_gal']?>" size="100" maxlength="100" onkeypress="if(event.keyCode == 13) return false;">
	</p>

<br>

	<p>Псевдоним (до 100 знаков):<br>
	<span class="form_rem">* - Псевдоним используется для формирования ссылки на страницу. Оставьте поле пустым, чтобы сформировать автоматически.</span><br>
		<input type="text" name="alias_gal" value="<?=$row_gal['alias_gal']?>" size="100"  maxlength="100" onkeypress="if(event.keyCode == 13) return false;">
	</p>

	<br>

	<p>Текущее изображение раздела:<br>
	<img src="../gal_img/<?=$row_gal['pic_gal']?>"><br><strong><?=$row_gal['pic_gal']?></strong>
	<br>
	<br>
	<span class='form_rem'>* - Выберите изображение для раздела (формат .jpg, .jpeg, .gif, .png, не более 5 мегабайт, размер 4:3 , но не менее 350 на 262 пикселя..<br>Не загружайте, если текущее изображение актуально!</span><br>
	<input type='file' name='upfl'></p>

	<br>

	<p>Заголовок (на ярлыке) страницы (до 150 знаков):<br>
	<span class="form_rem">* - Требуется для тега title. <strong>Можно оставить пустым</strong>, будет формироваться автоматически.</span><br>
		<input name='title_gal' size="100" value="<?=$row_gal['title_gal']?>" maxlength="150" onkeypress="if(event.keyCode == 13) return false;">
	</p>

	<br>

	<p>Краткое описание (до 300 знаков):<br>
	<span class='form_rem'>* - Краткое описание должно содержать &laquo;главную мысль&raquo; страницы. Требуется только для тега description с целью лучшего отображения в поиске и продвижения в поисковых системах. Можно оставлять пустым.</span><br>
		<textarea name='desc_gal' cols='100' rows='5' maxlength='300'><?=$row_gal['desc_gal']?></textarea>
	</p>

	<br>

	<p>Вес:<br>
	<span class="form_rem">* - Влияет на порядок выдачи на странице. Чем выше значение, тем больше вес и тем ниже опускается в выдаче.</span><br>
	<input type="number" name="order_gal" value="<?=$row_gal['order_gal']?>" style="width:40px;" onkeypress="if(event.keyCode == 13) return false;"></p>

	<br>

	<p>Отображение:<br>
	<span class="form_rem">* - При значении &laquo;скрыто&raquo; будет загружено в базу данных, но не видно для посетителей.</span><br>
		<select name="show_gal">
			<option value=1 selected>опубликовано</option>
			<option value=0>скрыто</option>
		</select>
	</p>

	<br>

	<p>
		<input type="submit" name="save_gal" value="Подтвердить">
	</p>

</form>
<?php
	}
}
else {
	// проверка глобальных переменных и перезапись в обычные
	if (isset($_REQUEST['name_gal']))	{$name_gal = substr(htmlspecialchars(trim($_REQUEST['name_gal']), ENT_QUOTES, 'utf-8'), 0, 200);	unset($_REQUEST['name_gal']);}
	if (isset($_REQUEST['adr_gal']))	{$adr_gal = substr(htmlspecialchars(trim($_REQUEST['adr_gal']), ENT_QUOTES, 'utf-8'), 0, 200);	unset($_REQUEST['adr_gal']);}
	if (isset($_REQUEST['alias_gal']))		{$alias_gal = substr(htmlspecialchars(trim($_REQUEST['alias_gal']), ENT_QUOTES, 'utf-8'), 0, 200);	unset($_REQUEST['alias_gal']);}
	if (isset($_REQUEST['title_gal']))		{$title_gal = substr(htmlspecialchars(trim($_REQUEST['title_gal']), ENT_QUOTES, 'utf-8'), 0, 300);	unset($_REQUEST['title_gal']);}
	if (isset($_REQUEST['desc_gal']))		{$desc_gal = substr(htmlspecialchars(trim($_REQUEST['desc_gal']), ENT_QUOTES, 'utf-8'), 0, 600);	unset($_REQUEST['desc_gal']);}
	if (isset($_REQUEST['order_gal']))		{$order_gal = intval($_REQUEST['order_gal']);	unset($_REQUEST['order_gal']);}
	if (isset($_REQUEST['show_gal']))		{$show_gal = intval($_REQUEST['show_gal']);	unset($_REQUEST['show_gal']);}

	// проверка имени галереи на дубль, если дубль - останавливаем
	$res_dub = mysqli_query ($db, "SELECT id_gal FROM galleries WHERE (id_gal != $gal && name_gal = '$name_gal')");
	$row_dub = mysqli_fetch_array ($res_dub);
	if(!empty($row_dub)) exit("<p style='color:red;'>Галерея с таким именем уже существует! Дайте другое имя или обратитесь к разработчику.<br><br><input type='button' onClick='history.go(-1)' value='Вернуться'></p>");


	// формируем псевдоним вкладки
	// транслитерация псевдонима, перевод в нижний регистр
	$rus = array("А", "Б", "В", "Г", "Д", "Е", "Ё", "Ж", "З", "И", "Й", "К", "Л", "М", "Н", "О", "П", "Р", "С", "Т", "У", "Ф", "Х", "Ц", "Ч", "Ш", "Щ", "Ъ", "Ы", "Ь", "Э", "Ю", "Я", "а", "б", "в", "г", "д", "е", "ё", "ж", "з", "и", "й", "к", "л", "м", "н", "о", "п", "р", "с", "т", "у", "ф", "х", "ц", "ч", "ш", "щ", "ъ", "ы", "ь", "э", "ю", "я", "?");
	$lat = array("A", "B", "V", "G", "D", "E", "Yo", "Zh", "Z", "I", "Y", "K", "L", "M", "N", "O", "P", "R", "S", "T", "U", "F", "H", "Ts", "Ch", "Sh", "Sch", "", "I", "", "E", "Yu", "Ya", "a", "b", "v", "g", "d", "e", "yo", "zh", "z", "i", "y", "k", "l", "m", "n", "o", "p", "r", "s", "t", "u", "f", "h", "ts", "ch", "sh", "sch", "", "i", "", "e", "yu", "ya", "");
	if (empty($alias_gal)) {
		$alias_gal = str_replace(" ", "-", strtolower(str_replace($rus, $lat, $name_gal)));
	}
	else {
		$alias_gal = str_replace(" ", "-", strtolower(str_replace($rus, $lat, $alias_gal)));
	}

	// загружаем изображение
	if (is_uploaded_file($_FILES['upfl']['tmp_name'])) {
		// исходные параметры обработки картинки
		$raz_fl = 5000000; // максимальный размер исходного файла
		$stor_gor = "350"; // ширина конечного изображения
		$stor_ver = "262"; // высота конечного изображения
		$file_srs = $_FILES['upfl']['tmp_name']; // исходный файл с изображением
		$path_im = '../gal_img/'; // путь к папке для загрузки конечного изображения
		$name_file = $_FILES['upfl']['name']; // запоминаем имя файла
		// назначаем имя конечному файлу (без расширения)
		$name_pic = $alias_gal;

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
		switch ($mim)
		{
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

		// формируем параметр для запроса
		$pic_querry = ", pic_gal = '$pic'"; 
	}
	else $pic_querry = "";

	// записываем в базу данных
	$res = mysqli_query ($db, "UPDATE galleries SET name_gal='$name_gal', adr_gal='$adr_gal', alias_gal='$alias_gal', title_gal='$title_gal', desc_gal='$desc_gal', order_gal=$order_gal, show_gal=$show_gal{$pic_querry} WHERE id_gal=$gal");
	if ($res) {echo "<p>Галерея <strong>&laquo;{$name_gal}&raquo;</strong> обновлена!</p>";} 
}
?>
