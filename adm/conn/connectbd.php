<?php
// проверяем легальность загрузки файла
if(!defined('CONTROL_INC')) {
	$protocol = stripos($_SERVER['SERVER_PROTOCOL'],'https') === true ? 'https://' : 'http://';
	header ("Location: $protocol$_SERVER[SERVER_NAME]");
	exit;
}
// Соединяемся с базой
$db=mysqli_connect("localhost","root","", 'okna-a')
or die("<p>В настоящее время сервер не доступен.<br>Отображение страницы не возможно.<br>Напишите об этом администратору <a href='mailto:info@okna-a.by'>info@okna-a.by</a></p>" .mysqli_error($db));

mysqli_query($db, "SET NAMES 'utf8' COLLATE 'utf8_general_ci'");
mysqli_query($db, "SET CHARACTER SET 'utf8'");
?>