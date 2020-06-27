<?php
// создаем константу для проверки инклюдов
define(CONTROL_INC, '');

// авторизуемся в базе данных
require_once ("conn/connectbd.php");

// авторизуем админа
require_once ("inc/lock/lock.php");

		error_reporting(E_ALL); 
		ini_set('display_errors', 'on');

// проверяем переменные
if (isset($_GET['raz']))			{$raz = intval($_GET['raz']); unset($_GET['raz']);}
if (isset($_GET['gal']))			{$gal = intval($_GET['gal']); unset($_GET['gal']);}
if (isset($_GET['nov']))			{$nov = intval($_GET['nov']); unset($_GET['nov']);}
if (isset($_GET['del']))			{$del = intval($_GET['del']); unset($_GET['del']);}
if (isset($_GET['adm']))			{$adm = intval($_GET['adm']); unset($_GET['adm']);}

if (isset($_GET['redglstr']))	{$redglstr = intval($_GET['redglstr']); unset($_GET['redglstr']);	if ($redglstr != 1){unset($redglstr);}}
if (isset($_GET['redglav']))	{$redglav = intval($_GET['redglav']); unset($_GET['redglav']);	if ($redglav != 1){unset($redglav);}}
if (isset($_GET['newraz']))		{$newraz = intval($_GET['newraz']); 	unset($_GET['newraz']);		if ($newraz != 1) {unset($newraz);}}
if (isset($_GET['delraz']))		{$delraz = intval($_GET['delraz']); 	unset($_GET['delraz']);		if ($delraz != 1) {unset($delraz);}}
if (isset($_GET['redraz']))		{$redraz = intval($_GET['redraz']); 	unset($_GET['redraz']);		if ($redraz != 1) {unset($redraz);}}
if (isset($_GET['newgal']))		{$newgal = intval($_GET['newgal']); 	unset($_GET['newgal']);		if ($newgal != 1) {unset($newgal);}}
if (isset($_GET['redgal']))		{$redgal = intval($_GET['redgal']); 	unset($_GET['redgal']);		if ($redgal != 1) {unset($redgal);}}
if (isset($_GET['sortgal']))	{$sortgal = intval($_GET['sortgal']); unset($_GET['sortgal']);	if ($sortgal != 1){unset($sortgal);}}
if (isset($_GET['delgal']))		{$delgal = intval($_GET['delgal']); 	unset($_GET['delgal']); 	if ($delgal != 1) {unset($delgal);}}	
if (isset($_GET['uplpic']))		{$uplpic = intval($_GET['uplpic']); 	unset($_GET['uplpic']);		if ($uplpic != 1) {unset($uplpic);}}
if (isset($_GET['dobnov']))		{$dobnov = intval($_GET['dobnov']); 	unset($_GET['dobnov']);		if ($dobnov != 1) {unset($dobnov);}}
if (isset($_GET['rednov']))		{$rednov = intval($_GET['rednov']); 	unset($_GET['rednov']);		if ($rednov != 1) {unset($rednov);}}
if (isset($_GET['delnov']))		{$delnov = intval($_GET['delnov']); 	unset($_GET['delnov']);		if ($delnov != 1) {unset($delnov);}}
if (isset($_GET['redkont']))	{$redkont = intval($_GET['redkont']); unset($_GET['redkont']);	if ($redkont != 1){unset($redkont);}}
if (isset($_GET['mapgen']))		{$mapgen = intval($_GET['mapgen']); 	unset($_GET['mapgen']);		if ($mapgen != 1) {unset($mapgen);}}
if (isset($_GET['dobadm']))		{$dobadm = intval($_GET['dobadm']); 	unset($_GET['dobadm']);		if ($dobadm != 1) {unset($dobadm);}}
if (isset($_GET['redadm']))		{$redadm = intval($_GET['redadm']); 	unset($_GET['redadm']);		if ($redadm != 1) {unset($redadm);}}
if (isset($_GET['deladm']))		{$deladm = intval($_GET['deladm']); 	unset($_GET['deladm']);		if ($deladm != 1) {unset($deladm);}}


?>
<!doctype html>
<html lang="ru">
<head>
<meta charset="utf-8">
<title>Панель администратора сайта BELROLLET.BY</title>
<link href="favicon.ico" rel="shortcut icon" type="image/x-icon">
<link href='inc/css/styles.css' rel='stylesheet' type='text/css'>
<script type='text/javascript' src='ckeditor/ckeditor.js'></script>
</head>
<body>

