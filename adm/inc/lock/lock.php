<?php
if (!isset($_SERVER['PHP_AUTH_USER']))
{
 Header ("WWW-Authenticate: Basic realm=\"Admin Page\"");
 Header ("HTTP/1.0 401 Unauthorized");
 exit();
}
else
{
	if (!get_magic_quotes_gpc())
	{
    $_SERVER['PHP_AUTH_USER'] = mysqli_real_escape_string($db, $_SERVER['PHP_AUTH_USER']);
    $_SERVER['PHP_AUTH_PW'] = mysqli_real_escape_string($db, $_SERVER['PHP_AUTH_PW']);
	}
	$pu = $_SERVER['PHP_AUTH_USER'];
	$query = mysqli_query ($db, "SELECT pas_adm, nm_adm FROM adm WHERE log_adm='$pu'");
	$lst = mysqli_fetch_array ($query);

	if (!$query)
	{
		Header ("WWW-Authenticate: Basic realm=\"Admin Page\"");
		Header ("HTTP/1.0 401 Unauthorized");
		exit();
	}

	if (mysqli_num_rows($query) == 0)
	{
		Header ("WWW-Authenticate: Basic realm=\"Admin Page\"");
		Header ("HTTP/1.0 401 Unauthorized");
		exit();
	}

	$pass = $lst['pas_adm'];
	if ($_SERVER['PHP_AUTH_PW'] != $pass)
	{
		Header ("WWW-Authenticate: Basic realm=\"Admin Page\"");
		Header ("HTTP/1.0 401 Unauthorized");
		exit();
	}
	$nm_adm = $lst['nm_adm'];
}



?>