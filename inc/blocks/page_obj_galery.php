<?php
// проверяем легальность загрузки файла
if(!defined('CONTROL_INC')) {
	$protocol = stripos($_SERVER['SERVER_PROTOCOL'],'https') === true ? 'https://' : 'http://';
	header ("Location: $protocol$_SERVER[SERVER_NAME]");
	exit;
}

// формируем строку ссылок
$url_line = "<a href='".$row_main_cat['alias_main_cat']."'>".$row_main_cat['name_main_cat']."</a> <span>/</span> ".$row_gal['name_gal'];
// формируем заголовок
$row_cat['name_cat'] = $row_gal['name_gal'];

?>

<link rel='stylesheet prefetch' href='inc/css/jquery.fancybox.css'>


<?php
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
// выбираем изображения из базы 
$res_obj_gal = mysqli_query ($db, "SELECT * FROM {$row_gal['table_gal']} ORDER BY order_pic");
$row_obj_gal = mysqli_fetch_array ($res_obj_gal);

if(!empty($row_obj_gal)) {
do {
?>
		<div class="gallery-page_gallery-element">
			<a data-fancybox="images" data-caption="<?=$row_obj_gal['name_pic']?>" href="gal_img/<?=$row_obj_gal['big_pic']?>">
				<div class="gallery-page_address-obj"><p><?=$row_gal['adr_gal']?></p></div>
				<img src="gal_img/<?=$row_obj_gal['sm_pic']?>" title="<?=$row_obj_gal['name_pic']?>" alt="<?=$row_obj_gal['name_pic']?>">
				<div class="gallery-page_name-obj"><p><?=$row_obj_gal['name_pic']?></p></div>
			</a>
		</div>
<?php
}
while($row_obj_gal = mysqli_fetch_array ($res_obj_gal));
}
else echo "<p style='font-size:1.3em; margin-bottom:15px;'>Галереи пока нет...</p>";
?>

			</div>
		</div>
		<div class="right-side">
		</div>
	</div>
</article>

<script src='inc/js/jquery.fancybox.js'></script>
<script>
$(function() {
$("[data-fancybox]").fancybox({loop:true});
});
</script>
