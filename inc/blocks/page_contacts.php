<?php
// проверяем легальность загрузки файла
if(!defined('CONTROL_INC')) {
	$protocol = stripos($_SERVER['SERVER_PROTOCOL'],'https') === true ? 'https://' : 'http://';
	header ("Location: $protocol$_SERVER[SERVER_NAME]");
	exit;
}
// выбираем из базы режим работы предприятия
$res_wrk = mysqli_query ($db, "SELECT * FROM regime");
$row_wrk = mysqli_fetch_array ($res_wrk);
// выбираем из базы адрес предприятия
$res_adr = mysqli_query ($db, "SELECT * FROM adress");
$row_adr = mysqli_fetch_array ($res_adr);
// выбираем из базы e-mail предприятия
$res_ml = mysqli_query ($db, "SELECT * FROM mail");
$row_ml = mysqli_fetch_array ($res_ml);
// выбираем из базы телефоны предприятия
$res_tel = mysqli_query ($db, "SELECT * FROM phones");
$row_tel = mysqli_fetch_array ($res_tel);

// добавляем в константы ключи для рекапчи
define('SITE_KEY', '6LfFxLQUAAAAABYm4Mw3R5frLfQoXD68wn4B0u3A');
define('SECRET_KEY', '6LfFxLQUAAAAALwkWrHERsXsuGZ1AHWQohLrcyDS');

