<?php

class Controller {

	public $model;
	public $view;
	public $data;

	function __construct()
	{
		$this->model = new Model();
		$this->view = new View();
	}

	// действие (action), вызываемое по умолчанию
	function action_index()
	{
		$this->view->generate('main_view.php', 'template_view.php');
	}
	
	function my_preg_repla($text_replace){
		//Подставляем данные если поподаются
		foreach($text_replace as $key => $value){
			$text_replace[$key] = preg_replace('/{SAIT_NAME}/', SAIT_NAME, $text_replace[$key]);
			$text_replace[$key] = preg_replace('/{CONT_TEL1}/', CONT_TEL1, $text_replace[$key]);
			$text_replace[$key] = preg_replace('/{CONT_TEL2}/', CONT_TEL2, $text_replace[$key]);
			$text_replace[$key] = preg_replace('/{CONT_EMAIL1}/', CONT_EMAIL1, $text_replace[$key]);
			$text_replace[$key] = preg_replace('/{CONT_EMAIL2}/', CONT_EMAIL2, $text_replace[$key]);
			$text_replace[$key] = preg_replace('/{CONT_ADRESS}/', CONT_ADRESS, $text_replace[$key]);
		}
		return $text_replace;
	}
}