<?php
// проверяем легальность загрузки файла
if(!defined('CONTROL_INC')) {
	$protocol = stripos($_SERVER['SERVER_PROTOCOL'],'https') === true ? 'https://' : 'http://';
	header ("Location: $protocol$_SERVER[SERVER_NAME]");
	exit;
}

	echo "
<h2>Заполните необходимые данные!</h2><p>Поля, помеченные &laquo;<span class='zvezd'>*</span>&raquo; - обязательны для заполнения.</p><hr>

<form method='post'>

	<p>Имя вкладки (до 100 знаков): <span class='zvezd'>*</span><br>
		<input type='text' name='name_art' value='$name_art' size='100' maxlength='100' onkeypress='if(event.keyCode == 13) return false;'>
	";
	if (!isset($name_art)) {echo "<span style='color:red'> - введите в поле заголовок статьи</span><br>";}
	echo "
	</p>

	<br>

	<p>Псевдоним (до 100 знаков):<br>
	<span class='form_rem'>* - ОСТАВЬТЕ ПУСТЫМ, будет создан автоматически.</span><br>
		<input type='text' name='alias_art' value='$alias_art' size='100'  maxlength='100' onkeypress='if(event.keyCode == 13) return false;'>
	</p>

	<br>

	<p>Текст: <span class='zvezd'>*</span><br>
		<textarea name='text_art' id='editor' cols='100' rows='5'>$text_art</textarea>
	";
	if (!isset($text_art)) {echo "<span style='color:red'> - введите в поле текст статьи</span><br>";}
	echo "
	</p>
	<script>CKEDITOR.replace( 'editor' ); </script>

	<br>

	<p>Краткое описание (до 300 знаков):<br>
	<span class='form_rem'>* - Краткое описание должно содержать &laquo;главную мысль&raquo; страницы. Требуется только для тега description с целью лучшего отображения в поиске и продвижения в поисковых системах. Можно оставлять пустым.</span><br>
		<textarea name='desc_art' cols='100' rows='5' maxlength='300'>$desc_art</textarea>
	</p>

	<br>

	<p>Ключевые слова (фразы) (до 300 знаков):<br>
	<span class='form_rem'>* - Требуется только для тега keywords с целью продвижения в поисковых системах. Можно оставлять пустым.</span><br>
		<textarea name='key_art' cols='100' rows='5' maxlength='300'>$key_art</textarea>
	</p>

	<br>

	<p>Вес:<br>
	<span class='form_rem'>* - Влияет на порядок выдачи в меню. Чем выше значение, тем больше вес и тем ниже опускается в выдаче.</span><br>
		<input type='number' name='order_art' value='$order_art' min='1' max='99' style='width:40px;' onkeypress='if(event.keyCode == 13) return false;'>
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
	";
?>