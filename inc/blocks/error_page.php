<?php
// проверяем легальность загрузки файла
if(!defined('CONTROL_INC')) {
	$protocol = stripos($_SERVER['SERVER_PROTOCOL'],'https') === true ? 'https://' : 'http://';
	header ("Location: $protocol$_SERVER[SERVER_NAME]");
	exit;
}
?>

<div class="text">
	<p class="error_str">Извините!<br><br>Страницы <strong>&laquo;<?=$_SERVER['SERVER_NAME']."/".$query?>&raquo;</strong><br><br>на нашем сайте нет!</p>
</div>