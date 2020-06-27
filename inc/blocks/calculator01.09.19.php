<?php 
// проверяем легальность загрузки файла
if(!defined('CONTROL_INC')) {
	$protocol = stripos($_SERVER['SERVER_PROTOCOL'],'https') === true ? 'https://' : 'http://';
	header ("Location: $protocol$_SERVER[SERVER_NAME]");
	exit;
}

// обработчик формы
if(isset($_REQUEST['submit'])) {
	// проверяем переменные
	if (isset($_REQUEST['open-tipe-window-1'])) {$open_tipe_window_1 = substr(htmlspecialchars(trim($_REQUEST['open-tipe-window-1']), ENT_QUOTES, 'utf-8'), 0, 50);	unset($_REQUEST['open-tipe-window-1']);}
	if (isset($_REQUEST['open-tipe-window-2'])) {$open_tipe_window_2 = substr(htmlspecialchars(trim($_REQUEST['open-tipe-window-2']), ENT_QUOTES, 'utf-8'), 0, 50);	unset($_REQUEST['open-tipe-window-2']);}
	if (isset($_REQUEST['open-tipe-window-3'])) {$open_tipe_window_3 = substr(htmlspecialchars(trim($_REQUEST['open-tipe-window-3']), ENT_QUOTES, 'utf-8'), 0, 50);	unset($_REQUEST['open-tipe-window-3']);}

	if (isset($_REQUEST['window-size-height'])) {$window_size_height = intval($_REQUEST['window-size-height']);	unset($_REQUEST['window-size-height']);}
	if (isset($_REQUEST['window-size-width'])) {$window_size_width = intval($_REQUEST['window-size-width']);	unset($_REQUEST['window-size-width']);}
	if (isset($_REQUEST['window-count'])) {$window_count = intval($_REQUEST['window-count']);	unset($_REQUEST['window-count']);}

	if (isset($_REQUEST['profile-type'])) {$profile_type = substr(htmlspecialchars(trim($_REQUEST['profile-type']), ENT_QUOTES, 'utf-8'), 0, 50);	unset($_REQUEST['profile-type']);}
	if (isset($_REQUEST['home-type'])) {$home_type = substr(htmlspecialchars(trim($_REQUEST['home-type']), ENT_QUOTES, 'utf-8'), 0, 50);	unset($_REQUEST['home-type']);}
	if (isset($_REQUEST['home-type'])) {$home_type = substr(htmlspecialchars(trim($_REQUEST['home-type']), ENT_QUOTES, 'utf-8'), 0, 50);	unset($_REQUEST['home-type']);}

	if (isset($_REQUEST['additional_1'])) {$additional_1 = substr(htmlspecialchars(trim($_REQUEST['additional_1']), ENT_QUOTES, 'utf-8'), 0, 50);	unset($_REQUEST['additional_1']);}
	if (isset($_REQUEST['additional_2'])) {$additional_2 = substr(htmlspecialchars(trim($_REQUEST['additional_2']), ENT_QUOTES, 'utf-8'), 0, 50);	unset($_REQUEST['additional_2']);}
	if (isset($_REQUEST['additional_3'])) {$additional_3 = substr(htmlspecialchars(trim($_REQUEST['additional_3']), ENT_QUOTES, 'utf-8'), 0, 50);	unset($_REQUEST['additional_3']);}
	if (isset($_REQUEST['additional_4'])) {$additional_4 = substr(htmlspecialchars(trim($_REQUEST['additional_4']), ENT_QUOTES, 'utf-8'), 0, 50);	unset($_REQUEST['additional_4']);}
	if (isset($_REQUEST['additional_5'])) {$additional_5 = substr(htmlspecialchars(trim($_REQUEST['additional_5']), ENT_QUOTES, 'utf-8'), 0, 50);	unset($_REQUEST['additional_5']);}

	if (isset($_REQUEST['location'])) {$location = substr(htmlspecialchars(trim($_REQUEST['location']), ENT_QUOTES, 'utf-8'), 0, 200);	unset($_REQUEST['location']);}
	if (isset($_REQUEST['name'])) {$name = substr(htmlspecialchars(trim($_REQUEST['name']), ENT_QUOTES, 'utf-8'), 0, 100);	unset($_REQUEST['name']);}
	if (isset($_REQUEST['email'])) {$email = substr(htmlspecialchars(trim($_REQUEST['email']), ENT_QUOTES, 'utf-8'), 0, 200);	unset($_REQUEST['email']);}
	if (isset($_REQUEST['phone'])) {$phone = substr(htmlspecialchars(trim($_REQUEST['phone']), ENT_QUOTES, 'utf-8'), 0, 100);	unset($_REQUEST['phone']);}
	if (isset($_REQUEST['text'])) {$text = substr(htmlspecialchars(trim($_REQUEST['text']), ENT_QUOTES, 'utf-8'), 0, 100);	unset($_REQUEST['text']);}

	// готовим сообщение
	$post_txt = "
<p>Клиент: <strong>{$name}</strong></p>
<p>Телефон: <strong>{$phone}</strong></p>
<p>E-mail: <strong>{$email}</strong></p>
<p>Сообщение:<br>
<strong>{$text}</strong></p>
<br>
<p>Параметры для расчета:</p>
<br>
<p>Тип открывания:</p>
<p>Окно 1: <strong>{$open_tipe_window_1}</strong></p>
	";
	if(isset($open_tipe_window_2)) $post_txt .= "
<p>Окно 2: <strong>{$open_tipe_window_2}</strong></p>
	";
	if(isset($open_tipe_window_3)) $post_txt .= "
<p>Окно 3: <strong>{$open_tipe_window_3}</strong></p>
	";
	$post_txt .= "
<br>
<p>Размеры:</p>
<p>Высота: <strong>{$window_size_height}</strong></p>
<p>Ширина: <strong>{$window_size_width}</strong></p>
<br>
<p>Количество: <strong>{$window_count} шт.</strong></p>
<br>
<p>Тип профиля: <strong>{$profile_type}</strong></p>
<p>Тип дома: <strong>{$home_type}</strong></p>
<br>
<p>Дополнительно:</p>
	";
	if(isset($additional_1)) $post_txt .= "
<p><strong>{$additional_1}</strong></p>
	";
	if(isset($additional_2)) $post_txt .= "
<p><strong>{$additional_2}</strong></p>
	";
	if(isset($additional_3)) $post_txt .= "
<p><strong>{$additional_3}</strong></p>
	";
	if(isset($additional_4)) $post_txt .= "
<p><strong>{$additional_4}</strong></p>
	";
	if(isset($additional_5)) $post_txt .= "
<p><strong>{$additional_5}</strong></p>
	";
	$post_txt .= "
<br>
<p>Место монтажа: <strong>{$location}</strong></p>
	";
	// заголовки
	$headers= "MIME-Version: 1.0\r\n";
	$headers .= "Content-type: text/html; charset=utf-8\r\n";
	$headers .= "From: $name <$email>\r\n";
	// отправляем
	$mail = mail('info@okna-a.by', 'Сообщение с сайта OKNA-A.BY из формы КАЛЬКУЛЯТОР', $post_txt, $headers);

	// если удачно, отображаем сообщение
	if($mail) echo "
<p style='color:red; font-weight:bold; text-align:center;'>Уважаемый {$name}, сообщение отправлено. Очень скоро мы с Вами свяжемся.</p>
";
	else echo "
<p style='color:red; font-weight:bold; text-align:center;'>Что-то пошло не так!... Попробуйте еще раз.</p>
	";
}
?>
<div class="calculator">
	<div class="calculator_menu">
		<ul>
			<li><a href="#" id="calculator_menu_1" style="background-color:#E31E24">Одностворчатые</a></li>
			<li><a href="#" id="calculator_menu_2">Двухстворчатые</a></li>
			<li><a href="#" id="calculator_menu_3">Трёхстворчатые</a></li>
			<li><a href="#" id="calculator_menu_4">Балконные блоки</a></li>
		</ul>
	</div>

