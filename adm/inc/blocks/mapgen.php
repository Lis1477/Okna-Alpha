<?php
// проверяем легальность загрузки файла
if(!defined('CONTROL_INC')) {
	$protocol = stripos($_SERVER['SERVER_PROTOCOL'],'https') === true ? 'http://' : 'http://';
	header ("Location: $protocol$_SERVER[SERVER_NAME]");
	exit;
}

// создаем sitemap
$text = '<?xml version="1.0" encoding="UTF-8"?>
<urlset
      xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
      xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
      xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
            http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
';
// ссылка на главную страницу
$text .= "
	<url>
  	<loc>https://okna-a.by</loc>
  	<priority>1</priority>
	</url>
";

// выводим ссылки на главные разделы
$res_main_cat = mysqli_query($db, "SELECT alias_main_cat FROM main_categories");
$row_main_cat = mysqli_fetch_array($res_main_cat);

do {
	$text .= "
	<url>
  	<loc>https://okna-a.by/".$row_main_cat['alias_main_cat']."</loc>
  	<priority>0.9</priority>
	</url>
	";
}
while($row_main_cat = mysqli_fetch_array($res_main_cat));

// выводим ссылки на категории раздела Продукция
	// вызываем псевдоним главного раздела
$res_main_cat = mysqli_query($db, "SELECT alias_main_cat FROM main_categories WHERE id_main_cat=1");
$row_main_cat = mysqli_fetch_array($res_main_cat);
	// вызываем псевдонимы материнских категорий
$res_cat = mysqli_query($db, "SELECT alias_cat, id_cat FROM product_categories WHERE parent_cat=0 && visible_cat=1 ORDER BY parent_cat");
$row_cat = mysqli_fetch_array($res_cat);
	// выводим ссылки
do {
	$text .= "
	<url>
  	<loc>https://okna-a.by/".$row_main_cat['alias_main_cat']."/".$row_cat['alias_cat']."</loc>
	  <priority>0.8</priority>
	</url>
	";
	// вызываем псевдонимы подчиненных категорий
	$res_sub_cat = mysqli_query($db, "SELECT alias_cat FROM product_categories WHERE parent_cat={$row_cat['id_cat']} && visible_cat=1 ORDER BY order_cat");
	$row_sub_cat = mysqli_fetch_array($res_sub_cat);
	if(!empty($row_sub_cat)) {
		do {
			$text .= "
	<url>
  	<loc>https://okna-a.by/".$row_main_cat['alias_main_cat']."/".$row_cat['alias_cat']."/".$row_sub_cat['alias_cat']."</loc>
	  <priority>0.8</priority>
	</url>
			";
		}
		while($row_sub_cat = mysqli_fetch_array($res_sub_cat));
	}
}
while($row_cat = mysqli_fetch_array($res_cat));

// выводим ссылки на галереи раздела Наши работы
	// вызываем псевдоним главного раздела
$res_main_cat = mysqli_query($db, "SELECT alias_main_cat FROM main_categories WHERE id_main_cat=2");
$row_main_cat = mysqli_fetch_array($res_main_cat);
	// вызываем псевдонимы галерей
$res_gal = mysqli_query($db, "SELECT alias_gal FROM galleries WHERE show_gal=1 ORDER BY order_gal");
$row_gal = mysqli_fetch_array($res_gal);

do {
	$text .= "
	<url>
  	<loc>https://okna-a.by/".$row_main_cat['alias_main_cat']."/".$row_gal['alias_gal']."</loc>
  	<priority>0.7</priority>
	</url>
	";
}
while($row_gal = mysqli_fetch_array($res_gal));

// выводим ссылки раздела Статьи
	// вызываем псевдоним главного раздела
$res_main_cat = mysqli_query($db, "SELECT alias_main_cat FROM main_categories WHERE id_main_cat=3");
$row_main_cat = mysqli_fetch_array($res_main_cat);
	// вызываем псевдонимы статей
$res_news = mysqli_query($db, "SELECT alias_nov FROM news WHERE show_nov=1");
$row_news = mysqli_fetch_array($res_news);

do {
	$text .= "
	<url>
  	<loc>https://okna-a.by/".$row_main_cat['alias_main_cat']."/".$row_news['alias_nov']."</loc>
  	<priority>0.7</priority>
	</url>
	";
}
while($row_news = mysqli_fetch_array($res_news));

$text .= "
</urlset> 
";

// записываем файл
$sitemap_file = fopen('../sitemap.xml', 'w');
fwrite($sitemap_file, $text);
fclose($sitemap_file);

echo "<p>Sitemap для сайта OKNA-A.BY создан!</p>";
?>
