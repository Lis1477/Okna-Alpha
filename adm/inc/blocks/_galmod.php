<?php
// проверяем легальность загрузки файла
if(!defined('CONTROL_INC')) {
	$protocol = stripos($_SERVER['SERVER_PROTOCOL'],'https') === true ? 'https://' : 'http://';
	header ("Location: $protocol$_SERVER[SERVER_NAME]");
	exit;
}


// удаление изображения
if (isset($_POST['delpic']))
{
//	unlink('../img/news/id_'.$art.'/big/'.$_POST['pic']);
//	unlink('../img/news/id_'.$art.'/sml/'.$_POST['pic']);
}

//$result = mysql_query ("SELECT zag_art FROM artnews WHERE id_art=$art",$db);
//$myrow = mysql_fetch_array ($result);


// выводим форму загрузки изображения
echo "
<h2>Добавление, редактирование изображений галереи &laquo;".$myrow['zag_art']."&raquo;</h3>
<hr>
";
	// форма загрузки изображения
echo "
<form method='post' enctype='multipart/form-data'>
	<p>Выберите изображение (формат .jpg, .jpeg, .gif, .png, не более 5 мегабайт):</p>
	<p><input type='file' name='upfl'></p>
	<br>
	<p><input type='submit' name='subm' value='Загрузить'></p>
