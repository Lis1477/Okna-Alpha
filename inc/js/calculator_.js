// JavaScript Document
window.onload = function () {
	// дефолтная обработка меню окон типа ОДНОСТВОРЧАТЫЕ
	var win_menu_1_1 = document.getElementById("window_menu_1_1");
	win_menu_1_1.onclick = function() {
		// устанавливаем стили для активного элемента меню окон
		window_menu_1_1.setAttribute("style", "padding:1px; border:solid 1px #E31E24; transform:scale(1.15);");
		// удаляем стили у других элемента меню окон, если имются
		if (window_menu_1_2.style) window_menu_1_2.removeAttribute("style");
		if (window_menu_1_3.style) window_menu_1_3.removeAttribute("style");
		// отображаем соответствующую главную картинку
		var calc_main_pic = document.getElementById("main_pic");
		if (calc_main_pic.firstElementChild.style) calc_main_pic.firstElementChild.removeAttribute("style");
		// чекаем соответствующий тип открывания окна		
		var win_1_type = document.getElementById("win_type_1_1");
		win_1_type.checked = true;
		// отображаем птичку
		var bird_1_1 = document.getElementById("bird_1_1");
		bird_1_1.setAttribute("style", "left:0");
		// прячем птичку у остальных типов, если видна
		if (bird_1_1.style) bird_1_2.removeAttribute("style");
		if (bird_1_3.style) bird_1_3.removeAttribute("style");
		return false;
	}
	var win_menu_1_2 = document.getElementById("window_menu_1_2");
	win_menu_1_2.onclick = function() {
		// устанавливаем стили для активного элемента меню окон
		window_menu_1_2.setAttribute("style", "padding:1px; border:solid 1px #E31E24; transform:scale(1.15);");
		// удаляем стили у других элемента меню окон, если имются
		if (window_menu_1_1.style) window_menu_1_1.removeAttribute("style");
		if (window_menu_1_3.style) window_menu_1_3.removeAttribute("style");
		// отображаем соответствующую главную картинку
		var calc_main_pic = document.getElementById("main_pic");
		calc_main_pic.firstElementChild.setAttribute("style", "left:-159px");
		// чекаем соответствующий тип открывания окна		
		var win_1_type = document.getElementById("win_type_1_2");
		win_1_type.checked = true;
		// отображаем птичку
		var bird_1_2 = document.getElementById("bird_1_2");
		bird_1_2.setAttribute("style", "left:0");
		// прячем птичку у остальных типов, если видна
		if (bird_1_1.style) bird_1_1.removeAttribute("style");
		if (bird_1_3.style) bird_1_3.removeAttribute("style");
		return false;
	}
	var win_menu_1_3 = document.getElementById("window_menu_1_3");
	win_menu_1_3.onclick = function() {
		// устанавливаем стили для активного элемента меню окон
		window_menu_1_3.setAttribute("style", "padding:1px; border:solid 1px #E31E24; transform:scale(1.15);");
		// удаляем стили у других элемента меню окон, если имются
		if (window_menu_1_1.style) window_menu_1_1.removeAttribute("style");
		if (window_menu_1_2.style) window_menu_1_2.removeAttribute("style");
		// отображаем соответствующую главную картинку
		var calc_main_pic = document.getElementById("main_pic");
		calc_main_pic.firstElementChild.setAttribute("style", "left:-316px");
		// чекаем соответствующий тип открывания окна		
		var win_1_type = document.getElementById("win_type_1_3");
		win_1_type.checked = true;
		// отображаем птичку
		var bird_1_3 = document.getElementById("bird_1_3");
		bird_1_3.setAttribute("style", "left:0");
		// прячем птичку у остальных типов, если видна
		if (bird_1_1.style) bird_1_1.removeAttribute("style");
		if (bird_1_2.style) bird_1_2.removeAttribute("style");
		return false;
	}
	// ОДНОСТВОРЧАТЫЕ 
	var calc_menu_1 = document.getElementById("calculator_menu_1");
	calc_menu_1.onclick = function() {
		// добавляем стиль для активного меню
		calc_menu_1.style.backgroundColor = "#E31E24";
		// удаляем стили для неактивного меню, если надо
		if (calc_menu_2.style) calc_menu_2.removeAttribute("style");
		if (calc_menu_3.style) calc_menu_3.removeAttribute("style");
		if (calc_menu_4.style) calc_menu_4.removeAttribute("style");
		// вставляем меню вариантов окон
		var win_menu = document.getElementById("window_menu");
		win_menu.innerHTML = '<ul><li><a href="#" id="window_menu_1_1" style="padding:1px; border:solid 1px #E31E24; transform:scale(1.15);"><img src="/img/calc_menu_pic_1_1.jpg"></a></li><li><a href="#" id="window_menu_1_2"><img src="/img/calc_menu_pic_1_2.jpg"></a></li><li><a href="#" id="window_menu_1_3"><img src="/img/calc_menu_pic_1_3.jpg"></a></li></ul>';
		// вставляем картинку окна
		var calc_main_pic = document.getElementById("main_pic");
		calc_main_pic.innerHTML = '<img src="/img/calc_pic_1.jpg">';
		// правим стили для корректного отображения картинки
		calc_main_pic.style.width = "";

		//делаем серым фон цифры 2 и 3
		document.getElementById("num_2").removeAttribute("style");
		document.getElementById("num_3").removeAttribute("style");

		// обработка меню окон
		var win_menu_1_1 = document.getElementById("window_menu_1_1");
		win_menu_1_1.onclick = function() {
			// устанавливаем стили для активного элемента меню окон
			window_menu_1_1.setAttribute("style", "padding:1px; border:solid 1px #E31E24; transform:scale(1.15);");
			// удаляем стили у других элемента меню окон, если имются
			if (window_menu_1_2.style) window_menu_1_2.removeAttribute("style");
			if (window_menu_1_3.style) window_menu_1_3.removeAttribute("style");
			// отображаем соответствующую главную картинку
			var calc_main_pic = document.getElementById("main_pic");
			if (calc_main_pic.firstElementChild.style) calc_main_pic.firstElementChild.removeAttribute("style");
			// чекаем соответствующий тип открывания окна		
			var win_1_type = document.getElementById("win_type_1_1");
			win_1_type.checked = true;
			// отображаем птичку
			var bird_1_1 = document.getElementById("bird_1_1");
			bird_1_1.setAttribute("style", "left:0");
			// прячем птичку у остальных типов, если видна
			if (bird_1_1.style) bird_1_2.removeAttribute("style");
			if (bird_1_3.style) bird_1_3.removeAttribute("style");
			return false;
		}
		var win_menu_1_2 = document.getElementById("window_menu_1_2");
		win_menu_1_2.onclick = function() {
			// устанавливаем стили для активного элемента меню окон
			window_menu_1_2.setAttribute("style", "padding:1px; border:solid 1px #E31E24; transform:scale(1.15);");
			// удаляем стили у других элемента меню окон, если имются
			if (window_menu_1_1.style) window_menu_1_1.removeAttribute("style");
			if (window_menu_1_3.style) window_menu_1_3.removeAttribute("style");
			// отображаем соответствующую главную картинку
			var calc_main_pic = document.getElementById("main_pic");
			calc_main_pic.firstElementChild.setAttribute("style", "left:-159px");
			// чекаем соответствующий тип открывания окна		
			var win_1_type = document.getElementById("win_type_1_2");
			win_1_type.checked = true;
			// отображаем птичку
			var bird_1_2 = document.getElementById("bird_1_2");
			bird_1_2.setAttribute("style", "left:0");
			// прячем птичку у остальных типов, если видна
			if (bird_1_1.style) bird_1_1.removeAttribute("style");
			if (bird_1_3.style) bird_1_3.removeAttribute("style");
			return false;
		}
		var win_menu_1_3 = document.getElementById("window_menu_1_3");
		win_menu_1_3.onclick = function() {
			// устанавливаем стили для активного элемента меню окон
			window_menu_1_3.setAttribute("style", "padding:1px; border:solid 1px #E31E24; transform:scale(1.15);");
			// удаляем стили у других элемента меню окон, если имются
			if (window_menu_1_1.style) window_menu_1_1.removeAttribute("style");
			if (window_menu_1_2.style) window_menu_1_2.removeAttribute("style");
			// отображаем соответствующую главную картинку
			var calc_main_pic = document.getElementById("main_pic");
			calc_main_pic.firstElementChild.setAttribute("style", "left:-316px");
			// чекаем соответствующий тип открывания окна		
			var win_1_type = document.getElementById("win_type_1_3");
			win_1_type.checked = true;
			// отображаем птичку
			var bird_1_3 = document.getElementById("bird_1_3");
			bird_1_3.setAttribute("style", "left:0");
			// прячем птичку у остальных типов, если видна
			if (bird_1_1.style) bird_1_1.removeAttribute("style");
			if (bird_1_2.style) bird_1_2.removeAttribute("style");
			return false;
		}
		return false;
	}

	// ДВУХСТВОРЧАТЫЕ 
	var calc_menu_2 = document.getElementById("calculator_menu_2");
	calc_menu_2.onclick = function() {
		if (calc_menu_1.style) calc_menu_1.removeAttribute("style");
		if (calc_menu_3.style) calc_menu_3.removeAttribute("style");
		if (calc_menu_4.style) calc_menu_4.removeAttribute("style");
		calc_menu_2.style.backgroundColor = "#E31E24";
		// вставляем меню вариантов окон
		var win_menu = document.getElementById("window_menu");
		win_menu.innerHTML = '<ul><li><a href="#" id="window_menu_2_1" style="padding:1px; border:solid 1px #E31E24; transform:scale(1.15);"><img src="/img/calc_menu_pic_2_1.jpg"></a></li><li><a href="#" id="window_menu_2_2"><img src="/img/calc_menu_pic_2_2.jpg"></a></li><li><a href="#" id="window_menu_2_3"><img src="/img/calc_menu_pic_2_3.jpg"></a></li><li><a href="#" id="window_menu_2_4"><img src="/img/calc_menu_pic_2_4.jpg"></a></li></ul>';
		// вставляем картинку окна
		var calc_main_pic = document.getElementById("main_pic");
		calc_main_pic.innerHTML = '<img src="/img/calc_pic_2.jpg">';
		// правим стили для корректного отображения картинки
		calc_main_pic.style.width = "205px";
		// делаем красной цифру 2
		var num_2 = document.getElementById("num_2");
		num_2.style.backgroundColor = "#E31E24";
		//делаем серым фон цифры 3
		document.getElementById("num_3").removeAttribute("style");
		// устанавливаем птичку в дефорт
		document.getElementById("bird_1_1").setAttribute("style", "left:0");
		document.getElementById("bird_1_2").removeAttribute("style");
		document.getElementById("bird_1_3").removeAttribute("style");
		// чекаем дефолтный тип открывания окна		
		document.getElementById("win_type_1_1").checked = true;





		// обработка меню окон
		var win_menu_2_1 = document.getElementById("window_menu_2_1");
		win_menu_2_1.onclick = function() {
			// устанавливаем стили для активного элемента меню окон
			window_menu_2_1.setAttribute("style", "padding:1px; border:solid 1px #E31E24; transform:scale(1.15);");
			// удаляем стили у других элемента меню окон, если имются
			if (window_menu_2_2.style) window_menu_1_2.removeAttribute("style");
			if (window_menu_2_3.style) window_menu_1_3.removeAttribute("style");
			// отображаем соответствующую главную картинку
			document.getElementById("main_pic").firstElementChild.removeAttribute("style");
			// чекаем соответствующий тип открывания окна		
			document.getElementById("win_type_2_1").checked = true;
			// отображаем птичку
			document.getElementById("bird_2_1").setAttribute("style", "left:0");
			// прячем птичку у остальных типов, если видна
			document.getElementById("bird_2_2").removeAttribute("style");
			document.getElementById("bird_2_3").removeAttribute("style");
			return false;
		}
		var win_menu_2_2 = document.getElementById("window_menu_2_2");
		win_menu_2_2.onclick = function() {
			// устанавливаем стили для активного элемента меню окон
			window_menu_2_2.setAttribute("style", "padding:1px; border:solid 1px #E31E24; transform:scale(1.15);");
			// удаляем стили у других элемента меню окон, если имются
			if (window_menu_2_1.style) window_menu_2_1.removeAttribute("style");
			if (window_menu_2_3.style) window_menu_2_3.removeAttribute("style");
			// отображаем соответствующую главную картинку
			document.getElementById("main_pic").firstElementChild.setAttribute("style", "left:-220px");
			// чекаем соответствующий тип открывания окна		
			document.getElementById("win_type_2_2").checked = true;
			// отображаем птичку
			document.getElementById("bird_1_2").setAttribute("style", "left:0");
			// прячем птичку у остальных типов, если видна
			if (bird_2_1.style) bird_2_1.removeAttribute("style");
			if (bird_2_3.style) bird_2_3.removeAttribute("style");
			return false;
		}
		var win_menu_1_3 = document.getElementById("window_menu_1_3");
		win_menu_1_3.onclick = function() {
			// устанавливаем стили для активного элемента меню окон
			window_menu_1_3.setAttribute("style", "padding:1px; border:solid 1px #E31E24; transform:scale(1.15);");
			// удаляем стили у других элемента меню окон, если имются
			if (window_menu_1_1.style) window_menu_1_1.removeAttribute("style");
			if (window_menu_1_2.style) window_menu_1_2.removeAttribute("style");
			// отображаем соответствующую главную картинку
			var calc_main_pic = document.getElementById("main_pic");
			calc_main_pic.firstElementChild.setAttribute("style", "left:-316px");
			// чекаем соответствующий тип открывания окна		
			var win_1_type = document.getElementById("win_type_1_3");
			win_1_type.checked = true;
			// отображаем птичку
			var bird_1_3 = document.getElementById("bird_1_3");
			bird_1_3.setAttribute("style", "left:0");
			// прячем птичку у остальных типов, если видна
			if (bird_1_1.style) bird_1_1.removeAttribute("style");
			if (bird_1_2.style) bird_1_2.removeAttribute("style");
			return false;
		}






		return false;
	}

	// ТРЕХСТВОРЧАТЫЕ 
	var calc_menu_3 = document.getElementById("calculator_menu_3");
	calc_menu_3.onclick = function() {
		if (calc_menu_1.style) calc_menu_1.removeAttribute("style");
		if (calc_menu_2.style) calc_menu_2.removeAttribute("style");
		if (calc_menu_4.style) calc_menu_4.removeAttribute("style");
		calc_menu_3.style.backgroundColor = "#E31E24";

		// вставляем меню вариантов окон
		var win_menu = document.getElementById("window_menu");
		win_menu.innerHTML = '<ul><li><a href="#" id="window_menu_3_1" style="padding:1px; border:solid 1px #E31E24; transform:scale(1.15);"><img src="/img/calc_menu_pic_3_1.jpg"></a></li><li><a href="#" id="window_menu_3_2"><img src="/img/calc_menu_pic_3_2.jpg"></a></li><li><a href="#" id="window_menu_3_3"><img src="/img/calc_menu_pic_3_3.jpg"></a></li><li><a href="#" id="window_menu_3_4"><img src="/img/calc_menu_pic_3_4.jpg"></a></li><li><a href="#" id="window_menu_3_5"><img src="/img/calc_menu_pic_3_5.jpg"></a></li><li><a href="#" id="window_menu_3_6"><img src="/img/calc_menu_pic_3_6.jpg"></a></li></ul>';

		// вставляем картинку окна
		var calc_main_pic = document.getElementById("main_pic");
		calc_main_pic.innerHTML = '<img src="/img/calc_pic_3.jpg">';
		// правим стили для корректного отображения картинки
		calc_main_pic.style.width = "270px";

		// делаем красной цифру 2 и 3
		var num_2 = document.getElementById("num_2");
		num_2.style.backgroundColor = "#E31E24";
		var num_3 = document.getElementById("num_3");
		num_3.style.backgroundColor = "#E31E24";

		// устанавливаем птичку в дефорт
		document.getElementById("bird_1_1").setAttribute("style", "left:0");
		document.getElementById("bird_1_2").removeAttribute("style");
		document.getElementById("bird_1_3").removeAttribute("style");
		// чекаем дефолтный тип открывания окна		
		document.getElementById("win_type_1_1").checked = true;


		return false;
	}
	// БАЛКОННЫЕ БЛОКИ
	var calc_menu_4 = document.getElementById("calculator_menu_4");
	calc_menu_4.onclick = function() {
		if (calc_menu_1.style) calc_menu_1.removeAttribute("style");
		if (calc_menu_2.style) calc_menu_2.removeAttribute("style");
		if (calc_menu_3.style) calc_menu_3.removeAttribute("style");
		calc_menu_4.style.backgroundColor = "#E31E24";

		// вставляем меню вариантов окон
		var win_menu = document.getElementById("window_menu");
		win_menu.innerHTML = '<ul><li><a href="#" id="window_menu_4_1" style="padding:1px; border:solid 1px #E31E24; transform:scale(1.15);"><img src="/img/calc_menu_pic_4_1.jpg"></a></li><li><a href="#" id="window_menu_4_2"><img src="/img/calc_menu_pic_4_2.jpg"></a></li><li><a href="#" id="window_menu_4_3"><img src="/img/calc_menu_pic_4_3.jpg"></a></li><li><a href="#" id="window_menu_4_4"><img src="/img/calc_menu_pic_4_4.jpg"></a></li><li><a href="#" id="window_menu_4_5"><img src="/img/calc_menu_pic_4_5.jpg"></a></li></ul>';

		// вставляем картинку окна
		var calc_main_pic = document.getElementById("main_pic");
		calc_main_pic.innerHTML = '<img src="/img/calc_pic_4.jpg">';
		// правим стили для корректного отображения картинки
		calc_main_pic.style.width = "90px";

		//делаем серым фон цифры 2 и 3
		document.getElementById("num_2").removeAttribute("style");
		document.getElementById("num_3").removeAttribute("style");

		// устанавливаем птичку в дефорт
		document.getElementById("bird_1_1").setAttribute("style", "left:0");
		document.getElementById("bird_1_2").removeAttribute("style");
		document.getElementById("bird_1_3").removeAttribute("style");
		// чекаем дефолтный тип открывания окна		
		document.getElementById("win_type_1_1").checked = true;


		return false;
	}
	return false;

}
