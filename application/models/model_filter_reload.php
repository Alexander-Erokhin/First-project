<?php

class Model_Filter_reload extends Model
{
	public function get_data($filter_page, $filter)
	{
		switch($filter_page){
			case 'dvigateli_dlya_legkovyh':
			if($filter){
				//Перебором подставляем все данные которые были выбраны
				foreach($filter as $filter_key=>$filter_value){
					if(!empty($filter_value)) {
						if(!isset($filter_query)) {
							if($filter_key == "ddl_year") $filter_query = " ('".DataBase::mysql_prep($filter_value)."' >= ddl_year_from AND '".DataBase::mysql_prep($filter_value)."' <= ddl_year_to)";
							else $filter_query = "`".DataBase::mysql_prep($filter_key)."` = '".DataBase::mysql_prep($filter_value)."'";
						}
						else {
							if($filter_key == "ddl_year") $filter_query .= " AND ('".$filter_value."' >= ddl_year_from AND '".$filter_value."' <= ddl_year_to)";
							else $filter_query .= " AND `".DataBase::mysql_prep($filter_key)."` = '".DataBase::mysql_prep($filter_value)."'";
						}
					}
				}
				//Делаем запрос для фильтра
				$db = DataBase::getDB(); // Создаём объект базы данных
				$query = "SELECT ddl_model, ddl_model_title, ddl_type_engine, ddl_transmission, ddl_volume_cars, ddl_year_from, ddl_year_to FROM `".DataBase::mysql_prep($filter_page)."` WHERE ".$filter_query." ORDER BY ddl_model, ddl_volume_cars, ddl_year_from";
				$reply['data_selection'] = $db->select($query);
				
				//Делаем запрос для таблицы 
				$db = DataBase::getDB(); // Создаём объект базы данных
				$query = "SELECT ddl_id, ddl_mark, ddl_mark_title, ddl_model, ddl_model_title, ddl_type_engine, ddl_transmission, ddl_volume_cars, ddl_year_from, ddl_year_to, ddl_name_engine, ddl_price FROM `".DataBase::mysql_prep($filter_page)."` WHERE ".$filter_query." ORDER BY ddl_model, ddl_volume_cars, ddl_year_from";
				//echo $query;
				
				$reply['data_table'] = $db->select($query);
				//Если пустая выдача
				if(empty($reply['data_table']) || empty($reply['data_selection'])){
					unset($reply['data_table']); unset($reply['data_selection']);
					return false;
				}
				else return $reply;
			}
			else return false;

			break;
			
			case 'kpp_dlya_legkovyh':
				if($filter){
					//Перебором подставляем все данные которые были выбраны
					foreach($filter as $filter_key=>$filter_value){
						if(!empty($filter_value)) {
							if(!isset($filter_query)) {
								if($filter_key == "kdl_year") $filter_query = " ('".DataBase::mysql_prep($filter_value)."' >= kdl_year_from AND '".DataBase::mysql_prep($filter_value)."' <= kdl_year_to)";
								else $filter_query = "`".DataBase::mysql_prep($filter_key)."` = '".DataBase::mysql_prep($filter_value)."'";
							}
							else {
								if($filter_key == "kdl_year") $filter_query .= " AND ('".DataBase::mysql_prep($filter_value)."' >= kdl_year_from AND '".DataBase::mysql_prep($filter_value)."' <= kdl_year_to)";
								else $filter_query .= " AND `".DataBase::mysql_prep($filter_key)."` = '".DataBase::mysql_prep($filter_value)."'";
							}
						}
					}
					//Делаем запрос для фильтра
					$db = DataBase::getDB(); // Создаём объект базы данных
					$query = "SELECT kdl_model, kdl_model_title, kdl_type_engine, kdl_transmission, kdl_volume_cars, kdl_year_from, kdl_year_to FROM `".DataBase::mysql_prep($filter_page)."` WHERE ".$filter_query." ORDER BY kdl_model, kdl_volume_cars, kdl_year_from";
					$reply['data_selection'] = $db->select($query);
					
					//Делаем запрос для таблицы 
					$db = DataBase::getDB(); // Создаём объект базы данных
					$query = "SELECT kdl_id, kdl_mark, kdl_mark_title, kdl_model, kdl_model_title, kdl_type_engine, kdl_transmission, kdl_volume_cars, kdl_year_from, kdl_year_to, kdl_name_engine, kdl_price FROM `".DataBase::mysql_prep($filter_page)."` WHERE ".$filter_query." ORDER BY kdl_model, kdl_volume_cars, kdl_year_from";
					$reply['data_table'] = $db->select($query);
					//Если пустая выдача
					if(empty($reply['data_table']) || empty($reply['data_selection'])){
						unset($reply['data_table']); unset($reply['data_selection']);
						return false;
					}
					else return $reply;
				}
				else return false;
			break;
			
			case 'dvigateli_dlya_gruzovyh':

				if($filter){
					//Перебором подставляем все данные которые были выбраны
					foreach($filter as $filter_key=>$filter_value){
						if(!empty($filter_value)) {
							if(!isset($filter_query)) {
								if($filter_key == "ddg_year") $filter_query = " ('".DataBase::mysql_prep($filter_value)."' >= ddg_year_from AND '".DataBase::mysql_prep($filter_value)."' <= ddg_year_to)";
								else $filter_query = "`".DataBase::mysql_prep($filter_key)."` = '".DataBase::mysql_prep($filter_value)."'";
							}
							else {
								if($filter_key == "ddg_year") $filter_query .= " AND ('".DataBase::mysql_prep($filter_value)."' >= ddg_year_from AND '".DataBase::mysql_prep($filter_value)."' <= ddg_year_to)";
								else $filter_query .= " AND `".DataBase::mysql_prep($filter_key)."` = '".DataBase::mysql_prep($filter_value)."'";
							}
						}
					}
					//Делаем запрос для фильтра
					$db = DataBase::getDB(); // Создаём объект базы данных
					$query = "SELECT ddg_model, ddg_model_title, ddg_volume, ddg_capacity, ddg_year_from, ddg_year_to FROM `dvigateli_dlya_gruzovyh` WHERE ".$filter_query." ORDER BY ddg_model, ddg_volume, ddg_year_from";
					$reply['data_selection'] = $db->select($query);
					
					//Делаем запрос для таблицы 
					$db = DataBase::getDB(); // Создаём объект базы данных
					$query = "SELECT ddg_id, ddg_mark, ddg_mark_title, ddg_model, ddg_model_title, ddg_modification, ddg_modification_tittle, ddg_model_dvs, ddg_volume, ddg_capacity, ddg_year_from, ddg_year_to, ddg_price  FROM `dvigateli_dlya_gruzovyh` WHERE ".$filter_query." ORDER BY ddg_model, ddg_volume, ddg_year_from";
					$reply['data_table'] = $db->select($query);
					//Если пустая выдача
					if(empty($reply['data_table']) || empty($reply['data_selection'])){
						unset($reply['data_table']); unset($reply['data_selection']);
						return false;
					}
					else return $reply;
				}
				else return false;
			break;
			
			default:
				die(); 
			break;
		}
	}
}
