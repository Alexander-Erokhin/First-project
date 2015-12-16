<?php

// подключаем классы
set_include_path(get_include_path().PATH_SEPARATOR."application/class/");
spl_autoload_extensions("_class.php");
spl_autoload_register();


// подключаем файлы ядра
require_once 'core/config.php';
require_once 'core/model.php';
require_once 'core/view.php';
require_once 'core/controller.php';

// подключаем 
/*
Здесь обычно подключаются дополнительные модули, реализующие различный функционал:
	> аутентификацию
	> кеширование
	> работу с формами
	> абстракции для доступа к данным
	> ORM
	> Unit тестирование
	> Benchmarking
	> Работу с изображениями
	> Backup
	> и др.
*/

require_once 'core/route.php';
Route::start(); // запускаем маршрутизатор