<form method="post" name="custinfo_form" onSubmit="return validate_custinfo(this);">
	<div class="calculator_choice-block">
		<div class="calculator_line-1">
			<div class="calculator_block-1">
				<div id="window_menu" class="calculator_window-menu">
					<ul><li><a href="#" id="window_menu_1_1" style="padding:1px; border:solid 1px #E31E24; transform:scale(1.15);"><img src="/img/calc_menu_pic_1_1.jpg"></a></li><li><a href="#" id="window_menu_1_2"><img src="/img/calc_menu_pic_1_2.jpg"></a></li><li><a href="#" id="window_menu_1_3"><img src="/img/calc_menu_pic_1_3.jpg"></a></li></ul>
				</div>

				<div class="calculator_main-pic-block">
					<div id="main_pic" class="calculator_main-pic">
						<img src="/img/calc_pic_1.jpg">
					</div>
				</div>
			</div>

			<div class="calculator_block-2">
				<div class="calculator_open-window-choice-title">
					<p>Тип открывания</p>
				</div>
				<div class="calculator_open-window-choice-block">
					<div class="calculator_open-window-choice_window-1">
						<div class="calculator_open-window-choice_number-of-window"><span class="calculator_win_number" id="num_1">1</span></div>
						<p><span class="calculator_bird"><img src="/img/red_bird.jpg" id="bird_1_1" style="left:0"></span>Не открывается<input id="win_type_1_1" type="radio" name="open-tipe-window-1" value="Не открывается" checked></p>
						<p><span class="calculator_bird"><img src="/img/red_bird.jpg" id="bird_1_2"></span>Поворотное<input id="win_type_1_2" type="radio" name="open-tipe-window-1" value="Поворотное"></p>
						<p><span class="calculator_bird"><img src="/img/red_bird.jpg" id="bird_1_3"></span>Поворотно-откидное<input id="win_type_1_3" type="radio" name="open-tipe-window-1" value="Поворотно-откидное"></p>
					</div>
					<div class="calculator_open-window-choice_window-2">
						<div class="calculator_open-window-choice_number-of-window"><span class="calculator_win_number" id="num_2">2</span></div>
						<p><span class="calculator_bird"><img src="/img/red_bird.jpg" id="bird_2_1"></span>Не открывается<input id="win_type_2_1" type="radio" name="open-tipe-window-2" value="Не открывается"></p>
						<p><span class="calculator_bird"><img src="/img/red_bird.jpg" id="bird_2_2"></span>Поворотное<input id="win_type_2_2" type="radio" name="open-tipe-window-2" value="Поворотное"></p>
						<p><span class="calculator_bird"><img src="/img/red_bird.jpg" id="bird_2_3"></span>Поворотно-откидное<input id="win_type_2_3" type="radio" name="open-tipe-window-2" value="Поворотно-откидное"></p>
					</div>
					<div class="calculator_open-window-choice_window-3">
						<div class="calculator_open-window-choice_number-of-window"><span class="calculator_win_number" id="num_3">3</span></div>
						<p><span class="calculator_bird"><img src="/img/red_bird.jpg" id="bird_3_1"></span>Не открывается<input id="win_type_3_1" type="radio" name="open-tipe-window-3" value="Не открывается"></p>
						<p><span class="calculator_bird"><img src="/img/red_bird.jpg" id="bird_3_2"></span>Поворотное<input id="win_type_3_2" type="radio" name="open-tipe-window-3" value="Поворотное"></p>
						<p><span class="calculator_bird"><img src="/img/red_bird.jpg" id="bird_3_3"></span>Поворотно-откидное<input id="win_type_3_3" type="radio" name="open-tipe-window-3" value="Поворотно-откидное"></p>
					</div>
				</div>

				<div class="calculator_window-size-block">
					<div class="calculator_window-size-title">
						<p>Ваши размеры:</p>
					</div>
					<div class="calculator_window-size-input">
						высота <input type="number" name="window-size-height" value="1400" min="500" max="2000"> мм, 
						ширина <input type="number" name="window-size-width" value="1400" min="500" max="2000"> мм.
					</div>
				</div>

				<div class="calculator_window-count-block">
					<div class="calculator_window-count-title">
						<p>Количество:</p>
					</div>
					<div class="calculator_window-count-input">
						<input type="number" name="window-count" value="1" min="1"> шт. 
					</div>
				</div>

			</div>
		</div>

		<div class="calculator_line-2">
			<div class="calculator_additional-option-block">
				<div class="calculator_profile-type">
					<div class="calculator_additional-title">
						<p>Тип профиля</p>
					</div>
					<div>
						<label><span class="calculator_radio"><img src="/img/red_radio_button.jpg" id="profile_type_round_1" style="left:-21px"></span>SALAMANDER<input type="radio" id="profile_type_1" name="profile-type" value="Salamander" checked></label>
					</div>
					<div>
						<label><span class="calculator_radio"><img src="/img/red_radio_button.jpg" id="profile_type_round_2"></span>REHAU<input type="radio" id="profile_type_2" name="profile-type" value="Rehau"></label>
					</div>
					<div>
						<label><span class="calculator_radio"><img src="/img/red_radio_button.jpg" id="profile_type_round_3"></span>BRUSBOX<input id="profile_type_3" type="radio" name="profile-type" value="Brusbox"></label>
					</div>
					<div>
						<label><span class="calculator_radio"><img src="/img/red_radio_button.jpg" id="profile_type_round_4"></span>KBE<input type="radio" id="profile_type_4" name="profile-type" value="KBE"></label>
					</div>
				</div>
				<div class="calculator_home-type">
					<div class="calculator_additional-title">
						<p>Тип дома</p>
					</div>
					<div>
						<label><span class="calculator_radio"><img src="/img/red_radio_button.jpg" id="home_type_round_1" style="left:-21px"></span>Панель<input type="radio" id="home_type_1" name="home-type" value="Панель" checked></label>
					</div>
					<div>
						<label><span class="calculator_radio"><img src="/img/red_radio_button.jpg" id="home_type_round_2"></span>Кирпич<input type="radio" id="home_type_2" name="home-type" value="Кирпич"></label>
					</div>
					<div>
						<label><span class="calculator_radio"><img src="/img/red_radio_button.jpg" id="home_type_round_3"></span>Газосиликатный блок<input type="radio" id="home_type_3" name="home-type" value="Газосиликатный блок"></label>
					</div>
					<div>
						<label><span class="calculator_radio"><img src="/img/red_radio_button.jpg" id="home_type_round_4"></span>Дерево<input type="radio" id="home_type_4" name="home-type" value="Дерево"></label>
					</div>
				</div>
				<div class="calculator_additional-type">
					<div class="calculator_additional-title">
						<p>Дополнительно</p>
					</div>
					<div>
						<label><span class="calculator_radio"><img src="/img/red_radio_button.jpg" id="additional_type_round_1"></span>Монтаж<input type="checkbox" id="additional_type_1" name="additional_1" value="Монтаж"></label>
					</div>
					<div>
						<label><span class="calculator_radio"><img src="/img/red_radio_button.jpg" id="additional_type_round_2"></span>Откосы<input type="checkbox" id="additional_type_2" name="additional_2" value="Откосы"></label>
					</div>
					<div>
						<label><span class="calculator_radio"><img src="/img/red_radio_button.jpg" id="additional_type_round_3"></span>Москитная сетка<input type="checkbox" id="additional_type_3" name="additional_3" value="Москитная сетка"></label>
					</div>
					<div>
						<label><span class="calculator_radio"><img src="/img/red_radio_button.jpg" id="additional_type_round_4"></span>Отливы<input type="checkbox" id="additional_type_4" name="additional_4" value="Отливы"></label>
					</div>
					<div>
						<label><span class="calculator_radio"><img src="/img/red_radio_button.jpg" id="additional_type_round_5"></span>Подоконник<input type="checkbox" id="additional_type_5" name="additional_5" value="Подоконник"></label>
					</div>
				</div>
			</div>

			<div class="calculator_location">
				Место монтажа <span>*</span>
				<input type="text" name="location" placeholder="Минск" maxlength="200">
			</div>

		</div>
	</div>

	<div class="calculator_contact-form-block">
		<div class="calculator_person-info">
			<div>
				<p>Ваше имя <span>*</span></p>
				<p><input type="text" name="name" maxlength="100"></p>
			</div>
			<div>
				<p>Ваш e-mail <span>*</span></p>
				<p><input type="email" name="email" maxlength="100"></p>
			</div>
			<div>
				<p>Ваш телефон <span>*</span></p>
				<p><input type="tel" name="phone" maxlength="100"></p>
			</div>
		</div>

		<div class="calculator_text">
			<div>
				<textarea name="text" placeholder="Сообщение"></textarea>
			</div>

			<div class="calculator_notify">
				<p><span>*</span> - обязательно к заполнению</p>
			</div>



			<div>
				<p><input type="submit" name="submit" value="Отправить"></p>
			</div>
		</div>

	</div>

</form>
</div>
<script type="text/javascript" src="/inc/js/calculator.js"></script>
