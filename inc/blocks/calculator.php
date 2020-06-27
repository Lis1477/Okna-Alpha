<?php 
// проверяем легальность загрузки файла
if(!defined('CONTROL_INC')) {
	$protocol = stripos($_SERVER['SERVER_PROTOCOL'],'https') === true ? 'https://' : 'http://';
	header ("Location: $protocol$_SERVER[SERVER_NAME]");
	exit;
}

if(!isset($_REQUEST['to_basket'])) {
	// создаем сессию заказа
	if (!isset($_SESSION['ordering'])) $_SESSION['ordering'] = array();
	// назначаем номер заказа - 1, если не существует номера заказа
	if (!isset($_SESSION['number_of_list'])) $_SESSION['number_of_list'] = 1;

	// обработчик формы - запоминаем заказ
	if(isset($_REQUEST['add_to_order'])) {
		// проверяем переменные
		if (isset($_REQUEST['open-tipe-window-1'])) {$open_tipe_window_1 = substr(htmlspecialchars(trim($_REQUEST['open-tipe-window-1']), ENT_QUOTES, 'utf-8'), 0, 50);	unset($_REQUEST['open-tipe-window-1']);}
		if (isset($_REQUEST['open-tipe-window-2'])) {$open_tipe_window_2 = substr(htmlspecialchars(trim($_REQUEST['open-tipe-window-2']), ENT_QUOTES, 'utf-8'), 0, 50);	unset($_REQUEST['open-tipe-window-2']);} else $open_tipe_window_2 = "";
		if (isset($_REQUEST['open-tipe-window-3'])) {$open_tipe_window_3 = substr(htmlspecialchars(trim($_REQUEST['open-tipe-window-3']), ENT_QUOTES, 'utf-8'), 0, 50);	unset($_REQUEST['open-tipe-window-3']);}  else $open_tipe_window_3 = "";

		if (isset($_REQUEST['window_size_height'])) {$window_size_height = intval($_REQUEST['window_size_height']);	unset($_REQUEST['window_size_height']);}
		if (isset($_REQUEST['window_size_width'])) {$window_size_width = intval($_REQUEST['window_size_width']);	unset($_REQUEST['window_size_width']);}
		if (isset($_REQUEST['window_count'])) {$window_count = intval($_REQUEST['window_count']);	unset($_REQUEST['window_count']);}

		if (isset($_REQUEST['profile-type'])) {$profile_type = substr(htmlspecialchars(trim($_REQUEST['profile-type']), ENT_QUOTES, 'utf-8'), 0, 50);	unset($_REQUEST['profile-type']);}
		if (isset($_REQUEST['home-type'])) {$home_type = substr(htmlspecialchars(trim($_REQUEST['home-type']), ENT_QUOTES, 'utf-8'), 0, 50);	unset($_REQUEST['home-type']);}
		if (isset($_REQUEST['glasspack-type'])) {$glasspack_type = substr(htmlspecialchars(trim($_REQUEST['glasspack-type']), ENT_QUOTES, 'utf-8'), 0, 50);	unset($_REQUEST['glasspack-type']);}
		if (isset($_REQUEST['furniture-type'])) {$furniture_type = substr(htmlspecialchars(trim($_REQUEST['furniture-type']), ENT_QUOTES, 'utf-8'), 0, 50);	unset($_REQUEST['furniture-type']);}

		if (isset($_REQUEST['additional_1'])) {$additional_1 = substr(htmlspecialchars(trim($_REQUEST['additional_1']), ENT_QUOTES, 'utf-8'), 0, 50);	unset($_REQUEST['additional_1']);}
				else $additional_1 = "";
		if (isset($_REQUEST['additional_2'])) {$additional_2 = substr(htmlspecialchars(trim($_REQUEST['additional_2']), ENT_QUOTES, 'utf-8'), 0, 50);	unset($_REQUEST['additional_2']);}
				else $additional_2 = "";
		if (isset($_REQUEST['additional_3'])) {$additional_3 = substr(htmlspecialchars(trim($_REQUEST['additional_3']), ENT_QUOTES, 'utf-8'), 0, 50);	unset($_REQUEST['additional_3']);}
				else $additional_3 = "";
		if (isset($_REQUEST['additional_4'])) {$additional_4 = substr(htmlspecialchars(trim($_REQUEST['additional_4']), ENT_QUOTES, 'utf-8'), 0, 50);	unset($_REQUEST['additional_4']);}
				else $additional_4 = "";
		if (isset($_REQUEST['additional_5'])) {$additional_5 = substr(htmlspecialchars(trim($_REQUEST['additional_5']), ENT_QUOTES, 'utf-8'), 0, 50);	unset($_REQUEST['additional_5']);}
				else $additional_5 = "";

		if (isset($_REQUEST['location'])) {$location = substr(htmlspecialchars(trim($_REQUEST['location']), ENT_QUOTES, 'utf-8'), 0, 200);	unset($_REQUEST['location']);}

		if (isset($_REQUEST['list'])) {$list = intval($_REQUEST['list']);	unset($_REQUEST['list']);}
		if (isset($_REQUEST['type_window'])) {$type_window = substr(htmlspecialchars(trim($_REQUEST['type_window']), ENT_QUOTES, 'utf-8'), 0, 50);	unset($_REQUEST['type_window']);}
		if (isset($_REQUEST['pic'])) {$pic = substr(htmlspecialchars(trim($_REQUEST['pic']), ENT_QUOTES, 'utf-8'), 0, 50);	unset($_REQUEST['pic']);}

		// записываем заказ в сессию
		$_SESSION['ordering'][$list] = array("Лист" => $list, "Тип окна" => $type_window, "Тип открывания Окно-1" => $open_tipe_window_1, "Тип открывания Окно-2" => $open_tipe_window_2, "Тип открывания Окно-3" => $open_tipe_window_3, "Высота" => $window_size_height, "Ширина" => $window_size_width, "Количество" => $window_count, "Тип профиля" => $profile_type, "Тип дома" => $home_type, "Тип стеклопакета" => $glasspack_type, "Тип фурнитуры" => $furniture_type, "Дополнительно 1" => $additional_1, "Дополнительно 2" => $additional_2, "Дополнительно 3" => $additional_3, "Дополнительно 4" => $additional_4, "Дополнительно 5" => $additional_5, "Место монтажа" => $location, "Изображение" => $pic);

		if(isset($_SESSION['ordering'][$_SESSION['number_of_list']])) $_SESSION['number_of_list'] +=1;
		// сообщение
?>
<p style="color:red; text-align:center; font-weight:bold;">Заказ № <?=$list?> сохранен.<br>Для просмотра и редактирование заказов, отправки администратору, жмите на кнопку &laquo;Ваши заказы&raquo;<br>или заполните следующий заказ.</p>
<?php
	}
	// если не сушествует запрос на редактирование..
	if(!isset($_REQUEST['edit_order'])) {
		// определяем номер заказа
		$number_of_list = $_SESSION['number_of_list'];
	}
	// если существует..
	else {
		// проверяем переменную
		if (isset($_REQUEST['list'])) {$list = intval($_REQUEST['list']);	unset($_REQUEST['list']);}
		// определяем номер заказа
		$number_of_list = $list;
	}

	// отправка письма администратору
	if(isset($_REQUEST['on_mail'])) {

		// проверяем переменные
		if (isset($_REQUEST['name'])) {$name = substr(htmlspecialchars(trim($_REQUEST['name']), ENT_QUOTES, 'utf-8'), 0, 100);	unset($_REQUEST['name']);}
		if (isset($_REQUEST['email'])) {$email = substr(htmlspecialchars(trim($_REQUEST['email']), ENT_QUOTES, 'utf-8'), 0, 200);	unset($_REQUEST['email']);}
		if (isset($_REQUEST['phone'])) {$phone = substr(htmlspecialchars(trim($_REQUEST['phone']), ENT_QUOTES, 'utf-8'), 0, 100);	unset($_REQUEST['phone']);}
		if (isset($_REQUEST['text'])) {$text = substr(htmlspecialchars(trim($_REQUEST['text']), ENT_QUOTES, 'utf-8'), 0, 6000);	unset($_REQUEST['text']);}

		// готовим сообщение
		$post_txt = "
<style>
	table td {border:solid 1px #CCCCCC; padding:5px;}
	table img {height:100px;}
</style>

<p>Клиент: <strong>{$name}</strong></p>
<p>Телефон: <strong>{$phone}</strong></p>
<p>E-mail: <strong>{$email}</strong></p>
<p>Сообщение:<br>
<strong>{$text}</strong></p>
<p>Параметры для расчета:</p>

<table cellpadding=0 cellspacing=0>
	<tr>
		<td>№ заказа</td>
		<td>Тип открывания</td>
		<td>Ширина</td>
		<td>Высота</td>
		<td>Количество</td>
		<td>Тип стеклопакета</td>
		<td>Тип профиля</td>
		<td>Тип фурнитуры</td>
		<td>Тип дома</td>
		<td>Место монтажа</td>
		<td>Дополнительно</td>
	</tr>
		";
		foreach($_SESSION['ordering'] as $list_num => $parameter) {
		$post_txt .= "
	<tr>
		<td>№ {$parameter['Лист']}</td>
		<td><img src='https://okna-a.by/img/{$parameter['Изображение']}'></td>
		<td>{$parameter['Ширина']}</td>
		<td>{$parameter['Высота']}</td>
		<td>{$parameter['Количество']}</td>
		<td>{$parameter['Тип стеклопакета']}</td>
		<td>{$parameter['Тип профиля']}</td>
		<td>{$parameter['Тип фурнитуры']}</td>
		<td>{$parameter['Тип дома']}</td>
		<td>{$parameter['Место монтажа']}</td>
		<td>{$parameter['Дополнительно 1']}<br>{$parameter['Дополнительно 2']}<br>{$parameter['Дополнительно 3']}<br>{$parameter['Дополнительно 4']}<br>{$parameter['Дополнительно 5']}</td>
	</tr>
		";
}
		$post_txt .= "
</table>
		";
		// заголовки
		$headers= "MIME-Version: 1.0\r\n";
		$headers .= "Content-type: text/html; charset=utf-8\r\n";
		$headers .= "From: $name <$email>\r\n";
		// отправляем
		$mail = mail('info@okna-a.by', 'Сообщение с сайта OKNA-A.BY из формы КАЛЬКУЛЯТОР', $post_txt, $headers);

		// если удачно, отображаем сообщение
		if($mail) {
			echo "
<p style='color:red; font-weight:bold; text-align:center;'>Уважаемый {$name}, заказ отправлен на предварительный расчет.<br>Очень скоро с Вами свяжется наш специалист для уточнения деталей.</p>
			";
			// удаляем сессию заказа
			$_SESSION['ordering'] = array();
			$_SESSION['number_of_list'] = 1;
			$number_of_list = 1;
		}
			else echo "
<p style='color:red; font-weight:bold; text-align:center;'>Что-то пошло не так!... Попробуйте еще раз.</p>
	";


	}

	// выводим калькулятор
	// вставляем скрипт обработки калькулятора
	require_once ("js_script.php");
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

	<div class="calculator_choice-block">
	<form method="post" name="custinfo_form" id="order_form" onSubmit="return validate_custinfo(this);">
		<div class="calculator_number-list">№ <?=$number_of_list?></div>
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
						ширина <input type="number" name="window_size_width" value="1400" min="360" max="3000"> мм, 
						высота <input type="number" name="window_size_height" value="1400" min="360" max="3000"> мм.
					</div>
				</div>

				<div class="calculator_window-count-block">
					<div class="calculator_window-count-title">
						<p>Количество:</p>
					</div>
					<div class="calculator_window-count-input">
						<input type="number" name="window_count" value="1" min="1"> шт. 
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
						<label><span class="calculator_radio"><img src="/img/red_radio_button.jpg" id="profile_type_round_4"></span>KBE<input type="radio" id="profile_type_4" name="profile-type" value="KBE"></label>
					</div>
					<div>
						<label><span class="calculator_radio"><img src="/img/red_radio_button.jpg" id="profile_type_round_3"></span>BRUSBOX<input id="profile_type_3" type="radio" name="profile-type" value="Brusbox"></label>
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

				<div class="calculator_glasspack-type">
					<div class="calculator_additional-title">
						<p>Тип стеклопакета</p>
					</div>
					<div>
						<label><span class="calculator_radio"><img src="/img/red_radio_button.jpg" id="glasspack_type_round_1" style="left:-21px"></span>Однокамерный<input type="radio" id="glasspack_type_1" name="glasspack-type" value="Однокамерный" checked></label>
					</div>
					<div>
						<label><span class="calculator_radio"><img src="/img/red_radio_button.jpg" id="glasspack_type_round_2"></span>Двухкамерный<input type="radio" id="glasspack_type_2" name="glasspack-type" value="Двухкамерный"></label>
					</div>
					<div style="display:none;">
						<label><span class="calculator_radio"><img src="/img/red_radio_button.jpg" id="glasspack_type_round_3"></span>Трёхкамерный<input type="radio" id="glasspack_type_3" name="glasspack-type" value="Трёхкамерный"></label>
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

			<div class="calculator_furniture-type">
				<div class="calculator_additional-title">
					<p>Тип фурнитуры</p>
				</div>
				<div>
					<label><span class="calculator_radio"><img src="/img/red_radio_button.jpg" id="furniture_type_round_1" style="left:-21px"></span>Бюджетная<input type="radio" id="furniture_type_1" name="furniture-type" value="Бюджетная" checked></label>
				</div>
				<div>
					<label><span class="calculator_radio"><img src="/img/red_radio_button.jpg" id="furniture_type_round_2"></span>Средняя<input type="radio" id="furniture_type_2" name="furniture-type" value="Средняя"></label>
				</div>
				<div>
					<label><span class="calculator_radio"><img src="/img/red_radio_button.jpg" id="furniture_type_round_3"></span>Премиум<input type="radio" id="furniture_type_3" name="furniture-type" value="Премиум"></label>
				</div>
			</div>

			<div class="calculator_location">
				Место монтажа <span>*</span>
				<input type="text" name="location" placeholder="Минск" maxlength="200">
			</div>
      
      <div><input type="hidden" name="list" value="<?=$number_of_list?>"></div>
      <div><input type="hidden" name="type_window" value="Одностворчатые"></div>
      <div><input type="hidden" name="pic" value="calc_pic_1_1.jpg"></div>

		</div>
	</form>
			<div class="calculator_button-line">
				<div><input type="submit" name="add_to_order" value="Добавить в заказ" form="order_form"></div>
				<div><form method="post"><input type="submit" name="to_basket" value="Ваш заказ"></form></div>
			</div>

	</div>

</div>

<?php
}
else {
// удаление заказа, если есть запрос
	// предупреждение перед удалением
	if(isset($_REQUEST['del_order'])) {
		// проверяем переменную
		if (isset($_REQUEST['list'])) {$list = intval($_REQUEST['list']);	unset($_REQUEST['list']);}
?>
<p style="color:red; font-weight:bold;">Вы собираетесь удалить заказ № <?=$list?>!</p>
<form method='post'>
	<input type="hidden" name="list" value="<?=$list?>">
	<input type="hidden" name="to_basket" value="">
	<input type="submit" name="del" value="ДА" style="cursor:pointer;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<input type="submit" value="НЕТ" style="cursor:pointer;">
</form>
</div></div></div><div class="right-side"></div></div></article>
<footer>
	<div class="container">
		<p>Copyright © 2019 <a href="<?=$main_url?>">www.okna-a.by</a></p>
	</div>
</footer>
<?php
		exit();
	}
	if(isset($_REQUEST['del'])) {
		// проверяем переменную
		if (isset($_REQUEST['list'])) {$list = intval($_REQUEST['list']);	unset($_REQUEST['list']);}
		// удаляем
		unset($_SESSION['ordering'][$list]);
		unset($list);
	}
// выводим заказы
?>
<div class="calculator">
	<div class="calculator_orders-header-line">
		<div class="calculator_orders-header">Ваш заказ</div>
		<div class="calculator_return"><a href="/produktsiya/okna-pvh/kalkulyator">В калькулятор</a></div>
	</div>

	<div class="calculator_orders">
  
<?php
	if(!empty($_SESSION['ordering'])) {
		foreach($_SESSION['ordering'] as $list_num => $parameters) {
?>
		<div class="calculator_order-element">
			<div class="calculator_order-number">
				<p>№ <?=$parameters['Лист']?></p>
			</div>
			<div class="calculator_order-picture">
				<img src="/img/<?=$parameters['Изображение']?>">
			</div>
			<div class="calculator_order-parameters">
				<p><span>Тип окна:</span> <span><?=$parameters['Тип окна']?></span></p>
				<p><span>Тип открывания Окно-1:</span> <span><?=$parameters['Тип открывания Окно-1']?></span></p>
<?php
			if(!empty($parameters['Тип открывания Окно-2'])) {
?>
				<p><span>Тип открывания Окно-2:</span> <span><?=$parameters['Тип открывания Окно-2']?></span></p>
<?php
			}
			if(!empty($parameters['Тип открывания Окно-3'])) {
?>
				<p><span>Тип открывания Окно-3:</span> <span><?=$parameters['Тип открывания Окно-3']?></span></p>
<?php
			}
?>
				<p><span>Ширина:</span> <span><?=$parameters['Ширина']?></span></p>
				<p><span>Высота:</span> <span><?=$parameters['Высота']?></span></p>
				<p><span>Количество:</span> <span><?=$parameters['Количество']?></span></p>
				<p><span>Тип профиля:</span> <span><?=$parameters['Тип профиля']?></span></p>
				<p><span>Тип дома:</span> <span><?=$parameters['Тип дома']?></span></p>
				<p><span>Тип стеклопакета:</span> <span><?=$parameters['Тип стеклопакета']?></span></p>
				<p><span>Тип фурнитуры:</span> <span><?=$parameters['Тип фурнитуры']?></span></p>
<?php
			$additional = "";
			if(!empty($parameters['Дополнительно 1'])) $additional .= $parameters['Дополнительно 1'];
			if(!empty($parameters['Дополнительно 2'])) $additional .= ", ".$parameters['Дополнительно 2'];
			if(!empty($parameters['Дополнительно 3'])) $additional .= ", ".$parameters['Дополнительно 3'];
			if(!empty($parameters['Дополнительно 4'])) $additional .= ", ".$parameters['Дополнительно 4'];
			if(!empty($parameters['Дополнительно 5'])) $additional .= ", ".$parameters['Дополнительно 5'];
					
			if(!empty($additional)) {
?>
				<p><span>Дополнительно:</span> <span><?=$additional?></span></p>
<?php
			}
?>
				<p><span>Место монтажа:</span> <span><?=$parameters['Место монтажа']?></span></p>
			</div>
			<div class="calculator_order-edit">
				<form method="post">
					<input type="hidden" name="list" value="<?=$parameters['Лист']?>">
					<input type="submit" name="edit_order" value="Редактировать">
				</form>

				<form method="post">
					<input type="hidden" name="list" value="<?=$parameters['Лист']?>">
					<input type="hidden" name="to_basket" value="">
					<input type="submit" name="del_order" value="Удалить">
				</form>
			</div>

		</div>
<?php
		}
	}
	else  {
// выдаем сообщение, что заказы отсутствуют
?>
<p style="font-weight:bold;">У Вас нет сохраненных заказов.</p>
<?php
// удаляем сессии
		unset($_SESSION['ordering']);
		unset($_SESSION['number_of_list']);
	}
?>
	</div>
<?php
	if(!empty($_SESSION['ordering'])) {
?>
	<form method="post">
	<div class="calculator_contact-form-block">
		<div class="calculator_person-info">
			<div>
				<p>Ваше имя <span>*</span></p>
				<p><input type="text" name="name" maxlength="100" required></p>
			</div>
			<div>
				<p>Ваш e-mail <span>*</span></p>
				<p><input type="email" name="email" maxlength="100" required></p>
			</div>
			<div>
				<p>Ваш телефон <span>*</span></p>
				<p><input type="tel" name="phone" maxlength="100" required></p>
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
				<p><input type="submit" name="on_mail" value="Отправить на расчет"></p>
			</div>
		</div>
	</div>
	</form>
<?php
	}
?>
</div>
<?php
}
?>
