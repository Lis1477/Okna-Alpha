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
	$res_glav = mysqli_query ($db, "SELECT id_main_cat, name_main_cat FROM main_categories");
	$row_glav = mysqli_fetch_array ($res_glav);

	do {
		echo "
<h3><a href='index.php?redglav=1&raz=".$row_glav['id_main_cat']."'>".$row_glav['name_main_cat']."</a></h3>
		";
	}
	while ($row_glav = mysqli_fetch_array ($res_glav));
}
else {
	// выводим форму
	if (!isset($_POST['red_glav'])) {
		$res_glav = mysqli_query ($db, "SELECT * FROM main_categories WHERE id_main_cat=$raz");
		$row_glav = mysqli_fetch_array ($res_glav);
?>

<h2>Отредактируйте данные раздела &laquo;<?=$row_glav['name_main_cat']?>&raquo;:</h2>
<hr>
<form method="post">

	<p>Имя раздела:<br>
	<span class="form_rem">* - <span style="color:red; font-weight:bold;">Внимание!</span> Изменение имени раздела может негативно отразится на выводе главного меню на сайте! Для корректного изменения и отображения <span style="color:red; font-weight:bold;">обратитесь к разработчику</span>.</span><br>
		<input type="text" name="name_main_cat" value="<?=$row_glav['name_main_cat']?>" size="100"  maxlength="100" onkeypress="if(event.keyCode == 13) return false;">
	</p>

	<br>

	<p>Псевдоним:<br>
	<span class="form_rem">* - <span style="color:red; font-weight:bold;">Внимание!</span> Производить смену псевдонима НЕ РЕКОМЕНДУЕТСЯ! Корректировка повлечет за собой изменение псевдонимов всех подчиненных подразделов и материалов. Это негативно повлияет на рейтинг в поисковых системах в связи с переиндексацией новых (с точки зрения поиска) страниц.</span><br>
		<input type="text" name="alias_main_cat" value="<?=$row_glav['alias_main_cat']?>" size="100"  maxlength="100" onkeypress="if(event.keyCode == 13) return false;">
	</p>

	<br>

	<p>Заголовок (на ярлыке) страницы (до 150 знаков):<br>
	<span class="form_rem">* - Требуется для тега title. <strong>Можно оставить пустым</strong>, будет формироваться автоматически.</span><br>
		<input name="title_main_cat" value="<?=$row_glav['title_main_cat']?>" size="100"  maxlength="150" onkeypress="if(event.keyCode == 13) return false;">
	</p>

	<br>

	<p>Краткое описание (до 300 знаков):<br>
	<span class="form_rem">* - Краткое описание должно содержать &laquo;главную мысль&raquo; страницы. Требуется только для тега description с целью лучшего отображения в поиске и продвижения в поисковых системах. Можно оставить пустым.</span><br>
		<textarea name="desc_main_cat" cols="100" rows="5" maxlength="300"><?=$row_glav['desc_main_cat']?></textarea>
	</p>

	<br>

	<p>
		<input type='submit' name='red_glav' value='Подтвердить'>
	</p>

</form>

<?php
	}
	else {
		if (isset($_REQUEST['name_main_cat']))	{$name_main_cat = substr(htmlspecialchars(trim($_REQUEST['name_main_cat']), ENT_QUOTES, 'utf-8'), 0, 200);	unset($_REQUEST['name_main_cat']);}
		if (isset($_REQUEST['alias_main_cat'])){$alias_main_cat = substr(htmlspecialchars(trim($_REQUEST['alias_main_cat']), ENT_QUOTES, 'utf-8'), 0, 200);	unset($_REQUEST['alias_main_cat']);}
		if (isset($_REQUEST['title_main_cat'])){$title_main_cat = substr(htmlspecialchars(trim($_REQUEST['title_main_cat']), ENT_QUOTES, 'utf-8'), 0, 300);	unset($_REQUEST['title_main_cat']);}
		if (isset($_REQUEST['desc_main_cat']))	{$desc_main_cat = substr(htmlspecialchars(trim($_REQUEST['desc_main_cat']), ENT_QUOTES, 'utf-8'), 0, 600);	unset($_REQUEST['desc_main_cat']);}

		// формируем псевдоним раздела
		// транслитерация псевдонима, перевод в нижний регистр
		$rus = array('А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ё', 'Ж', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф', 'Х', 'Ц', 'Ч', 'Ш', 'Щ', 'Ъ', 'Ы', 'Ь', 'Э', 'Ю', 'Я', 'а', 'б', 'в', 'г', 'д', 'е', 'ё', 'ж', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф', 'х', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ы', 'ь', 'э', 'ю', 'я');
		$lat = array('A', 'B', 'V', 'G', 'D', 'E', 'Yo', 'Zh', 'Z', 'I', 'Y', 'K', 'L', 'M', 'N', 'O', 'P', 'R', 'S', 'T', 'U', 'F', 'H', 'Ts', 'Ch', 'Sh', 'Sch', '', 'I', '', 'E', 'Yu', 'Ya', 'a', 'b', 'v', 'g', 'd', 'e', 'yo', 'zh', 'z', 'i', 'y', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'h', 'ts', 'ch', 'sh', 'sch', '', 'i', '', 'e', 'yu', 'ya');
		if (empty($alias_cat)) {
			$alias_main_cat = str_replace(" ", "-", strtolower(str_replace($rus, $lat, $name_main_cat)));
		}
		else {
			$alias_main_cat = str_replace(" ", "-", strtolower(str_replace($rus, $lat, $alias_main_cat)));
		}

		// записываем в базу данных 
		// данные раздела
		$res = mysqli_query ($db, "UPDATE main_categories SET name_main_cat='$name_main_cat', alias_main_cat='$alias_main_cat', desc_main_cat='$desc_main_cat', title_main_cat='$title_main_cat' WHERE id_main_cat = $raz");
		echo "<p>Данные раздела <strong>&laquo;$name_main_cat&raquo;</strong> обновлены!</p>";
	}
}
?>
