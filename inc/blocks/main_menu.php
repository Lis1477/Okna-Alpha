<?php
// проверяем легальность загрузки файла
if(!defined('CONTROL_INC')) {
	$protocol = stripos($_SERVER['SERVER_PROTOCOL'],'https') === true ? 'https://' : 'http://';
	header ("Location: $protocol$_SERVER[SERVER_NAME]");
	exit;
}
// выбираем из базы и выводим главное меню в хэдере
$res_main_menu = mysqli_query ($db, "SELECT * FROM main_categories");
$row_main_menu = mysqli_fetch_array ($res_main_menu);
?>
			<nav class="header_main-menu-block" id='cssmenu'>
				<div id="head-mobile"></div> 
				<div class="button"><span>Меню</span></div> 
				<ul>
<?php
do {
	// параметр класса для активного каталога
	if(isset($id_main_cat) && $id_main_cat == $row_main_menu['id_main_cat']) $class_for_activ = ' class="activ_main_cat"';
	else $class_for_activ = "";
?>
					<li<?=$class_for_activ?>><a href="<?=$row_main_menu['alias_main_cat']?>" title="Открыть раздел &laquo;<?=$row_main_menu['name_main_cat']?>&raquo;"><?=$row_main_menu['name_main_cat']?></a></li>
<?php
}
while ($row_main_menu = mysqli_fetch_array ($res_main_menu));
?>
				</ul>
			</nav>
