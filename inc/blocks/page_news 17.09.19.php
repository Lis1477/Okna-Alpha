<?php
// проверяем легальность загрузки файла
if(!defined('CONTROL_INC')) {
	$protocol = stripos($_SERVER['SERVER_PROTOCOL'],'https') === true ? 'https://' : 'http://';
	header ("Location: $protocol$_SERVER[SERVER_NAME]");
	exit;
}
if(!isset($query_array[1])) {
// выводим строку ссылок
	require_once ("inc/blocks/url_line.php");
// выводим анонсы новостей
?>
<article>
	<div class="container">
<?php
	// вызываем данные новостей из базы
	$res_news = mysqli_query ($db, "SELECT * FROM news WHERE show_nov = 1 ORDER BY date_nov DESC LIMIT 20");
	$row_news = mysqli_fetch_array ($res_news);
	if(!empty($row_news)) {
		do {
?>
		<div class="news-block_element">
			<a href="<?=$query_array[0]?>/<?=$row_news['alias_nov']?>" title="Читать далее статью &laquo;<?=$row_news['head_nov']?>&raquo;">
				<div class="news-block_pic"><img src="img/<?=$row_news['pic_nov']?>"></div>
				<div class="news-block_text">
					<div class="data"><?=date("d.m.Y", strtotime($row_news['date_nov']))?></div>
					<h2><?=$row_news['head_nov']?></h2>
					<?=$row_news['anonce_nov']?>
				</div>
			</a>
		</div>
<?php
		}
		while($row_news = mysqli_fetch_array ($res_news));
	}
	else echo "<p>Пока новостей нет.</p>";
?>
	</div>
</article>
<?php
}
// выводим статью
else {
	// для строки ссылок
	$row_cat['name_cat'] = $row_news['head_nov'];
	$url_line = "<a href='{$query_array[0]}'>Статьи</a> <span>/</span> {$row_news['head_nov']}";
	// выводим строку ссылок
	require_once ("inc/blocks/url_line.php");

	// выводим текст статьи
?>
<article>
	<div class="container text">
		<div class="txt_data"><?=date("d.m.Y", strtotime($row_news['date_nov']))?></div>
		<h1><?=$row_news['head_nov']?></h1>
		<?=$row_news['text_nov']?>
	</div>
</article>
<?php
}
?>
