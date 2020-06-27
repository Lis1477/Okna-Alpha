<?php
// проверяем легальность загрузки файла
if(!defined('CONTROL_INC')) {
	$protocol = stripos($_SERVER['SERVER_PROTOCOL'],'https') === true ? 'https://' : 'http://';
	header ("Location: $protocol$_SERVER[SERVER_NAME]");
	exit;
}

if (!isset($raz))
{
	echo "
<h2>Выберите раздел для добавления материала.</h2>
<hr>
	";
	// выводим главные категории
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
	<p>&nbsp;&nbsp;&nbsp;&nbsp;<a href='index.php?dobart=1&raz=".$row_subcat['id_cat']."'>".$row_subcat['name_cat']."</a></p>
			";
		}
		while ($row_subcat = mysqli_fetch_array ($res_subcat));
	}
	while ($row_maincat = mysqli_fetch_array ($res_maincat));
}
else
{
	if (!isset($_POST['save_art']))
	{
?>
<script>
	function validate_custinfo()	{ //валидация формы
		if (document.custinfo_form.name_art.value=="")	{
			alert("Заполните поле формы - ИМЯ ВКЛАДКИ");
			return false;
		}
		if (document.custinfo_form.text_art.value=="")	{
			alert("Заполните поле формы - ТЕКСТ");
			return false;
		}
		return true;
	}
</script>

<h2>Заполните необходимые данные!</h2>
<p>Поля, помеченные &laquo;<span class='zvezd'>*</span>&raquo; - обязательны для заполнения.</p><hr>

<form method='post' name='custinfo_form' onSubmit='return validate_custinfo(this);'>

	<p>Имя вкладки (до 100 знаков): <span class='zvezd'>*</span><br>
		<input type='text' name='name_art' size='100' maxlength='100' onkeypress='if(event.keyCode == 13) return false;'>
	</p>

	<br>

	<p>Псевдоним (до 100 знаков):<br>
	<span class='form_rem'>* - ОСТАВЬТЕ ПУСТЫМ, будет создан автоматически.</span><br>
		<input type='text' name='alias_art' size='100'  maxlength='100' onkeypress='if(event.keyCode == 13) return false;'>
	</p>

	<br>

	<p>Текст: <span class='zvezd'>*</span><br>
		<textarea name='text_art' id='editor' cols='100' rows='5'></textarea>
	</p>
	<script>CKEDITOR.replace( 'editor' ); </script>

	<br>

	<p>Заголовок (на ярлыке) страницы (до 150 знаков):<br>
	<span class="form_rem">* - Требуется для тега title. <strong>Можно оставить пустым</strong>, будет формироваться автоматически.</span><br>
		<input name='title_art' size="100"  maxlength="150" onkeypress="if(event.keyCode == 13) return false;">
	</p>

	<br>

	<p>Краткое описание (до 300 знаков):<br>
	<span class='form_rem'>* - Краткое описание должно содержать &laquo;главную мысль&raquo; страницы. Требуется только для тега description с целью лучшего отображения в поиске и продвижения в поисковых системах. Можно оставлять пустым.</span><br>
		<textarea name='desc_art' cols='100' rows='5' maxlength='300'></textarea>
	</p>

	<br>

	<p>Ключевые слова (фразы) (до 300 знаков):<br>
	<span class='form_rem'>* - Требуется только для тега keywords с целью продвижения в поисковых системах. Можно оставлять пустым.</span><br>
		<textarea name='key_art' cols='100' rows='5' maxlength='300'></textarea>
	</p>

	<br>

	<p>Вес:<br>
	<span class='form_rem'>* - Влияет на порядок выдачи в меню. Чем выше значение, тем больше вес и тем ниже опускается в выдаче.</span><br>
		<input type='number' name='order_art' min='1' max='99' value='1' style='width:40px;' onkeypress='if(event.keyCode == 13) return false;'>
	</p>

	<br>

	<p>Отображение:<br>
	<span class='form_rem'>* - При значении &laquo;скрыто&raquo; будет загружено в базу данных, но не видно для посетителей.</span><br>
		<select name='visible_art'>
			<option value='1' selected>опубликовано</option>
			<option value='0'>скрыто</option>
		</select>
	</p>

	<br>

	<p>
		<input type='submit' name='save_art' value='Подтвердить'>
	</p>

</form>
<?php
	}
	else {
		// проверка глобальных переменных и перезапись в обычные
		if (isset($_POST['name_art']))	{$name_art = substr(htmlspecialchars(trim($_POST['name_art']), ENT_QUOTES, 'cp1251'), 0, 100);	unset($_POST['name_art']);}
		if (isset($_POST['alias_art']))		{$alias_art = substr(htmlspecialchars(trim($_POST['alias_art']), ENT_QUOTES, 'cp1251'), 0, 100);	unset($_POST['alias_art']);}
		if (isset($_POST['text_art']))		{$text_art = substr(mysqli_real_escape_string($db, trim($_POST['text_art'])), 0, 15000);	unset($_POST['text_art']);}
		if (isset($_POST['title_art']))		{$title_art = substr(htmlspecialchars(trim($_POST['title_art']), ENT_QUOTES, 'cp1251'), 0, 150);	unset($_POST['title_art']);}
		if (isset($_POST['desc_art']))		{$desc_art = substr(htmlspecialchars(trim($_POST['desc_art']), ENT_QUOTES, 'cp1251'), 0, 300);	unset($_POST['desc_art']);}
		if (isset($_POST['key_art']))			{$key_art = substr(htmlspecialchars(trim($_POST['key_art']), ENT_QUOTES, 'cp1251'), 0, 300);	unset($_POST['key_art']);}
		if (isset($_POST['order_art']))			{$order_art = intval($_POST['order_art']);	unset($_POST['order_art']);}
		if (isset($_POST['visible_art']))		{$visible_art = intval($_POST['visible_art']);	unset($_POST['visible_art']);}

		// определяем имя и псевдоним родителя
		$res_famcat = mysqli_query ($db, "SELECT name_cat, alias_cat FROM categories WHERE id_cat = $raz");
		$row_famcat = mysqli_fetch_array ($res_famcat);

		// проверка на дубль
		$res_dub_art = mysqli_query ($db, "SELECT name_art FROM articles WHERE (category_art = $raz && name_art = '$name_art')");
		$row_dub_art = mysqli_fetch_array ($res_dub_art);
		if(!empty($row_dub_art)) exit("<p style='color:red;'>Материал с именем <strong>&laquo;$name_art&raquo;</strong> в подразделе <strong>&laquo;{$row_famcat['name_cat']}&raquo;</strong> уже существует! Дайте другое имя или обратитесь к разработчику.<br><br><input type='button' onClick='history.go(-1)' value='Вернуться'></p>");

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
		$alias_art = $row_famcat['alias_cat']."/".$alias_art;
			
		// записываем в базу данных
		$res = mysqli_query ($db, "INSERT INTO articles (name_art, alias_art, category_art, text_art, title_art, desc_art, key_art, order_art, visible_art) VALUES ('$name_art', '$alias_art', $raz, '$text_art', '$title_art', '$desc_art', '$key_art', $order_art, $visible_art)");
		if ($res) {echo "<p>Материал <strong>&laquo;$name_art&raquo;</strong> подраздела <strong>&laquo;{$row_famcat['name_cat']}&raquo;</strong> добавлен в базу данных!</p>";} 
	}
}
?>
