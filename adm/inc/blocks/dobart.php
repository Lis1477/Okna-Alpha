<?php
// ��������� ����������� �������� �����
if(!defined('CONTROL_INC')) {
	$protocol = stripos($_SERVER['SERVER_PROTOCOL'],'https') === true ? 'https://' : 'http://';
	header ("Location: $protocol$_SERVER[SERVER_NAME]");
	exit;
}

if (!isset($raz))
{
	echo "
<h2>�������� ������ ��� ���������� ���������.</h2>
<hr>
	";
	// ������� ������� ���������
	$res_maincat = mysqli_query ($db, "SELECT id_cat, name_cat FROM categories WHERE parent_cat = 0 && id_cat != 1 && id_cat != 6 && id_cat != 7 ORDER BY order_cat");
	$row_maincat = mysqli_fetch_array ($res_maincat);
	do {
		echo "
	<h3>".$row_maincat['name_cat']."</h3>
		";
		// ������� ������������
		$res_subcat = mysqli_query ($db, "SELECT id_cat, name_cat FROM categories WHERE parent_cat = ".$row_maincat['id_cat']." ORDER BY order_cat");
		$row_subcat = mysqli_fetch_array ($res_subcat);

		do {
			echo "
	<p>&nbsp;&nbsp;&nbsp;&nbsp;<a href='index.php?dobart=1&raz=".$row_subcat['id_cat']."'>".$row_subcat['name_cat']."</a></p>
			";
		}
		while ($row_subcat = mysqli_fetch_array ($res_subcat));
	}
	while ($row_maincat = mysqli_fetch_array ($res_maincat));
}
else
{
	if (!isset($_POST['save_art']))
	{
?>
<script>
	function validate_custinfo()	{ //��������� �����
		if (document.custinfo_form.name_art.value=="")	{
			alert("��������� ���� ����� - ��� �������");
			return false;
		}
		if (document.custinfo_form.text_art.value=="")	{
			alert("��������� ���� ����� - �����");
			return false;
		}
		return true;
	}
</script>

<h2>��������� ����������� ������!</h2>
<p>����, ���������� &laquo;<span class='zvezd'>*</span>&raquo; - ����������� ��� ����������.</p><hr>

<form method='post' name='custinfo_form' onSubmit='return validate_custinfo(this);'>

	<p>��� ������� (�� 100 ������): <span class='zvezd'>*</span><br>
		<input type='text' name='name_art' size='100' maxlength='100' onkeypress='if(event.keyCode == 13) return false;'>
	</p>

	<br>

	<p>��������� (�� 100 ������):<br>
	<span class='form_rem'>* - �������� ������, ����� ������ �������������.</span><br>
		<input type='text' name='alias_art' size='100'  maxlength='100' onkeypress='if(event.keyCode == 13) return false;'>
	</p>

	<br>

	<p>�����: <span class='zvezd'>*</span><br>
		<textarea name='text_art' id='editor' cols='100' rows='5'></textarea>
	</p>
	<script>CKEDITOR.replace( 'editor' ); </script>

	<br>

	<p>��������� (�� ������) �������� (�� 150 ������):<br>
	<span class="form_rem">* - ��������� ��� ���� title. <strong>����� �������� ������</strong>, ����� ������������� �������������.</span><br>
		<input name='title_art' size="100"  maxlength="150" onkeypress="if(event.keyCode == 13) return false;">
	</p>

	<br>

	<p>������� �������� (�� 300 ������):<br>
	<span class='form_rem'>* - ������� �������� ������ ��������� &laquo;������� �����&raquo; ��������. ��������� ������ ��� ���� description � ����� ������� ����������� � ������ � ����������� � ��������� ��������. ����� ��������� ������.</span><br>
		<textarea name='desc_art' cols='100' rows='5' maxlength='300'></textarea>
	</p>

	<br>

	<p>�������� ����� (�����) (�� 300 ������):<br>
	<span class='form_rem'>* - ��������� ������ ��� ���� keywords � ����� ����������� � ��������� ��������. ����� ��������� ������.</span><br>
		<textarea name='key_art' cols='100' rows='5' maxlength='300'></textarea>
	</p>

	<br>

	<p>���:<br>
	<span class='form_rem'>* - ������ �� ������� ������ � ����. ��� ���� ��������, ��� ������ ��� � ��� ���� ���������� � ������.</span><br>
		<input type='number' name='order_art' min='1' max='99' value='1' style='width:40px;' onkeypress='if(event.keyCode == 13) return false;'>
	</p>

	<br>

	<p>�����������:<br>
	<span class='form_rem'>* - ��� �������� &laquo;������&raquo; ����� ��������� � ���� ������, �� �� ����� ��� �����������.</span><br>
		<select name='visible_art'>
			<option value='1' selected>������������</option>
			<option value='0'>������</option>
		</select>
	</p>

	<br>

	<p>
		<input type='submit' name='save_art' value='�����������'>
	</p>

</form>
<?php
	}
	else {
		// �������� ���������� ���������� � ���������� � �������
		if (isset($_POST['name_art']))	{$name_art = substr(htmlspecialchars(trim($_POST['name_art']), ENT_QUOTES, 'cp1251'), 0, 100);	unset($_POST['name_art']);}
		if (isset($_POST['alias_art']))		{$alias_art = substr(htmlspecialchars(trim($_POST['alias_art']), ENT_QUOTES, 'cp1251'), 0, 100);	unset($_POST['alias_art']);}
		if (isset($_POST['text_art']))		{$text_art = substr(mysqli_real_escape_string($db, trim($_POST['text_art'])), 0, 15000);	unset($_POST['text_art']);}
		if (isset($_POST['title_art']))		{$title_art = substr(htmlspecialchars(trim($_POST['title_art']), ENT_QUOTES, 'cp1251'), 0, 150);	unset($_POST['title_art']);}
		if (isset($_POST['desc_art']))		{$desc_art = substr(htmlspecialchars(trim($_POST['desc_art']), ENT_QUOTES, 'cp1251'), 0, 300);	unset($_POST['desc_art']);}
		if (isset($_POST['key_art']))			{$key_art = substr(htmlspecialchars(trim($_POST['key_art']), ENT_QUOTES, 'cp1251'), 0, 300);	unset($_POST['key_art']);}
		if (isset($_POST['order_art']))			{$order_art = intval($_POST['order_art']);	unset($_POST['order_art']);}
		if (isset($_POST['visible_art']))		{$visible_art = intval($_POST['visible_art']);	unset($_POST['visible_art']);}

		// ���������� ��� � ��������� ��������
		$res_famcat = mysqli_query ($db, "SELECT name_cat, alias_cat FROM categories WHERE id_cat = $raz");
		$row_famcat = mysqli_fetch_array ($res_famcat);

		// �������� �� �����
		$res_dub_art = mysqli_query ($db, "SELECT name_art FROM articles WHERE (category_art = $raz && name_art = '$name_art')");
		$row_dub_art = mysqli_fetch_array ($res_dub_art);
		if(!empty($row_dub_art)) exit("<p style='color:red;'>�������� � ������ <strong>&laquo;$name_art&raquo;</strong> � ���������� <strong>&laquo;{$row_famcat['name_cat']}&raquo;</strong> ��� ����������! ����� ������ ��� ��� ���������� � ������������.<br><br><input type='button' onClick='history.go(-1)' value='���������'></p>");

		// ��������� ��������� �������
		// �������������� ����������, ������� � ������ �������
		$rus = array('�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�');
		$lat = array('A', 'B', 'V', 'G', 'D', 'E', 'Yo', 'Zh', 'Z', 'I', 'Y', 'K', 'L', 'M', 'N', 'O', 'P', 'R', 'S', 'T', 'U', 'F', 'H', 'Ts', 'Ch', 'Sh', 'Sch', '', 'I', '', 'E', 'Yu', 'Ya', 'a', 'b', 'v', 'g', 'd', 'e', 'yo', 'zh', 'z', 'i', 'y', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'h', 'ts', 'ch', 'sh', 'sch', '', 'i', '', 'e', 'yu', 'ya');
		if (empty($alias_art)) {
			$alias_art = str_replace(" ", "-", strtolower(str_replace($rus, $lat, $name_art)));
		}
		else {
			$alias_art = str_replace(" ", "-", strtolower(str_replace($rus, $lat, $alias_art)));
		}

		// ��������� ��������� ��� �������
		$alias_art = $row_famcat['alias_cat']."/".$alias_art;
			
		// ���������� � ���� ������
		$res = mysqli_query ($db, "INSERT INTO articles (name_art, alias_art, category_art, text_art, title_art, desc_art, key_art, order_art, visible_art) VALUES ('$name_art', '$alias_art', $raz, '$text_art', '$title_art', '$desc_art', '$key_art', $order_art, $visible_art)");
		if ($res) {echo "<p>�������� <strong>&laquo;$name_art&raquo;</strong> ���������� <strong>&laquo;{$row_famcat['name_cat']}&raquo;</strong> �������� � ���� ������!</p>";} 
	}
}
?>
