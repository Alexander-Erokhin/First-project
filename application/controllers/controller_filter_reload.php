<?php

class Controller_Filter_reload extends Controller
{
	
	//Страница с выдочей каталог марок
	function action_index()
	{
		if(!empty($_POST['filter_page']) && !empty($_POST['filter_mark'])){
		switch($_POST['filter_page']){
			case "dvigateli_dlya_legkovyh":
				//Очистка поступивших данных
				$this->validator = new Validator();
				$filter_page = $this->validator->basic_filter($_POST['filter_page']);
				$filter['ddl_mark'] = $this->validator->basic_filter($_POST['filter_mark']);
				$filter['ddl_model'] = $this->validator->basic_filter($_POST['filter_model']);
				$filter['ddl_transmission'] = $this->validator->basic_filter($_POST['filter_transmission']);
				$filter['ddl_type_engine'] = $this->validator->rus_string_slash_filter($_POST['filter_type_engine']);
				$filter['ddl_volume_cars'] = $this->validator->volume_car_filter($_POST['filter_volume_cars']);
				$filter['ddl_year'] = $this->validator->integer($_POST['filter_year']);
				$this->model_filter_reload = new Model_Filter_reload();//Создаем объект для вытаскивания 			
				$data = $this->model_filter_reload->get_data($filter_page, $filter);
				
				//Проверяю есть ли такая марка или модель
				if($data){
					$data['data_table'] = $data['data_table']; //Масив для таблицы
					$data['data_filter'] = $data['data_selection'];//Массив для формы фильтр
					
					//Собираем форму фильтр
					foreach($data['data_filter'] as $key_filter=>$value_filter){

						//Убираем не уникальные модели
						$DataArrayFilterModel[$value_filter['ddl_model']] = $value_filter['ddl_model_title']; 
						$DataArrayFilterTypeEngine[$value_filter['ddl_type_engine']] = $value_filter['ddl_type_engine'];
						$DataArrayFilterTransmission[$value_filter['ddl_transmission']] = $value_filter['ddl_transmission'];
						if(!empty($value_filter['ddl_volume_cars'])) $DataArrayFilteVolumeCars[$value_filter['ddl_volume_cars']] = $value_filter['ddl_volume_cars'];

						//Если год до 2099 то меняем ее на текущий год
						if($value_filter['ddl_year_to'] == 2099){
							$value_filter['ddl_year_to'] = date('Y');
						}
						
						//Дописываем недостающие года которые попал в диапазон от до года выпуска. 
						for($i = $value_filter['ddl_year_from']; $i <= $value_filter['ddl_year_to']; $i++){
							if(isset($DataArrayFilterMinMaxYearDateDirty)){
								if(!in_array($i, $DataArrayFilterMinMaxYearDateDirty) ) {
									$DataArrayFilterMinMaxYearDateDirty[] = $i;
								}								
							}
							else{
								$DataArrayFilterMinMaxYearDateDirty[] = $i;
							}
						}
					}
				
					//Удаляем повторяющиеся года
					$DataArrayFilteDate = array_unique($DataArrayFilterMinMaxYearDateDirty);
					
					//Производим сортировку по возрастанию
					ksort($DataArrayFilterModel, SORT_STRING);
					sort($DataArrayFilterTypeEngine, SORT_STRING);
					sort($DataArrayFilterTransmission, SORT_STRING);
					sort($DataArrayFilteVolumeCars, SORT_STRING);
					sort($DataArrayFilteDate, SORT_STRING);
					
					//unset($data['data_selection']);
					
					//Загоняем в общий массив
					$data['data_filter_form']['model'] = $DataArrayFilterModel;
					$data['data_filter_form']['type_engine'] = $DataArrayFilterTypeEngine;
					$data['data_filter_form']['transmission'] = $DataArrayFilterTransmission;
					$data['data_filter_form']['volume_cars'] = $DataArrayFilteVolumeCars;
					$data['data_filter_form']['date'] = $DataArrayFilteDate;

					
					//Если год до 2099 то меняем его на текущий год
					foreach($data['data_table'] as $key_year_data_table_all => $value_year_data_table_all){
						if($value_year_data_table_all['ddl_year_to'] == 2099){
							$data['data_table'][$key_year_data_table_all]['ddl_year_to'] = date('Y');
						}			
					}
				}
				else $data = false;
			break;
			
			case "kpp_dlya_legkovyh":
				//Очистка поступивших данных
				$this->validator = new Validator();
				$filter_page = $this->validator->basic_filter($_POST['filter_page']);
				$filter['kdl_mark'] = $this->validator->basic_filter($_POST['filter_mark']);
				$filter['kdl_model'] = $this->validator->basic_filter($_POST['filter_model']);
				$filter['kdl_transmission'] = $this->validator->basic_filter($_POST['filter_transmission']);
				$filter['kdl_type_engine'] = $this->validator->rus_string_slash_filter($_POST['filter_type_engine']);
				$filter['kdl_volume_cars'] = $this->validator->volume_car_filter($_POST['filter_volume_cars']);
				$filter['kdl_year'] = $this->validator->integer($_POST['filter_year']);
				$this->model_filter_reload = new Model_Filter_reload();//Создаем объект для вытаскивания 			
				$data = $this->model_filter_reload->get_data($filter_page, $filter);
				
				//Проверяю есть ли такая марка или модель
				if($data){
					$data['data_filter'] = $data['data_selection'];//Массив для формы фильтр
					
					//Собираем форму фильтр
					foreach($data['data_filter'] as $key_filter=>$value_filter){

						//Убираем не уникальные модели
						$DataArrayFilterModel[$value_filter['kdl_model']] = $value_filter['kdl_model_title']; 
						$DataArrayFilterTypeEngine[$value_filter['kdl_type_engine']] = $value_filter['kdl_type_engine'];
						$DataArrayFilterTransmission[$value_filter['kdl_transmission']] = $value_filter['kdl_transmission'];
						if(!empty($value_filter['kdl_volume_cars'])) $DataArrayFilteVolumeCars[$value_filter['kdl_volume_cars']] = $value_filter['kdl_volume_cars'];

						//Если год до 2099 то меняем ее на текущий год
						if($value_filter['kdl_year_to'] == 2099){
							$value_filter['kdl_year_to'] = date('Y');
						}
						
						//Дописываем недостающие года которые попал в диапазон от до года выпуска. 
						for($i = $value_filter['kdl_year_from']; $i <= $value_filter['kdl_year_to']; $i++){
							if(isset($DataArrayFilterMinMaxYearDateDirty)){
								if(!in_array($i, $DataArrayFilterMinMaxYearDateDirty) ) {
									$DataArrayFilterMinMaxYearDateDirty[] = $i;
								}								
							}
							else{
								$DataArrayFilterMinMaxYearDateDirty[] = $i;
							}
						}
					}
				
					//Удоляем повторяющиеся года
					$DataArrayFilteDate = array_unique($DataArrayFilterMinMaxYearDateDirty);
					
					//Производим сортировку по возрастанию
					ksort($DataArrayFilterModel, SORT_STRING);
					sort($DataArrayFilterTypeEngine, SORT_STRING);
					sort($DataArrayFilterTransmission, SORT_STRING);
					sort($DataArrayFilteVolumeCars, SORT_STRING);
					sort($DataArrayFilteDate, SORT_STRING);
					
					//unset($data['data_selection']);
					
					//Загоняем в общий массив
					$data['data_filter_form']['model'] = $DataArrayFilterModel;
					$data['data_filter_form']['type_engine'] = $DataArrayFilterTypeEngine;
					$data['data_filter_form']['transmission'] = $DataArrayFilterTransmission;
					$data['data_filter_form']['volume_cars'] = $DataArrayFilteVolumeCars;
					$data['data_filter_form']['date'] = $DataArrayFilteDate;

					
					//Если год до 2099 то меняем его на текущий год
					foreach($data['data_table'] as $key_year_data_table_all => $value_year_data_table_all){
						if($value_year_data_table_all['kdl_year_to'] == 2099){
							$data['data_table'][$key_year_data_table_all]['kdl_year_to'] = date('Y');
						}			
					}
				}
				else $data = false;
			break;

			case "dvigateli_dlya_gruzovyh":
				//Очистка поступивших данных
				$this->validator = new Validator();	
				$filter_page = $this->validator->basic_filter($_POST['filter_page']);
				$filter['ddg_mark'] = $this->validator->basic_filter($_POST['filter_mark']);
				$filter['ddg_model'] = $this->validator->basic_filter($_POST['filter_model']);
				$filter['ddg_volume'] = $this->validator->volume_car_filter($_POST['filter_volume']);
				$filter['ddg_capacity'] = $this->validator->integer($_POST['filter_capacity']);
				$filter['ddg_year'] = $this->validator->integer($_POST['filter_year']);

				$this->model_filter_reload = new Model_Filter_reload();//Создаем объект для вытаскивания 			
				$data = $this->model_filter_reload->get_data($filter_page, $filter);
				
				//Проверяю есть ли такая марка или модель
				if($data){
					$data['data_filter'] = $data['data_selection'];//Массив для формы фильтр
		
					
					//Собираем форму фильтр
					foreach($data['data_filter'] as $key_filter=>$value_filter){

						//Убираем не уникальные модели
						$DataArrayFilterModel[$value_filter['ddg_model']] = $value_filter['ddg_model_title'];
						if(!empty($value_filter['ddg_volume'])) $DataArrayFilteVolume[$value_filter['ddg_volume']] = $value_filter['ddg_volume'];
						if(!empty($value_filter['ddg_capacity'])) $DataArrayFilteCapacity[$value_filter['ddg_capacity']] = $value_filter['ddg_capacity'];

						//Если год до 2099 то меняем ее на текущий год
						if($value_filter['ddg_year_to'] == 2099){
							$value_filter['ddg_year_to'] = date('Y');
						}
						
						//Дописываем недостающие года которые попал в диапазон от до года выпуска. 
						for($i = $value_filter['ddg_year_from']; $i <= $value_filter['ddg_year_to']; $i++){
							if(isset($DataArrayFilterMinMaxYearDateDirty)){
								if(!in_array($i, $DataArrayFilterMinMaxYearDateDirty) ) {
									$DataArrayFilterMinMaxYearDateDirty[] = $i;
								}								
							}
							else{
								$DataArrayFilterMinMaxYearDateDirty[] = $i;
							}
						}
					}
				
					//Удоляем повторяющиеся года
					$DataArrayFilteDate = array_unique($DataArrayFilterMinMaxYearDateDirty);
					
					//Производим сортировку по возрастанию
					ksort($DataArrayFilterModel, SORT_STRING);
					sort($DataArrayFilteVolume, SORT_NUMERIC);
					sort($DataArrayFilteCapacity, SORT_STRING);
					sort($DataArrayFilteDate, SORT_STRING);
					
					//unset($data['data_selection']);
					
					//Загоняем в общий массив
					$data['data_filter_form']['model'] = $DataArrayFilterModel;
					$data['data_filter_form']['volume'] = $DataArrayFilteVolume;
					$data['data_filter_form']['capacity'] = $DataArrayFilteCapacity;
					$data['data_filter_form']['date'] = $DataArrayFilteDate;
					
					//Если год до 2099 то меняем его на текущий год
					foreach($data['data_table'] as $key_year_data_table_all => $value_year_data_table_all){
						if($value_year_data_table_all['ddg_year_to'] == 2099){
							$data['data_table'][$key_year_data_table_all]['ddg_year_to'] = date('Y');
						}			
					}
				}
				else $data = false;
			break;			
			
		}

			$data['filter_page'] = $this->validator->basic_filter($_POST['filter_page']);
			$this->view->generate('filter_reload_view.php', 'ajax_view.php', $data);//Вызваем Вьевер страницы

		}
		else{
			URL::location_index();
		}
	}
}