<div class="all">

	<!-- Блок Хэдера -->
	<header>
			<div class='logo'><img src="../img/okna-a_logo.png"></div>
			<div class='greeting'><h1><strong>Здравствуйте, <?=$nm_adm?></strong>!<br>Добро пожаловать в панель администратора.</h1></div>
	</header>

	<div class='tbl_2'>
		<div class='row_2'>
			<div class='cl_22'>
				<!-- Левый навигационный блок -->
				<h2>Главная страница:</h2>
				<h3><a href="index.php?redglstr=1">Редактировать</a></h3>
				<hr>
				<h2>Главные разделы:</h2>
				<h3><a href="index.php?redglav=1">Редактировать</a></h3>
				<hr>
				<h2>Продукция:</h2>
				<h3><a href="index.php?newraz=1">Создать раздел</a></h3>
				<h3><a href="index.php?redraz=1">Редактировать</a></h3>
				<h3><a href="index.php?delraz=1">Удалить</a></h3>
				<hr>
				<h2>Наши работы:</h2>
				<h3><a href="index.php?newgal=1">Создать галерею</a></h3>
				<h3><a href="index.php?redgal=1">Редактировать</a></h3>
				<h3><a href="index.php?sortgal=1">Сортировать</a></h3>
				<h3><a href="index.php?delgal=1">Удалить</a></h3>
				<br>
				<h3><a href="index.php?uplpic=1" title="Добавить-Редактировать-Удалить">Изображения</a></h3>
				<hr>
				<h2>Статьи:</h2>
				<h3><a href="index.php?dobnov=1">Создать</a></h3>
				<h3><a href="index.php?rednov=1">Редактировать</a></h3>
				<h3><a href="index.php?delnov=1">Удалить</a></h3>
				<hr>
				<h2>Контакты:</h2>
				<h3><a href="index.php?redkont=1">Редактировать</a></h3>
				<hr>
				<h3><a href="index.php?mapgen=1" title="Используйте всякий раз, когда добавляете или удаляете материалы и изображения">Генератор sitemap</a></h3>
<?php
$res_adm = mysqli_query ($db, "SELECT id_adm FROM adm WHERE nm_adm='$nm_adm'");
$row_adm = mysqli_fetch_array ($res_adm);
if ($row_adm['id_adm'] == 1 || $row_adm['id_adm'] == 2) {
?>
				<hr>
				<h2>Администраторы:</h2>
				<h3><a href="index.php?dobadm=1">Добавить</a></h3>
				<h3><a href="index.php?redadm=1">Смотреть<br>(редактировать)</a></h3>
				<h3><a href="index.php?deladm=1">Удалить</a></h3>
				<hr>
<?php
}
?>

			</div>

			<div class='cl_2'>
				<!-- Блок выдачи результатов запроса -->
<?php
// редактирование главной страницы
if (isset($redglstr)) {require_once ("inc/blocks/redglstr.php");}

// редактирование главных разделов
if (isset($redglav)) {require_once ("inc/blocks/redglav.php");}

// новый раздел
if (isset($newraz)) {require_once ("inc/blocks/newraz.php");}
// редактирование разделов
if (isset($redraz)) {require_once ("inc/blocks/redraz.php");}
// удаление разделов
if (isset($delraz)) {require_once ("inc/blocks/delraz.php");}

// добавление галереи
if (isset($newgal)) {require_once ("inc/blocks/newgal.php");}
// редактирование галереи
if (isset($redgal)) {require_once ("inc/blocks/redgal.php");}
// сортировка галереи
if (isset($sortgal)) {require_once ("inc/blocks/sortgal.php");}
// удаление галереи
if (isset($delgal)) {require_once ("inc/blocks/delgal.php");}

// добавление / удаление изображений
if (isset($uplpic)) {require_once ("inc/blocks/uplpic.php");}

// добавление новости
if (isset($dobnov)) {require_once ("inc/blocks/dobnov.php");}
// редактирование новости
if (isset($rednov)) {require_once ("inc/blocks/rednov.php");}
// удаление новости
if (isset($delnov)) {require_once ("inc/blocks/delnov.php");}

// редактируем контакты
if (isset($redkont)) {require_once ("inc/blocks/redkont.php");}

// генератор сайтмэп
if (isset($mapgen)) {require_once ("inc/blocks/mapgen.php");}

// добавление нового администратора
if (isset($dobadm)) {require_once ("inc/blocks/dobadm.php");}
// редактирование данных администратора
if (isset($redadm)) {require_once ("inc/blocks/redadm.php");}
// удаление администратора
if (isset($deladm)) {require_once ("inc/blocks/deladm.php");}
?>

			</div>
		</div>
	</div>
</div>

</body>
</html>