<?php
if ($_POST) { // Если передан массив POST
	//Данные
	$to      = CONT_EMAIL_ORDER;
	$headers  = "MIME-Version: 1.0\r\n"; 
	$headers .= "Content-type: text/plain; charset=utf-8\r\n";
	$headers .= "From: ".CONT_EMAIL_ORDER."\r\n";
	$subject = "=?UTF-8?B?".base64_encode("Оставлена заявка с сайта ".SAIT_URL)."?=";
	$message = "Оставлена заявка с сайта ".SAIT_URL."\r\n";
	
	if(isset($_POST['user_tel']) && isset($_POST['user_name'])){
		if(isset($_POST['user_name'])) $name = trim($_POST['user_name']);
		if(isset($_POST['user_tel'])) $tel = trim($_POST['user_tel']);
		if(isset($_POST['user_com'])) $com = trim($_POST['user_com']);
		if(isset($_POST['description'])) $description = trim($_POST['description']);
		if(!empty($name) && !empty($tel)){
			if ($_POST['user_tel'] == 'Номер телефона' || $_POST['user_name'] == 'Ваше имя'){
				$json['messanger'] = 'Введите обязательные поля: имя и телефон!'; // пишем ошибку в массив
				$json['error'] = true; // пишем ошибку в массив
				echo json_encode($json); // Ошибка
				die(); // умираем	
			}
			else{
				$text = "Имя: ".preg_replace("/[^a-zA-ZёЁА-Яа-я0-9\s]/u", "", $_POST['user_name']);
				if(preg_match("/^((8|\+7)[\- ]?)?(\(?\d{3,4}\)?[\- ]?)?[\d\- ]{7,10}$/", $_POST['user_tel'])){
					$text .= "\r\nТелефон: ".$_POST['user_tel'];
				}
				else{
					$json['error'] = true; // пишем ошибку в массив
					$json['messanger'] = 'Телефон введен неправильно!<br><br>Пример: +7 909 123 45 67'; // пишем ошибку в массив
					echo json_encode($json); // выводим массив ответа
					die(); // умираем
				}
				if(!empty($com)){
					$text .= "\r\nКомментарий: ".htmlspecialchars($com);
				}
				if(!empty($description)){
					$text .= "\r\n\r\n".htmlspecialchars($description);
				}
			}
		}
		else{
			$json['error'] = true; // пишем ошибку в массив
			$json['messanger'] = 'Введите обязательные поля: имя и телефон!'; // пишем ошибку в массив
			echo json_encode($json); // выводим массив ответа
			die(); // умираем	
		}
	}
	else{
		$json['error'] = true; // пишем ошибку в массив
		$json['messanger'] = 'Введите обязательные поля: имя и телефон!'; // пишем ошибку в массив
		echo json_encode($json); // выводим массив ответа
		die(); // умираем	
	}
	
	//Отправка почты
	$message .= $text;
	
	mail($to, $subject, $message, $headers);

	if(!isset($json['error'])) {
		$json['messanger'] = 'Данные отправлены!'; // пишем ошибку в массив
		echo json_encode($json); // выводим массив ответа
		die(); // умираем	
	}
	
} else { // если массив POST не был передан
	header('Location: http://'.$_SERVER['HTTP_HOST']);//Перекидываем на основную страницу
}