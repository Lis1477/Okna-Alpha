<?php
// ��������� ����������� �������� �����
if(!defined('CONTROL_INC')) {
	$protocol = stripos($_SERVER['SERVER_PROTOCOL'],'https') === true ? 'https://' : 'http://';
	header ("Location: $protocol$_SERVER[SERVER_NAME]");
	exit;
}

	echo "
<h2>��������� ����������� ������!</h2><p>����, ���������� &laquo;<span class='zvezd'>*</span>&raquo; - ����������� ��� ����������.</p><hr>

<form method='post'>

	<p>��� ������� (�� 100 ������): <span class='zvezd'>*</span><br>
		<input type='text' name='name_art' value='$name_art' size='100' maxlength='100' onkeypress='if(event.keyCode == 13) return false;'>
	";
	if (!isset($name_art)) {echo "<span style='color:red'> - ������� � ���� ��������� ������</span><br>";}
	echo "
	</p>

	<br>

	<p>��������� (�� 100 ������):<br>
	<span class='form_rem'>* - �������� ������, ����� ������ �������������.</span><br>
		<input type='text' name='alias_art' value='$alias_art' size='100'  maxlength='100' onkeypress='if(event.keyCode == 13) return false;'>
	</p>

	<br>

	<p>�����: <span class='zvezd'>*</span><br>
		<textarea name='text_art' id='editor' cols='100' rows='5'>$text_art</textarea>
	";
	if (!isset($text_art)) {echo "<span style='color:red'> - ������� � ���� ����� ������</span><br>";}
	echo "
	</p>
	<script>CKEDITOR.replace( 'editor' ); </script>

	<br>

	<p>������� �������� (�� 300 ������):<br>
	<span class='form_rem'>* - ������� �������� ������ ��������� &laquo;������� �����&raquo; ��������. ��������� ������ ��� ���� description � ����� ������� ����������� � ������ � ����������� � ��������� ��������. ����� ��������� ������.</span><br>
		<textarea name='desc_art' cols='100' rows='5' maxlength='300'>$desc_art</textarea>
	</p>

	<br>

	<p>�������� ����� (�����) (�� 300 ������):<br>
	<span class='form_rem'>* - ��������� ������ ��� ���� keywords � ����� ����������� � ��������� ��������. ����� ��������� ������.</span><br>
		<textarea name='key_art' cols='100' rows='5' maxlength='300'>$key_art</textarea>
	</p>

	<br>

	<p>���:<br>
	<span class='form_rem'>* - ������ �� ������� ������ � ����. ��� ���� ��������, ��� ������ ��� � ��� ���� ���������� � ������.</span><br>
		<input type='number' name='order_art' value='$order_art' min='1' max='99' style='width:40px;' onkeypress='if(event.keyCode == 13) return false;'>
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
	";
?>