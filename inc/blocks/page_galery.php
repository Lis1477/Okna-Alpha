<?php
// проверяем легальность загрузки файла
if(!defined('CONTROL_INC')) {
	$protocol = stripos($_SERVER['SERVER_PROTOCOL'],'https') === true ? 'https://' : 'http://';
	header ("Location: $protocol$_SERVER[SERVER_NAME]");
	exit;
}

// выводим строку ссылок и заголовок
require_once ("inc/blocks/url_line.php");
?>
<article>
	<div class="gallery-page">
		<div class="left-side">
		</div>
		<div class="gallery-page_wrapper">
			<div class="gallery-page_menu-block">
			</div>
			<div class="gallery-page_gallery-block">


<?php
// определяем алиас главной категории

// выводим главные изображения галерей
$res_main_gal = mysqli_query ($db, "SELECT name_gal, adr_gal, alias_gal, pic_gal FROM galleries WHERE show_gal = 1 ORDER BY order_gal");
$row_main_gal = mysqli_fetch_array ($res_main_gal);

if(!empty($row_main_gal)) {
	do {
?>
		<div class="gallery-page_gallery-element">
			<a href="<?=$query_array[0]?>/<?=$row_main_gal['alias_gal']?>" title="Открыть галерею объекта &laquo;<?=mb_strtoupper($row_main_gal['name_gal'], 'utf-8')?>&raquo;">
				<div class="gallery-page_address-obj"><p><?=$row_main_gal['adr_gal']?></p></div>
				<img src="gal_img/<?=$row_main_gal['pic_gal']?>" alt="<?=$row_main_gal['name_gal']?>">
				<div class="gallery-page_name-obj"><p><?=$row_main_gal['name_gal']?></p></div>
			</a>
		</div>
<?php
	}
	while($row_main_gal = mysqli_fetch_array ($res_main_gal));
}
else echo "<p>Галерей пока нет...</p>";
?>
			</div>
		</div>
		<div class="right-side">
		</div>
	</div>
</article>
