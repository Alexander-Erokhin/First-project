<?php

class Controller_Reload_table extends Controller
{
	//Страница с выдочей каталог марок
	function action_index()
	{
		if(!empty($_POST['filter_page']) && !empty($_POST['filter_mark'])){
			//Очистка поступивших данных
			$this->validator = new Validator();
			$filter_page = $this->validator->basic_filter($_POST['filter_page']);

			switch($filter_page){
				
				case "dvigateli_dlya_legkovyh":
					$filter['ddl_mark'] = $this->validator->basic_filter($_POST['filter_mark']);
					$filter['ddl_model'] = $this->validator->basic_filter($_POST['filter_model']);
					$filter['ddl_transmission'] = $this->validator->basic_filter($_POST['filter_transmission']);
					$filter['ddl_type_engine'] = $this->validator->rus_string_slash_filter($_POST['filter_type_engine']);
					$filter['ddl_volume_cars'] = $this->validator->float($_POST['filter_volume_cars']);
					$filter['ddl_year'] = $this->validator->integer($_POST['filter_year']);	
					$this->model_reload_table = new Model_Reload_table();//Создаем объект для вытаскивания 
					$data['data_table'] = $this->model_reload_table->get_data($filter_page, $filter);
					
					//Если год до 2099 то меняем его на текущий год
					foreach($data['data_table'] as $key_year_data_table => $value_year_data_table){
						if($value_year_data_table['ddl_year_to'] == 2099){
							$data['data_table'][$key_year_data_table]['ddl_year_to'] = date('Y');
						}			
					}				
				break;
				
				case "dvigateli_dlya_gruzovyh":
					$filter['ddg_mark'] = $this->validator->basic_filter($_POST['filter_mark']);
					$filter['ddg_model'] = $this->validator->basic_filter($_POST['filter_model']);
					$filter['ddg_volume'] = $this->validator->float($_POST['filter_volume']);
					$filter['ddg_capacity'] = $this->validator->integer($_POST['filter_capacity']);
					$filter['ddg_year'] = $this->validator->integer($_POST['filter_year']);	
					$this->model_reload_table = new Model_Reload_table();//Создаем объект для вытаскивания 
					$data['data_table'] = $this->model_reload_table->get_data($filter_page, $filter);
					
					//Если год до 2099 то меняем его на текущий год
					foreach($data['data_table'] as $key_year_data_table => $value_year_data_table){
						if($value_year_data_table['ddg_year_to'] == 2099){
							$data['data_table'][$key_year_data_table]['ddg_year_to'] = date('Y');
						}			
					}			
				break;
				
				case "kpp_dlya_legkovyh":
					$filter['kdl_mark'] = $this->validator->basic_filter($_POST['filter_mark']);
					$filter['kdl_model'] = $this->validator->basic_filter($_POST['filter_model']);
					$filter['kdl_transmission'] = $this->validator->basic_filter($_POST['filter_transmission']);
					$filter['kdl_type_engine'] = $this->validator->rus_string_slash_filter($_POST['filter_type_engine']);
					$filter['kdl_volume_cars'] = $this->validator->float($_POST['filter_volume_cars']);
					$filter['kdl_year'] = $this->validator->integer($_POST['filter_year']);	
					$this->model_reload_table = new Model_Reload_table();//Создаем объект для вытаскивания 
					$data['data_table'] = $this->model_reload_table->get_data($filter_page, $filter);
					
					//Если год до 2099 то меняем его на текущий год
					foreach($data['data_table'] as $key_year_data_table => $value_year_data_table){
						if($value_year_data_table['kdl_year_to'] == 2099){
							$data['data_table'][$key_year_data_table]['kdl_year_to'] = date('Y');
						}			
					}				
				break;
			}
			
			$data['filter_page'] = $this->validator->basic_filter($_POST['filter_page']);
			$this->view->generate('reload_table_view.php', 'ajax_view.php', $data);//Вызваем Вьевер страницы
		}
		else{
			URL::location_index();
		}
	}
}