</form>
";
if (isset($_POST['subm']))
{
	if (is_uploaded_file($_FILES['upfl']['tmp_name']))
	{
		// исходные параметры
		$raz_fl = 5000000; // максимальный размер файла в байтах
		$stor_big = "1500"; // желаемая ширина/высота большого файла
		$stor_sm = "300"; // желаемая ширина/высота маленького файла
		$file_srs = $_FILES['upfl']['tmp_name']; // исходный файл с изображением
		$path_im = '../img/news'; // путь к папке с изображениями
		// запоминаем имя файла
		$name_file = $_FILES['upfl']['name'];
		// получаем имя без расширения
		$name_pic = substr($name_file, 0, (strpos($name_file, ".")));
		// проверяем, не превышает ли размер файла требуемый параметр
		$sz = filesize ($file_srs);
		if ($sz > $raz_fl) {echo "<p>Размер файла <strong>$name_file</strong> превышает максимальный ($sz байт, требуется не  более $raz_fl байт)</p>"; exit;};
		// проверяем, является ли файл изображением
		$prop = getimagesize($file_srs);
		if (!preg_match('{image/(.*)}is', $prop['mime'], $p)) {echo "<p>Файл <strong>$name_file</strong> не является 	изображением.</p>"; exit;};
		// создаем соответствующие каталоги, если их нет
		@mkdir($path_im.'/id_'.$art, 0755);
		@mkdir($path_im.'/id_'.$art.'/big', 0755);
		@mkdir($path_im.'/id_'.$art.'/sml', 0755);
		// узнаем мим тип изображения
		$mim = image_type_to_mime_type($prop[2]);
		// трансформируем изображение и записываем его в каталог 
		list($width_orig, $height_orig) = $prop;
		switch ($mim)
		{
			case "image/jpeg":
			$image = imagecreatefromjpeg($file_srs);  
			if($width_orig > $height_orig)
			{
				// для горизонтального изобажения
				if ($width_orig > $stor_big) {$new_width = $stor_big;} else {$new_width = $width_orig;}
				// для большого изображения
				$new_height = $new_width * $height_orig / $width_orig;
				$newpic = imagecreatetruecolor($new_width, $new_height);  
				imagecopyresampled($newpic, $image, 0, 0, 0, 0, $new_width, $new_height, $width_orig, $height_orig);
				imagejpeg($newpic, $path_im.'/id_'.$art.'/big/'.$name_file);
				// для маленького изображения
				$new_width = $stor_sm;
				$new_height = $new_width * $height_orig / $width_orig;
				$newpic = imagecreatetruecolor($new_width, $new_height);  
				imagecopyresampled($newpic, $image, 0, 0, 0, 0, $new_width, $new_height, $width_orig, $height_orig);
				imagejpeg($newpic, $path_im.'/id_'.$art.'/sml/'.$name_file);
			}
			else
			{
				// для вертикального изображения
				if ($height_orig > $stor_big) {$new_height = $stor_big;} else {$new_height = $height_orig;}
				// для большого изображения
				$new_width = $new_height * $width_orig / $height_orig;
				$newpic = imagecreatetruecolor($new_width, $new_height);  
				imagecopyresampled($newpic, $image, 0, 0, 0, 0, $new_width, $new_height, $width_orig, $height_orig);
				imagejpeg($newpic, $path_im.'/id_'.$art.'/big/'.$name_file);
				// для маленького изображения
				$new_height = $stor_sm;
				$new_width = $new_height * $width_orig / $height_orig;
				$newpic = imagecreatetruecolor($new_width, $new_height);  
				imagecopyresampled($newpic, $image, 0, 0, 0, 0, $new_width, $new_height, $width_orig, $height_orig);
				imagejpeg($newpic, $path_im.'/id_'.$art.'/sml/'.$name_file);
			}
			break;  
			case "image/gif":	
			$image = imagecreatefromgif($file_srs);  
			if($width_orig > $height_orig)
			{
				// для горизонтального изобажения
				if ($width_orig > $stor_big) {$new_width = $stor_big;} else {$new_width = $width_orig;}
				// для большого изображения
				$new_height = $new_width * $height_orig / $width_orig;
				$newpic = imagecreatetruecolor($new_width, $new_height);  
				imagecopyresampled($newpic, $image, 0, 0, 0, 0, $new_width, $new_height, $width_orig, $height_orig);
				imagegif($newpic, $path_im.'/id_'.$art.'/big/'.$name_file);
				// для маленького изображения
				$new_width = $stor_sm;
				$new_height = $new_width * $height_orig / $width_orig;
				$newpic = imagecreatetruecolor($new_width, $new_height);  
				imagecopyresampled($newpic, $image, 0, 0, 0, 0, $new_width, $new_height, $width_orig, $height_orig);
				imagegif($newpic, $path_im.'/id_'.$art.'/sml/'.$name_file);
			}
			else
			{
				// для вертикального изображения
				if ($height_orig > $stor_big) {$new_height = $stor_big;} else {$new_height = $height_orig;}
				// для большого изображения
				$new_width = $new_height * $width_orig / $height_orig;
				$newpic = imagecreatetruecolor($new_width, $new_height);  
				imagecopyresampled($newpic, $image, 0, 0, 0, 0, $new_width, $new_height, $width_orig, $height_orig);
				imagegif($newpic, $path_im.'/id_'.$art.'/big/'.$name_file);
				// для маленького изображения
				$new_height = $stor_sm;
				$new_width = $new_height * $width_orig / $height_orig;
				$newpic = imagecreatetruecolor($new_width, $new_height);  
				imagecopyresampled($newpic, $image, 0, 0, 0, 0, $new_width, $new_height, $width_orig, $height_orig);
				imagegif($newpic, $path_im.'/id_'.$art.'/sml/'.$name_file);
			}
			break;  
		case "image/png":
		$image = imagecreatefrompng($file_srs);  
			if($width_orig > $height_orig)
			{
				// для горизонтального изобажения
				if ($width_orig > $stor_big) {$new_width = $stor_big;} else {$new_width = $width_orig;}
				// для большого изображения
				$new_height = $new_width * $height_orig / $width_orig;
				$newpic = imagecreatetruecolor($new_width, $new_height);  
				imagealphablending($newpic, false);
				imagesavealpha($newpic, true);
				imagecopyresampled($newpic, $image, 0, 0, 0, 0, $new_width, $new_height, $width_orig, $height_orig);
				imagepng($newpic, $path_im.'/id_'.$art.'/big/'.$name_file);
				// для маленького изображения
				$new_width = $stor_sm;
				$new_height = $new_width * $height_orig / $width_orig;
				$newpic = imagecreatetruecolor($new_width, $new_height);  
				imagealphablending($newpic, false);
				imagesavealpha($newpic, true);
				imagecopyresampled($newpic, $image, 0, 0, 0, 0, $new_width, $new_height, $width_orig, $height_orig);
				imagepng($newpic, $path_im.'/id_'.$art.'/sml/'.$name_file);
			}
			else
			{
				// для вертикального изображения
				if ($height_orig > $stor_big) {$new_height = $stor_big;} else {$new_height = $height_orig;}
				// для большого изображения
				$new_width = $new_height * $width_orig / $height_orig;
				$newpic = imagecreatetruecolor($new_width, $new_height);  
				imagealphablending($newpic, false);
				imagesavealpha($newpic, true);
				imagecopyresampled($newpic, $image, 0, 0, 0, 0, $new_width, $new_height, $width_orig, $height_orig);
				imagepng($newpic, $path_im.'/id_'.$art.'/big/'.$name_file);
				// для маленького изображения
				$new_height = $stor_sm;
				$new_width = $new_height * $width_orig / $height_orig;
				$newpic = imagecreatetruecolor($new_width, $new_height);  
				imagealphablending($newpic, false);
				imagesavealpha($newpic, true);
				imagecopyresampled($newpic, $image, 0, 0, 0, 0, $new_width, $new_height, $width_orig, $height_orig);
				imagepng($newpic, $path_im.'/id_'.$art.'/sml/'.$name_file);
			}
			break;  
			default:
			die("Не удалось создать изображение.");
		}
	}
	else {echo "<p style='color:red; font-size:0.7em; font-weight:bold;'>Для загрузки изображения воспользуйтесь кнопкой &laquo;Выберите файл&raquo;</p>";}
}

echo "
<hr>
";

// выводим загруженные изображения

$wimage = "";
$fimg = "";
$path_gal = "../img/news/id_$art/sml/"; // задаем путь к папке с малыми изображениями
$path_big = "../img/news/id_$art/big/"; // задаем путь к папке с большими изображениями
$images = @scandir($path_gal); // сканируем папку
if ($images !== false) // если нет ошибок при сканировании
{
	$images = preg_grep("/\.(?:png|gif|jpe?g)$/i", $images); // через регулярку создаем массив только изображений
	if (is_array($images)) // если изображения найдены
	{
		echo "
<div class='gal_sml'>
		";
		foreach($images as $image) // делаем проход по массиву
		{ 
			echo "
	<div class='im_cont'>
		<a href='".$path_big.$image."' target='_blank'><img src='".$path_gal.$image."' alt='".substr($image, 0, (strpos($image, ".")))."' title='".substr($image, 0, (strpos($image, ".")))."'></a>
		<form method='post'>
			<input type='hidden' name='pic' value='$image'>
			<input type='submit' name='delpic' value='X' class='im_del' title='Удалить изображение'>
		</form>
	</div>
			";
		}
		echo "
</div>
		";
	}
}
?>
