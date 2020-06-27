<script type="text/javascript">
window.onload = function () {
<?php
// если не сушествует запрос на редактирование..
if(!isset($_REQUEST['edit_order'])) {
?>
	// дефолтная обработка меню окон типа ОДНОСТВОРЧАТЫЕ
	document.getElementById("window_menu_1_1").onclick = function() {
		// вставляем нужную картинку в input
		document.custinfo_form.pic.value="calc_pic_1_1.jpg";
		// устанавливаем стили для активного элемента меню окон
		window_menu_1_1.setAttribute("style", "padding:1px; border:solid 1px #E31E24; transform:scale(1.15);");
		// удаляем стили у других элемента меню окон, если имются
		if (window_menu_1_2.style) window_menu_1_2.removeAttribute("style");
		if (window_menu_1_3.style) window_menu_1_3.removeAttribute("style");
		// отображаем соответствующую главную картинку
		document.getElementById("main_pic");
		if (main_pic.firstElementChild.style) main_pic.firstElementChild.removeAttribute("style");
		// чекаем соответствующий тип открывания окна		
		document.getElementById("win_type_1_1").checked = true;
		// отображаем птичку
		document.getElementById("bird_1_1").setAttribute("style", "left:0");
		// прячем птичку у остальных типов, если видна
		if (bird_1_1.style) bird_1_2.removeAttribute("style");
		if (bird_1_3.style) bird_1_3.removeAttribute("style");
		return false;
	}
	document.getElementById("window_menu_1_2").onclick = function() {
		// вставляем нужную картинку в input
		document.custinfo_form.pic.value="calc_pic_1_2.jpg";
		// устанавливаем стили для активного элемента меню окон
		window_menu_1_2.setAttribute("style", "padding:1px; border:solid 1px #E31E24; transform:scale(1.15);");
		// удаляем стили у других элемента меню окон, если имются
		if (window_menu_1_1.style) window_menu_1_1.removeAttribute("style");
		if (window_menu_1_3.style) window_menu_1_3.removeAttribute("style");
		// отображаем соответствующую главную картинку
		document.getElementById("main_pic").firstElementChild.setAttribute("style", "left:-159px");
		// чекаем соответствующий тип открывания окна		
		document.getElementById("win_type_1_2").checked = true;
		// отображаем птичку
		document.getElementById("bird_1_2").setAttribute("style", "left:0");
		// прячем птичку у остальных типов, если видна
		if (bird_1_1.style) bird_1_1.removeAttribute("style");
		if (bird_1_3.style) bird_1_3.removeAttribute("style");
		return false;
	}
	document.getElementById("window_menu_1_3").onclick = function() {
		// вставляем нужную картинку в input
		document.custinfo_form.pic.value="calc_pic_1_3.jpg";
		// устанавливаем стили для активного элемента меню окон
		window_menu_1_3.setAttribute("style", "padding:1px; border:solid 1px #E31E24; transform:scale(1.15);");
		// удаляем стили у других элемента меню окон, если имются
		if (window_menu_1_1.style) window_menu_1_1.removeAttribute("style");
		if (window_menu_1_2.style) window_menu_1_2.removeAttribute("style");
		// отображаем соответствующую главную картинку
		document.getElementById("main_pic").firstElementChild.setAttribute("style", "left:-316px");
		// чекаем соответствующий тип открывания окна		
		document.getElementById("win_type_1_3").checked = true;
		// отображаем птичку
		document.getElementById("bird_1_3").setAttribute("style", "left:0");
		// прячем птичку у остальных типов, если видна
		if (bird_1_1.style) bird_1_1.removeAttribute("style");
		if (bird_1_2.style) bird_1_2.removeAttribute("style");
		return false;
	}
	// чекаем чекбоксы Дополнительно
	document.getElementById("additional_type_1");
	document.getElementById("additional_type_2");
	document.getElementById("additional_type_3");
	document.getElementById("additional_type_4");
	document.getElementById("additional_type_5");

	additional_type_1.checked = true;
	additional_type_2.checked = true;
	additional_type_3.checked = true;
	additional_type_4.checked = true;
	additional_type_5.checked = true;

<?php
}
else {
	// для удобства записываем сессию заказа в отдельную переменную
	$order = $_SESSION['ordering'][$list];
	// с помощью скрипта меняем параметры для правильного отображения
?>
		// вставляем высоту, ширину, количество, место монтажа в input
		document.custinfo_form.window_size_height.value="<?=$order['Высота']?>";
		document.custinfo_form.window_size_width.value="<?=$order['Ширина']?>";
		document.custinfo_form.window_count.value="<?=$order['Количество']?>";
		document.custinfo_form.location.value="<?=$order['Место монтажа']?>";
		document.custinfo_form.type_window.value="<?=$order['Тип окна']?>";
		document.custinfo_form.pic.value="<?=$order['Изображение']?>";

<?php
		if($order['Тип открывания Окно-1'] == "Поворотное") {
			// чекаем соответствующий тип открывания окна		
?>
		// чекаем соответствующий тип открывания окна		
		document.getElementById("win_type_1_2").checked = true;
		// отображаем птичку
		document.getElementById("bird_1_2").setAttribute("style", "left:0");
		// прячем птичку у остальных типов, если видна
		if (bird_1_1.style) bird_1_1.removeAttribute("style");
<?php
		}
		if($order['Тип открывания Окно-1'] == "Поворотно-откидное") {
			// чекаем соответствующий тип открывания окна		
?>
		// чекаем соответствующий тип открывания окна		
		document.getElementById("win_type_1_3").checked = true;
		// отображаем птичку
		document.getElementById("bird_1_3").setAttribute("style", "left:0");
		// прячем птичку у остальных типов, если видна
		if (bird_1_1.style) bird_1_1.removeAttribute("style");
<?php
		}

		if($order['Тип открывания Окно-2'] == "Не открывается") {
			// чекаем соответствующий тип открывания окна		
?>
		// чекаем соответствующий тип открывания окна		
		document.getElementById("win_type_2_1").checked = true;
		// отображаем птичку
		document.getElementById("bird_2_1").setAttribute("style", "left:0");
<?php
		}
		if($order['Тип открывания Окно-2'] == "Поворотное") {
			// чекаем соответствующий тип открывания окна		
?>
		// чекаем соответствующий тип открывания окна		
		document.getElementById("win_type_2_2").checked = true;
		// отображаем птичку
		document.getElementById("bird_2_2").setAttribute("style", "left:0");
<?php
		}
		if($order['Тип открывания Окно-2'] == "Поворотно-откидное") {
			// чекаем соответствующий тип открывания окна		
?>
		// чекаем соответствующий тип открывания окна		
		document.getElementById("win_type_2_3").checked = true;
		// отображаем птичку
		document.getElementById("bird_2_3").setAttribute("style", "left:0");
<?php
		}

		if($order['Тип открывания Окно-3'] == "Не открывается") {
			// чекаем соответствующий тип открывания окна		
?>
		// чекаем соответствующий тип открывания окна		
		document.getElementById("win_type_3_1").checked = true;
		// отображаем птичку
		document.getElementById("bird_3_1").setAttribute("style", "left:0");
<?php
		}
		if($order['Тип открывания Окно-3'] == "Поворотное") {
			// чекаем соответствующий тип открывания окна		
?>
		// чекаем соответствующий тип открывания окна		
		document.getElementById("win_type_3_2").checked = true;
		// отображаем птичку
		document.getElementById("bird_3_2").setAttribute("style", "left:0");
<?php
		}
		if($order['Тип открывания Окно-3'] == "Поворотно-откидное") {
			// чекаем соответствующий тип открывания окна		
?>
		// чекаем соответствующий тип открывания окна		
		document.getElementById("win_type_3_3").checked = true;
		// отображаем птичку
		document.getElementById("bird_3_3").setAttribute("style", "left:0");
<?php
		}



		if($order['Тип профиля'] == "Rehau") {
			// чекаем соответствующий тип профиля		
?>
		document.getElementById("profile_type_round_2").setAttribute("style", "left:-21.5px");
		document.getElementById("profile_type_round_1").removeAttribute("style");
		document.getElementById("profile_type_2").checked = true;
		document.getElementById("profile_type_1").checked = false;
<?php
		}
		if($order['Тип профиля'] == "Brusbox") {
			// чекаем соответствующий тип профиля		
?>
		document.getElementById("profile_type_round_3").setAttribute("style", "left:-21.5px");
		document.getElementById("profile_type_round_1").removeAttribute("style");
		document.getElementById("profile_type_3").checked = true;
		document.getElementById("profile_type_1").checked = false;
<?php
		}
		if($order['Тип профиля'] == "KBE") {
			// чекаем соответствующий тип профиля		
?>
		document.getElementById("profile_type_round_4").setAttribute("style", "left:-21.5px");
		document.getElementById("profile_type_round_1").removeAttribute("style");
		document.getElementById("profile_type_4").checked = true;
		document.getElementById("profile_type_1").checked = false;
<?php
		}

		if($order['Тип дома'] == "Кирпич") {
			// чекаем соответствующий тип дома		
?>
		document.getElementById("home_type_round_2").setAttribute("style", "left:-21.5px");
		document.getElementById("home_type_round_1").removeAttribute("style");
		document.getElementById("home_type_2").checked = true;
		document.getElementById("home_type_1").checked = false;
<?php
		}
		if($order['Тип дома'] == "Газосиликатный блок") {
			// чекаем соответствующий тип дома		
?>
		document.getElementById("home_type_round_3").setAttribute("style", "left:-21.5px");
		document.getElementById("home_type_round_1").removeAttribute("style");
		document.getElementById("home_type_3").checked = true;
		document.getElementById("home_type_1").checked = false;
<?php
		}
		if($order['Тип дома'] == "Дерево") {
			// чекаем соответствующий тип дома		
?>
		document.getElementById("home_type_round_4").setAttribute("style", "left:-21.5px");
		document.getElementById("home_type_round_1").removeAttribute("style");
		document.getElementById("home_type_4").checked = true;
		document.getElementById("home_type_1").checked = false;
<?php
		}

		if($order['Тип стеклопакета'] == "Двухкамерный") {
			// чекаем соответствующий тип Тип стеклопакета
?>
		document.getElementById("glasspack_type_round_2").setAttribute("style", "left:-21.5px");
		document.getElementById("glasspack_type_round_1").removeAttribute("style");
		document.getElementById("glasspack_type_2").checked = true;
		document.getElementById("glasspack_type_1").checked = false;
<?php
		}
		if($order['Тип стеклопакета'] == "Трёхкамерный") {
			// чекаем соответствующий тип Тип стеклопакета		
?>
		document.getElementById("glasspack_type_round_3").setAttribute("style", "left:-21.5px");
		document.getElementById("glasspack_type_round_1").removeAttribute("style");
		document.getElementById("glasspack_type_3").checked = true;
		document.getElementById("glasspack_type_1").checked = false;
<?php
		}

		if($order['Тип фурнитуры'] == "Средняя") {
			// чекаем соответствующий тип Тип фурнитуры
?>
		document.getElementById("furniture_type_round_2").setAttribute("style", "left:-21.5px");
		document.getElementById("furniture_type_round_1").removeAttribute("style");
		document.getElementById("furniture_type_2").checked = true;
		document.getElementById("furniture_type_1").checked = false;
<?php
		}
		if($order['Тип фурнитуры'] == "Премиум") {
			// чекаем соответствующий тип Тип фурнитуры		
?>
		document.getElementById("furniture_type_round_3").setAttribute("style", "left:-21.5px");
		document.getElementById("furniture_type_round_1").removeAttribute("style");
		document.getElementById("furniture_type_3").checked = true;
		document.getElementById("furniture_type_1").checked = false;
<?php
		}

		if(!empty($order['Дополнительно 1'])) {
			// чекаем в Дополнительно, где необходимо		
?>
		document.getElementById("additional_type_1").checked = true;
		document.getElementById("additional_type_round_1").setAttribute("style", "left:-21.5px");
<?php
		}
		else {
?>
		document.getElementById("additional_type_round_1").setAttribute("style", "left:0");
<?php
		}
		if(!empty($order['Дополнительно 2'])) {
			// чекаем в Дополнительно, где необходимо		
?>
		document.getElementById("additional_type_2").checked = true;
		document.getElementById("additional_type_round_2").setAttribute("style", "left:-21.5px");
<?php
		}
		else {
?>
		document.getElementById("additional_type_round_2").setAttribute("style", "left:0");
<?php
		}
		if(!empty($order['Дополнительно 3'])) {
			// чекаем в Дополнительно, где необходимо		
?>
		document.getElementById("additional_type_3").checked = true;
		document.getElementById("additional_type_round_3").setAttribute("style", "left:-21.5px");
<?php
		}
		else {
?>
		document.getElementById("additional_type_round_3").setAttribute("style", "left:0");
<?php
		}
		if(!empty($order['Дополнительно 4'])) {
			// чекаем в Дополнительно, где необходимо		
?>
		document.getElementById("additional_type_4").checked = true;
		document.getElementById("additional_type_round_4").setAttribute("style", "left:-21.5px");
<?php
		}
		else {
?>
		document.getElementById("additional_type_round_4").setAttribute("style", "left:0");
<?php
		}
		if(!empty($order['Дополнительно 5'])) {
			// чекаем в Дополнительно, где необходимо		
?>
		document.getElementById("additional_type_5").checked = true;
		document.getElementById("additional_type_round_5").setAttribute("style", "left:-21.5px");
<?php
		}
		else {
?>
		document.getElementById("additional_type_round_5").setAttribute("style", "left:0");
<?php
		}

		// меняем активное меню
	if($order['Тип окна'] == "Одностворчатые") {
		// отображаем правильное изображение
		if($order['Изображение'] == "calc_pic_1_2.jpg") {
?>
		// устанавливаем стили для активного элемента меню окон
		window_menu_1_2.setAttribute("style", "padding:1px; border:solid 1px #E31E24; transform:scale(1.15);");
		// удаляем стили у других элемента меню окон, если имются
		if (window_menu_1_1.style) window_menu_1_1.removeAttribute("style");
		// отображаем соответствующую главную картинку
		document.getElementById("main_pic").firstElementChild.setAttribute("style", "left:-159px");
<?php
		}
		if($order['Изображение'] == "calc_pic_1_3.jpg") {
?>
		// устанавливаем стили для активного элемента меню окон
		window_menu_1_3.setAttribute("style", "padding:1px; border:solid 1px #E31E24; transform:scale(1.15);");
		// удаляем стили у других элемента меню окон, если имются
		if (window_menu_1_1.style) window_menu_1_1.removeAttribute("style");
		// отображаем соответствующую главную картинку
		document.getElementById("main_pic").firstElementChild.setAttribute("style", "left:-316px");
<?php
		}
?>

	// дефолтная обработка меню окон типа ОДНОСТВОРЧАТЫЕ
	document.getElementById("window_menu_1_1").onclick = function() {
		// вставляем нужную картинку в input
		document.custinfo_form.pic.value="calc_pic_1_1.jpg";
		// устанавливаем стили для активного элемента меню окон
		window_menu_1_1.setAttribute("style", "padding:1px; border:solid 1px #E31E24; transform:scale(1.15);");
		// удаляем стили у других элемента меню окон, если имются
		if (window_menu_1_2.style) window_menu_1_2.removeAttribute("style");
		if (window_menu_1_3.style) window_menu_1_3.removeAttribute("style");
		// отображаем соответствующую главную картинку
		document.getElementById("main_pic");
		if (main_pic.firstElementChild.style) main_pic.firstElementChild.removeAttribute("style");
		// чекаем соответствующий тип открывания окна		
		document.getElementById("win_type_1_1").checked = true;
		// отображаем птичку
		document.getElementById("bird_1_1").setAttribute("style", "left:0");
		// прячем птичку у остальных типов, если видна
		if (bird_1_1.style) bird_1_2.removeAttribute("style");
		if (bird_1_3.style) bird_1_3.removeAttribute("style");
		return false;
	}
	document.getElementById("window_menu_1_2").onclick = function() {
		// вставляем нужную картинку в input
		document.custinfo_form.pic.value="calc_pic_1_2.jpg";
		// устанавливаем стили для активного элемента меню окон
		window_menu_1_2.setAttribute("style", "padding:1px; border:solid 1px #E31E24; transform:scale(1.15);");
		// удаляем стили у других элемента меню окон, если имются
		if (window_menu_1_1.style) window_menu_1_1.removeAttribute("style");
		if (window_menu_1_3.style) window_menu_1_3.removeAttribute("style");
		// отображаем соответствующую главную картинку
		document.getElementById("main_pic").firstElementChild.setAttribute("style", "left:-159px");
		// чекаем соответствующий тип открывания окна		
		document.getElementById("win_type_1_2").checked = true;
		// отображаем птичку
		document.getElementById("bird_1_2").setAttribute("style", "left:0");
		// прячем птичку у остальных типов, если видна
		if (bird_1_1.style) bird_1_1.removeAttribute("style");
		if (bird_1_3.style) bird_1_3.removeAttribute("style");
		return false;
	}
	document.getElementById("window_menu_1_3").onclick = function() {
		// вставляем нужную картинку в input
		document.custinfo_form.pic.value="calc_pic_1_3.jpg";
		// устанавливаем стили для активного элемента меню окон
		window_menu_1_3.setAttribute("style", "padding:1px; border:solid 1px #E31E24; transform:scale(1.15);");
		// удаляем стили у других элемента меню окон, если имются
		if (window_menu_1_1.style) window_menu_1_1.removeAttribute("style");
		if (window_menu_1_2.style) window_menu_1_2.removeAttribute("style");
		// отображаем соответствующую главную картинку
		document.getElementById("main_pic").firstElementChild.setAttribute("style", "left:-316px");
		// чекаем соответствующий тип открывания окна		
		document.getElementById("win_type_1_3").checked = true;
		// отображаем птичку
		document.getElementById("bird_1_3").setAttribute("style", "left:0");
		// прячем птичку у остальных типов, если видна
		if (bird_1_1.style) bird_1_1.removeAttribute("style");
		if (bird_1_2.style) bird_1_2.removeAttribute("style");
		return false;
	}
<?php
	}

	if($order['Тип окна'] == "Двухстворчатые") {
?>
	// добавляем стиль для активного меню
	calculator_menu_2.setAttribute("style", "background-color:#E31E24;");
	// удаляем стили для неактивного меню
	if (calculator_menu_1.style) calculator_menu_1.removeAttribute("style");
	// вставляем меню вариантов окон
	window_menu.innerHTML = '<ul><li><a href="#" id="window_menu_2_1" style="padding:1px; border:solid 1px #E31E24; transform:scale(1.15);"><img src="/img/calc_menu_pic_2_1.jpg"></a></li><li><a href="#" id="window_menu_2_2"><img src="/img/calc_menu_pic_2_2.jpg"></a></li><li><a href="#" id="window_menu_2_3"><img src="/img/calc_menu_pic_2_3.jpg"></a></li><li><a href="#" id="window_menu_2_4"><img src="/img/calc_menu_pic_2_4.jpg"></a></li></ul>';
	// вставляем картинку окна
	main_pic.innerHTML = '<img src="/img/calc_pic_2.jpg">';
	// правим стиль ширины области для корректного отображения картинки
	main_pic.style.width = "205px";
	// делаем красной цифру 2
	num_2.style.backgroundColor = "#E31E24";

<?php
		// отображаем правильное изображение
		if($order['Изображение'] == "calc_pic_2_2.jpg") {
?>
	// устанавливаем стили для активного элемента меню окон
	window_menu_2_2.setAttribute("style", "padding:1px; border:solid 1px #E31E24; transform:scale(1.15);");
	// удаляем стили у других элемента меню окон, если имются
	if (window_menu_2_1.style) window_menu_2_1.removeAttribute("style");
	// отображаем соответствующую главную картинку
	main_pic.firstElementChild.setAttribute("style", "left:-221px");
<?php
		}
		if($order['Изображение'] == "calc_pic_2_3.jpg") {
?>
	// устанавливаем стили для активного элемента меню окон
	window_menu_2_3.setAttribute("style", "padding:1px; border:solid 1px #E31E24; transform:scale(1.15);");
	// удаляем стили у других элемента меню окон, если имются
	if (window_menu_2_1.style) window_menu_2_1.removeAttribute("style");
	// отображаем соответствующую главную картинку
	main_pic.firstElementChild.setAttribute("style", "left:-442px");
<?php
		}
		if($order['Изображение'] == "calc_pic_2_4.jpg") {
?>
	// устанавливаем стили для активного элемента меню окон
	window_menu_2_4.setAttribute("style", "padding:1px; border:solid 1px #E31E24; transform:scale(1.15);");
	// удаляем стили у других элемента меню окон, если имются
	if (window_menu_2_1.style) window_menu_2_1.removeAttribute("style");
	// отображаем соответствующую главную картинку
	main_pic.firstElementChild.setAttribute("style", "left:-663px");
<?php
		}
?>
		// обработка меню окон
		document.getElementById("window_menu_2_1").onclick = function() {
			// вставляем нужную картинку в input
			document.custinfo_form.pic.value="calc_pic_2_1.jpg";
			// устанавливаем стили для активного элемента меню окон
			window_menu_2_1.setAttribute("style", "padding:1px; border:solid 1px #E31E24; transform:scale(1.15);");
			// удаляем стили у других элемента меню окон, если имются
			if (window_menu_2_2.style) window_menu_2_2.removeAttribute("style");
			if (window_menu_2_3.style) window_menu_2_3.removeAttribute("style");
			if (window_menu_2_4.style) window_menu_2_4.removeAttribute("style");
			// отображаем соответствующую главную картинку
			main_pic.firstElementChild.removeAttribute("style");
			// чекаем соответствующий тип открывания окна		
			win_type_1_1.checked = true;
			win_type_2_1.checked = true;
			// отображаем птичку
			bird_1_1.setAttribute("style", "left:0");
			bird_2_1.setAttribute("style", "left:0");
			// прячем птичку у остальных типов, если видна
			if (bird_1_2.style) bird_1_2.removeAttribute("style");
			if (bird_1_3.style) bird_1_3.removeAttribute("style");
			if (bird_2_2.style) bird_2_2.removeAttribute("style");
			if (bird_2_3.style) bird_2_3.removeAttribute("style");
			if (bird_3_1.style) bird_3_1.removeAttribute("style");
			if (bird_3_2.style) bird_3_2.removeAttribute("style");
			if (bird_3_3.style) bird_3_3.removeAttribute("style");
			return false;
		}
		document.getElementById("window_menu_2_2").onclick = function() {
			// вставляем нужную картинку в input
			document.custinfo_form.pic.value="calc_pic_2_2.jpg";
			// устанавливаем стили для активного элемента меню окон
			window_menu_2_2.setAttribute("style", "padding:1px; border:solid 1px #E31E24; transform:scale(1.15);");
			// удаляем стили у других элемента меню окон, если имются
			if (window_menu_2_1.style) window_menu_2_1.removeAttribute("style");
			if (window_menu_2_3.style) window_menu_2_3.removeAttribute("style");
			if (window_menu_2_4.style) window_menu_2_4.removeAttribute("style");
			// отображаем соответствующую главную картинку
			main_pic.firstElementChild.setAttribute("style", "left:-221px");
			// чекаем соответствующий тип открывания окна		
			win_type_1_1.checked = true;
			document.getElementById("win_type_2_3").checked = true;
			// отображаем птичку
			bird_1_1.setAttribute("style", "left:0");
			document.getElementById("bird_2_3").setAttribute("style", "left:0");
			// прячем птичку у остальных типов, если видна
			if (bird_1_2.style) bird_1_2.removeAttribute("style");
			if (bird_1_3.style) bird_1_3.removeAttribute("style");
			if (bird_2_1.style) bird_2_1.removeAttribute("style");
			if (bird_2_2.style) bird_2_2.removeAttribute("style");
			if (bird_3_1.style) bird_3_1.removeAttribute("style");
			if (bird_3_2.style) bird_3_2.removeAttribute("style");
			if (bird_3_3.style) bird_3_3.removeAttribute("style");
			return false;
		}
		document.getElementById("window_menu_2_3").onclick = function() {
			// вставляем нужную картинку в input
			document.custinfo_form.pic.value="calc_pic_2_3.jpg";
			// устанавливаем стили для активного элемента меню окон
			window_menu_2_3.setAttribute("style", "padding:1px; border:solid 1px #E31E24; transform:scale(1.15);");
			// удаляем стили у других элемента меню окон, если имются
			if (window_menu_2_1.style) window_menu_2_1.removeAttribute("style");
			if (window_menu_2_2.style) window_menu_2_2.removeAttribute("style");
			if (window_menu_2_4.style) window_menu_2_4.removeAttribute("style");
			// отображаем соответствующую главную картинку
			main_pic.firstElementChild.setAttribute("style", "left:-442px");
			// чекаем соответствующий тип открывания окна		
			win_type_1_2.checked = true;
			document.getElementById("win_type_2_3").checked = true;
			// отображаем птичку
			bird_1_2.setAttribute("style", "left:0");
			document.getElementById("bird_2_3").setAttribute("style", "left:0");
			// прячем птичку у остальных типов, если видна
			if (bird_1_1.style) bird_1_1.removeAttribute("style");
			if (bird_1_3.style) bird_1_3.removeAttribute("style");
			if (bird_2_1.style) bird_2_1.removeAttribute("style");
			if (bird_2_2.style) bird_2_2.removeAttribute("style");
			if (bird_3_1.style) bird_3_1.removeAttribute("style");
			if (bird_3_2.style) bird_3_2.removeAttribute("style");
			if (bird_3_3.style) bird_3_3.removeAttribute("style");
			return false;
		}
		document.getElementById("window_menu_2_4").onclick = function() {
			// вставляем нужную картинку в input
			document.custinfo_form.pic.value="calc_pic_2_4.jpg";
			// устанавливаем стили для активного элемента меню окон
			window_menu_2_4.setAttribute("style", "padding:1px; border:solid 1px #E31E24; transform:scale(1.15);");
			// удаляем стили у других элемента меню окон, если имются
			if (window_menu_2_1.style) window_menu_2_1.removeAttribute("style");
			if (window_menu_2_2.style) window_menu_2_2.removeAttribute("style");
			if (window_menu_2_3.style) window_menu_2_3.removeAttribute("style");
			// отображаем соответствующую главную картинку
			main_pic.firstElementChild.setAttribute("style", "left:-663px");
			// чекаем соответствующий тип открывания окна		
			win_type_1_3.checked = true;
			win_type_2_3.checked = true;
			// отображаем птичку
			bird_1_3.setAttribute("style", "left:0");
			bird_2_3.setAttribute("style", "left:0");
			// прячем птичку у остальных типов, если видна
			if (bird_1_1.style) bird_1_1.removeAttribute("style");
			if (bird_1_2.style) bird_1_2.removeAttribute("style");
			if (bird_2_1.style) bird_2_1.removeAttribute("style");
			if (bird_2_2.style) bird_2_2.removeAttribute("style");
			if (bird_3_1.style) bird_3_1.removeAttribute("style");
			if (bird_3_2.style) bird_3_2.removeAttribute("style");
			if (bird_3_3.style) bird_3_3.removeAttribute("style");
			return false;
		}
<?php
	}

	if($order['Тип окна'] == "Трехстворчатые") {
?>
	// добавляем стиль для активного меню
	calculator_menu_3.setAttribute("style", "background-color:#E31E24;");
	// удаляем стили для неактивного меню
	if (calculator_menu_1.style) calculator_menu_1.removeAttribute("style");
	// вставляем меню вариантов окон
	window_menu.innerHTML = '<ul><li><a href="#" id="window_menu_3_1" style="padding:1px; border:solid 1px #E31E24; transform:scale(1.15);"><img src="/img/calc_menu_pic_3_1.jpg"></a></li><li><a href="#" id="window_menu_3_2"><img src="/img/calc_menu_pic_3_2.jpg"></a></li><li><a href="#" id="window_menu_3_3"><img src="/img/calc_menu_pic_3_3.jpg"></a></li><li><a href="#" id="window_menu_3_4"><img src="/img/calc_menu_pic_3_4.jpg"></a></li><li><a href="#" id="window_menu_3_5"><img src="/img/calc_menu_pic_3_5.jpg"></a></li><li><a href="#" id="window_menu_3_6"><img src="/img/calc_menu_pic_3_6.jpg"></a></li></ul>';
	// вставляем картинку окна
	main_pic.innerHTML = '<img src="/img/calc_pic_3.jpg">';
	// правим стили для корректного отображения картинки
	main_pic.style.width = "265px";
	// делаем красной цифру 2 и 3
	num_2.style.backgroundColor = "#E31E24";
	num_3.style.backgroundColor = "#E31E24";
<?php

		// отображаем правильное изображение
		if($order['Изображение'] == "calc_pic_3_2.jpg") {
?>
	// устанавливаем стили для активного элемента меню окон
	window_menu_3_2.setAttribute("style", "padding:1px; border:solid 1px #E31E24; transform:scale(1.15);");
	// удаляем стили у других элемента меню окон, если имются
	if (window_menu_3_1.style) window_menu_3_1.removeAttribute("style");
	// отображаем соответствующую главную картинку
	main_pic.firstElementChild.setAttribute("style", "left:-284px");
<?php
		}
		if($order['Изображение'] == "calc_pic_3_3.jpg") {
?>
	// устанавливаем стили для активного элемента меню окон
	window_menu_3_3.setAttribute("style", "padding:1px; border:solid 1px #E31E24; transform:scale(1.15);");
	// удаляем стили у других элемента меню окон, если имются
	if (window_menu_3_1.style) window_menu_3_1.removeAttribute("style");
	// отображаем соответствующую главную картинку
	main_pic.firstElementChild.setAttribute("style", "left:-569px");
<?php
		}
		if($order['Изображение'] == "calc_pic_3_4.jpg") {
?>
	// устанавливаем стили для активного элемента меню окон
	window_menu_3_4.setAttribute("style", "padding:1px; border:solid 1px #E31E24; transform:scale(1.15);");
	// удаляем стили у других элемента меню окон, если имются
	if (window_menu_3_1.style) window_menu_3_1.removeAttribute("style");
	// отображаем соответствующую главную картинку
	main_pic.firstElementChild.setAttribute("style", "left:-853px");
<?php
		}
		if($order['Изображение'] == "calc_pic_3_5.jpg") {
?>
	// устанавливаем стили для активного элемента меню окон
	window_menu_3_5.setAttribute("style", "padding:1px; border:solid 1px #E31E24; transform:scale(1.15);");
	// удаляем стили у других элемента меню окон, если имются
	if (window_menu_3_1.style) window_menu_3_1.removeAttribute("style");
	// отображаем соответствующую главную картинку
	main_pic.firstElementChild.setAttribute("style", "left:-1138px");
<?php
		}
		if($order['Изображение'] == "calc_pic_3_6.jpg") {
?>
	// устанавливаем стили для активного элемента меню окон
	window_menu_3_6.setAttribute("style", "padding:1px; border:solid 1px #E31E24; transform:scale(1.15);");
	// удаляем стили у других элемента меню окон, если имются
	if (window_menu_3_1.style) window_menu_3_1.removeAttribute("style");
	// отображаем соответствующую главную картинку
	main_pic.firstElementChild.setAttribute("style", "left:-1422px");
<?php
		}
?>
		// обработка меню окон
		document.getElementById("window_menu_3_1").onclick = function() {
			// вставляем нужную картинку в input
			document.custinfo_form.pic.value="calc_pic_3_1.jpg";
			// устанавливаем стили для активного элемента меню окон
			window_menu_3_1.setAttribute("style", "padding:1px; border:solid 1px #E31E24; transform:scale(1.15);");
			// удаляем стили у других элемента меню окон, если имются
			if (window_menu_3_2.style) window_menu_3_2.removeAttribute("style");
			if (window_menu_3_3.style) window_menu_3_3.removeAttribute("style");
			if (window_menu_3_4.style) window_menu_3_4.removeAttribute("style");
			if (window_menu_3_5.style) window_menu_3_5.removeAttribute("style");
			if (window_menu_3_6.style) window_menu_3_6.removeAttribute("style");
			// отображаем соответствующую главную картинку
			main_pic.firstElementChild.removeAttribute("style");
			// чекаем соответствующий тип открывания окна		
			win_type_1_1.checked = true;
			win_type_2_1.checked = true;
			win_type_3_1.checked = true;
			// отображаем птичку
			bird_1_1.setAttribute("style", "left:0");
			bird_2_1.setAttribute("style", "left:0");
			bird_3_1.setAttribute("style", "left:0");
			// прячем птичку у остальных типов, если видна
			if (bird_1_2.style) bird_1_2.removeAttribute("style");
			if (bird_1_3.style) bird_1_3.removeAttribute("style");
			if (bird_2_2.style) bird_2_2.removeAttribute("style");
			if (bird_2_3.style) bird_2_3.removeAttribute("style");
			if (bird_3_2.style) bird_3_2.removeAttribute("style");
			if (bird_3_3.style) bird_3_3.removeAttribute("style");
			return false;
		}
		document.getElementById("window_menu_3_2").onclick = function() {
			// вставляем нужную картинку в input
			document.custinfo_form.pic.value="calc_pic_3_2.jpg";
			// устанавливаем стили для активного элемента меню окон
			window_menu_3_2.setAttribute("style", "padding:1px; border:solid 1px #E31E24; transform:scale(1.15);");
			// удаляем стили у других элемента меню окон, если имются
			if (window_menu_3_1.style) window_menu_3_1.removeAttribute("style");
			if (window_menu_3_3.style) window_menu_3_3.removeAttribute("style");
			if (window_menu_3_4.style) window_menu_3_4.removeAttribute("style");
			if (window_menu_3_5.style) window_menu_3_5.removeAttribute("style");
			if (window_menu_3_6.style) window_menu_3_6.removeAttribute("style");
			// отображаем соответствующую главную картинку
			main_pic.firstElementChild.setAttribute("style", "left:-284px");
			// чекаем соответствующий тип открывания окна		
			win_type_1_1.checked = true;
			win_type_2_3.checked = true;
			win_type_3_1.checked = true;
			// отображаем птичку
			bird_1_1.setAttribute("style", "left:0");
			bird_2_3.setAttribute("style", "left:0");
			bird_3_1.setAttribute("style", "left:0");
			// прячем птичку у остальных типов, если видна
			if (bird_1_2.style) bird_1_2.removeAttribute("style");
			if (bird_1_3.style) bird_1_3.removeAttribute("style");
			if (bird_2_1.style) bird_2_1.removeAttribute("style");
			if (bird_2_2.style) bird_2_2.removeAttribute("style");
			if (bird_3_2.style) bird_3_2.removeAttribute("style");
			if (bird_3_3.style) bird_3_3.removeAttribute("style");
			return false;
		}
		document.getElementById("window_menu_3_3").onclick = function() {
			// вставляем нужную картинку в input
			document.custinfo_form.pic.value="calc_pic_3_3.jpg";
			// устанавливаем стили для активного элемента меню окон
			window_menu_3_3.setAttribute("style", "padding:1px; border:solid 1px #E31E24; transform:scale(1.15);");
			// удаляем стили у других элемента меню окон, если имются
			if (window_menu_3_1.style) window_menu_3_1.removeAttribute("style");
			if (window_menu_3_2.style) window_menu_3_2.removeAttribute("style");
			if (window_menu_3_4.style) window_menu_3_4.removeAttribute("style");
			if (window_menu_3_5.style) window_menu_3_5.removeAttribute("style");
			if (window_menu_3_6.style) window_menu_3_6.removeAttribute("style");
			// отображаем соответствующую главную картинку
			main_pic.firstElementChild.setAttribute("style", "left:-569px");
			// чекаем соответствующий тип открывания окна		
			win_type_1_2.checked = true;
			win_type_2_1.checked = true;
			win_type_3_3.checked = true;
			// отображаем птичку
			bird_1_2.setAttribute("style", "left:0");
			bird_2_1.setAttribute("style", "left:0");
			bird_3_3.setAttribute("style", "left:0");
			// прячем птичку у остальных типов, если видна
			if (bird_1_1.style) bird_1_1.removeAttribute("style");
			if (bird_1_3.style) bird_1_3.removeAttribute("style");
			if (bird_2_2.style) bird_2_2.removeAttribute("style");
			if (bird_2_3.style) bird_2_3.removeAttribute("style");
			if (bird_3_1.style) bird_3_1.removeAttribute("style");
			if (bird_3_2.style) bird_3_2.removeAttribute("style");
			return false;
		}
		document.getElementById("window_menu_3_4").onclick = function() {
			// вставляем нужную картинку в input
			document.custinfo_form.pic.value="calc_pic_3_4.jpg";
			// устанавливаем стили для активного элемента меню окон
			window_menu_3_4.setAttribute("style", "padding:1px; border:solid 1px #E31E24; transform:scale(1.15);");
			// удаляем стили у других элемента меню окон, если имются
			if (window_menu_3_1.style) window_menu_3_1.removeAttribute("style");
			if (window_menu_3_2.style) window_menu_3_2.removeAttribute("style");
			if (window_menu_3_3.style) window_menu_3_3.removeAttribute("style");
			if (window_menu_3_5.style) window_menu_3_5.removeAttribute("style");
			if (window_menu_3_6.style) window_menu_3_6.removeAttribute("style");
			// отображаем соответствующую главную картинку
			main_pic.firstElementChild.setAttribute("style", "left:-853px");
			// чекаем соответствующий тип открывания окна		
			win_type_1_3.checked = true;
			win_type_2_1.checked = true;
			win_type_3_3.checked = true;
			// отображаем птичку
			bird_1_3.setAttribute("style", "left:0");
			bird_2_1.setAttribute("style", "left:0");
			bird_3_3.setAttribute("style", "left:0");
			// прячем птичку у остальных типов, если видна
			if (bird_1_1.style) bird_1_1.removeAttribute("style");
			if (bird_1_2.style) bird_1_2.removeAttribute("style");
			if (bird_2_2.style) bird_2_2.removeAttribute("style");
			if (bird_2_3.style) bird_2_3.removeAttribute("style");
			if (bird_3_1.style) bird_3_1.removeAttribute("style");
			if (bird_3_2.style) bird_3_2.removeAttribute("style");
			return false;
		}
		document.getElementById("window_menu_3_5").onclick = function() {
			// вставляем нужную картинку в input
			document.custinfo_form.pic.value="calc_pic_3_5.jpg";
			// устанавливаем стили для активного элемента меню окон
			window_menu_3_5.setAttribute("style", "padding:1px; border:solid 1px #E31E24; transform:scale(1.15);");
			// удаляем стили у других элемента меню окон, если имются
			if (window_menu_3_1.style) window_menu_3_1.removeAttribute("style");
			if (window_menu_3_2.style) window_menu_3_2.removeAttribute("style");
			if (window_menu_3_3.style) window_menu_3_3.removeAttribute("style");
			if (window_menu_3_4.style) window_menu_3_4.removeAttribute("style");
			if (window_menu_3_6.style) window_menu_3_6.removeAttribute("style");
			// отображаем соответствующую главную картинку
			main_pic.firstElementChild.setAttribute("style", "left:-1138px");
			// чекаем соответствующий тип открывания окна		
			win_type_1_3.checked = true;
			win_type_2_2.checked = true;
			win_type_3_3.checked = true;
			// отображаем птичку
			bird_1_3.setAttribute("style", "left:0");
			bird_2_2.setAttribute("style", "left:0");
			bird_3_3.setAttribute("style", "left:0");
			// прячем птичку у остальных типов, если видна
			if (bird_1_1.style) bird_1_1.removeAttribute("style");
			if (bird_1_2.style) bird_1_2.removeAttribute("style");
			if (bird_2_1.style) bird_2_1.removeAttribute("style");
			if (bird_2_3.style) bird_2_3.removeAttribute("style");
			if (bird_3_1.style) bird_3_1.removeAttribute("style");
			if (bird_3_2.style) bird_3_2.removeAttribute("style");
			return false;
		}
		document.getElementById("window_menu_3_6").onclick = function() {
			// вставляем нужную картинку в input
			document.custinfo_form.pic.value="calc_pic_3_6.jpg";
			// устанавливаем стили для активного элемента меню окон
			window_menu_3_6.setAttribute("style", "padding:1px; border:solid 1px #E31E24; transform:scale(1.15);");
			// удаляем стили у других элемента меню окон, если имются
			if (window_menu_3_1.style) window_menu_3_1.removeAttribute("style");
			if (window_menu_3_2.style) window_menu_3_2.removeAttribute("style");
			if (window_menu_3_3.style) window_menu_3_3.removeAttribute("style");
			if (window_menu_3_4.style) window_menu_3_4.removeAttribute("style");
			if (window_menu_3_5.style) window_menu_3_5.removeAttribute("style");
			// отображаем соответствующую главную картинку
			main_pic.firstElementChild.setAttribute("style", "left:-1422px");
			// чекаем соответствующий тип открывания окна		
			win_type_1_3.checked = true;
			win_type_2_3.checked = true;
			win_type_3_3.checked = true;
			// отображаем птичку
			bird_1_3.setAttribute("style", "left:0");
			bird_2_3.setAttribute("style", "left:0");
			bird_3_3.setAttribute("style", "left:0");
			// прячем птичку у остальных типов, если видна
			if (bird_1_1.style) bird_1_1.removeAttribute("style");
			if (bird_1_2.style) bird_1_2.removeAttribute("style");
			if (bird_2_1.style) bird_2_1.removeAttribute("style");
			if (bird_2_2.style) bird_2_2.removeAttribute("style");
			if (bird_3_1.style) bird_3_1.removeAttribute("style");
			if (bird_3_2.style) bird_3_2.removeAttribute("style");
			return false;
		}

<?php
	}
	if($order['Тип окна'] == "Балконные блоки") {
?>
	// добавляем стиль для активного меню
	calculator_menu_4.setAttribute("style", "background-color:#E31E24;");
	// удаляем стили для неактивного меню
	if (calculator_menu_1.style) calculator_menu_1.removeAttribute("style");
	// вставляем меню вариантов окон
	window_menu.innerHTML = '<ul><li><a href="#" id="window_menu_4_1" style="padding:1px; border:solid 1px #E31E24; transform:scale(1.15);"><img src="/img/calc_menu_pic_4_1.jpg"></a></li><li><a href="#" id="window_menu_4_2"><img src="/img/calc_menu_pic_4_2.jpg"></a></li><li><a href="#" id="window_menu_4_3"><img src="/img/calc_menu_pic_4_3.jpg"></a></li><li><a href="#" id="window_menu_4_4"><img src="/img/calc_menu_pic_4_4.jpg"></a></li><li><a href="#" id="window_menu_4_5"><img src="/img/calc_menu_pic_4_5.jpg"></a></li></ul>';
	// вставляем картинку окна
	main_pic.innerHTML = '<img src="/img/calc_pic_4.jpg">';
	// правим стили для корректного отображения картинки
	main_pic.style.width = "90px";
	//делаем серым фон цифры 2 и 3
	num_2.removeAttribute("style");
	num_3.removeAttribute("style");
<?php

		// отображаем правильное изображение
		if($order['Изображение'] == "calc_pic_4_2.jpg") {
?>
	// устанавливаем стили для активного элемента меню окон
	window_menu_4_2.setAttribute("style", "padding:1px; border:solid 1px #E31E24; transform:scale(1.15);");
	// удаляем стили у других элемента меню окон, если имются
	if (window_menu_4_1.style) window_menu_4_1.removeAttribute("style");
	// правим стили для корректного отображения картинки
	main_pic.style.width = "185px";
	// отображаем соответствующую главную картинку
	main_pic.firstElementChild.setAttribute("style", "left:-105px");
	// делаем красной цифру 2
	num_2.style.backgroundColor = "#E31E24";
<?php
		}
		if($order['Изображение'] == "calc_pic_4_3.jpg") {
?>
	// устанавливаем стили для активного элемента меню окон
	window_menu_4_3.setAttribute("style", "padding:1px; border:solid 1px #E31E24; transform:scale(1.15);");
	// удаляем стили у других элемента меню окон, если имются
	if (window_menu_4_1.style) window_menu_4_1.removeAttribute("style");
	// правим стили для корректного отображения картинки
	main_pic.style.width = "185px";
	// отображаем соответствующую главную картинку
	main_pic.firstElementChild.setAttribute("style", "left:-294px");
	// делаем красной цифру 2
	num_2.style.backgroundColor = "#E31E24";
	//делаем серым фон цифры 3
	num_3.removeAttribute("style");
<?php
		}
		if($order['Изображение'] == "calc_pic_4_4.jpg") {
?>
	// устанавливаем стили для активного элемента меню окон
	window_menu_4_4.setAttribute("style", "padding:1px; border:solid 1px #E31E24; transform:scale(1.15);");
	// удаляем стили у других элемента меню окон, если имются
	if (window_menu_4_1.style) window_menu_4_1.removeAttribute("style");
	// правим стили для корректного отображения картинки
	main_pic.style.width = "265px";
	// отображаем соответствующую главную картинку
	main_pic.firstElementChild.setAttribute("style", "left:-477px");
	// делаем красной цифру 2 и 3
	num_2.style.backgroundColor = "#E31E24";
	num_3.style.backgroundColor = "#E31E24";
<?php
		}
		if($order['Изображение'] == "calc_pic_4_5.jpg") {
?>
	// устанавливаем стили для активного элемента меню окон
	window_menu_4_5.setAttribute("style", "padding:1px; border:solid 1px #E31E24; transform:scale(1.15);");
	// удаляем стили у других элемента меню окон, если имются
	if (window_menu_4_1.style) window_menu_4_1.removeAttribute("style");
	// правим стили для корректного отображения картинки
	main_pic.style.width = "265px";
	// отображаем соответствующую главную картинку
	main_pic.firstElementChild.setAttribute("style", "left:-730px");
	// делаем красной цифру 2 и 3
	num_2.style.backgroundColor = "#E31E24";
	num_3.style.backgroundColor = "#E31E24";
<?php
		}
?>
		// обработка меню окон
		document.getElementById("window_menu_4_1").onclick = function() {
			// вставляем нужную картинку в input
			document.custinfo_form.pic.value="calc_pic_4_1.jpg";
			// устанавливаем стили для активного элемента меню окон
			window_menu_4_1.setAttribute("style", "padding:1px; border:solid 1px #E31E24; transform:scale(1.15);");
			// удаляем стили у других элемента меню окон, если имются
			if (window_menu_4_2.style) window_menu_4_2.removeAttribute("style");
			if (window_menu_4_3.style) window_menu_4_3.removeAttribute("style");
			if (window_menu_4_4.style) window_menu_4_4.removeAttribute("style");
			if (window_menu_4_5.style) window_menu_4_5.removeAttribute("style");
			// правим стили для корректного отображения картинки
			main_pic.style.width = "90px";
			// отображаем соответствующую главную картинку
			main_pic.firstElementChild.removeAttribute("style");
			//делаем серым фон цифры 2 и 3
			num_2.removeAttribute("style");
			num_3.removeAttribute("style");
			// чекаем дефолтный тип открывания окна		
			win_type_1_3.checked = true;
			// удаляем чек 2 и 3 типа открывания окна
			if (win_type_2_1.checked) win_type_2_1.checked = false;
			if (win_type_2_2.checked) win_type_2_2.checked = false;
			if (win_type_2_3.checked) win_type_2_3.checked = false;
			if (win_type_3_1.checked) win_type_3_1.checked = false;
			if (win_type_3_2.checked) win_type_3_2.checked = false;
			if (win_type_3_3.checked) win_type_3_3.checked = false;
			// отображаем птичку
			bird_1_3.setAttribute("style", "left:0");
			// прячем птичку у остальных типов, если видна
			if (bird_1_1.style) bird_1_1.removeAttribute("style");
			if (bird_1_2.style) bird_1_2.removeAttribute("style");
			if (bird_2_1.style) bird_2_1.removeAttribute("style");
			if (bird_2_2.style) bird_2_2.removeAttribute("style");
			if (bird_2_3.style) bird_2_3.removeAttribute("style");
			if (bird_3_1.style) bird_3_1.removeAttribute("style");
			if (bird_3_2.style) bird_3_2.removeAttribute("style");
			if (bird_3_3.style) bird_3_3.removeAttribute("style");
			return false;
		}
		document.getElementById("window_menu_4_2").onclick = function() {
			// вставляем нужную картинку в input
			document.custinfo_form.pic.value="calc_pic_4_2.jpg";
			// устанавливаем стили для активного элемента меню окон
			window_menu_4_2.setAttribute("style", "padding:1px; border:solid 1px #E31E24; transform:scale(1.15);");
			// удаляем стили у других элемента меню окон, если имются
			if (window_menu_4_1.style) window_menu_4_1.removeAttribute("style");
			if (window_menu_4_3.style) window_menu_4_3.removeAttribute("style");
			if (window_menu_4_4.style) window_menu_4_4.removeAttribute("style");
			if (window_menu_4_5.style) window_menu_4_5.removeAttribute("style");
			// правим стили для корректного отображения картинки
			main_pic.style.width = "185px";
			// отображаем соответствующую главную картинку
			main_pic.firstElementChild.setAttribute("style", "left:-105px");
			// делаем красной цифру 2
			num_2.style.backgroundColor = "#E31E24";
			//делаем серым фон цифры 3
			num_3.removeAttribute("style");
			// чекаем соответствующий тип открывания окна		
			win_type_1_1.checked = true;
			win_type_2_3.checked = true;
			// удаляем чек 3 типа открывания окна
			if (win_type_3_1.checked) win_type_3_1.checked = false;
			if (win_type_3_2.checked) win_type_3_2.checked = false;
			if (win_type_3_3.checked) win_type_3_3.checked = false;
			// отображаем птичку
			bird_1_1.setAttribute("style", "left:0");
			bird_2_3.setAttribute("style", "left:0");
			// прячем птичку у остальных типов, если видна
			if (bird_1_2.style) bird_1_2.removeAttribute("style");
			if (bird_1_3.style) bird_1_3.removeAttribute("style");
			if (bird_2_1.style) bird_2_1.removeAttribute("style");
			if (bird_2_2.style) bird_2_2.removeAttribute("style");
			if (bird_3_1.style) bird_3_1.removeAttribute("style");
			if (bird_3_2.style) bird_3_2.removeAttribute("style");
			if (bird_3_3.style) bird_3_3.removeAttribute("style");
			return false;
		}
		document.getElementById("window_menu_4_3").onclick = function() {
			// вставляем нужную картинку в input
			document.custinfo_form.pic.value="calc_pic_4_3.jpg";
			// устанавливаем стили для активного элемента меню окон
			window_menu_4_3.setAttribute("style", "padding:1px; border:solid 1px #E31E24; transform:scale(1.15);");
			// удаляем стили у других элемента меню окон, если имются
			if (window_menu_4_1.style) window_menu_4_1.removeAttribute("style");
			if (window_menu_4_2.style) window_menu_4_2.removeAttribute("style");
			if (window_menu_4_4.style) window_menu_4_4.removeAttribute("style");
			if (window_menu_4_5.style) window_menu_4_5.removeAttribute("style");
			// правим стили для корректного отображения картинки
			main_pic.style.width = "185px";
			// отображаем соответствующую главную картинку
			main_pic.firstElementChild.setAttribute("style", "left:-294px");
			// делаем красной цифру 2
			num_2.style.backgroundColor = "#E31E24";
			//делаем серым фон цифры 3
			num_3.removeAttribute("style");
			// чекаем соответствующий тип открывания окна		
			win_type_1_3.checked = true;
			win_type_2_3.checked = true;
			// удаляем чек 3 типа открывания окна
			if (win_type_3_1.checked) win_type_3_1.checked = false;
			if (win_type_3_2.checked) win_type_3_2.checked = false;
			if (win_type_3_3.checked) win_type_3_3.checked = false;
			// отображаем птичку
			bird_1_3.setAttribute("style", "left:0");
			bird_2_3.setAttribute("style", "left:0");
			// прячем птичку у остальных типов, если видна
			if (bird_1_1.style) bird_1_1.removeAttribute("style");
			if (bird_1_2.style) bird_1_2.removeAttribute("style");
			if (bird_2_1.style) bird_2_1.removeAttribute("style");
			if (bird_2_2.style) bird_2_2.removeAttribute("style");
			if (bird_3_1.style) bird_3_1.removeAttribute("style");
			if (bird_3_2.style) bird_3_2.removeAttribute("style");
			if (bird_3_3.style) bird_3_3.removeAttribute("style");
			return false;
		}
		document.getElementById("window_menu_4_4").onclick = function() {
			// вставляем нужную картинку в input
			document.custinfo_form.pic.value="calc_pic_4_4.jpg";
			// устанавливаем стили для активного элемента меню окон
			window_menu_4_4.setAttribute("style", "padding:1px; border:solid 1px #E31E24; transform:scale(1.15);");
			// удаляем стили у других элемента меню окон, если имются
			if (window_menu_4_1.style) window_menu_4_1.removeAttribute("style");
			if (window_menu_4_2.style) window_menu_4_2.removeAttribute("style");
			if (window_menu_4_3.style) window_menu_4_3.removeAttribute("style");
			if (window_menu_4_5.style) window_menu_4_5.removeAttribute("style");
			// правим стили для корректного отображения картинки
			main_pic.style.width = "265px";
			// отображаем соответствующую главную картинку
			main_pic.firstElementChild.setAttribute("style", "left:-477px");
			// делаем красной цифру 2 и 3
			num_2.style.backgroundColor = "#E31E24";
			num_3.style.backgroundColor = "#E31E24";
			// чекаем соответствующий тип открывания окна		
			win_type_1_1.checked = true;
			win_type_2_1.checked = true;
			win_type_3_3.checked = true;
			// отображаем птичку
			bird_1_1.setAttribute("style", "left:0");
			bird_2_1.setAttribute("style", "left:0");
			bird_3_3.setAttribute("style", "left:0");
			// прячем птичку у остальных типов, если видна
			if (bird_1_2.style) bird_1_2.removeAttribute("style");
			if (bird_1_3.style) bird_1_3.removeAttribute("style");
			if (bird_2_2.style) bird_2_2.removeAttribute("style");
			if (bird_2_3.style) bird_2_3.removeAttribute("style");
			if (bird_3_1.style) bird_3_1.removeAttribute("style");
			if (bird_3_2.style) bird_3_2.removeAttribute("style");
			return false;
		}
		document.getElementById("window_menu_4_5").onclick = function() {
			// вставляем нужную картинку в input
			document.custinfo_form.pic.value="calc_pic_4_5.jpg";
			// устанавливаем стили для активного элемента меню окон
			window_menu_4_5.setAttribute("style", "padding:1px; border:solid 1px #E31E24; transform:scale(1.15);");
			// удаляем стили у других элемента меню окон, если имются
			if (window_menu_4_1.style) window_menu_4_1.removeAttribute("style");
			if (window_menu_4_2.style) window_menu_4_2.removeAttribute("style");
			if (window_menu_4_3.style) window_menu_4_3.removeAttribute("style");
			if (window_menu_4_4.style) window_menu_4_4.removeAttribute("style");
			// правим стили для корректного отображения картинки
			main_pic.style.width = "265px";
			// отображаем соответствующую главную картинку
			main_pic.firstElementChild.setAttribute("style", "left:-730px");
			// делаем красной цифру 2 и 3
			num_2.style.backgroundColor = "#E31E24";
			num_3.style.backgroundColor = "#E31E24";
			// чекаем соответствующий тип открывания окна		
			win_type_1_1.checked = true;
			win_type_2_3.checked = true;
			win_type_3_3.checked = true;
			// отображаем птичку
			bird_1_1.setAttribute("style", "left:0");
			bird_2_3.setAttribute("style", "left:0");
			bird_3_3.setAttribute("style", "left:0");
			// прячем птичку у остальных типов, если видна
			if (bird_1_2.style) bird_1_2.removeAttribute("style");
			if (bird_1_3.style) bird_1_3.removeAttribute("style");
			if (bird_2_1.style) bird_2_1.removeAttribute("style");
			if (bird_2_2.style) bird_2_2.removeAttribute("style");
			if (bird_3_1.style) bird_3_1.removeAttribute("style");
			if (bird_3_2.style) bird_3_2.removeAttribute("style");
			return false;
		}
<?php
	}
?>

<?php
}
?>
	// ОБЩАЯ ОБРАБОТКА КЛИКОВ
	// ОДНОСТВОРЧАТЫЕ 
//	var calc_menu_1 = document.getElementById("calculator_menu_1");
	document.getElementById("calculator_menu_1").onclick = function() {
		// добавляем стиль для активного меню
		calculator_menu_1.style.backgroundColor = "#E31E24";
		// удаляем стили для неактивного меню, если надо
		if (calculator_menu_2.style) calculator_menu_2.removeAttribute("style");
		if (calculator_menu_3.style) calculator_menu_3.removeAttribute("style");
		if (calculator_menu_4.style) calculator_menu_4.removeAttribute("style");
		// вставляем меню вариантов окон
		document.getElementById("window_menu").innerHTML = '<ul><li><a href="#" id="window_menu_1_1" style="padding:1px; border:solid 1px #E31E24; transform:scale(1.15);"><img src="/img/calc_menu_pic_1_1.jpg"></a></li><li><a href="#" id="window_menu_1_2"><img src="/img/calc_menu_pic_1_2.jpg"></a></li><li><a href="#" id="window_menu_1_3"><img src="/img/calc_menu_pic_1_3.jpg"></a></li></ul>';
		// вставляем картинку окна
		main_pic.innerHTML = '<img src="/img/calc_pic_1.jpg">';
		// правим стили для корректного отображения картинки
		main_pic.style.width = "";
		//делаем серым фон цифры 2 и 3
		if(num_2.style) document.getElementById("num_2").removeAttribute("style");
		if(num_3.style) document.getElementById("num_3").removeAttribute("style");
		// чекаем дефолтный тип открывания окна
		win_type_1_1.checked = true;
		// удаляем чек 2 и 3 типа открывания окна
		if (win_type_2_1.checked) win_type_2_1.checked = false;
		if (win_type_2_2.checked) win_type_2_2.checked = false;
		if (win_type_2_3.checked) win_type_2_3.checked = false;
		if (win_type_3_1.checked) win_type_3_1.checked = false;
		if (win_type_3_2.checked) win_type_3_2.checked = false;
		if (win_type_3_3.checked) win_type_3_3.checked = false;
		// прячем птичку у остальных типов, если видна
		if (bird_2_1.style) bird_2_1.removeAttribute("style");
		if (bird_2_2.style) bird_2_2.removeAttribute("style");
		if (bird_2_3.style) bird_2_3.removeAttribute("style");
		if (bird_3_1.style) bird_3_1.removeAttribute("style");
		if (bird_3_2.style) bird_3_2.removeAttribute("style");
		if (bird_3_3.style) bird_3_3.removeAttribute("style");
		// вставляем дефолтную картинку в input
		document.custinfo_form.pic.value="calc_pic_1_1.jpg";

		// обработка меню окон
		window_menu_1_1.onclick = function() {
			// вставляем нужную картинку в input
			document.custinfo_form.pic.value="calc_pic_1_1.jpg";
			// устанавливаем стили для активного элемента меню окон
			window_menu_1_1.setAttribute("style", "padding:1px; border:solid 1px #E31E24; transform:scale(1.15);");
			// удаляем стили у других элемента меню окон, если имются
			if (window_menu_1_2.style) window_menu_1_2.removeAttribute("style");
			if (window_menu_1_3.style) window_menu_1_3.removeAttribute("style");
			// отображаем соответствующую главную картинку
			if (main_pic.firstElementChild.style) main_pic.firstElementChild.removeAttribute("style");
			// чекаем соответствующий тип открывания окна
			win_type_1_1.checked = true;
			// отображаем птичку
			bird_1_1.setAttribute("style", "left:0");
			// прячем птичку у остальных типов, если видна
			if (bird_1_2.style) bird_1_2.removeAttribute("style");
			if (bird_1_3.style) bird_1_3.removeAttribute("style");
			return false;
		}
		window_menu_1_2.onclick = function() {
			// вставляем нужную картинку в input
			document.custinfo_form.pic.value="calc_pic_1_2.jpg";
			// устанавливаем стили для активного элемента меню окон
			window_menu_1_2.setAttribute("style", "padding:1px; border:solid 1px #E31E24; transform:scale(1.15);");
			// удаляем стили у других элемента меню окон, если имются
			if (window_menu_1_1.style) window_menu_1_1.removeAttribute("style");
			if (window_menu_1_3.style) window_menu_1_3.removeAttribute("style");
			// отображаем соответствующую главную картинку
			main_pic.firstElementChild.setAttribute("style", "left:-159px");
			// чекаем соответствующий тип открывания окна		
			win_type_1_2.checked = true;
			// отображаем птичку
			bird_1_2.setAttribute("style", "left:0");
			// прячем птичку у остальных типов, если видна
			if (bird_1_1.style) bird_1_1.removeAttribute("style");
			if (bird_1_3.style) bird_1_3.removeAttribute("style");
			return false;
		}
		window_menu_1_3.onclick = function() {
			// вставляем нужную картинку в input
			document.custinfo_form.pic.value="calc_pic_1_3.jpg";
			// устанавливаем стили для активного элемента меню окон
			window_menu_1_3.setAttribute("style", "padding:1px; border:solid 1px #E31E24; transform:scale(1.15);");
			// удаляем стили у других элемента меню окон, если имются
			if (window_menu_1_1.style) window_menu_1_1.removeAttribute("style");
			if (window_menu_1_2.style) window_menu_1_2.removeAttribute("style");
			// отображаем соответствующую главную картинку
			main_pic.firstElementChild.setAttribute("style", "left:-316px");
			// чекаем соответствующий тип открывания окна		
			win_type_1_3.checked = true;
			// отображаем птичку
			bird_1_3.setAttribute("style", "left:0");
			// прячем птичку у остальных типов, если видна
			if (bird_1_1.style) bird_1_1.removeAttribute("style");
			if (bird_1_2.style) bird_1_2.removeAttribute("style");
			return false;
		}
		// определяем значение для тега input типа окна
		document.custinfo_form.type_window.value="Одностворчатые";
		return false;
	}

	// ДВУХСТВОРЧАТЫЕ 
	document.getElementById("calculator_menu_2").onclick = function() {
		// добавляем стиль для активного меню
		calculator_menu_2.style.backgroundColor = "#E31E24";
		// удаляем стили для неактивного меню, если надо
		if (calculator_menu_1.style) calculator_menu_1.removeAttribute("style");
		if (calculator_menu_3.style) calculator_menu_3.removeAttribute("style");
		if (calculator_menu_4.style) calculator_menu_4.removeAttribute("style");
		// вставляем меню вариантов окон
		window_menu.innerHTML = '<ul><li><a href="#" id="window_menu_2_1" style="padding:1px; border:solid 1px #E31E24; transform:scale(1.15);"><img src="/img/calc_menu_pic_2_1.jpg"></a></li><li><a href="#" id="window_menu_2_2"><img src="/img/calc_menu_pic_2_2.jpg"></a></li><li><a href="#" id="window_menu_2_3"><img src="/img/calc_menu_pic_2_3.jpg"></a></li><li><a href="#" id="window_menu_2_4"><img src="/img/calc_menu_pic_2_4.jpg"></a></li></ul>';
		// вставляем картинку окна
		main_pic.innerHTML = '<img src="/img/calc_pic_2.jpg">';
		// правим стили для корректного отображения картинки
		main_pic.style.width = "205px";
		// делаем красной цифру 2
		num_2.style.backgroundColor = "#E31E24";
		//делаем серым фон цифры 3
		if(num_3.style) num_3.removeAttribute("style");
		// чекаем дефолтный тип открывания окна		
		win_type_1_1.checked = true;
		document.getElementById("win_type_2_1").checked = true;
		// удаляем чек 3 типа открывания окна
		if (win_type_3_1.checked) win_type_3_1.checked = false;
		if (win_type_3_2.checked) win_type_3_2.checked = false;
		if (win_type_3_3.checked) win_type_3_3.checked = false;
		// устанавливаем птичку в дефорт
		bird_1_1.setAttribute("style", "left:0");
		document.getElementById("bird_2_1").setAttribute("style", "left:0");
		// прячем птичку у остальных типов, если видна
		if (bird_1_2.style) bird_1_2.removeAttribute("style");
		if (bird_1_3.style) bird_1_3.removeAttribute("style");
		if (bird_2_2.style) bird_2_2.removeAttribute("style");
		if (bird_2_3.style) bird_2_3.removeAttribute("style");
		if (bird_3_1.style) bird_3_1.removeAttribute("style");
		if (bird_3_2.style) bird_3_2.removeAttribute("style");
		if (bird_3_3.style) bird_3_3.removeAttribute("style");
		// вставляем дефолтную картинку в input
		document.custinfo_form.pic.value="calc_pic_2_1.jpg";

		// обработка меню окон
		document.getElementById("window_menu_2_1").onclick = function() {
			// вставляем нужную картинку в input
			document.custinfo_form.pic.value="calc_pic_2_1.jpg";
			// устанавливаем стили для активного элемента меню окон
			window_menu_2_1.setAttribute("style", "padding:1px; border:solid 1px #E31E24; transform:scale(1.15);");
			// удаляем стили у других элемента меню окон, если имются
			if (window_menu_2_2.style) window_menu_2_2.removeAttribute("style");
			if (window_menu_2_3.style) window_menu_2_3.removeAttribute("style");
			if (window_menu_2_4.style) window_menu_2_4.removeAttribute("style");
			// отображаем соответствующую главную картинку
			main_pic.firstElementChild.removeAttribute("style");
			// чекаем соответствующий тип открывания окна		
			win_type_1_1.checked = true;
			win_type_2_1.checked = true;
			// отображаем птичку
			bird_1_1.setAttribute("style", "left:0");
			bird_2_1.setAttribute("style", "left:0");
			// прячем птичку у остальных типов, если видна
			if (bird_1_2.style) bird_1_2.removeAttribute("style");
			if (bird_1_3.style) bird_1_3.removeAttribute("style");
			if (bird_2_2.style) bird_2_2.removeAttribute("style");
			if (bird_2_3.style) bird_2_3.removeAttribute("style");
			if (bird_3_1.style) bird_3_1.removeAttribute("style");
			if (bird_3_2.style) bird_3_2.removeAttribute("style");
			if (bird_3_3.style) bird_3_3.removeAttribute("style");
			return false;
		}
		document.getElementById("window_menu_2_2").onclick = function() {
			// вставляем нужную картинку в input
			document.custinfo_form.pic.value="calc_pic_2_2.jpg";
			// устанавливаем стили для активного элемента меню окон
			window_menu_2_2.setAttribute("style", "padding:1px; border:solid 1px #E31E24; transform:scale(1.15);");
			// удаляем стили у других элемента меню окон, если имются
			if (window_menu_2_1.style) window_menu_2_1.removeAttribute("style");
			if (window_menu_2_3.style) window_menu_2_3.removeAttribute("style");
			if (window_menu_2_4.style) window_menu_2_4.removeAttribute("style");
			// отображаем соответствующую главную картинку
			main_pic.firstElementChild.setAttribute("style", "left:-221px");
			// чекаем соответствующий тип открывания окна		
			win_type_1_1.checked = true;
			document.getElementById("win_type_2_3").checked = true;
			// отображаем птичку
			bird_1_1.setAttribute("style", "left:0");
			document.getElementById("bird_2_3").setAttribute("style", "left:0");
			// прячем птичку у остальных типов, если видна
			if (bird_1_2.style) bird_1_2.removeAttribute("style");
			if (bird_1_3.style) bird_1_3.removeAttribute("style");
			if (bird_2_1.style) bird_2_1.removeAttribute("style");
			if (bird_2_2.style) bird_2_2.removeAttribute("style");
			if (bird_3_1.style) bird_3_1.removeAttribute("style");
			if (bird_3_2.style) bird_3_2.removeAttribute("style");
			if (bird_3_3.style) bird_3_3.removeAttribute("style");
			return false;
		}
		document.getElementById("window_menu_2_3").onclick = function() {
			// вставляем нужную картинку в input
			document.custinfo_form.pic.value="calc_pic_2_3.jpg";
			// устанавливаем стили для активного элемента меню окон
			window_menu_2_3.setAttribute("style", "padding:1px; border:solid 1px #E31E24; transform:scale(1.15);");
			// удаляем стили у других элемента меню окон, если имются
			if (window_menu_2_1.style) window_menu_2_1.removeAttribute("style");
			if (window_menu_2_2.style) window_menu_2_2.removeAttribute("style");
			if (window_menu_2_4.style) window_menu_2_4.removeAttribute("style");
			// отображаем соответствующую главную картинку
			main_pic.firstElementChild.setAttribute("style", "left:-442px");
			// чекаем соответствующий тип открывания окна		
			win_type_1_2.checked = true;
			document.getElementById("win_type_2_3").checked = true;
			// отображаем птичку
			bird_1_2.setAttribute("style", "left:0");
			document.getElementById("bird_2_3").setAttribute("style", "left:0");
			// прячем птичку у остальных типов, если видна
			if (bird_1_1.style) bird_1_1.removeAttribute("style");
			if (bird_1_3.style) bird_1_3.removeAttribute("style");
			if (bird_2_1.style) bird_2_1.removeAttribute("style");
			if (bird_2_2.style) bird_2_2.removeAttribute("style");
			if (bird_3_1.style) bird_3_1.removeAttribute("style");
			if (bird_3_2.style) bird_3_2.removeAttribute("style");
			if (bird_3_3.style) bird_3_3.removeAttribute("style");
			return false;
		}
		document.getElementById("window_menu_2_4").onclick = function() {
			// вставляем нужную картинку в input
			document.custinfo_form.pic.value="calc_pic_2_4.jpg";
			// устанавливаем стили для активного элемента меню окон
			window_menu_2_4.setAttribute("style", "padding:1px; border:solid 1px #E31E24; transform:scale(1.15);");
			// удаляем стили у других элемента меню окон, если имются
			if (window_menu_2_1.style) window_menu_2_1.removeAttribute("style");
			if (window_menu_2_2.style) window_menu_2_2.removeAttribute("style");
			if (window_menu_2_3.style) window_menu_2_3.removeAttribute("style");
			// отображаем соответствующую главную картинку
			main_pic.firstElementChild.setAttribute("style", "left:-663px");
			// чекаем соответствующий тип открывания окна		
			win_type_1_3.checked = true;
			win_type_2_3.checked = true;
			// отображаем птичку
			bird_1_3.setAttribute("style", "left:0");
			bird_2_3.setAttribute("style", "left:0");
			// прячем птичку у остальных типов, если видна
			if (bird_1_1.style) bird_1_1.removeAttribute("style");
			if (bird_1_2.style) bird_1_2.removeAttribute("style");
			if (bird_2_1.style) bird_2_1.removeAttribute("style");
			if (bird_2_2.style) bird_2_2.removeAttribute("style");
			if (bird_3_1.style) bird_3_1.removeAttribute("style");
			if (bird_3_2.style) bird_3_2.removeAttribute("style");
			if (bird_3_3.style) bird_3_3.removeAttribute("style");
			return false;
		}
		// определяем значение для тега input типа окна
		document.custinfo_form.type_window.value="Двухстворчатые";
		return false;
	}

	// ТРЕХСТВОРЧАТЫЕ 
	document.getElementById("calculator_menu_3").onclick = function() {
		calculator_menu_3.style.backgroundColor = "#E31E24";
		if (calculator_menu_1.style) calculator_menu_1.removeAttribute("style");
		if (calculator_menu_2.style) calculator_menu_2.removeAttribute("style");
		if (calculator_menu_4.style) calculator_menu_4.removeAttribute("style");
		// вставляем меню вариантов окон
		window_menu.innerHTML = '<ul><li><a href="#" id="window_menu_3_1" style="padding:1px; border:solid 1px #E31E24; transform:scale(1.15);"><img src="/img/calc_menu_pic_3_1.jpg"></a></li><li><a href="#" id="window_menu_3_2"><img src="/img/calc_menu_pic_3_2.jpg"></a></li><li><a href="#" id="window_menu_3_3"><img src="/img/calc_menu_pic_3_3.jpg"></a></li><li><a href="#" id="window_menu_3_4"><img src="/img/calc_menu_pic_3_4.jpg"></a></li><li><a href="#" id="window_menu_3_5"><img src="/img/calc_menu_pic_3_5.jpg"></a></li><li><a href="#" id="window_menu_3_6"><img src="/img/calc_menu_pic_3_6.jpg"></a></li></ul>';
		// вставляем картинку окна
		main_pic.innerHTML = '<img src="/img/calc_pic_3.jpg">';
		// правим стили для корректного отображения картинки
		main_pic.style.width = "265px";
		// делаем красной цифру 2 и 3
		num_2.style.backgroundColor = "#E31E24";
		document.getElementById("num_3").style.backgroundColor = "#E31E24";
		// чекаем дефолтный тип открывания окна		
		win_type_1_1.checked = true;
		win_type_2_1.checked = true;
		document.getElementById("win_type_3_1").checked = true;
		// устанавливаем птичку в дефорт
		bird_1_1.setAttribute("style", "left:0");
		bird_2_1.setAttribute("style", "left:0");
		document.getElementById("bird_3_1").setAttribute("style", "left:0");
		// прячем птичку у остальных типов, если видна
		if (bird_1_2.style) bird_1_2.removeAttribute("style");
		if (bird_1_3.style) bird_1_3.removeAttribute("style");
		if (bird_2_2.style) bird_2_2.removeAttribute("style");
		if (bird_2_3.style) bird_2_3.removeAttribute("style");
		if (bird_3_2.style) bird_3_2.removeAttribute("style");
		if (bird_3_3.style) bird_3_3.removeAttribute("style");
		// вставляем дефолтную картинку в input
		document.custinfo_form.pic.value="calc_pic_3_1.jpg";

		// обработка меню окон
		document.getElementById("window_menu_3_1").onclick = function() {
			// вставляем нужную картинку в input
			document.custinfo_form.pic.value="calc_pic_3_1.jpg";
			// устанавливаем стили для активного элемента меню окон
			window_menu_3_1.setAttribute("style", "padding:1px; border:solid 1px #E31E24; transform:scale(1.15);");
			// удаляем стили у других элемента меню окон, если имются
			if (window_menu_3_2.style) window_menu_3_2.removeAttribute("style");
			if (window_menu_3_3.style) window_menu_3_3.removeAttribute("style");
			if (window_menu_3_4.style) window_menu_3_4.removeAttribute("style");
			if (window_menu_3_5.style) window_menu_3_5.removeAttribute("style");
			if (window_menu_3_6.style) window_menu_3_6.removeAttribute("style");
			// отображаем соответствующую главную картинку
			main_pic.firstElementChild.removeAttribute("style");
			// чекаем соответствующий тип открывания окна		
			win_type_1_1.checked = true;
			win_type_2_1.checked = true;
			win_type_3_1.checked = true;
			// отображаем птичку
			bird_1_1.setAttribute("style", "left:0");
			bird_2_1.setAttribute("style", "left:0");
			bird_3_1.setAttribute("style", "left:0");
			// прячем птичку у остальных типов, если видна
			if (bird_1_2.style) bird_1_2.removeAttribute("style");
			if (bird_1_3.style) bird_1_3.removeAttribute("style");
			if (bird_2_2.style) bird_2_2.removeAttribute("style");
			if (bird_2_3.style) bird_2_3.removeAttribute("style");
			if (bird_3_2.style) bird_3_2.removeAttribute("style");
			if (bird_3_3.style) bird_3_3.removeAttribute("style");
			return false;
		}
		document.getElementById("window_menu_3_2").onclick = function() {
			// вставляем нужную картинку в input
			document.custinfo_form.pic.value="calc_pic_3_2.jpg";
			// устанавливаем стили для активного элемента меню окон
			window_menu_3_2.setAttribute("style", "padding:1px; border:solid 1px #E31E24; transform:scale(1.15);");
			// удаляем стили у других элемента меню окон, если имются
			if (window_menu_3_1.style) window_menu_3_1.removeAttribute("style");
			if (window_menu_3_3.style) window_menu_3_3.removeAttribute("style");
			if (window_menu_3_4.style) window_menu_3_4.removeAttribute("style");
			if (window_menu_3_5.style) window_menu_3_5.removeAttribute("style");
			if (window_menu_3_6.style) window_menu_3_6.removeAttribute("style");
			// отображаем соответствующую главную картинку
			main_pic.firstElementChild.setAttribute("style", "left:-284px");
			// чекаем соответствующий тип открывания окна		
			win_type_1_1.checked = true;
			win_type_2_3.checked = true;
			win_type_3_1.checked = true;
			// отображаем птичку
			bird_1_1.setAttribute("style", "left:0");
			bird_2_3.setAttribute("style", "left:0");
			bird_3_1.setAttribute("style", "left:0");
			// прячем птичку у остальных типов, если видна
			if (bird_1_2.style) bird_1_2.removeAttribute("style");
			if (bird_1_3.style) bird_1_3.removeAttribute("style");
			if (bird_2_1.style) bird_2_1.removeAttribute("style");
			if (bird_2_2.style) bird_2_2.removeAttribute("style");
			if (bird_3_2.style) bird_3_2.removeAttribute("style");
			if (bird_3_3.style) bird_3_3.removeAttribute("style");
			return false;
		}
		document.getElementById("window_menu_3_3").onclick = function() {
			// вставляем нужную картинку в input
			document.custinfo_form.pic.value="calc_pic_3_3.jpg";
			// устанавливаем стили для активного элемента меню окон
			window_menu_3_3.setAttribute("style", "padding:1px; border:solid 1px #E31E24; transform:scale(1.15);");
			// удаляем стили у других элемента меню окон, если имются
			if (window_menu_3_1.style) window_menu_3_1.removeAttribute("style");
			if (window_menu_3_2.style) window_menu_3_2.removeAttribute("style");
			if (window_menu_3_4.style) window_menu_3_4.removeAttribute("style");
			if (window_menu_3_5.style) window_menu_3_5.removeAttribute("style");
			if (window_menu_3_6.style) window_menu_3_6.removeAttribute("style");
			// отображаем соответствующую главную картинку
			main_pic.firstElementChild.setAttribute("style", "left:-569px");
			// чекаем соответствующий тип открывания окна		
			win_type_1_2.checked = true;
			win_type_2_1.checked = true;
			win_type_3_3.checked = true;
			// отображаем птичку
			bird_1_2.setAttribute("style", "left:0");
			bird_2_1.setAttribute("style", "left:0");
			bird_3_3.setAttribute("style", "left:0");
			// прячем птичку у остальных типов, если видна
			if (bird_1_1.style) bird_1_1.removeAttribute("style");
			if (bird_1_3.style) bird_1_3.removeAttribute("style");
			if (bird_2_2.style) bird_2_2.removeAttribute("style");
			if (bird_2_3.style) bird_2_3.removeAttribute("style");
			if (bird_3_1.style) bird_3_1.removeAttribute("style");
			if (bird_3_2.style) bird_3_2.removeAttribute("style");
			return false;
		}
		document.getElementById("window_menu_3_4").onclick = function() {
			// вставляем нужную картинку в input
			document.custinfo_form.pic.value="calc_pic_3_4.jpg";
			// устанавливаем стили для активного элемента меню окон
			window_menu_3_4.setAttribute("style", "padding:1px; border:solid 1px #E31E24; transform:scale(1.15);");
			// удаляем стили у других элемента меню окон, если имются
			if (window_menu_3_1.style) window_menu_3_1.removeAttribute("style");
			if (window_menu_3_2.style) window_menu_3_2.removeAttribute("style");
			if (window_menu_3_3.style) window_menu_3_3.removeAttribute("style");
			if (window_menu_3_5.style) window_menu_3_5.removeAttribute("style");
			if (window_menu_3_6.style) window_menu_3_6.removeAttribute("style");
			// отображаем соответствующую главную картинку
			main_pic.firstElementChild.setAttribute("style", "left:-853px");
			// чекаем соответствующий тип открывания окна		
			win_type_1_3.checked = true;
			win_type_2_1.checked = true;
			win_type_3_3.checked = true;
			// отображаем птичку
			bird_1_3.setAttribute("style", "left:0");
			bird_2_1.setAttribute("style", "left:0");
			bird_3_3.setAttribute("style", "left:0");
			// прячем птичку у остальных типов, если видна
			if (bird_1_1.style) bird_1_1.removeAttribute("style");
			if (bird_1_2.style) bird_1_2.removeAttribute("style");
			if (bird_2_2.style) bird_2_2.removeAttribute("style");
			if (bird_2_3.style) bird_2_3.removeAttribute("style");
			if (bird_3_1.style) bird_3_1.removeAttribute("style");
			if (bird_3_2.style) bird_3_2.removeAttribute("style");
			return false;
		}
		document.getElementById("window_menu_3_5").onclick = function() {
			// вставляем нужную картинку в input
			document.custinfo_form.pic.value="calc_pic_3_5.jpg";
			// устанавливаем стили для активного элемента меню окон
			window_menu_3_5.setAttribute("style", "padding:1px; border:solid 1px #E31E24; transform:scale(1.15);");
			// удаляем стили у других элемента меню окон, если имются
			if (window_menu_3_1.style) window_menu_3_1.removeAttribute("style");
			if (window_menu_3_2.style) window_menu_3_2.removeAttribute("style");
			if (window_menu_3_3.style) window_menu_3_3.removeAttribute("style");
			if (window_menu_3_4.style) window_menu_3_4.removeAttribute("style");
			if (window_menu_3_6.style) window_menu_3_6.removeAttribute("style");
			// отображаем соответствующую главную картинку
			main_pic.firstElementChild.setAttribute("style", "left:-1138px");
			// чекаем соответствующий тип открывания окна		
			win_type_1_3.checked = true;
			win_type_2_2.checked = true;
			win_type_3_3.checked = true;
			// отображаем птичку
			bird_1_3.setAttribute("style", "left:0");
			bird_2_2.setAttribute("style", "left:0");
			bird_3_3.setAttribute("style", "left:0");
			// прячем птичку у остальных типов, если видна
			if (bird_1_1.style) bird_1_1.removeAttribute("style");
			if (bird_1_2.style) bird_1_2.removeAttribute("style");
			if (bird_2_1.style) bird_2_1.removeAttribute("style");
			if (bird_2_3.style) bird_2_3.removeAttribute("style");
			if (bird_3_1.style) bird_3_1.removeAttribute("style");
			if (bird_3_2.style) bird_3_2.removeAttribute("style");
			return false;
		}
		document.getElementById("window_menu_3_6").onclick = function() {
			// вставляем нужную картинку в input
			document.custinfo_form.pic.value="calc_pic_3_6.jpg";
			// устанавливаем стили для активного элемента меню окон
			window_menu_3_6.setAttribute("style", "padding:1px; border:solid 1px #E31E24; transform:scale(1.15);");
			// удаляем стили у других элемента меню окон, если имются
			if (window_menu_3_1.style) window_menu_3_1.removeAttribute("style");
			if (window_menu_3_2.style) window_menu_3_2.removeAttribute("style");
			if (window_menu_3_3.style) window_menu_3_3.removeAttribute("style");
			if (window_menu_3_4.style) window_menu_3_4.removeAttribute("style");
			if (window_menu_3_5.style) window_menu_3_5.removeAttribute("style");
			// отображаем соответствующую главную картинку
			main_pic.firstElementChild.setAttribute("style", "left:-1422px");
			// чекаем соответствующий тип открывания окна		
			win_type_1_3.checked = true;
			win_type_2_3.checked = true;
			win_type_3_3.checked = true;
			// отображаем птичку
			bird_1_3.setAttribute("style", "left:0");
			bird_2_3.setAttribute("style", "left:0");
			bird_3_3.setAttribute("style", "left:0");
			// прячем птичку у остальных типов, если видна
			if (bird_1_1.style) bird_1_1.removeAttribute("style");
			if (bird_1_2.style) bird_1_2.removeAttribute("style");
			if (bird_2_1.style) bird_2_1.removeAttribute("style");
			if (bird_2_2.style) bird_2_2.removeAttribute("style");
			if (bird_3_1.style) bird_3_1.removeAttribute("style");
			if (bird_3_2.style) bird_3_2.removeAttribute("style");
			return false;
		}
		// определяем значение для тега input типа окна
		document.custinfo_form.type_window.value="Трехстворчатые";
		return false;
	}
	// БАЛКОННЫЕ БЛОКИ
	document.getElementById("calculator_menu_4").onclick = function() {
		calculator_menu_4.style.backgroundColor = "#E31E24";
		if (calculator_menu_1.style) calculator_menu_1.removeAttribute("style");
		if (calculator_menu_2.style) calculator_menu_2.removeAttribute("style");
		if (calculator_menu_3.style) calculator_menu_3.removeAttribute("style");
		// вставляем меню вариантов окон
		window_menu.innerHTML = '<ul><li><a href="#" id="window_menu_4_1" style="padding:1px; border:solid 1px #E31E24; transform:scale(1.15);"><img src="/img/calc_menu_pic_4_1.jpg"></a></li><li><a href="#" id="window_menu_4_2"><img src="/img/calc_menu_pic_4_2.jpg"></a></li><li><a href="#" id="window_menu_4_3"><img src="/img/calc_menu_pic_4_3.jpg"></a></li><li><a href="#" id="window_menu_4_4"><img src="/img/calc_menu_pic_4_4.jpg"></a></li><li><a href="#" id="window_menu_4_5"><img src="/img/calc_menu_pic_4_5.jpg"></a></li></ul>';
		// вставляем картинку окна
		main_pic.innerHTML = '<img src="/img/calc_pic_4.jpg">';
		// правим стили для корректного отображения картинки
		main_pic.style.width = "90px";
		//делаем серым фон цифры 2 и 3
		num_2.removeAttribute("style");
		num_3.removeAttribute("style");
		// чекаем дефолтный тип открывания окна		
		win_type_1_3.checked = true;
		// удаляем чек 2 и 3 типа открывания окна
		if (win_type_2_1.checked) win_type_2_1.checked = false;
		if (win_type_2_2.checked) win_type_2_2.checked = false;
		if (win_type_2_3.checked) win_type_2_3.checked = false;
		if (win_type_3_1.checked) win_type_3_1.checked = false;
		if (win_type_3_2.checked) win_type_3_2.checked = false;
		if (win_type_3_3.checked) win_type_3_3.checked = false;
		// устанавливаем птичку в дефорт
		bird_1_3.setAttribute("style", "left:0");
		// прячем птичку у остальных типов, если видна
		if (bird_1_1.style) bird_1_1.removeAttribute("style");
		if (bird_1_2.style) bird_1_2.removeAttribute("style");
		if (bird_2_1.style) bird_2_1.removeAttribute("style");
		if (bird_2_2.style) bird_2_2.removeAttribute("style");
		if (bird_2_3.style) bird_2_3.removeAttribute("style");
		if (bird_3_1.style) bird_3_1.removeAttribute("style");
		if (bird_3_2.style) bird_3_2.removeAttribute("style");
		if (bird_3_3.style) bird_3_3.removeAttribute("style");
		// вставляем дефолтную картинку в input
		document.custinfo_form.pic.value="calc_pic_4_1.jpg";

		// обработка меню окон
		document.getElementById("window_menu_4_1").onclick = function() {
			// вставляем нужную картинку в input
			document.custinfo_form.pic.value="calc_pic_4_1.jpg";
			// устанавливаем стили для активного элемента меню окон
			window_menu_4_1.setAttribute("style", "padding:1px; border:solid 1px #E31E24; transform:scale(1.15);");
			// удаляем стили у других элемента меню окон, если имются
			if (window_menu_4_2.style) window_menu_4_2.removeAttribute("style");
			if (window_menu_4_3.style) window_menu_4_3.removeAttribute("style");
			if (window_menu_4_4.style) window_menu_4_4.removeAttribute("style");
			if (window_menu_4_5.style) window_menu_4_5.removeAttribute("style");
			// правим стили для корректного отображения картинки
			main_pic.style.width = "90px";
			// отображаем соответствующую главную картинку
			main_pic.firstElementChild.removeAttribute("style");
			//делаем серым фон цифры 2 и 3
			num_2.removeAttribute("style");
			num_3.removeAttribute("style");
			// чекаем дефолтный тип открывания окна		
			win_type_1_3.checked = true;
			// удаляем чек 2 и 3 типа открывания окна
			if (win_type_2_1.checked) win_type_2_1.checked = false;
			if (win_type_2_2.checked) win_type_2_2.checked = false;
			if (win_type_2_3.checked) win_type_2_3.checked = false;
			if (win_type_3_1.checked) win_type_3_1.checked = false;
			if (win_type_3_2.checked) win_type_3_2.checked = false;
			if (win_type_3_3.checked) win_type_3_3.checked = false;
			// отображаем птичку
			bird_1_3.setAttribute("style", "left:0");
			// прячем птичку у остальных типов, если видна
			if (bird_1_1.style) bird_1_1.removeAttribute("style");
			if (bird_1_2.style) bird_1_2.removeAttribute("style");
			if (bird_2_1.style) bird_2_1.removeAttribute("style");
			if (bird_2_2.style) bird_2_2.removeAttribute("style");
			if (bird_2_3.style) bird_2_3.removeAttribute("style");
			if (bird_3_1.style) bird_3_1.removeAttribute("style");
			if (bird_3_2.style) bird_3_2.removeAttribute("style");
			if (bird_3_3.style) bird_3_3.removeAttribute("style");
			return false;
		}
		document.getElementById("window_menu_4_2").onclick = function() {
			// вставляем нужную картинку в input
			document.custinfo_form.pic.value="calc_pic_4_2.jpg";
			// устанавливаем стили для активного элемента меню окон
			window_menu_4_2.setAttribute("style", "padding:1px; border:solid 1px #E31E24; transform:scale(1.15);");
			// удаляем стили у других элемента меню окон, если имются
			if (window_menu_4_1.style) window_menu_4_1.removeAttribute("style");
			if (window_menu_4_3.style) window_menu_4_3.removeAttribute("style");
			if (window_menu_4_4.style) window_menu_4_4.removeAttribute("style");
			if (window_menu_4_5.style) window_menu_4_5.removeAttribute("style");
			// правим стили для корректного отображения картинки
			main_pic.style.width = "185px";
			// отображаем соответствующую главную картинку
			main_pic.firstElementChild.setAttribute("style", "left:-105px");
			// делаем красной цифру 2
			num_2.style.backgroundColor = "#E31E24";
			//делаем серым фон цифры 3
			num_3.removeAttribute("style");
			// чекаем соответствующий тип открывания окна		
			win_type_1_1.checked = true;
			win_type_2_3.checked = true;
			// удаляем чек 3 типа открывания окна
			if (win_type_3_1.checked) win_type_3_1.checked = false;
			if (win_type_3_2.checked) win_type_3_2.checked = false;
			if (win_type_3_3.checked) win_type_3_3.checked = false;
			// отображаем птичку
			bird_1_1.setAttribute("style", "left:0");
			bird_2_3.setAttribute("style", "left:0");
			// прячем птичку у остальных типов, если видна
			if (bird_1_2.style) bird_1_2.removeAttribute("style");
			if (bird_1_3.style) bird_1_3.removeAttribute("style");
			if (bird_2_1.style) bird_2_1.removeAttribute("style");
			if (bird_2_2.style) bird_2_2.removeAttribute("style");
			if (bird_3_1.style) bird_3_1.removeAttribute("style");
			if (bird_3_2.style) bird_3_2.removeAttribute("style");
			if (bird_3_3.style) bird_3_3.removeAttribute("style");
			return false;
		}
		document.getElementById("window_menu_4_3").onclick = function() {
			// вставляем нужную картинку в input
			document.custinfo_form.pic.value="calc_pic_4_3.jpg";
			// устанавливаем стили для активного элемента меню окон
			window_menu_4_3.setAttribute("style", "padding:1px; border:solid 1px #E31E24; transform:scale(1.15);");
			// удаляем стили у других элемента меню окон, если имются
			if (window_menu_4_1.style) window_menu_4_1.removeAttribute("style");
			if (window_menu_4_2.style) window_menu_4_2.removeAttribute("style");
			if (window_menu_4_4.style) window_menu_4_4.removeAttribute("style");
			if (window_menu_4_5.style) window_menu_4_5.removeAttribute("style");
			// правим стили для корректного отображения картинки
			main_pic.style.width = "185px";
			// отображаем соответствующую главную картинку
			main_pic.firstElementChild.setAttribute("style", "left:-294px");
			// делаем красной цифру 2
			num_2.style.backgroundColor = "#E31E24";
			//делаем серым фон цифры 3
			num_3.removeAttribute("style");
			// чекаем соответствующий тип открывания окна		
			win_type_1_3.checked = true;
			win_type_2_3.checked = true;
			// удаляем чек 3 типа открывания окна
			if (win_type_3_1.checked) win_type_3_1.checked = false;
			if (win_type_3_2.checked) win_type_3_2.checked = false;
			if (win_type_3_3.checked) win_type_3_3.checked = false;
			// отображаем птичку
			bird_1_3.setAttribute("style", "left:0");
			bird_2_3.setAttribute("style", "left:0");
			// прячем птичку у остальных типов, если видна
			if (bird_1_1.style) bird_1_1.removeAttribute("style");
			if (bird_1_2.style) bird_1_2.removeAttribute("style");
			if (bird_2_1.style) bird_2_1.removeAttribute("style");
			if (bird_2_2.style) bird_2_2.removeAttribute("style");
			if (bird_3_1.style) bird_3_1.removeAttribute("style");
			if (bird_3_2.style) bird_3_2.removeAttribute("style");
			if (bird_3_3.style) bird_3_3.removeAttribute("style");
			return false;
		}
		document.getElementById("window_menu_4_4").onclick = function() {
			// вставляем нужную картинку в input
			document.custinfo_form.pic.value="calc_pic_4_4.jpg";
			// устанавливаем стили для активного элемента меню окон
			window_menu_4_4.setAttribute("style", "padding:1px; border:solid 1px #E31E24; transform:scale(1.15);");
			// удаляем стили у других элемента меню окон, если имются
			if (window_menu_4_1.style) window_menu_4_1.removeAttribute("style");
			if (window_menu_4_2.style) window_menu_4_2.removeAttribute("style");
			if (window_menu_4_3.style) window_menu_4_3.removeAttribute("style");
			if (window_menu_4_5.style) window_menu_4_5.removeAttribute("style");
			// правим стили для корректного отображения картинки
			main_pic.style.width = "265px";
			// отображаем соответствующую главную картинку
			main_pic.firstElementChild.setAttribute("style", "left:-477px");
			// делаем красной цифру 2 и 3
			num_2.style.backgroundColor = "#E31E24";
			num_3.style.backgroundColor = "#E31E24";
			// чекаем соответствующий тип открывания окна		
			win_type_1_1.checked = true;
			win_type_2_1.checked = true;
			win_type_3_3.checked = true;
			// отображаем птичку
			bird_1_1.setAttribute("style", "left:0");
			bird_2_1.setAttribute("style", "left:0");
			bird_3_3.setAttribute("style", "left:0");
			// прячем птичку у остальных типов, если видна
			if (bird_1_2.style) bird_1_2.removeAttribute("style");
			if (bird_1_3.style) bird_1_3.removeAttribute("style");
			if (bird_2_2.style) bird_2_2.removeAttribute("style");
			if (bird_2_3.style) bird_2_3.removeAttribute("style");
			if (bird_3_1.style) bird_3_1.removeAttribute("style");
			if (bird_3_2.style) bird_3_2.removeAttribute("style");
			return false;
		}
		document.getElementById("window_menu_4_5").onclick = function() {
			// вставляем нужную картинку в input
			document.custinfo_form.pic.value="calc_pic_4_5.jpg";
			// устанавливаем стили для активного элемента меню окон
			window_menu_4_5.setAttribute("style", "padding:1px; border:solid 1px #E31E24; transform:scale(1.15);");
			// удаляем стили у других элемента меню окон, если имются
			if (window_menu_4_1.style) window_menu_4_1.removeAttribute("style");
			if (window_menu_4_2.style) window_menu_4_2.removeAttribute("style");
			if (window_menu_4_3.style) window_menu_4_3.removeAttribute("style");
			if (window_menu_4_4.style) window_menu_4_4.removeAttribute("style");
			// правим стили для корректного отображения картинки
			main_pic.style.width = "265px";
			// отображаем соответствующую главную картинку
			main_pic.firstElementChild.setAttribute("style", "left:-730px");
			// делаем красной цифру 2 и 3
			num_2.style.backgroundColor = "#E31E24";
			num_3.style.backgroundColor = "#E31E24";
			// чекаем соответствующий тип открывания окна		
			win_type_1_1.checked = true;
			win_type_2_3.checked = true;
			win_type_3_3.checked = true;
			// отображаем птичку
			bird_1_1.setAttribute("style", "left:0");
			bird_2_3.setAttribute("style", "left:0");
			bird_3_3.setAttribute("style", "left:0");
			// прячем птичку у остальных типов, если видна
			if (bird_1_2.style) bird_1_2.removeAttribute("style");
			if (bird_1_3.style) bird_1_3.removeAttribute("style");
			if (bird_2_1.style) bird_2_1.removeAttribute("style");
			if (bird_2_2.style) bird_2_2.removeAttribute("style");
			if (bird_3_1.style) bird_3_1.removeAttribute("style");
			if (bird_3_2.style) bird_3_2.removeAttribute("style");
			return false;
		}
		// определяем значение для тега input типа окна
		document.custinfo_form.type_window.value="Балконные блоки";
		return false;
	}
	// получаем элементы по id
	document.getElementById("profile_type_1");
	document.getElementById("profile_type_2");
	document.getElementById("profile_type_3");
	document.getElementById("profile_type_4");
	document.getElementById("profile_type_round_1");
	document.getElementById("profile_type_round_2");
	document.getElementById("profile_type_round_3");
	document.getElementById("profile_type_round_4");

	document.getElementById("home_type_1");
	document.getElementById("home_type_2");
	document.getElementById("home_type_3");
	document.getElementById("home_type_4");
	document.getElementById("home_type_round_1");
	document.getElementById("home_type_round_2");
	document.getElementById("home_type_round_3");
	document.getElementById("home_type_round_4");

	document.getElementById("furniture_type_1");
	document.getElementById("furniture_type_2");
	document.getElementById("furniture_type_3");
	document.getElementById("furniture_type_round_1");
	document.getElementById("furniture_type_round_2");
	document.getElementById("furniture_type_round_3");

	// обрабатываем радиокнопки Тип профиля
	profile_type_1.onclick = function() {
		profile_type_round_1.setAttribute("style", "left:-21.5px");
		profile_type_round_2.removeAttribute("style");
		profile_type_round_3.removeAttribute("style");
		profile_type_round_4.removeAttribute("style");
		profile_type_2.checked = false;
		profile_type_3.checked = false;
		profile_type_4.checked = false;
	}
	profile_type_2.onclick  = function() {
		profile_type_round_2.setAttribute("style", "left:-21.5px");
		profile_type_round_1.removeAttribute("style");
		profile_type_round_3.removeAttribute("style");
		profile_type_round_4.removeAttribute("style");
		profile_type_1.checked = false;
		profile_type_3.checked = false;
		profile_type_4.checked = false;
	}
	profile_type_3.onclick  = function() {
		profile_type_round_3.setAttribute("style", "left:-21.5px");
		profile_type_round_1.removeAttribute("style");
		profile_type_round_2.removeAttribute("style");
		profile_type_round_4.removeAttribute("style");
		profile_type_1.checked = false;
		profile_type_2.checked = false;
		profile_type_4.checked = false;
	}
	profile_type_4.onclick  = function() {
		profile_type_round_4.setAttribute("style", "left:-21.5px");
		profile_type_round_1.removeAttribute("style");
		profile_type_round_2.removeAttribute("style");
		profile_type_round_3.removeAttribute("style");
		profile_type_1.checked = false;
		profile_type_2.checked = false;
		profile_type_3.checked = false;
	}

	// обрабатываем радиокнопки Тип дома
	home_type_1.onclick = function() {
		home_type_round_1.setAttribute("style", "left:-21.5px");
		home_type_round_2.removeAttribute("style");
		home_type_round_3.removeAttribute("style");
		home_type_round_4.removeAttribute("style");
		home_type_2.checked = false;
		home_type_3.checked = false;
		home_type_4.checked = false;
	}
	home_type_2.onclick  = function() {
		home_type_round_2.setAttribute("style", "left:-21.5px");
		home_type_round_1.removeAttribute("style");
		home_type_round_3.removeAttribute("style");
		home_type_round_4.removeAttribute("style");
		home_type_1.checked = false;
		home_type_3.checked = false;
		home_type_4.checked = false;
	}
	home_type_3.onclick  = function() {
		home_type_round_3.setAttribute("style", "left:-21.5px");
		home_type_round_1.removeAttribute("style");
		home_type_round_2.removeAttribute("style");
		home_type_round_4.removeAttribute("style");
		home_type_1.checked = false;
		home_type_2.checked = false;
		home_type_4.checked = false;
	}
	home_type_4.onclick  = function() {
		home_type_round_4.setAttribute("style", "left:-21.5px");
		home_type_round_1.removeAttribute("style");
		home_type_round_2.removeAttribute("style");
		home_type_round_3.removeAttribute("style");
		home_type_1.checked = false;
		home_type_2.checked = false;
		home_type_3.checked = false;
	}

	// обрабатываем радиокнопки Тип стеклопакета
	glasspack_type_1.onclick = function() {
		glasspack_type_round_1.setAttribute("style", "left:-21.5px");
		glasspack_type_round_2.removeAttribute("style");
		glasspack_type_round_3.removeAttribute("style");
		glasspack_type_2.checked = false;
		glasspack_type_3.checked = false;
	}
	glasspack_type_2.onclick  = function() {
		glasspack_type_round_2.setAttribute("style", "left:-21.5px");
		glasspack_type_round_1.removeAttribute("style");
		glasspack_type_round_3.removeAttribute("style");
		glasspack_type_1.checked = false;
		glasspack_type_3.checked = false;
	}
	glasspack_type_3.onclick  = function() {
		glasspack_type_round_3.setAttribute("style", "left:-21.5px");
		glasspack_type_round_1.removeAttribute("style");
		glasspack_type_round_2.removeAttribute("style");
		glasspack_type_1.checked = false;
		glasspack_type_2.checked = false;
	}

	// обрабатываем радиокнопки Тип фурнитуры
	furniture_type_1.onclick = function() {
		furniture_type_round_1.setAttribute("style", "left:-21.5px");
		furniture_type_round_2.removeAttribute("style");
		furniture_type_round_3.removeAttribute("style");
		furniture_type_2.checked = false;
		furniture_type_3.checked = false;
	}
	furniture_type_2.onclick  = function() {
		furniture_type_round_2.setAttribute("style", "left:-21.5px");
		furniture_type_round_1.removeAttribute("style");
		furniture_type_round_3.removeAttribute("style");
		furniture_type_1.checked = false;
		furniture_type_3.checked = false;
	}
	furniture_type_3.onclick  = function() {
		furniture_type_round_3.setAttribute("style", "left:-21.5px");
		furniture_type_round_1.removeAttribute("style");
		furniture_type_round_2.removeAttribute("style");
		furniture_type_1.checked = false;
		furniture_type_2.checked = false;
	}

	// меняем картинку при нажатии на чекбокс Дополнительно
	document.getElementById("additional_type_round_1");
	document.getElementById("additional_type_round_2");
	document.getElementById("additional_type_round_3");
	document.getElementById("additional_type_round_4");
	document.getElementById("additional_type_round_5");
	additional_type_1.onclick  = function() {additional_type_round_1.style.left = (additional_type_1.checked) ? "-21.5px" : "0"}
	additional_type_2.onclick  = function() {additional_type_round_2.style.left = (additional_type_2.checked) ? "-21.5px" : "0"}
	additional_type_3.onclick  = function() {additional_type_round_3.style.left = (additional_type_3.checked) ? "-21.5px" : "0"}
	additional_type_4.onclick  = function() {additional_type_round_4.style.left = (additional_type_4.checked) ? "-21.5px" : "0"}
	additional_type_5.onclick  = function() {additional_type_round_5.style.left = (additional_type_5.checked) ? "-21.5px" : "0"}

	return false;
}

//валидация формы контактных данных
function validate_custinfo() {
	if (document.custinfo_form.location.value=="") {
		alert("Заполните поле формы - МЕСТО МОНТАЖА");
		return false;
	}
	return true;
}
</script>