if (isset($_REQUEST['submit_mess'])) {
	// формируем запрос для Гугла
	$recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
	$recaptcha_secret = SECRET_KEY;
	$recaptcha_response = $_POST['recaptcha_response'];

	// получаем ответ от Гугла
	$recaptcha = file_get_contents($recaptcha_url . '?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response);
	$recaptcha = json_decode($recaptcha);

	// если удачно, отправляем сообщение
	if ($recaptcha->score >= 0.5) {
		// провеляем глобальные переменные
		if (isset($_REQUEST['name_visitor']))	{$name_visitor = substr(htmlspecialchars(trim($_REQUEST['name_visitor']), ENT_QUOTES, 'utf-8'), 0, 60);	unset($_REQUEST['name_visitor']);}
		if (isset($_REQUEST['mail_visitor']))	{$mail_visitor = substr(htmlspecialchars(trim($_REQUEST['mail_visitor']), ENT_QUOTES, 'utf-8'), 0, 60);	unset($_REQUEST['mail_visitor']);}
		if (isset($_REQUEST['tel_visitor']))	{$tel_visitor = substr(htmlspecialchars(trim($_REQUEST['tel_visitor']), ENT_QUOTES, 'utf-8'), 0, 60);	unset($_REQUEST['tel_visitor']);}
		if (isset($_REQUEST['text_visitor']))	{$text_visitor = substr(htmlspecialchars(trim($_REQUEST['text_visitor']), ENT_QUOTES, 'utf-8'), 0, 6000);	unset($_REQUEST['text_visitor']);}

		// отправка письма
		// формируем сообщение
		$title = "Сообщение через форму обратной связи с сайта OKNA-A.BY";
		$mess = "
<p>Имя: {$name_visitor}<br>
E-mail: {$mail_visitor}<br>
Телефон: {$tel_visitor}</p>
<p>Сообщение:<br>
{$text_visitor}</p>
		";
		// заголовки
		$headers= "MIME-Version: 1.0\r\n";
		$headers .= "Content-type: text/html; charset=utf-8\r\n";
		$headers .= "From: {$mail_visitor}\r\n";
		// отправляем
		$mailing = mail($row_ml['value_ml'], $title, $mess, $headers);
		// формируем сообщение об отправке
		if($mailing) $ok_mail = "<p style='color:red; text-align:center;'>Уважаемый {$name_visitor}!<br>Сообщение успешно отправлено администратору.</p>";
	}
	// если рекапча не прошла, пишем, что это робот
	else $ok_mail = "<p style='color:red; text-align:center;'>Сайт определил, что Вы - робот!.</p>";
}
// выводим линию ссылок
require_once ("inc/blocks/url_line.php");
?>
<article>
	<div class="contact-page">
		<div class="left-side">
		</div>
		<div class="contact-page_wrapper">
			<div class="contact-page_menu-block">
			</div>
			<div class="contact-page_text-block">

				<h1>Контакты ООО &laquo;Европейские Защитные Системы&raquo;</h1>

				<div class="contact-page_info-area">

					<div class="contact-page_column-bl">
						<div class="contact-page_left-bl">

							<div class="contact-page_adr-bl">
								<h2><?=$row_adr['name_adr']?></h2>
								<p><?=$row_adr['value_adr']?></p>
							</div>

							<div class="contact-page_reg-bl">
								<h2><?=$row_wrk['name_wrk']?></h2>
								<p><?=$row_wrk['value_wrk']?></p>
							</div>

					</div>

					<div class="contact-page_right-bl">

						<div class="contact-page_tel-bl">
							<h2>Телефоны</h2>
<?php
do {
?>
							<p><a href="tel:<?=$row_tel['prefix_tel']?><?=$row_tel['number_tel']?>"><span class="contact-page_provider"><?=$row_tel['provider_tel']?>:</span><?=$row_tel['prefix_tel']?> <?=$row_tel['number_tel']?></a></p>
<?php
}
while ($row_tel = mysqli_fetch_array ($res_tel))
?>
						</div>

						<div class="contact-page_ml-bl">
							<h2><?=$row_ml['name_ml']?></h2>
							<p><a href="mailto:<?=$row_ml['value_ml']?>"><?=$row_ml['value_ml']?></a></p>
						</div>

						</div>
					</div>

					<h2>Мы на карте Яндекс</h2>
					<p>GPS-координаты: N53.8584, E27.7005</p>

					<div class="contact-page_map">
<script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3Af4c9c90ab6cb0f042322c2ffb30a321a98cf3a058e4ceed09c34aab7f065bb87&amp;width=100%25&amp;height=340&amp;lang=ru_RU&amp;scroll=true"></script>
					</div>

					<p class="contact-page_print-link"><a href="kontakti.html" title="Распечатать контакты и Схему проезда">Распечатать Контакты и схему проезда</a></p>

<?php
// выводим сообщение об успешной отправке письма
if(isset($ok_mail)) echo $ok_mail;
?>

					<h2>Написать нам через форму обратной связи</h2>

					<div class="contact-page_form-bl">

<script src="https://www.google.com/recaptcha/api.js?render=<?=SITE_KEY?>"></script>
<script>
	grecaptcha.ready(function () {
		grecaptcha.execute('<?=SITE_KEY?>', { action: 'contact' }).then(function (token) {
			var recaptchaResponse = document.getElementById('recaptchaResponse');
			recaptchaResponse.value = token;
		});
	});
</script>

<script>
	function validate_custinfo() //валидация формы контактных данных
	{
		if (document.custinfo_form.name_visitor.value=="")
		{
			alert("Заполните поле формы - ВАШЕ ИМЯ");
			return false;
		}
		if (document.custinfo_form.mail_visitor.value=="")
		{
			alert("Заполните поле формы - ВАШ E-MAIL");
			return false;
		}
		return true;
	}
</script>

<form method="post" name="custinfo_form" onSubmit="return validate_custinfo(this);">

<p><input type="text" name="name_visitor" placeholder="Ваше имя:*" onkeypress="if(event.keyCode == 13) return false;"></p>

<p><input type="email" name="mail_visitor" placeholder="Ваш e-mail:*" onkeypress="if(event.keyCode == 13) return false;"></p>

<p><input type="text" name="tel_visitor" placeholder="Ваш телефон:" onkeypress="if(event.keyCode == 13) return false;"></p>

<p><textarea name="text_visitor" placeholder="Сообщение:"></textarea></p>

<p class="sub_butt"><button type="submit" name="submit_mess">Отправить</button></p>

<input type="hidden" name="recaptcha_response" id="recaptchaResponse">

</form>

					</div>

				</div>

			</div>

		</div>
		<div class="right-side">
		</div>
	</div>
</article>
