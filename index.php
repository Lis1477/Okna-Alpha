<?php
		error_reporting(E_ALL); 
		ini_set('display_errors', 'on');
session_start();
// создаем константу для проверки инклюдов
define('CONTROL_INC', '');

// авторизуемся в базе данных
require_once ("inc/conn/connectbd.php");

// проверяем и выделяем запрос
$query = substr(htmlspecialchars(trim($_SERVER['REQUEST_URI']), ENT_QUOTES, 'UTF-8'), 1, 100);
// убираем все прицепленные get запросы
$query = explode("?", $query);
$query = $query[0];

// делим запрос
$query_array = explode("/", $query);

// выбираем данные главной страницы
if(empty($query)) {
	$res_main_page = mysqli_query ($db, "SELECT * FROM main_page");
	$row_main_page = mysqli_fetch_array ($res_main_page);

	// формируем метатеги
	if(!empty($row_main_page['title_main_page'])) $title = $row_main_page['title_main_page'];
	else $title = "Главная | OKNA-A.BY";
	$description = $row_main_page['desc_main_page'];
}
else {

// выбираем данные главных разделов
if(!isset($query_array[1])) {
	// вызываем из базы данные главных категорий
	$res_main_cat = mysqli_query ($db, "SELECT * FROM main_categories WHERE alias_main_cat = '{$query_array[0]}'");
	$row_main_cat = mysqli_fetch_array ($res_main_cat);
	// если страница существует
	if(!empty($row_main_cat)) {
		// определяем id главной категории
		$id_main_cat = $row_main_cat['id_main_cat'];
		// формируем метатеги
		if(empty($row_main_cat['title_main_cat'])) $title = $row_main_cat['name_main_cat']." | OKNA-A.BY";
		else $title = $row_main_cat['title_main_cat'];
		$description = $row_main_cat['desc_main_cat'];
	}
	else {
		$title = "ОШИБКА!";
		header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found");
	}
}
else {
	// выбираем данные подразделов
	if(!isset($query_array[2])) {
		// определяем id, Имя главной категории 
		$res_main_cat = mysqli_query ($db, "SELECT id_main_cat, name_main_cat, alias_main_cat FROM main_categories WHERE alias_main_cat = '{$query_array[0]}'");
		$row_main_cat = mysqli_fetch_array ($res_main_cat);
		if(!empty($row_main_cat)) {
			// определяем id главной категории
			$id_main_cat = $row_main_cat['id_main_cat'];

			// выбираем данные категории Продукция
			if($id_main_cat == 1) {
				$res_cat = mysqli_query ($db, "SELECT id_cat, name_cat, title_cat, desc_cat FROM product_categories WHERE alias_cat = '{$query_array[1]}'");
				$row_cat = mysqli_fetch_array ($res_cat);
				if(!empty($row_cat)) {
					// определяем id подкатегории
					$id_cat = $row_cat['id_cat'];
					// формируем метатеги
					if(empty($row_cat['title_cat'])) $title = $row_cat['name_cat']." | OKNA-A.BY";
					else $title = $row_cat['title_cat'];
					$description = $row_cat['desc_cat'];
				}
				else {
					$title = "ОШИБКА!";
//					header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found");
				}
			}

			// выбираем данные категории Наши работы
			if($id_main_cat == 2) {
				// определяем id галереи
				$res_gal = mysqli_query ($db, "SELECT * FROM galleries WHERE alias_gal = '{$query_array[1]}'");
				$row_gal = mysqli_fetch_array ($res_gal);
				if(!empty($row_gal)) {
					$id_gal = $row_gal['id_gal'];
					// формируем метатеги
					if(empty($row_gal['title_gal'])) $title = $row_gal['name_gal']." | Наши работы | OKNA-A.BY";
					else $title = $row_gal['title_gal'];
					$description = $row_gal['desc_gal'];
				}
				else {
					$title = "ОШИБКА!";
					header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found");
				}
			}

			// выбираем данные категории Статьи
			if($id_main_cat == 3) {
				// выбираем данные из базы
				$res_news = mysqli_query ($db, "SELECT * FROM news WHERE alias_nov = '{$query_array[1]}'");
				$row_news = mysqli_fetch_array ($res_news);
				if(!empty($row_news)) {
					$id_nov = $row_news['id_nov'];
					// формируем метатеги
					if(empty($row_news['title_nov'])) $title = $row_news['head_nov']." | Статьи | OKNA-A.BY";
					else $title = $row_news['title_nov'];
					$description = $row_news['desc_nov'];
				}
				else {
					$title = "ОШИБКА!";
					header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found");
				}
			}
		}
		else {
			$title = "ОШИБКА!";
//			header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found");
		}
	}
	else {
		// выбираем данные материалов
			// вызываем из базы данные материала
		$res_mat = mysqli_query ($db, "SELECT * FROM product_categories WHERE alias_cat = '{$query_array[2]}'");
		$row_mat = mysqli_fetch_array ($res_mat);
		if(!empty($row_mat)) {
			// вызываем из базы данные родительской категории
			$res_cat = mysqli_query ($db, "SELECT id_cat, name_cat, alias_cat, pic_cat FROM product_categories WHERE id_cat = ".$row_mat['parent_cat']);
			$row_cat = mysqli_fetch_array ($res_cat);

			// формируем метатеги
			if(empty($row_mat['title_cat'])) $title = $row_cat['name_cat']." ".$row_mat['name_cat']." | OKNA-A.BY";
			else $title = $row_mat['title_cat'];
			$description = $row_mat['desc_cat'];
			// определяем id главной увтегории
			$id_main_cat = 1;
			// определяем id родитерьского каталога
			$id_cat = $row_cat['id_cat'];
			// определяем id материала
			$id_mat = $row_mat['id_cat'];
		}
		else {
			$title = "ОШИБКА!";
			header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found");
		}
	}
}

}

