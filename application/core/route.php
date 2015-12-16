<?php

/*
Класс-маршрутизатор для определения запрашиваемой страницы.
> цепляет классы контроллеров и моделей;
> создает экземпляры контролеров страниц и вызывает действия этих контроллеров.
*/

class Route
{

	static function start()
	{
		// контроллер и действие по умолчанию
		$controller_name = 'Main';
		$action_name = 'index';
		
		// получаем имя контроллера
		if ( URL::routes_url(1) )
		{	
			$controller_name = preg_replace("/-/", "_", URL::routes_url(2));
			$controller_name = URL::routes_url(1);
		}

		// получаем имя экшена
		if (URL::routes_url(2))
		{
			$action_name = URL::routes_url(2);
		}

		//Проверка если находимся в двигателях
		switch($controller_name){		
			case 'dvigateli_dlya_legkovyh':		
				$model_name = 'Model_'.$controller_name;
				$controller_name = 'Controller_'.$controller_name;
				//Если он находиться 
				if(URL::routes_url(2)){
					// добавляем префиксы
					$action_name = 'action_table';
				}
				else{
					// добавляем префиксы
					$action_name = 'action_'.$action_name;
				}
			break;
			
			case 'kpp_dlya_legkovyh':
					
				$model_name = 'Model_'.$controller_name;
				$controller_name = 'Controller_'.$controller_name;
				//Если он находиться 
				if(URL::routes_url(2)){
					// добавляем префиксы
					$action_name = 'action_table';
				}
				else{
					// добавляем префиксы
					$action_name = 'action_'.$action_name;
				}
			break;
			
			case 'dvigateli_dlya_gruzovyh':
				$model_name = 'Model_'.$controller_name;
				$controller_name = 'Controller_'.$controller_name;
				//Если он находиться 
				if(URL::routes_url(2)){
					// добавляем префиксы
					$action_name = 'action_table';
				}
				else{
					// добавляем префиксы
					$action_name = 'action_'.$action_name;
				}				
			break;
			
			case 'kabiny_dlya_gruzovyh':
				$model_name = 'Model_'.$controller_name;
				$controller_name = 'Controller_'.$controller_name;
				//Если он находиться 
				if(URL::routes_url(2)){
					// добавляем префиксы
					$action_name = 'action_table';
				}
				else{
					// добавляем префиксы
					$action_name = 'action_'.$action_name;
				}			
			break;
			
			case 'reload_table':
				$model_name = 'Model_'.$controller_name;
				$controller_name = 'Controller_'.$controller_name;
				$action_name = "action_index";
			break;
			
			case 'filter_reload':
				$model_name = 'Model_'.$controller_name;
				$controller_name = 'Controller_'.$controller_name;
				$action_name = 'action_index';
				
			break;
			
			case 'stati':
				$model_name = 'Model_articles';
				$controller_name = 'Controller_articles';
				$action_name = 'action_index';				
			break;
		
			default:
				// добавляем префиксы
				$model_name = 'Model_'.$controller_name;
				$controller_name = 'Controller_'.$controller_name;
				$action_name = 'action_'.$action_name;
				//echo "<br>".$controller_name;
			break;
		}
		
		// подцепляем файл с классом модели (файла модели может и не быть)

		$model_file = strtolower($model_name).'.php';
		$model_path = "application/models/".$model_file;
		if(file_exists($model_path))
		{
			//Подключаем модель если есть файл
			include "application/models/".$model_file;
		}

		// подцепляем файл с классом контроллера
		$controller_file = strtolower($controller_name).'.php';
		$controller_path = "application/controllers/".$controller_file;
		if(file_exists($controller_path))
		{
			include "application/controllers/".$controller_file;
		}
		else
		{
			/*
			правильно было бы кинуть здесь исключение,
			но для упрощения сразу сделаем редирект на страницу 404
			*/
			Route::ErrorPage404();
		}

		// создаем контроллер
		$controller = new $controller_name;
		$action = $action_name;
		
		
		if(method_exists($controller, $action))
		{
			// вызываем действие контроллера
			$controller->$action();
		}
		else
		{
			// здесь также разумнее было бы кинуть исключение
			//Route::ErrorPage404();
		}
	
	}
	
	function ErrorPage404()
	{
		$host = 'http://'.$_SERVER['HTTP_HOST'].'/';
        header('HTTP/1.1 404 Not Found');
		header('Location:'.$host.'404');
		die();
    }
}