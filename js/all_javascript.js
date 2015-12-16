jQuery(document).ready(function() { // вся магия после загрузки страницы
	//#Форма заявки консультации#
	jQuery('form[name="ajaxform"]').submit(function(){ // перехватываем все при событии отправки
		var form = jQuery(this); // запишем форму, чтобы потом не было проблем с this
		var error = false; // предварительно ошибок нет
		
		if (!error) { // если ошибки нет
			var data = form.serialize(); // подготавливаем данные
			jQuery.ajax({ // инициализируем ajax запрос
			   type: 'POST', // отправляем в POST формате, можно GET
			   url: '/consultation_form', // путь до обработчика, у нас он лежит в той же папке
			   dataType: 'json', // ответ ждем в json формате
			   data: data, // данные для отправки
		       beforeSend: function(data) { // событие до отправки
		            form.find('input[type="submit"]').attr('disabled', 'disabled'); // например, отключим кнопку, чтобы не жали по 100 раз
		          },
		       success: function(data){ // событие после удачного обращения к серверу и получения ответа
					if (data['error']) { // если обработчик вернул ошибку
						$("body").append('<div id="bg_popup_alert"><div id="popup_alert">'+data['messanger']+'</div></div>');
						setTimeout(function() {
							$("#bg_popup_alert").fadeOut(700);
							
						}, 1500);
						setTimeout(function() {
							$("#bg_popup_alert").remove();
							
						}, 2500);
						$('#zayavka input[type="text"]').each(function(){
							inputPlaceholder(document.getElementById($(this).attr("id")));
						});
		       		} else { // если все прошло ок
						$("body").append('<div id="bg_popup_alert"><div id="popup_alert">Ваша заявка отправлена!</div></div>');	
						setTimeout(function() {
							$("#bg_popup_alert").fadeOut(700);
							
						}, 1500);
						setTimeout(function() {
							$("#bg_popup_alert").remove();
							
						}, 2500);
						$('#zayavka').trigger('reset');
						$('#zayavka input[type="text"]').each(function(){
							inputPlaceholder(document.getElementById($(this).attr("id")));
						});
		       		}
		         },
		       error: function (xhr, ajaxOptions, thrownError) { // в случае неудачного завершения запроса к серверу
		         },
		       complete: function(data) { // событие после любого исхода
		            form.find('input[type="submit"]').prop('disabled', false); // в любом случае включим кнопку обратно
		         }
		                  
			     });
		}
		return false; // вырубаем стандартную отправку формы
	});

	var url_clear_array = my_trim(location.pathname).split('/');//Переводим весь URL в массив
	var url_clear_not_mark = '/' + url_clear_array[0];//Сохранить путь URL для марки

	//Отправка, получение и изменения данных таблицы при изменения любого из Select'а 
	jQuery('form[name="ajaxfilter"]').change(function(event){		
		var filter_select_name = event.target.name;
		var form_submit = jQuery(this);
		var data = form_submit.serialize(); // подготавливаем данные
		var data_array = data.split('&');
		data = "";
		var data_array_volume = 0;
		var update_select_all_choice = false;//Не обнавлять все фильры
		var update_select_all = update_select_all_choice;

		//Меняем адрес строки еcли изменена была модель
		if(filter_select_name == "filter_model"){
			//Изменяем параметр который говорит что нужно изменить все select
			update_select_all = true;

			//Изменяем URL ля модели но не обновляем страницу
			if(jQuery('form select[name="filter_model"]').val() != 0){
				var stateParameters = { foo: "bar" };
				var uri = url_clear_not_mark + '/' + url_clear_array[1] + '/' + jQuery('form select[name="filter_model"]').val();
				if (history.pushState == undefined){//Если неработает history.pushState
					window.location = uri;
				}else{
					history.pushState(stateParameters, "", uri);
				}	
				
				history.pathname = uri;
			}else{//Если выбрана пустая модель
				var stateParameters = { foo: "bar" };
				var uri = url_clear_not_mark + '/' + url_clear_array[1];
				if (history.pushState == undefined){//Если неработает history.pushState
					window.location = uri;
				}else{
					history.pushState(stateParameters, "", uri);
				}	
				history.pathname = uri;
			}			
		}
		
		//После того элемента который выбрали ставим значение select'а в 0
		jQuery.each(data_array, function(index, element){
			if(element.split('=')[0] == filter_select_name){
				data_array_volume = 1;
			}
			else if (data_array_volume == 1){
				jQuery('select[name=' + element.split('=')[0] + ']').val(0);
			}
		})
		
		//Отправка данных для обновление таблицы
		url_clear_array = my_trim(location.pathname).split('/');//Переводим весь URL в массив
		
		//Формируем даные для передачи выбраные фильтры: страница, марка, модель...
		if(url_clear_array[0] != undefined){
			data = "filter_page" + '=' + url_clear_array[0]
			if(url_clear_array[1] != undefined) data += '&' + 'filter_mark' + '=' + url_clear_array[1]
			data += "&" + jQuery('form[name="ajaxfilter"]').serialize()
			
		}
		else return false;
		
		jQuery.ajax({ // инициализируем ajax запрос
		   type: 'POST', // отправляем в POST формате, можно GET
		   url: '/filter_reload', // путь до обработчика, у нас он лежит в той же папке
		   dataType: 'json', // ответ ждем в json формате
		   data: data, // данные для отправки
		   success: function(data){ // событие после удачного обращения к серверу и получения ответа
				if (data['error']) { // если обработчик вернул ошибку
					//alert(data['error']); // покажем её текст
				} else { // если все прошло ок				
					//Если статус 200, то все ок идем дальше
					if(data['status'] == 200){
						jQuery('#pos_vse').remove();
					
						if(data.form_select != undefined){
							//Заменяю Select
							jQuery.each(data.form_select, function(index, element){
								if(update_select_all === true){
									jQuery('select[name="' + index + '"]').replaceWith(element);
								}
							})							
						}						
						jQuery('#perechen').replaceWith(data.data_table);
					}
				}
			 }	  
		});
	})	
	
	//#Кнопка показать все позиции#
	jQuery('#pos_vse').click(function(){ // перехватываем все при событии отправки
		url_clear_array = my_trim(location.pathname).split('/');//Переводим весь URL в массив
		
		//Формируем даные для передачи страница, марка, модель
		if(url_clear_array[0] != undefined){
			data = "filter_page" + '=' + url_clear_array[0]
			if(url_clear_array[1] != undefined) data += '&' + 'filter_mark' + '=' + url_clear_array[1]
			data += "&" + jQuery('form[name="ajaxfilter"]').serialize()
			
		}
		else return false;
		
		jQuery.ajax({ // инициализируем ajax запрос
		   type: 'POST', // отправляем в POST формате, можно GET
		   url: '/reload_table', // путь до обработчика, у нас он лежит в той же папке
		   dataType: 'json', // ответ ждем в json формате
		   data: data + '', // данные для отправки
		   success: function(data){ // событие после удачного обращения к серверу и получения ответа
				if (data['error']) { // если обработчик вернул ошибку
					//alert(data['error']); // покажем её текст
				} else { // если все прошло ок				
					//Если статус 200, то все ок идем дальше
					if(data['status'] == 200){
						jQuery('#pos_vse').remove();
						jQuery('#perechen').replaceWith(data.data_table);
						//jQuery('#load_date_gif').remove();
						
					}
				}
			 }	  
		});
	});	
});
//Появление формы заявки
function bgPopup(id){
	url_clear_array = my_trim(location.pathname).split('/');//Переводим весь URL в массив
	var description = "Марка - " + url_clear_array[1] + "\r\n";
	$('#'+id+' td').not(':last').each(function( index ) {
	  description += $("#perechen th").eq(index).text() + ' - ' + $( this ).text() + '\r\n';
	});
	description += "\r\nЗаявка со страниц " + location.href;
	
	jQuery("body").append('<div id="bg_popup" onclick="bgPopupClose()"></div><form  id="forma_popup" action="" method="POST"><span onclick="bgPopupClose()"></span><div>Ваш запрос будет обработан<br>в течение часа</div><label>Имя<sup>*</sup></label><input type="text" name="user_name" placeholder="Введите имя" required><label>Телефон<sup>*</sup></label><input type="text" name="user_tel" placeholder="Введите телефон" required><label>E-mail</label><input type="text" name="user_mail" placeholder="Можете указать e-mail"><label>Что необходимо</label><textarea name="user_com"></textarea><input type="hidden" name="description" value= "' + description + '"><button type="submit">Отправить</button></form>');
	jQuery('#bg_popup').fadeIn(700);
	jQuery('#forma_popup').fadeIn(700);
}

