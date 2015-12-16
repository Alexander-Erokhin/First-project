<?php

class Controller_zayvka_form extends Controller
{
	//Основная страница
	function action_index()
	{
		if ($_POST) { // Если передан массив POST
			
			//Данные
			$to      = CONT_EMAIL2;
			$headers  = "MIME-Version: 1.0\r\n"; 
			$headers .= "Content-type: text/plain; charset=utf-8\r\n";
			$headers .= "From: ".CONT_EMAIL2."\r\n";
			$subject = "=?UTF-8?B?".base64_encode("Оставлена заявка с сайта ".SAIT_NAME)."?=";
			$message = "Оставлена заявка с сайта ".SAIT_NAME."\r\n";
			
			if(isset($_POST['user_tel'])){
				if(isset($_POST['user_name'])) $name = trim($_POST['user_name']);
				if(isset($_POST['user_tel'])) $tel = trim($_POST['user_tel']);
				if(!empty($_POST['user_mail'])) $mail = "\r\nEmail: ".trim($_POST['user_mail']); else $mail = "";
				if(!empty($_POST['user_com'])) $com = "\r\nКомментарии клиента: ".trim(preg_replace("/[^a-zA-ZёЁА-Яа-я0-9\/_.:\-\s]/u", "", $_POST['user_com'])); else $com = "";
				//if(isset($_POST['user_zap'])) $mark = trim($_POST['user_zap']);
				if(!empty($name) && !empty($tel)){
					if ($_POST['user_tel'] == 'Номер телефона' || $_POST['user_name'] == 'Ваше имя'){
						$json['messanger'] = 'Введите обязательные поля: имя и телефон!'; // пишем ошибку в массив
						$json['error'] = true; // пишем ошибку в массив
						$data = json_encode($json); // Ошибка
						$this->view->generate('zayvka_form_view.php', 'ajax_view.php', $data);
						die(); // умираем	
					}
					else{
						$text = "Имя: ".preg_replace("/[^a-zA-ZёЁА-Яа-я0-9\s]/u", "", $_POST['user_name']);
						if(preg_match("/^((8|\+7)[\- ]?)?(\(?\d{3,4}\)?[\- ]?)?[\d\- ]{7,10}$/", $_POST['user_tel'])){
							$text .= "\r\nТелефон: ".$_POST['user_tel'];
							$text .= $mail;
							$text .= $com;
							$text .= "\r\n\r\n----\r\nДанные с сайта:\r\n".preg_replace("/[^a-zA-ZёЁА-Яа-я0-9\/_.:\-\s]/u", "", htmlspecialchars($_POST['description'], ENT_QUOTES));
						}
						else{
							$json['error'] = true; // пишем ошибку в массив
							$json['messanger'] = 'Телефон введен неправильно!<br><br>Пример: +7 909 123 45 67'; // пишем ошибку в массив
							$data = json_encode($json); // выводим массив ответа
							$this->view->generate('zayvka_form_view.php', 'ajax_view.php', $data);
							die(); // умираем
						}
						if(!empty($_POST['user_zap'])){
							$text .= "\r\nИщу: ".htmlspecialchars($_POST['user_zap']);
						}
					}
				}
				else{
					$json['error'] = true; // пишем ошибку в массив
					$json['messanger'] = 'Введите обязательные поля: имя и телефон!'; // пишем ошибку в массив
					echo json_encode($json); // выводим массив ответа
					$this->view->generate('zayvka_form_view.php', 'ajax_view.php', $data);
					die(); // умираем	
				}
			}
			else if(isset($_POST['user_com'])){
				if(isset($_POST['user_name'])) $name = trim($_POST['user_name']);
				if(isset($_POST['user_com'])) $otzv = trim($_POST['user_com']);
				
				if(!empty($name) && !empty($otzv)){
					if ($_POST['user_com'] == 'Отзыв' || $_POST['user_name'] == 'Ваше имя'){
						$json['error'] = true; // пишем ошибку в массив
						$json['messanger'] = 'Введите обязательные поля: имя и отзыв!'; // пишем ошибку в массив
						$data = json_encode($json); // выводим массив ответа
						$this->view->generate('zayvka_form_view.php', 'ajax_view.php', $data);
						die(); // умираем	
					}else{
						$text = "Имя: ".preg_replace("/[^a-zA-ZёЁА-Яа-я0-9\s]/u", "", $_POST['user_name']);
						$text .= "\r\nОтзыв: ".htmlspecialchars($_POST['user_otzv']);
						//
						$subject = '=?UTF-8?B?'.base64_encode("Оставлен отзыв с real-motor.com").'?=';
						$message = "Оставлен отзыв с oasis-bliss.ru\r\n";
					}		
				}
				else{
					$json['error'] = true; // пишем ошибку в массив
					$json['messanger'] = 'Введите обязательные поля: имя и отзыв!'; // пишем ошибку в массив
					$data = json_encode($json); // выводим массив ответа
					$this->view->generate('zayvka_form_view.php', 'ajax_view.php', $data);
					die(); // умираем		
				}
			}
			
			//Отправка почты
			$message .= $text;
			
			mail($to, $subject, $message, $headers);

			if(!isset($json['error'])) {
				$json['messanger'] = 'Данные отправлены!'; // пишем ошибку в массив
				$data = json_encode($json); // выводим массив ответа
				$this->view->generate('zayvka_form_view.php', 'ajax_view.php', $data);
				die(); // умираем	
			}
			
		} else { // если массив POST не был передан
			header('Location: http://'.$_SERVER['HTTP_HOST']);//Перекидываем на основную страницу
		}
		
		$this->view->generate('zayvka_form_view.php', 'ajax_view.php', $data);
	}

}
?>