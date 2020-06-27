<?php
// проверяем легальность загрузки файла
if(!defined('CONTROL_INC')) {
	$protocol = stripos($_SERVER['SERVER_PROTOCOL'],'https') === true ? 'https://' : 'http://';
	header ("Location: $protocol$_SERVER[SERVER_NAME]");
	exit;
}
?>
<header>
	<div class="container header-items">
		<a href="<?=$main_url?>" title="На главную страницу" class="header_logo"><img src="img/okna-a_logo.png"></a>
		<div class="header_info-block">
			<div class="header_phone-block">
				<div class="header_phone-line">
<?php
// выбираем из базы и выводим номера телефонов в хэдере
$res_tel = mysqli_query ($db, "SELECT * FROM phones");
$row_tel = mysqli_fetch_array ($res_tel);
do {
	if($row_tel['id_tel'] == 2) continue;
?>
					<p class="header_phone-style"><img src="img/<?=$row_tel['ico_tel']?>"><a href="tel:<?=$row_tel['prefix_tel'].$row_tel['number_tel']?>"><?=$row_tel['prefix_tel']?> <span><?=$row_tel['number_tel']?></span></a></p>
<?php
}
while ($row_tel = mysqli_fetch_array ($res_tel));

// выбираем из базы и выводим email в хэдере
$res_mail = mysqli_query ($db, "SELECT * FROM mail");
$row_mail = mysqli_fetch_array ($res_mail);
?>
					<p class="header_phone-style"><img src="img/<?=$row_mail['ico_ml']?>"><a href="mailto:<?=$row_mail['value_ml']?>"><span><?=$row_mail['value_ml']?></span></a></p>
					<p class="social">
						<a href="https://www.facebook.com/oknaaMinsk/" class="sots_fb" title="Окна-А в Facebook" target="_blank"><img src="img/sots_sety_ico.png"></a><a href="https://www.instagram.com/okna_a.by/" class="sots_inst" title="Окна-А в Instagram" target="_blank"><img src="img/sots_sety_ico.png"></a>
					</p>
				</div>
				<div class="header_phone-line_empty-bl"></div>
			</div>
<?php
// выводим главное меню
require_once ("main_menu.php");
?>
		</div>
	</div>
    <hr>
</header>
<div class="empty-space"></div>