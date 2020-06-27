<?php
// проверяем легальность загрузки файла
if(!defined('CONTROL_INC')) {
	$protocol = stripos($_SERVER['SERVER_PROTOCOL'],'https') === true ? 'https://' : 'http://';
	header ("Location: $protocol$_SERVER[SERVER_NAME]");
	exit;
}

// выбираем из базы и выводим текст главной страницы
$res_main_page = mysqli_query ($db, "SELECT text_main_page FROM main_page");
$row_main_page = mysqli_fetch_array ($res_main_page);
?>
<article>
	<div class="main-page">
		<div class="main-page_pic-line">
			<div class="container main-pics">
				<img src="img/main_page_pic_1.jpg" alt="Изображение на главной 1"><img src="img/main_page_pic_2.jpg" alt="Изображение на главной 2"><img src="img/main_page_pic_3.jpg" alt="Изображение на главной 3">
			</div>
		</div>
		<div class="main-page_article">
			<div class="container text">
<?=$row_main_page['text_main_page']?>
			</div>
		</div>
	</div>
</article>