//Исчезновение формы заявки
function bgPopupClose(){
	jQuery('#bg_popup').fadeOut(700);
	jQuery('#forma_popup').fadeOut(700);
	setTimeout(function() {jQuery('#bg_popup').remove();jQuery('#forma_popup').remove();}, 700);
}


//Отправка формы заявки
$(document).on('submit','#forma_popup',function(){
	var form = jQuery(this); // запишем форму, чтобы потом не было проблем с this
	var error = false; // предварительно ошибок нет
	
	if (!error) { // если ошибки нет
		var data = form.serialize(); // подготавливаем данные
		jQuery.ajax({ // инициализируем ajax запрос
		   type: 'POST', // отправляем в POST формате, можно GET
		   url: '/zayvka_form', // путь до обработчика, у нас он лежит в той же папке
		   dataType: 'json', // ответ ждем в json формате
		   data: data, // данные для отправки
		   beforeSend: function(data) { // событие до отправки
				form.find('input[type="submit"]').attr('disabled', 'disabled'); // например, отключим кнопку, чтобы не жали по 100 раз
			  },
		   success: function(data){ // событие после удачного обращения к серверу и получения ответа
				if (data['error']) { // если обработчик вернул ошибку
					$("body").append('<div id="bg_popup_alert"><div id="popup_alert">'+data['messanger']+'</div></div>');
					setTimeout(function() {
						$("#bg_popup_alert").fadeOut(700);
						
					}, 1500);
					setTimeout(function() {
						$("#bg_popup_alert").remove();
						
					}, 2500);
					$('#zayavka input[type="text"]').each(function(){
						inputPlaceholder(document.getElementById($(this).attr("id")));
					});
				} else { // если все прошло ок
					$("body").append('<div id="bg_popup_alert"><div id="popup_alert">Ваша заявка отправлена!</div></div>');	
					setTimeout(function() {
						bgPopupClose();
						$("#bg_popup_alert").fadeOut(700);
						
					}, 1500);
					setTimeout(function() {
						$("#bg_popup_alert").remove();
						
					}, 2500);
					$('#zayavka').trigger('reset');
					$('#zayavka input[type="text"]').each(function(){
						inputPlaceholder(document.getElementById($(this).attr("id")));
					});
				}
			 },
		   error: function (xhr, ajaxOptions, thrownError) { // в случае неудачного завершения запроса к серверу
			 },
		   complete: function(data) { // событие после любого исхода
				form.find('input[type="submit"]').prop('disabled', false); // в любом случае включим кнопку обратно
			 }
					  
			 });
	}
   return false;
});

