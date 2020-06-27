<?php
// проверяем легальность загрузки файла
if(!defined('CONTROL_INC')) {
	$protocol = stripos($_SERVER['SERVER_PROTOCOL'],'https') === true ? 'https://' : 'http://';
	header ("Location: $protocol$_SERVER[SERVER_NAME]");
	exit;
}


// выводим форму
if (!isset($_POST['red_glav'])) {
	$res_glav = mysqli_query ($db, "SELECT * FROM main_page");
	$row_glav = mysqli_fetch_array ($res_glav);
?>

<h2>Отредактируйте данные Главной страницы:</h2>
<hr>
<form method="post">

	<p>Текст:<br>
		<textarea name="text_main_page" id="editor" cols="100" rows="15"><?=$row_glav['text_main_page']?></textarea>
	<script>CKEDITOR.replace( 'editor' ); </script>
	</p>

	<br>
	<p>Заголовок (на ярлыке) страницы (до 150 знаков):<br>
	<span class="form_rem">* - Требуется для тега title. <strong>Можно оставить пустым</strong>, будет формироваться автоматически.</span><br>
		<input name="title_main_page" value="<?=$row_glav['title_main_page']?>" size="100"  maxlength="150" onkeypress="if(event.keyCode == 13) return false;">
	</p>

	<br>

	<p>Краткое описание (до 300 знаков):<br>
	<span class="form_rem">* - Краткое описание должно содержать &laquo;главную мысль&raquo; страницы. Требуется только для тега description с целью лучшего отображения в поиске и продвижения в поисковых системах. Можно оставить пустым.</span><br>
		<textarea name="desc_main_page" cols="100" rows="5" maxlength="300"><?=$row_glav['desc_main_page']?></textarea>
	</p>

	<br>

	<p>
		<input type='submit' name='red_glav' value='Подтвердить'>
	</p>

</form>

<?php
}
else {
// проверяем переменные
	if (isset($_REQUEST['text_main_page']))	{$text_main_page = substr(mysqli_real_escape_string($db, trim($_POST['text_main_page'])), 0, 30000);	unset($_REQUEST['text_main_page']);}
	if (isset($_REQUEST['title_main_page']))	{$title_main_page = substr(htmlspecialchars(trim($_POST['title_main_page']), ENT_QUOTES, 'utf-8'), 0, 300);	unset($_REQUEST['title_main_page']);}
	if (isset($_REQUEST['desc_main_page']))	{$desc_main_page = substr(htmlspecialchars(trim($_POST['desc_main_page']), ENT_QUOTES, 'utf-8'), 0, 600);	unset($_REQUEST['desc_main_page']);}

	// записываем в базу данных 
	$res = mysqli_query ($db, "UPDATE main_page SET text_main_page='$text_main_page', title_main_page='$title_main_page', desc_main_page='$desc_main_page' WHERE id_main_page = 1");
	echo "<p>Данные <strong>Главной страницы</strong> обновлены!</p>";
}
?>
