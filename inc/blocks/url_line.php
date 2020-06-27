<?php
// проверяем легальность загрузки файла
if(!defined('CONTROL_INC')) {
	$protocol = stripos($_SERVER['SERVER_PROTOCOL'],'https') === true ? 'https://' : 'http://';
	header ("Location: $protocol$_SERVER[SERVER_NAME]");
	exit;
}
?>

	<div class="url-line">
		<div class="container">
			<p><a href="<?=$main_url?>">Главная</a> <span>/</span> <?php if(!isset($query_array[1])) echo $row_main_cat['name_main_cat']; else echo $url_line;?></p>
		</div>
	</div>
