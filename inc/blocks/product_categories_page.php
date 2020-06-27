<?php
// проверяем легальность загрузки файла
if(!defined('CONTROL_INC')) {
	$protocol = stripos($_SERVER['SERVER_PROTOCOL'],'https') === true ? 'https://' : 'http://';
	header ("Location: $protocol$_SERVER[SERVER_NAME]");
	exit;
}
// выводим линию ссылок
require_once ("inc/blocks/url_line.php");
?>
<article>
	<div class="product-page">
		<div class="left-side">
		</div>
		<div class="product-page_wrapper">
			<div class="product-page_menu-block mobile-disable">
			</div>
			<div class="product-page_subcat-block">
<?php
// определяем алиас раздела
$res_cat = mysqli_query ($db, "SELECT name_cat, pic_cat, alias_cat FROM product_categories WHERE parent_cat = 0 && visible_cat = 1 ORDER BY order_cat");
$row_cat = mysqli_fetch_array ($res_cat);
if(!empty($row_cat)) {
	do {
?>
				<div class="product-page_subcat-element">
					<a href="<?=$row_main_cat['alias_main_cat']?>/<?=$row_cat['alias_cat']?>" title="Открыть побробно - &laquo;<?=$row_cat['name_cat']?>&raquo;">
						<p><?=$row_cat['name_cat']?></p>
						<img src="img/<?=$row_cat['pic_cat']?>" alt="<?=$row_cat['name_cat']?>">
					</a>
				</div>
<?php
	}
	while ($row_cat = mysqli_fetch_array ($res_cat));
}
?>
			</div>
		</div>
		<div class="right-side">
		</div>
	</div>
</article>
