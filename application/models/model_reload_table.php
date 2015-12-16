<?php
class Model_Reload_table extends Model
{
	public function get_data($filter_page, $filter)
	{
		switch($filter_page){		
			case 'dvigateli_dlya_legkovyh':
			if($filter){
				//Перебором подставляем все данные которые были выбраны
				foreach($filter as $filter_key=>$filter_value){
					if(!empty($filter_value)) {
						if(!isset($filter_query)) $filter_query = "`".DataBase::mysql_prep($filter_key)."` = '".DataBase::mysql_prep($filter_value)."'";
						else $filter_query .= " AND `".DataBase::mysql_prep($filter_key)."` = '".DataBase::mysql_prep($filter_value)."'";
					}
				}
				$db = DataBase::getDB(); // Создаём объект базы данных
				$query = "SELECT ddl_id, ddl_mark, ddl_mark_title, ddl_model, ddl_model_title, ddl_type_engine, ddl_transmission, ddl_volume_cars, ddl_year_from, ddl_year_to, ddl_name_engine, ddl_price FROM `dvigateli_dlya_legkovyh` WHERE ".$filter_query." ORDER BY ddl_model, ddl_volume_cars, ddl_year_from";
				$reply = $db->select($query);
				return $reply;
			}
			else return MESSAGE_NOT_MODEL;

			break;

			case 'dvigateli_dlya_gruzovyh':
			if($filter){
				//Перебором подставляем все данные которые были выбраны
				foreach($filter as $filter_key=>$filter_value){
					if(!empty($filter_value)) {
						if(!isset($filter_query)) $filter_query = "`".DataBase::mysql_prep($filter_key)."` = '".DataBase::mysql_prep($filter_value)."'";
						else $filter_query .= " AND `".DataBase::mysql_prep($filter_key)."` = '".DataBase::mysql_prep($filter_value)."'";
					}
				}
				$db = DataBase::getDB(); // Создаём объект базы данных
				$query = "SELECT ddg_id, ddg_mark,	ddg_mark_title,	ddg_model, ddg_model_title,	ddg_modification, ddg_modification_tittle, ddg_model_dvs, ddg_volume, ddg_capacity, ddg_year_from, ddg_year_to, ddg_price  FROM `dvigateli_dlya_gruzovyh` WHERE ".$filter_query." ORDER BY ddg_model, ddg_volume, ddg_year_from";
				$reply = $db->select($query);
				return $reply;
			}
			else return MESSAGE_NOT_MODEL;

			break;
			
			case 'kpp_dlya_legkovyh':
				if($filter){
					//Перебором подставляем все данные которые были выбраны
					foreach($filter as $filter_key=>$filter_value){
						if(!empty($filter_value)) {
							if(!isset($filter_query)) $filter_query = "`".DataBase::mysql_prep($filter_key)."` = '".DataBase::mysql_prep($filter_value)."'";
							else $filter_query .= " AND `".DataBase::mysql_prep($filter_key)."` = '".DataBase::mysql_prep($filter_value)."'";
						}
					}
					$db = DataBase::getDB(); // Создаём объект базы данных
					$query = "SELECT kdl_id, kdl_mark, kdl_mark_title, kdl_model, kdl_model_title, kdl_type_engine, kdl_transmission, kdl_volume_cars, kdl_year_from, kdl_year_to, kdl_name_engine, kdl_price FROM `kpp_dlya_legkovyh` WHERE ".$filter_query." ORDER BY kdl_model, kdl_volume_cars, kdl_year_from";
					$reply = $db->select($query);
					return $reply;
				}
				else return MESSAGE_NOT_MODEL;

			break;
			
			default:
				die(); 
			break;
		}
	}
	
	//Достаем все модели из БД
	public function get_data_filter_form($mark)
	{
		$db = DataBase::getDB(); // Создаём объект базы данных
		$query = "SELECT ddl_id, ddl_model, ddl_model_title, ddl_type_engine, ddl_transmission, ddl_volume_cars, ddl_year_from, ddl_year_to FROM `dvigateli_dlya_legkovyh` WHERE `ddl_mark` = '".DataBase::mysql_prep($mark)."'";
		$reply = $db->select($query);
		return $reply;
		
	}
	//Достаем все модели из БД
	public function get_data_table_all($mark, $number_view = 'all')
	{
		$db = DataBase::getDB(); // Создаём объект базы данных
		//Проверяем показывать все моделт или первые 20
		if($number_view === 'all'){
			$query = "SELECT ddl_id, ddl_mark, ddl_mark_title, ddl_model, ddl_model_title, ddl_type_engine, ddl_transmission, ddl_volume_cars, ddl_year_from, ddl_year_to, ddl_name_engine, ddl_price FROM `dvigateli_dlya_legkovyh` WHERE `ddl_mark` = '".DataBase::mysql_prep($mark)."'";
		}
		else{
			$query = "SELECT ddl_id, ddl_mark, ddl_mark_title, ddl_model, ddl_model_title, ddl_type_engine, ddl_transmission, ddl_volume_cars, ddl_year_from, ddl_year_to, ddl_name_engine, ddl_price FROM `dvigateli_dlya_legkovyh` WHERE `ddl_mark` = '".DataBase::mysql_prep($mark)."' GROUP BY ddl_model LIMIT ".DataBase::mysql_prep($number_view);
		}
		$reply = $db->select($query);
		return $reply;	
	}
}