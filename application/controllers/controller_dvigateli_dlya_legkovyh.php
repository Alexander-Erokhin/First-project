<?php

class Controller_Dvigateli_dlya_legkovyh extends Controller
{	
	//Страница с выдочей каталог марок
	function action_index()
	{
		$this->model_dvigateli_dlya_legkovyh = new Model_Dvigateli_dlya_legkovyh();//Создаем объект для вытаскивания 
		$data['data_bd_view'] = $this->model->get_data_bd("dvigateli_dlya_legkovyh");
		$data['data_bd_view'] = parent::my_preg_repla($data['data_bd_view']);//Подставляем данные о теле, сате, название, почты..
		$data['name_model_all'] = $this->model_dvigateli_dlya_legkovyh->get_data_filter_form(URL::routes_url(2));
		$this->view->generate('dvigateli_dlya_legkovyh_model_view.php', 'template_view.php', $data);//Вызваем Вьевер страницы
	}
	//Страница с выдачи моделей
	function action_table()
	{
		$this->model_dvigateli_dlya_legkovyh = new Model_Dvigateli_dlya_legkovyh();//Создаем объект для вытаскивания 
		if(URL::routes_url(3)) $DataArrayAllForFilter = $this->model_dvigateli_dlya_legkovyh->get_data_filter_form(URL::routes_url(2), URL::routes_url(3));
		else  $DataArrayAllForFilter = $this->model_dvigateli_dlya_legkovyh->get_data_filter_form(URL::routes_url(2));

		//Если пустая выдоча запроса из БД то переносим на страницу 404
		if(empty($DataArrayAllForFilter)) Route::ErrorPage404();
		
		//Собираем форму фильтр
		foreach($DataArrayAllForFilter as $key_filter=>$value_filter){

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
		
		//Удоляем повторяющиеся года
		$DataArrayFilteDate = array_unique($DataArrayFilterMinMaxYearDateDirty);
		
		//Производим сортировку по возрастанию
		ksort($DataArrayFilterModel, SORT_STRING);
		sort($DataArrayFilterTypeEngine, SORT_STRING);
		sort($DataArrayFilterTransmission, SORT_STRING);
		sort($DataArrayFilteVolumeCars, SORT_NUMERIC);
		sort($DataArrayFilteDate, SORT_NUMERIC);
		
		//Загоняем в общий массив
		$data['data_filter_form']['model'] = $DataArrayFilterModel;
		$data['data_filter_form']['type_engine'] = $DataArrayFilterTypeEngine;
		$data['data_filter_form']['transmission'] = $DataArrayFilterTransmission;
		$data['data_filter_form']['volume_cars'] = $DataArrayFilteVolumeCars;
		$data['data_filter_form']['date'] = $DataArrayFilteDate;

		if(URL::routes_url(3)) $data['data_table_all'] = $this->model_dvigateli_dlya_legkovyh->get_data_table_all(URL::routes_url(2), URL::routes_url(3));
		else  $data['data_table_all'] = $this->model_dvigateli_dlya_legkovyh->get_data_table_all(URL::routes_url(2));
		
		if(empty($data['data_table_all'])) Route::ErrorPage404();
		
		//Количество моделей
		if(URL::routes_url(3)) $data['data_filter_form']['count_query'] = count($data['data_table_all']); else $data['data_filter_form']['count_query'] = count($DataArrayAllForFilter);
		
		//Выбираем минимальное число по которому потом будем мерить показывать кнопку показать все или нет
		$data['data_filtr_form']['count_view'] = $data['data_filtr_form']['count_table_view'] = $data['data_filtr_form']['count_view'] = min(count($data['data_table_all']), SETING_COUNT_VIEW_DATA);
		
		//Если год до 2099 то меняем его на текущий год
		foreach($data['data_table_all'] as $key_year_data_table_all => $value_year_data_table_all){
			if($value_year_data_table_all['ddl_year_to'] == 2099){
				$data['data_table_all'][$key_year_data_table_all]['ddl_year_to'] = date('Y');
			}			
		}

		$data['data_bd_view'] = $this->model->get_data_bd("dvigateli_dlya_legkovyh_mark");
		
		//Если пустая выдоча запроса из БД то переносим на страницу 404
		if(empty($DataArrayAllForFilter)) Route::ErrorPage404();
		
		//Подставляем марку автомобиля
		foreach($data['data_bd_view'][0] as $key => $value){
			$data['data_bd_view'][0][$key] = preg_replace('/{MARK}/', $data['data_table_all'][0]['ddl_mark_title'], $data['data_bd_view'][0][$key]);
		}
		$this->view->generate('dvigateli_dlya_legkovyh_view.php', 'template_view.php', $data);//Вызваем Вьевер страницы			
	}
}