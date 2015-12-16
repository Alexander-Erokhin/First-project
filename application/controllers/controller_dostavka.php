<?php

class Controller_dostavka extends Controller
{
	
	//Основная страница
	function action_index()
	{
		$data['data_bd_view'] = $this->model->get_data_bd("dostavka");
		$data['data_bd_view'] = parent::my_preg_repla($data['data_bd_view']);//Подставляем данные о теле, сате, название, почты..
		$this->view->generate('main_view.php', 'template_view.php', $data);
	}

}