//Появление слайдера
function fotoViewOn(id){
	var ArrayElemenFoto = [];
	var selectActivFoto = 0;
	var ArrayView = "";
	
	//Массив для картинок для слайдера
	jQuery('#'+id+' img').each(function( index , value) {
	  ArrayElemenFoto[index] = jQuery('#'+id+' img').eq(index).attr('src');
	});
	
	//Если картинок больше чем одна тогда стрелки появляються и методы изменения картинок включаются
	if(ArrayElemenFoto.length > 1){
		ArrayView = '<div class="arrow_bullets"><a class="" title="Images_1" href="#"></a><a class="" title="Images_2" href="#"></a></div><a class="arrow_prev" href="#"></a><a class="arrow_next" href="#"></a></div>';
	}
	
	jQuery("body").append('<div id="bg_slider" onclick="bgPopupImagesClose()"></div><div id="slider_popup"><img width="600" src="' + ArrayElemenFoto[0] + '"><div id="images_slider_controls"><div id="images_close" onclick="bgPopupImagesClose()"></div>' + ArrayView + '</div>');
	jQuery('#bg_slider').fadeIn(700);
	jQuery('#slider_popup').fadeIn(700);

	//Если картинок больше чем одна тогда стрелки появляються и методы изменения картинок включаются
	if(ArrayElemenFoto.length > 1){	
		//Изменение картинки по нажатию левую или правую область
		jQuery('#slider_popup img, .arrow_prev,.arrow_next').click(function(e){
			var offset = jQuery('#slider_popup img').offset();
			var elementWidth = (jQuery('#slider_popup img').width()/2);
			var elementMouseClickX = (e.pageX - offset.left);
			var elementMouseClickY = (e.pageY - offset.top);
			var array_select = jQuery('#slider_popup img');
			
			if(elementMouseClickX <= elementWidth){
				selectActivFoto--;
				if(ArrayElemenFoto[selectActivFoto]){
					imageSlide(jQuery('#slider_popup img'), ArrayElemenFoto[selectActivFoto], 700)
				}
				else{
					selectActivFoto = ArrayElemenFoto.length-1;
					imageSlide(jQuery('#slider_popup img'), ArrayElemenFoto[selectActivFoto], 700)
				}			
			}
			else{
				selectActivFoto++;
				if(ArrayElemenFoto[selectActivFoto]){
					imageSlide(jQuery('#slider_popup img'), ArrayElemenFoto[selectActivFoto], 700)
				}
				else{
					selectActivFoto = 0;
					imageSlide(jQuery('#slider_popup img'), ArrayElemenFoto[selectActivFoto], 700)
				}			
			}
		})
	}
	
}

//Исчезновение слайдера
function bgPopupImagesClose(){
	jQuery('#bg_slider').fadeOut(700);
	jQuery('#slider_popup').fadeOut(700);
	setTimeout(function() {jQuery('#bg_slider').remove();jQuery('#slider_popup').remove();}, 700);
}

//Очистка от пробелов trim
function my_trim(str) {
    return str.replace(/^\/+|\s+|\s+$/gm,'');
}

//Функция картинка плавная исчезновение и появление
function imageSlide(imageOld, imageNew, imageDelay){
	jQuery(imageOld).fadeOut(imageDelay);
	setTimeout(function() {jQuery(imageOld).attr("src", imageNew);}, imageDelay);
	jQuery(imageOld).fadeIn(imageDelay);	
}