<?php

class Controller_articles extends Controller
{
	
	//Основная страница
	function action_index()
	{
		$this->model_articles = new Model_articles();//Создаем объект для вытаскивания 
		$data['data_bd_view'] = $this->model_articles->get_data();
		$data['data_bd_view'] = parent::my_preg_repla($data['data_bd_view']);//Подставляем данные о теле, сате, название, почты..
		$data['data_bd_view'][0]['title'] = "Статьи";
		$this->view->generate('articles_view.php', 'template_view.php', $data);//Вызваем Вьевер страницы
	}

}
