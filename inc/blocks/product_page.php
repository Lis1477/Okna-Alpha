<?php
// проверяем легальность загрузки файла
if(!defined('CONTROL_INC')) {
	$protocol = stripos($_SERVER['SERVER_PROTOCOL'],'https') === true ? 'https://' : 'http://';
	header ("Location: $protocol$_SERVER[SERVER_NAME]");
	exit;
}
//выбираем данные продукции
if(!isset($query_array[2])) {
	// вызываем из базы данные продукции
	$res_subcat = mysqli_query ($db, "SELECT name_cat, parent_cat, text_cat, pic_cat, alias_cat FROM product_categories WHERE id_cat = $id_cat");
	$row_subcat = mysqli_fetch_array ($res_subcat);
	// определяем имя и ссылку родительского раздела
	$res_parentcat = mysqli_query ($db, "SELECT name_main_cat, alias_main_cat FROM main_categories WHERE id_main_cat = 1");
	$row_parentcat = mysqli_fetch_array ($res_parentcat);
	// формируем строку ссылок
	$url_line = "<a href='".$row_parentcat['alias_main_cat']."'>".$row_parentcat['name_main_cat']."</a> <span>/</span> ".$row_subcat['name_cat'];
	// переменная для текста
	$text_art = $row_subcat['text_cat'];
	// переменная для изображения текста
	$img_src = $row_subcat['pic_cat'];
	// переменная для класса активного меню
	$active_navart = " class='active-art'";
}
else {
	// формируем строку ссылок
	//вызываем из базы имя и ссылку главной категории
	$res_parentcat = mysqli_query ($db, "SELECT name_main_cat, alias_main_cat FROM main_categories WHERE id_main_cat = 1");
	$row_parentcat = mysqli_fetch_array ($res_parentcat);
	// формируем строку ссылок
	$url_line = "<a href='".$query_array[0]."'>".$row_parentcat['name_main_cat']."</a> <span>/</span> <a href='".$query_array[0]."/".$row_cat['alias_cat']."'>".$row_cat['name_cat']."</a> <span>/</span> ".$row_mat['name_cat'];
	// переменная для текста
	$text_art = $row_mat['text_cat'];
	// переменная для изображения текста
	if(!empty($row_mat['pic_cat'])) $img_src = $row_mat['pic_cat'];
	else $img_src = $row_cat['pic_cat'];
}
// выводим линию ссылок
require_once ("inc/blocks/url_line.php");
?>
<article>
	<div class="product-page">
		<div class="left-side">
		</div>
		<div class="product-page_wrapper">
			<div class="product-page_menu-block">
				<div id="sub_m">
				<nav class="product-page_subcategory-memu">
					<ul>
<?php
// формируем меню категорий раздела Продукция
	// выводим главные категории
$res_main_subcat = mysqli_query ($db, "SELECT id_cat, name_cat, parent_cat, text_cat, alias_cat FROM product_categories WHERE parent_cat = 0 && visible_cat = 1 ORDER BY order_cat");
$row_main_subcat = mysqli_fetch_array ($res_main_subcat);
if(!empty($row_main_subcat)) {
	do {
		// переменная для класса активного меню
		if(!empty($id_cat) && $row_main_subcat['id_cat'] == $id_cat) {$active_navcat = " class='active-cat'";} else {$active_navcat = "";}
?>
						<li<?=$active_navcat?>><a href="<?=$row_parentcat['alias_main_cat']?>/<?=$row_main_subcat['alias_cat']?>" title="Открыть подробно - &laquo;<?=$row_main_subcat['name_cat']?>&raquo;"><?=$row_main_subcat['name_cat']?></a></li>
<?php
	// выводим подкатегории
		if($id_cat == $row_main_subcat['id_cat']) {
			$res_subcat = mysqli_query ($db, "SELECT id_cat, name_cat, parent_cat, text_cat, alias_cat FROM product_categories WHERE parent_cat = '{$row_main_subcat['id_cat']}' && visible_cat = 1 ORDER BY order_cat");
			$row_subcat = mysqli_fetch_array ($res_subcat);
			if(!empty($row_subcat)) {
?>
							<ul>
<?php
				do {
					// переменная для класса активного меню
					if(!empty($id_mat) && $row_subcat['id_cat'] == $id_mat) {$active_navsubcat = " class='active-cat'";} else {$active_navsubcat = "";}
					// переменная для стиля цвета пункта "калькулятор"
					if($row_subcat['id_cat'] == 10) $calc_style = ' style="color:blue;"'; else $calc_style = "";
?>
								<li<?=$active_navsubcat?>><a href="<?=$row_parentcat['alias_main_cat']?>/<?=$row_main_subcat['alias_cat']?>/<?=$row_subcat['alias_cat']?>" title="Открыть подробно - &laquo;<?=$row_main_subcat['name_cat']?> - <?=$row_subcat['name_cat']?>&raquo;"<?=$calc_style?>><?=$row_subcat['name_cat']?></a></li>
<?php
				}
				while($row_subcat = mysqli_fetch_array ($res_subcat));
?>
							</ul>
<?php
			}
		}
	}
	while($row_main_subcat = mysqli_fetch_array ($res_main_subcat));
}
?>
					</ul>
				</nav>
				</div>
			</div>
			<div class="product-page_article-text">
				<img src="img/<?=$img_src?>">
				<div class="text">
<?php
echo $text_art;
// подключаем калькулятор на странице калькулятора
if(isset($id_mat) && $id_mat == 10) require_once ("calculator.php");
?>



				</div>
			</div>
		</div>
		<div class="right-side">
		</div>
	</div>
</article>

<script>
// скрипт для меню категорий
jQuery(function($) {
	        $(window).scroll(function(){
	            if($(this).scrollTop()>90){
	                $('#sub_m').addClass('fixed');
	            }
	            else if ($(this).scrollTop()<90){
	                $('#sub_m').removeClass('fixed');
	            }
	        });
	    });
</script>
