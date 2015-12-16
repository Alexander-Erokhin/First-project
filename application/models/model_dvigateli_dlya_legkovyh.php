<?php

class Model_Dvigateli_dlya_legkovyh extends Model
{
	//Достаем все модели из БД
	public function get_data_filter_form($mark)
	{
		$db = DataBase::getDB(); // Создаём объект базы данных	
		$query = "SELECT ddl_id, ddl_model, ddl_model_title, ddl_type_engine, ddl_transmission, ddl_volume_cars, ddl_year_from, ddl_year_to FROM `dvigateli_dlya_legkovyh` WHERE `ddl_mark` = '".DataBase::mysql_prep($mark)."'";
		$reply = $db->select($query);
		return $reply;
		
	}
	//Достаем все модели из БД
	public function get_data_table_all($mark, $model = 0)
	{
		$db = DataBase::getDB(); // Создаём объект базы данных
		//Если выбрана марка и модель то подгружаем и марку и модель иначе марку
		if($model) $query = "SELECT ddl_id, ddl_mark, ddl_mark_title, ddl_model, ddl_model_title, ddl_type_engine, ddl_transmission, ddl_volume_cars, ddl_year_from, ddl_year_to, ddl_name_engine, ddl_price FROM `dvigateli_dlya_legkovyh` WHERE `ddl_mark` = '".DataBase::mysql_prep($mark)."' AND `ddl_model` = '".DataBase::mysql_prep($model)."'";
		else $query = "SELECT ddl_id, ddl_mark, ddl_mark_title, ddl_model, ddl_model_title, ddl_type_engine, ddl_transmission, ddl_volume_cars, ddl_year_from, ddl_year_to, ddl_name_engine, ddl_price FROM `dvigateli_dlya_legkovyh` WHERE `ddl_mark` = '".DataBase::mysql_prep($mark)."' GROUP BY ddl_model";
		$reply = $db->select($query);
		return $reply;
	}
}