<?php

class Controller_404 extends Controller
{
	
	function action_index()
	{
		$data['data_bd_view'] = $this->model->get_data_bd("404");
		$data['data_bd_view'] = parent::my_preg_repla($data['data_bd_view']);//Подставляем данные о теле, сате, название, почты..
		$this->view->generate('main_view.php', 'template_view.php', $data);
	}

}