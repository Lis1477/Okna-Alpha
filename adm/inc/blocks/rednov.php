<?php
// проверяем легальность загрузки файла
if(!defined('CONTROL_INC')) {
	$protocol = stripos($_SERVER['SERVER_PROTOCOL'],'https') === true ? 'https://' : 'http://';
	header ("Location: $protocol$_SERVER[SERVER_NAME]");
	exit;
}

if (!isset($_POST['save_nov'])) {
	if (!isset($nov)) {
?>
<h2>Выберите новость для редактирования:</h2>
<?php
		// выводим все новости
		$res_news = mysqli_query ($db, "SELECT id_nov, date_nov, head_nov FROM news ORDER BY date_nov DESC");
		$row_news = mysqli_fetch_array ($res_news);

		do {
?>
<h3><a href="?rednov=1&nov=<?=$row_news['id_nov']?>"><?=date("d-m-Y", strtotime($row_news['date_nov']))?>. <?=$row_news['head_nov']?></a></h3>
<?php
		}
		while($row_news = mysqli_fetch_array ($res_news));
	}
	else {
		// вызываем из базы данные новости
		$res_news = mysqli_query ($db, "SELECT * FROM news WHERE id_nov = $nov");
		$row_news = mysqli_fetch_array ($res_news);
?>

<script>
	function validate_custinfo()	{ //валидация формы
		if (document.custinfo_form.head_nov.value=="")	{
			alert("Заполните поле формы - ЗАГОЛОВОК");
			return false;
		}
		if (document.custinfo_form.text_nov.value=="")	{
			alert("Заполните поле формы - ТЕКСТ");
			return false;
		}
		if (document.custinfo_form.anonce_nov.value=="")	{
			alert("Заполните поле формы - АНОНС");
			return false;
		}
		return true;
	}
</script>

<h2>Редактирование статьи: &laquo;<?=$row_news['head_nov']?>&raquo;.</h2>
<h3>Заполните необходимые данные!</h3>
<p>Поля, помеченные &laquo;<span class="zvezd">*</span>&raquo; - обязательны для заполнения.</p><hr><br>

<form method="post" enctype="multipart/form-data" name="custinfo_form" onSubmit="return validate_custinfo(this);">

	<p>Дата:<br>
	<span class="form_rem">* - Если обнулить, автоматически загрузится текущая дата.</span><br>
		<input type="date" name="date_nov" value="<?=date("Y-m-d", strtotime($row_news['date_nov']))?>" onkeypress="if(event.keyCode == 13) return false;">
	</p>

	<br>

	<p>Заголовок (до 200 знаков): <span class="zvezd">*</span><br>
		<input type="text" name="head_nov" value="<?=$row_news['head_nov']?>" size="100" maxlength="200" onkeypress="if(event.keyCode == 13) return false;">
	</p>

	<br>

	<p>Псевдоним (до 200 знаков):<br>
	<span class="form_rem">* - ОСТАВЬТЕ ПУСТЫМ, будет создан автоматически.</span><br>
		<input type="text" name="alias_nov" value="<?=$row_news['alias_nov']?>" size="100"  maxlength="200" onkeypress="if(event.keyCode == 13) return false;">
	</p>

	<br>

	<p>Текст: <span class="zvezd">*</span><br>
		<textarea name="text_nov" id="editor" cols="100" rows="5"><?=$row_news['text_nov']?></textarea>
	</p>
	<script>CKEDITOR.replace( 'editor' ); </script>

	<br>

	<p>Анонс: <span class="zvezd">*</span><br>
		<textarea name="anonce_nov" id="editor2" cols="100" rows="5"><?=$row_news['anonce_nov']?></textarea>
	</p>
	<script>CKEDITOR.replace( 'editor2' ); </script>

	<br>

	<p>Title (заколовок на ярлыке) страницы (до 150 знаков):<br>
	<span class="form_rem">* - Требуется для тега title. <strong>Можно оставить пустым</strong>, будет формироваться автоматически.</span><br>
		<input name='title_nov' size="100" value="<?=$row_news['title_nov']?>" maxlength="150" onkeypress="if(event.keyCode == 13) return false;">
	</p>

	<br>

	<p>Description (краткое описание) страницы (до 300 знаков):<br>
		<textarea name="desc_nov" cols="100" rows="5" maxlength="300"><?=$row_news['desc_nov']?></textarea>
	</p>

	<br>

	<p>Изображение для анонса новости:<br>
	<br>Текущее изображение:<br><img src='../img/<?=$row_news['pic_nov']?>'><br><br>
	Выберите изображение (формат .jpg, .jpeg, .gif, .png, не более 5 мегабайт, размер 350х250px или более в пропорции.):<br>
	<span class="form_rem">* - не загружайте, если текущее изображение актуально.</span><br>
		<input type="file" name="upfl" onkeypress="if(event.keyCode == 13) return false;">
	</p>

	<br>
  
	<p>Отображение:<br>
	<span class="form_rem">* - При значении &laquo;скрыто&raquo; будет загружено в базу данных, но не видно для посетителей.</span><br>
		<select name="show_nov">
			<option value=1 selected>опубликовано</option>
			<option value=0>скрыто</option>
		</select>
	</p>

	<br>

	<p>
		<input type="submit" name="save_nov" value="Подтвердить">
	</p>

</form>
<?php
	}
}
else {
	// проверка глобальных переменных и перезапись в обычные
	if (isset($_POST['head_nov']))	{$head_nov = mb_substr(htmlspecialchars(trim($_POST['head_nov']), ENT_QUOTES, 'utf-8'), 0, 400);	unset($_POST['head_nov']);}
	if (isset($_POST['alias_nov']))		{$alias_nov = mb_substr(htmlspecialchars(trim($_POST['alias_nov']), ENT_QUOTES, 'utf-8'), 0, 400);	unset($_POST['alias_nov']);}
	if (isset($_POST['text_nov']))		{$text_nov = mb_substr(mysqli_real_escape_string($db, trim($_POST['text_nov'])), 0, 15000);	unset($_POST['text_nov']);}
	if (isset($_POST['anonce_nov']))	{$anonce_nov = mb_substr(mysqli_real_escape_string($db, trim($_POST['anonce_nov'])), 0, 600);	unset($_POST['anonce_nov']);}
	if (isset($_POST['title_nov']))		{$title_nov = mb_substr(htmlspecialchars(trim($_POST['title_nov']), ENT_QUOTES, 'utf-8'), 0, 300);	unset($_POST['title_nov']);}
	if (isset($_POST['desc_nov']))		{$desc_nov = mb_substr(htmlspecialchars(trim($_POST['desc_nov']), ENT_QUOTES, 'utf-8'), 0, 600);	unset($_POST['desc_nov']);}
	if (isset($_POST['show_nov']))		{$show_nov = intval($_POST['show_nov']);	unset($_POST['show_nov']);}
	if (isset($_POST['date_nov']))	{$date_nov = substr(htmlspecialchars(trim($_POST['date_nov']), ENT_QUOTES, 'utf-8'), 0, 40);	unset($_POST['date_nov']);}

	// проверка на дубль
	$res_dub_nov = mysqli_query ($db, "SELECT id_nov FROM news WHERE (id_nov != $nov && head_nov = '$head_nov')");
	$row_dub_nov = mysqli_fetch_array ($res_dub_nov);
	if(!empty($row_dub_nov)) exit("<p style='color:red;'>Новость с заголовком <strong>&laquo;$head_nov&raquo;</strong> уже существует! Дайте другой заголовок или обратитесь к разработчику.<br><br><input type='button' onClick='history.go(-1)' value='Вернуться'></p>");

	// назначаем дату, если пришла пустая
	if(empty($date_nov)) $date_nov = date("Y-m-d");

	// загружаем изображение
	if (is_uploaded_file($_FILES['upfl']['tmp_name'])) {
		// исходные параметры
		$raz_fl = 5000000; // максимальный размер файла в байтах
		$gor_stor_sm = "350"; // желаемая ширина маленького файла
		$ver_stor_sm = "250"; // желаемая высота маленького файла
		$file_srs = $_FILES['upfl']['tmp_name']; // исходный файл с изображением
		$path_im = '../img'; // путь к папке с изображениями
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
			// для маленького изображения
			$small_pic = imagecreatetruecolor($gor_stor_sm, $ver_stor_sm);  
			imagecopyresampled($small_pic, $image, 0, 0, 0, 0, $gor_stor_sm, $ver_stor_sm, $width_orig, $height_orig);
			imagejpeg($small_pic, $path_im."/novost_".$nov.".jpg");
			// определяем имена загруженных файлов для таблицы бд
			$s_pic = "novost_".$nov.".jpg";
			break;  

			case "image/gif":	
			$image = imagecreatefromgif($file_srs);  
			// для маленького изображения
			$small_pic = imagecreatetruecolor($gor_stor_sm, $ver_stor_sm);  
			imagecopyresampled($small_pic, $image, 0, 0, 0, 0, $gor_stor_sm, $ver_stor_sm, $width_orig, $height_orig);
			imagegif($small_pic, $path_im."/novost_".$nov.".gif");
			// определяем имена загруженных файлов для таблицы бд
			$s_pic = "novost_".$nov.".gif";
			break;  

			case "image/png":
			$image = imagecreatefrompng($file_srs);  
			// для маленького изображения
			$small_pic = imagecreatetruecolor($gor_stor_sm, $ver_stor_sm);  
			imagealphablending($small_pic, false);
			imagesavealpha($small_pic, true);
			imagecopyresampled($small_pic, $image, 0, 0, 0, 0, $gor_stor_sm, $ver_stor_sm, $width_orig, $height_orig);
			imagepng($small_pic, $path_im."/novost_".$nov.".png");
			// определяем имена загруженных файлов для таблицы бд
			$s_pic = "novost_".$nov.".png";
			break;  

			default:
			die("Не удалось создать изображение.");
		}
		// формируем параметр для запроса
		$pic_querry = ", pic_nov = '$s_pic'"; 
	}
	else $pic_querry = "";

	// формируем псевдоним
	// транслитерация псевдонима, перевод в нижний регистр
	$rus = array('А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ё', 'Ж', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф', 'Х', 'Ц', 'Ч', 'Ш', 'Щ', 'Ъ', 'Ы', 'Ь', 'Э', 'Ю', 'Я', 'а', 'б', 'в', 'г', 'д', 'е', 'ё', 'ж', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф', 'х', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ы', 'ь', 'э', 'ю', 'я', '?', '«', '»');
	$lat = array('A', 'B', 'V', 'G', 'D', 'E', 'Yo', 'Zh', 'Z', 'I', 'Y', 'K', 'L', 'M', 'N', 'O', 'P', 'R', 'S', 'T', 'U', 'F', 'H', 'Ts', 'Ch', 'Sh', 'Sch', '', 'I', '', 'E', 'Yu', 'Ya', 'a', 'b', 'v', 'g', 'd', 'e', 'yo', 'zh', 'z', 'i', 'y', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'h', 'ts', 'ch', 'sh', 'sch', '', 'i', '', 'e', 'yu', 'ya', '', '', '');
	if (empty($alias_nov)) {
		$alias_nov = str_replace(" ", "-", strtolower(str_replace($rus, $lat, $head_nov)));
	}
	else {
		$alias_nov = str_replace(" ", "-", strtolower(str_replace($rus, $lat, $alias_nov)));
	}

	// записываем в базу данных
	$res = mysqli_query ($db, "UPDATE news SET date_nov='$date_nov', head_nov='$head_nov', alias_nov='$alias_nov', text_nov='$text_nov', anonce_nov='$anonce_nov', title_nov='$title_nov', desc_nov='$desc_nov', show_nov=$show_nov{$pic_querry} WHERE id_nov=$nov");
	if ($res) {echo "<p>Статья <strong>&laquo;{$head_nov}&raquo;</strong> обновлена!</p>";} 
}
?>
