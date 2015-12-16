<?php

class Controller_Kabiny_dlya_gruzovyh extends Controller
{
	//Страница с выдочей каталог марок
	function action_index()
	{
		$this->model_kabiny_dlya_gruzovyh = new Model_Kabiny_dlya_gruzovyh();//Создаем объект для вытаскивания 
		$data['data_bd_view'] = $this->model->get_data_bd("kabiny_dlya_gruzovyh");
		$data['data_bd_view'] = parent::my_preg_repla($data['data_bd_view']);//Подставляем данные о теле, сате, название, почты..
		$data['name_model_all'] = $this->model_kabiny_dlya_gruzovyh->get_data_filter_form(URL::routes_url(2));
		$this->view->generate('kabiny_dlya_gruzovyh_model_view.php', 'template_view.php', $data);//Вызваем Вьевер страницы
	}
	//Страница с выдочей моделей
	function action_table()
	{
		$this->model_kabiny_dlya_gruzovyh = new Model_Kabiny_dlya_gruzovyh();//Создаем объект для вытаскивания 
		$data['data_filter_form'] = $this->model_kabiny_dlya_gruzovyh->get_data_filter_form(URL::routes_url(2));
		$data['data_table_all'] = $this->model_kabiny_dlya_gruzovyh->get_data_table_all(URL::routes_url(2), 20);
		$data['data_bd_view'] = $this->model->get_data_bd("kabiny_dlya_gruzovyh_mark");

		//Если пустая выдоча запроса из БД то переносим на страницу 404
		if(empty($data['data_filter_form'])) Route::ErrorPage404();
		
		//Подставляем марку кабины. Вначале проверяем есть ли марка автомобиля
		if($data['data_table_all']){
			foreach($data['data_bd_view'][0] as $key => $value){
				$data['data_bd_view'][0][$key] = preg_replace('/{MARK}/', $data['data_table_all'][0]['kdg_mark_title'], $data['data_bd_view'][0][$key]);
			}
		}
		else{
			foreach($data['data_bd_view'][0] as $key => $value){
				$data['data_bd_view'][0][$key] = preg_replace('/{MARK}/', URL::routes_url(2), $data['data_bd_view'][0][$key]);
			}
		}
		$this->view->generate('kabiny_dlya_gruzovyh_view.php', 'template_view.php', $data);//Вызваем Вьевер страницы
	}
}
