<?php
// проверяем легальность загрузки файла
if(!defined('CONTROL_INC')) {
	$protocol = stripos($_SERVER['SERVER_PROTOCOL'],'https') === true ? 'https://' : 'http://';
	header ("Location: $protocol$_SERVER[SERVER_NAME]");
	exit;
}

if (isset($_POST['sort_gal'])) {
	$num_gal_arr = $_POST['num_gal_arr'];

	foreach ($num_gal_arr as $key => $value) {
			$res = mysqli_query ($db, "UPDATE galleries SET order_gal={intval($value)} WHERE id_gal={intval($key)}");
	}
	echo "<p style='color:red; font-weight:bold;'>Отсортировано!</p><hr><br>";
}
?>

<h2>Определите порядок сортировки галерей:</h2>

<form method="post">

<?php
// выводим все галереи
$res_gal = mysqli_query ($db, "SELECT id_gal, name_gal, order_gal FROM galleries ORDER BY order_gal");
$row_gal = mysqli_fetch_array ($res_gal);

do {
?>
	<h3><input name='num_gal_arr[<?=$row_gal['id_gal']?>]' value='<?=$row_gal['order_gal']?>' type='number' min='1' max='99' style='width:30px;'> <?=$row_gal['name_gal']?></h3>
<?php
}
while($row_gal = mysqli_fetch_array ($res_gal));
?>
	<input type="submit" name="sort_gal" value="Сортировать">
</form>
