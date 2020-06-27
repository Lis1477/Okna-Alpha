<?php
// проверяем легальность загрузки файла
if(!defined('CONTROL_INC')) {
	$protocol = stripos($_SERVER['SERVER_PROTOCOL'],'https') === true ? 'https://' : 'http://';
	header ("Location: $protocol$_SERVER[SERVER_NAME]");
	exit;
}

if (!isset($_POST['new_cat'])) 	{
	// выводим форму
?>
<script>
	function validate_custinfo()	{ //валидация формы
		if (document.custinfo_form.name_cat.value=="")	{
			alert("Заполните поле формы - ИМЯ ПОДРАЗДЕЛА");
			return false;
		}
		if (document.custinfo_form.parent_cat.value=="")	{
			alert("Выберите ПОДЧИНЕНИЕ");
			return false;
		}
		if (document.custinfo_form.upfl.value=="" && document.custinfo_form.parent_cat.value==0)	{
			alert("Для материнского раздела необходимо ЗАГРУЗИТЬ ИЗОБРАЖЕНИЕ");
			return false;
		}
		if (document.custinfo_form.text_cat.value=="")	{
			alert("Заполните поле формы - ТЕКСТ");
			return false;
		}
		return true;
	}
</script>

<h2>Введите данные для нового раздела:</h2>
<p>Поля, помеченные &laquo;<span class='zvezd'>*</span>&raquo; - обязательны для заполнения.</p>
<hr>

<form method='post' enctype='multipart/form-data' name='custinfo_form' onSubmit='return validate_custinfo(this);'>

	<p>Имя раздела (до 100 знаков): <span class="zvezd">*</span><br>
		<input type='text' name='name_cat' size='100'  maxlength='100' onkeypress='if(event.keyCode == 13) return false;'>
	</p>

	<br>

	<p>Псевдоним (до 100 знаков):<br>
	<span class="form_rem">* - ОСТАВЬТЕ ПУСТЫМ, будет создан автоматически.</span><br>
		<input type='text' name='alias_cat' size='100'  maxlength='100' onkeypress='if(event.keyCode == 13) return false;'>
	</p>

	<br>

	<p>Подчинение:<br>
		<select name='parent_cat'>
			<option value="" selected>- Выберите подчинение</option>
			<option value="0">0 - Материнский раздел</option>
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

	<p>Выберите и загрузите изображение:<br>
	<span class="form_rem"> - <span style='color:red; font-weight:bold;'>Внимание!</span> Если раздел материнский, загрузка изображения обязательна!<br>Если раздел подчиненный и изображение не загружено, при отображении будет использовано изображение материнского раздела.<br>(формат .jpg, .jpeg, .gif, .png, не более 5 мегабайт, размер 1200х375px или более в пропорции.):</span><br>
		<input type='file' name='upfl'>
  </p>

	<br>

	<p>Текст: <span class="zvezd">*</span><br>
		<textarea name='text_cat' id='editor'cols='100' rows='10'></textarea>
	<script>CKEDITOR.replace( 'editor' ); </script>
	</p>

	<br>

	<p>Заголовок (на ярлыке) страницы (до 150 знаков):<br>
	<span class="form_rem">* - Требуется для тега title. <strong>Можно оставить пустым</strong>, будет формироваться автоматически.</span><br>
		<input name='title_cat' size="100"  maxlength="150" onkeypress="if(event.keyCode == 13) return false;">
	</p>

	<br>

	<p>Краткое описание (до 300 знаков):<br>
	<span class='form_rem'>* - Краткое описание должно содержать &laquo;главную мысль&raquo; страницы. Требуется только для тега description с целью лучшего отображения в поиске и продвижения в поисковых системах. Можно оставлять пустым.</span><br>
		<textarea name='desc_cat' cols='100' rows='5' maxlength='300'></textarea>
	</p>

	<br>

	<p>Вес:<br>
	<span class='form_rem'>* - Влияет на порядок выдачи в меню. Чем выше значение, тем больше вес и тем ниже опускается в выдаче.</span><br>
		<input type='number' name='order_cat' min='1' max='99' value='1' style='width:40px;' onkeypress='if(event.keyCode == 13) return false;'>
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
		<input type='submit' name='new_cat' value='Подтвердить'>
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
		$res_dub = mysqli_query ($db, "SELECT id_cat FROM product_categories WHERE name_cat = '$name_cat'");
		$row_dub = mysqli_fetch_array ($res_dub);
		if(!empty($row_dub)) exit("<p style='color:red;'>Подраздел с таким именем уже существует! Дайте другое имя или обратитесь к разработчику.<br><br><input type='button' onClick='history.go(-1)' value='Вернуться'></p>");

		// формируем псевдоним вкладки
		// транслитерация псевдонима, перевод в нижний регистр
		$rus = array('А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ё', 'Ж', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф', 'Х', 'Ц', 'Ч', 'Ш', 'Щ', 'Ъ', 'Ы', 'Ь', 'Э', 'Ю', 'Я', 'а', 'б', 'в', 'г', 'д', 'е', 'ё', 'ж', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф', 'х', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ы', 'ь', 'э', 'ю', 'я', '?');
		$lat = array('A', 'B', 'V', 'G', 'D', 'E', 'Yo', 'Zh', 'Z', 'I', 'Y', 'K', 'L', 'M', 'N', 'O', 'P', 'R', 'S', 'T', 'U', 'F', 'H', 'Ts', 'Ch', 'Sh', 'Sch', '', 'I', '', 'E', 'Yu', 'Ya', 'a', 'b', 'v', 'g', 'd', 'e', 'yo', 'zh', 'z', 'i', 'y', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'h', 'ts', 'ch', 'sh', 'sch', '', 'i', '', 'e', 'yu', 'ya', '');
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
		}
		// если картинка не загружена - делаем пустую переменную
		else $pic = "";

		// записываем в базу данных
		$res = mysqli_query ($db, "INSERT INTO product_categories (name_cat, alias_cat, parent_cat, text_cat, title_cat, desc_cat, order_cat, visible_cat, pic_cat) VALUES ('$name_cat', '$alias_cat', $parent_cat, '$text_cat', '$title_cat', '$desc_cat', $order_cat, $visible_cat, '$pic')");
		if ($res) echo "<p>Раздел <strong>&laquo;$name_cat&raquo;</strong> создан!</p>";
		else exit("<p style='color:red;'>Упс.. Подраздел создать не удалось! Попробуйте еще раз или обратитесь к разработчику.</p>");
	}
?>
