<?php
// проверяем легальность загрузки файла
if(!defined('CONTROL_INC')) {
	$protocol = stripos($_SERVER['SERVER_PROTOCOL'],'https') === true ? 'https://' : 'http://';
	header ("Location: $protocol$_SERVER[SERVER_NAME]");
	exit;
}

if (!isset($art)) {
	echo "
<h2>Для редактирования материала, жмите на соответствующий.</h2>
<h3>Материал типа &laquo;Описание&raquo; редактируется при редактировании подраздела.</h3>
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

			do {
				echo "
	<p style='color:#106DCE;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong><a href='index.php?redart=1&art=".$row_mat['id_art']."'>".$row_mat['name_art']."</strong></a></p>
				";
			}
			while ($row_mat = mysqli_fetch_array ($res_mat));
		}
		while ($row_subcat = mysqli_fetch_array ($res_subcat));

		echo "<br>";
	}
	while ($row_maincat = mysqli_fetch_array ($res_maincat));
}
else {
	if (!isset($_POST['red_art']))	{
		// вызываем данные материала из базы
		$res_mat = mysqli_query ($db, "SELECT * FROM articles WHERE id_art = $art");
		$row_mat = mysqli_fetch_array ($res_mat);
		
		// выделяем псевдоним материала
		$alias_array = explode("/", $row_mat['alias_art']);
		$alias_art = $alias_array[2]; 

		// узнаем имя родительского подраздела
		$res_cat = mysqli_query ($db, "SELECT name_cat FROM categories WHERE id_cat = {$row_mat['category_art']}");
		$row_cat = mysqli_fetch_array ($res_cat);

		echo "
<h2>Отредактируйте текст и данные материала &laquo;".$row_mat['name_art']."&raquo; подраздела <strong>&laquo;".$row_cat['name_cat']."&raquo;</strong>:</h2>
<hr>

<form method='post'>

	<p>Имя вкладки:<br>
		<input type='text' name='name_art' value='".$row_mat['name_art']."' size='100' maxlength='100' onkeypress='if(event.keyCode == 13) return false;'>
	</p>

	<br>

	<p>Псевдоним:<br>
	<span class='form_rem'>* - Псевдоним используется для формирования ссылки на страницу. Оставьте поле пустым, чтобы сформировать автоматически.</span><br>
		<input type='text' name='alias_art' value='".$alias_art."' size='100' maxlength='100' onkeypress='if(event.keyCode == 13) return false;'>
	</p>

	<br>

	<p>Текст:<br>
		<textarea name='text_art' id='editor'cols='100' rows='10'>".$row_mat['text_art']."</textarea>
	</p>

<script>
	CKEDITOR.replace('editor');
</script>

	<br>

	<p>Заголовок (на ярлыке) страницы (до 150 знаков):<br>
	<span class='form_rem'>* - Требуется для тега title. <strong>Можно оставить пустым</strong>, будет формироваться автоматически.</span><br>
		<input type='text' name='title_art' value='".$row_mat['title_art']."' size='100'  maxlength='150' onkeypress='if(event.keyCode == 13) return false;'>
	</p>

	<br>

	<p>Краткое описание (до 300 знаков):<br>
	<span class='form_rem'>* - Краткое описание должно содержать &laquo;главную мысль&raquo; страницы. Требуется только для тега description с целью лучшего отображения в поиске и продвижения в поисковых системах. Можно оставлять пустым.</span><br>
		<textarea name='desc_art' cols='100' rows='5' maxlength='300'>".$row_mat['desc_art']."</textarea>
	</p>

	<br>

	<p>Ключевые слова (фразы) (до 300 знаков):<br>
	<span class='form_rem'>* - Требуется только для тега keywords с целью продвижения в поисковых системах. Можно оставлять пустым.</span><br>
		<textarea name='key_art' cols='100' rows='5' maxlength='300'>".$row_mat['key_art']."</textarea>
	</p>

	<br>

	<p>Вес:<br>
	<span class='form_rem'>* - Влияет на порядок выдачи в меню. Чем выше значение, тем больше вес и тем ниже опускается в выдаче.</span><br>
		<input type='number' name='order_art' value='".$row_mat['order_art']."' min='1' max='99' style='width:40px' onkeypress='if(event.keyCode == 13) return false;'>
	</p>

	<br>

	<p>Отображение:<br>
	<span class='form_rem'>* - При значении &laquo;скрыто&raquo; не будет видно для посетителей. Но из базы не удаляется.</span><br>
		<select name='visible_art'>
			<option value='1' selected>опубликовано</option>
			<option value='0'>скрыто</option>
		</select>
	</p>

	<br>

	<p>
		<input type='submit' name='red_art' value='Подтвердить'>
	</p>

</form>
		";
	}
	else {
		//проверяем переменные
		if (isset($_POST['name_art']))	{$name_art = substr(htmlspecialchars(trim($_POST['name_art']), ENT_QUOTES, 'cp1251'), 0, 100);	unset($_POST['name_art']);}
		if (isset($_POST['alias_art']))		{$alias_art = substr(htmlspecialchars(trim($_POST['alias_art']), ENT_QUOTES, 'cp1251'), 0, 100);	unset($_POST['alias_art']);}
		if (isset($_POST['text_art']))		{$text_art = substr(mysqli_real_escape_string($db, trim($_POST['text_art'])), 0, 15000);	unset($_POST['text_art']);}
		if (isset($_POST['title_art']))		{$title_art = substr(htmlspecialchars(trim($_POST['title_art']), ENT_QUOTES, 'cp1251'), 0, 150);	unset($_POST['title_art']);}
		if (isset($_POST['desc_art']))		{$desc_art = substr(htmlspecialchars(trim($_POST['desc_art']), ENT_QUOTES, 'cp1251'), 0, 300);	unset($_POST['desc_art']);}
		if (isset($_POST['key_art']))			{$key_art = substr(htmlspecialchars(trim($_POST['key_art']), ENT_QUOTES, 'cp1251'), 0, 300);	unset($_POST['key_art']);}
		if (isset($_POST['order_art']))			{$order_art = intval($_POST['order_art']);	unset($_POST['order_art']);}
		if (isset($_POST['visible_art']))		{$visible_art = intval($_POST['visible_art']);	unset($_POST['visible_art']);}

		// узнаем id родиительской категории
		$res_mat = mysqli_query ($db, "SELECT category_art FROM articles WHERE id_art = $art");
		$row_mat = mysqli_fetch_array ($res_mat);

		// узнаем имя и псевдоним родиительской категории
		$res_cat = mysqli_query ($db, "SELECT name_cat, alias_cat FROM categories WHERE id_cat = {$row_mat['category_art']}");
		$row_cat = mysqli_fetch_array ($res_cat);

		// проверка на дубль
		$res_dub_art = mysqli_query ($db, "SELECT name_art FROM articles WHERE (category_art = {$row_mat['category_art']} && id_art != $art && name_art = '$name_art')");
		$row_dub_art = mysqli_fetch_array ($res_dub_art);
		if(!empty($row_dub_art)) exit("<p style='color:red;'>Материал с именем <strong>&laquo;$name_art&raquo;</strong> в подразделе <strong>&laquo;{$row_cat['name_cat']}&raquo;</strong> уже существует! Дайте другое имя или обратитесь к разработчику.<br><br><input type='button' onClick='history.go(-1)' value='Вернуться'></p>");

		// формируем псевдоним вкладки
		// транслитерация псевдонима, перевод в нижний регистр
		$rus = array('А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ё', 'Ж', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф', 'Х', 'Ц', 'Ч', 'Ш', 'Щ', 'Ъ', 'Ы', 'Ь', 'Э', 'Ю', 'Я', 'а', 'б', 'в', 'г', 'д', 'е', 'ё', 'ж', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф', 'х', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ы', 'ь', 'э', 'ю', 'я');
		$lat = array('A', 'B', 'V', 'G', 'D', 'E', 'Yo', 'Zh', 'Z', 'I', 'Y', 'K', 'L', 'M', 'N', 'O', 'P', 'R', 'S', 'T', 'U', 'F', 'H', 'Ts', 'Ch', 'Sh', 'Sch', '', 'I', '', 'E', 'Yu', 'Ya', 'a', 'b', 'v', 'g', 'd', 'e', 'yo', 'zh', 'z', 'i', 'y', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'h', 'ts', 'ch', 'sh', 'sch', '', 'i', '', 'e', 'yu', 'ya');
		if (empty($alias_art)) {
			$alias_art = str_replace(" ", "-", strtolower(str_replace($rus, $lat, $name_art)));
		}
		else {
			$alias_art = str_replace(" ", "-", strtolower(str_replace($rus, $lat, $alias_art)));
		}

		// назначаем псевдоним для вкладки
		$alias_art = $row_cat['alias_cat']."/".$alias_art;

		// записываем данные из формы в базу данных
		$result = mysqli_query ($db, "UPDATE articles SET name_art='$name_art', alias_art='$alias_art', text_art='$text_art', title_art='$title_art', desc_art='$desc_art', key_art='$key_art', order_art=$order_art, visible_art=$visible_art WHERE id_art = $art");
		if ($result) echo "<p>Материал <strong>&laquo;$name_art&raquo;</strong> подраздела <strong>&laquo;".$row_cat['name_cat']."&raquo;</strong> обновлен!</p>";
		else echo "Упс... Что-то пошло не так. Попробуйте еще раз или обратитесь к разработчику.";
	}
}
?>
