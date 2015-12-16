<?php

class Controller_consultation_form extends Controller
{
	//Основная страница
	function action_index()
	{
		$data['data_mail_view'] = "fig";
		$this->view->generate('consultation_form_view.php', 'ajax_view.php', $data);
	}

}
?>