// назначаем переменную для линка на главную страницу
$main_url = "http://okna-a/";
?>
<!doctype html>
<html lang="ru">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<base href="<?=$main_url?>" />

<title><?=$title?></title>

<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="<?=$description?>">
<link href="favicon.ico" rel="shortcut icon" type="image/x-icon">
<link type="text/css" href="inc/css/styles.css" rel="stylesheet">
<script type="text/javascript" src="inc/js/jquery.min.js"></script>
</head>

<body>
<?php
// выводим хэдер
require_once ("inc/blocks/header.php");

// если существует запрос выше 3-го уровня, выдаем ошибку
if(isset($query_array[3])) {require_once ("inc/blocks/error_page.php");}


// выводим главную страницу
if(empty($query)) require_once ("inc/blocks/main_page.php");
else {

// выводим информацию главных разделов
if(!isset($query_array[1])) {
	// если запрос соответствует существующим в базе
	if(!empty($row_main_cat)) {
		// для страницы Продукция
		if($id_main_cat == 1) {
			require_once ("inc/blocks/product_categories_page.php");
		}
		// для Наши Объекты
		if($id_main_cat == 2) {
			require_once ("inc/blocks/page_galery.php");
		}
		// для Статьи
		if($id_main_cat == 3) {
			require_once ("inc/blocks/page_news.php");
		}
		// для контактов
		if($id_main_cat == 4) {
			require_once ("inc/blocks/page_contacts.php");
		}
	}
	// если запрос не существует в базе - ошибка
	else  require_once ("inc/blocks/error_page.php");
}
else {
	// выводим информацию подразделов
	if(!isset($query_array[2])) {
		if(!empty($row_main_cat)) {

			// Продукция
			if($id_main_cat == 1) {
				if(!empty($row_cat)) {
					require_once ("inc/blocks/product_page.php");
				}
				else require_once ("inc/blocks/error_page.php");
			}

			// Наши работы
			if($id_main_cat == 2) {
				if(!empty($row_gal)) {
					require_once ("inc/blocks/page_obj_galery.php");
				}
				else require_once ("inc/blocks/error_page.php");
			}

			// Статьи
			if($id_main_cat == 3) {
				if(!empty($row_news)) {
					require_once ("inc/blocks/page_news.php");
				}
				else require_once ("inc/blocks/error_page.php");
			}
		}
		else require_once ("inc/blocks/error_page.php");
	}
	else {
		if(!empty($row_mat)) {
			// выводим текстовые материалы
			require_once ("inc/blocks/product_page.php");
		}
		else require_once ("inc/blocks/error_page.php");
	}
}

}
?>
<footer>
	<div class="container">
		<p>Copyright © 2019 <a href="<?=$main_url?>">www.okna-a.by</a></p>
	</div>
</footer>

<script src="inc/js/main-menu.js"></script>

</body>
</html>