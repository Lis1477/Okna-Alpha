<?php
// ��������� ����������� �������� �����
if(!defined('CONTROL_INC')) {
	$protocol = stripos($_SERVER['SERVER_PROTOCOL'],'https') === true ? 'https://' : 'http://';
	header ("Location: $protocol$_SERVER[SERVER_NAME]");
	exit;
}


// �������� �����������
if (isset($_POST['delpic']))
{
//	unlink('../img/news/id_'.$art.'/big/'.$_POST['pic']);
//	unlink('../img/news/id_'.$art.'/sml/'.$_POST['pic']);
}

//$result = mysql_query ("SELECT zag_art FROM artnews WHERE id_art=$art",$db);
//$myrow = mysql_fetch_array ($result);


// ������� ����� �������� �����������
echo "
<h2>����������, �������������� ����������� ������� &laquo;".$myrow['zag_art']."&raquo;</h3>
<hr>
";
	// ����� �������� �����������
echo "
<form method='post' enctype='multipart/form-data'>
	<p>�������� ����������� (������ .jpg, .jpeg, .gif, .png, �� ����� 5 ��������):</p>
	<p><input type='file' name='upfl'></p>
	<br>
	<p><input type='submit' name='subm' value='���������'></p>
</form>
";
if (isset($_POST['subm']))
{
	if (is_uploaded_file($_FILES['upfl']['tmp_name']))
	{
		// �������� ���������
		$raz_fl = 5000000; // ������������ ������ ����� � ������
		$stor_big = "1500"; // �������� ������/������ �������� �����
		$stor_sm = "300"; // �������� ������/������ ���������� �����
		$file_srs = $_FILES['upfl']['tmp_name']; // �������� ���� � ������������
		$path_im = '../img/news'; // ���� � ����� � �������������
		// ���������� ��� �����
		$name_file = $_FILES['upfl']['name'];
		// �������� ��� ��� ����������
		$name_pic = substr($name_file, 0, (strpos($name_file, ".")));
		// ���������, �� ��������� �� ������ ����� ��������� ��������
		$sz = filesize ($file_srs);
		if ($sz > $raz_fl) {echo "<p>������ ����� <strong>$name_file</strong> ��������� ������������ ($sz ����, ��������� ��  ����� $raz_fl ����)</p>"; exit;};
		// ���������, �������� �� ���� ������������
		$prop = getimagesize($file_srs);
		if (!preg_match('{image/(.*)}is', $prop['mime'], $p)) {echo "<p>���� <strong>$name_file</strong> �� �������� 	������������.</p>"; exit;};
		// ������� ��������������� ��������, ���� �� ���
		@mkdir($path_im.'/id_'.$art, 0755);
		@mkdir($path_im.'/id_'.$art.'/big', 0755);
		@mkdir($path_im.'/id_'.$art.'/sml', 0755);
		// ������ ��� ��� �����������
		$mim = image_type_to_mime_type($prop[2]);
		// �������������� ����������� � ���������� ��� � ������� 
		list($width_orig, $height_orig) = $prop;
		switch ($mim)
		{
			case "image/jpeg":
			$image = imagecreatefromjpeg($file_srs);  
			if($width_orig > $height_orig)
			{
				// ��� ��������������� ����������
				if ($width_orig > $stor_big) {$new_width = $stor_big;} else {$new_width = $width_orig;}
				// ��� �������� �����������
				$new_height = $new_width * $height_orig / $width_orig;
				$newpic = imagecreatetruecolor($new_width, $new_height);  
				imagecopyresampled($newpic, $image, 0, 0, 0, 0, $new_width, $new_height, $width_orig, $height_orig);
				imagejpeg($newpic, $path_im.'/id_'.$art.'/big/'.$name_file);
				// ��� ���������� �����������
				$new_width = $stor_sm;
				$new_height = $new_width * $height_orig / $width_orig;
				$newpic = imagecreatetruecolor($new_width, $new_height);  
				imagecopyresampled($newpic, $image, 0, 0, 0, 0, $new_width, $new_height, $width_orig, $height_orig);
				imagejpeg($newpic, $path_im.'/id_'.$art.'/sml/'.$name_file);
			}
			else
			{
				// ��� ������������� �����������
				if ($height_orig > $stor_big) {$new_height = $stor_big;} else {$new_height = $height_orig;}
				// ��� �������� �����������
				$new_width = $new_height * $width_orig / $height_orig;
				$newpic = imagecreatetruecolor($new_width, $new_height);  
				imagecopyresampled($newpic, $image, 0, 0, 0, 0, $new_width, $new_height, $width_orig, $height_orig);
				imagejpeg($newpic, $path_im.'/id_'.$art.'/big/'.$name_file);
				// ��� ���������� �����������
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
				// ��� ��������������� ����������
				if ($width_orig > $stor_big) {$new_width = $stor_big;} else {$new_width = $width_orig;}
				// ��� �������� �����������
				$new_height = $new_width * $height_orig / $width_orig;
				$newpic = imagecreatetruecolor($new_width, $new_height);  
				imagecopyresampled($newpic, $image, 0, 0, 0, 0, $new_width, $new_height, $width_orig, $height_orig);
				imagegif($newpic, $path_im.'/id_'.$art.'/big/'.$name_file);
				// ��� ���������� �����������
				$new_width = $stor_sm;
				$new_height = $new_width * $height_orig / $width_orig;
				$newpic = imagecreatetruecolor($new_width, $new_height);  
				imagecopyresampled($newpic, $image, 0, 0, 0, 0, $new_width, $new_height, $width_orig, $height_orig);
				imagegif($newpic, $path_im.'/id_'.$art.'/sml/'.$name_file);
			}
			else
			{
				// ��� ������������� �����������
				if ($height_orig > $stor_big) {$new_height = $stor_big;} else {$new_height = $height_orig;}
				// ��� �������� �����������
				$new_width = $new_height * $width_orig / $height_orig;
				$newpic = imagecreatetruecolor($new_width, $new_height);  
				imagecopyresampled($newpic, $image, 0, 0, 0, 0, $new_width, $new_height, $width_orig, $height_orig);
				imagegif($newpic, $path_im.'/id_'.$art.'/big/'.$name_file);
				// ��� ���������� �����������
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
				// ��� ��������������� ����������
				if ($width_orig > $stor_big) {$new_width = $stor_big;} else {$new_width = $width_orig;}
				// ��� �������� �����������
				$new_height = $new_width * $height_orig / $width_orig;
				$newpic = imagecreatetruecolor($new_width, $new_height);  
				imagealphablending($newpic, false);
				imagesavealpha($newpic, true);
				imagecopyresampled($newpic, $image, 0, 0, 0, 0, $new_width, $new_height, $width_orig, $height_orig);
				imagepng($newpic, $path_im.'/id_'.$art.'/big/'.$name_file);
				// ��� ���������� �����������
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
				// ��� ������������� �����������
				if ($height_orig > $stor_big) {$new_height = $stor_big;} else {$new_height = $height_orig;}
				// ��� �������� �����������
				$new_width = $new_height * $width_orig / $height_orig;
				$newpic = imagecreatetruecolor($new_width, $new_height);  
				imagealphablending($newpic, false);
				imagesavealpha($newpic, true);
				imagecopyresampled($newpic, $image, 0, 0, 0, 0, $new_width, $new_height, $width_orig, $height_orig);
				imagepng($newpic, $path_im.'/id_'.$art.'/big/'.$name_file);
				// ��� ���������� �����������
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
			die("�� ������� ������� �����������.");
		}
	}
	else {echo "<p style='color:red; font-size:0.7em; font-weight:bold;'>��� �������� ����������� �������������� ������� &laquo;�������� ����&raquo;</p>";}
}

echo "
<hr>
";

// ������� ����������� �����������

$wimage = "";
$fimg = "";
$path_gal = "../img/news/id_$art/sml/"; // ������ ���� � ����� � ������ �������������
$path_big = "../img/news/id_$art/big/"; // ������ ���� � ����� � �������� �������������
$images = @scandir($path_gal); // ��������� �����
if ($images !== false) // ���� ��� ������ ��� ������������
{
	$images = preg_grep("/\.(?:png|gif|jpe?g)$/i", $images); // ����� ��������� ������� ������ ������ �����������
	if (is_array($images)) // ���� ����������� �������
	{
		echo "
<div class='gal_sml'>
		";
		foreach($images as $image) // ������ ������ �� �������
		{ 
			echo "
	<div class='im_cont'>
		<a href='".$path_big.$image."' target='_blank'><img src='".$path_gal.$image."' alt='".substr($image, 0, (strpos($image, ".")))."' title='".substr($image, 0, (strpos($image, ".")))."'></a>
		<form method='post'>
			<input type='hidden' name='pic' value='$image'>
			<input type='submit' name='delpic' value='X' class='im_del' title='������� �����������'>
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
