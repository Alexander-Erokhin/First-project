<?php

class Model_Kpp_dlya_legkovyh extends Model
{
	//Достаем все модели из БД
	public function get_data_filter_form($mark)
	{
		$db = DataBase::getDB(); // Создаём объект базы данных	
		$query = "SELECT kdl_id, kdl_model, kdl_model_title, kdl_type_engine, kdl_transmission, kdl_volume_cars, kdl_year_from, kdl_year_to FROM `kpp_dlya_legkovyh` WHERE `kdl_mark` = '".DataBase::mysql_prep($mark)."'";
		$reply = $db->select($query);
		return $reply;
		
	}
	//Достаем все модели из БД
	public function get_data_table_all($mark, $model = 0)
	{
		$db = DataBase::getDB(); // Создаём объект базы данных
		//Если выбрана марка и модель то подгружаем и марку и модель иначе марку
		if($model) $query = "SELECT kdl_id, kdl_mark, kdl_mark_title, kdl_model, kdl_model_title, kdl_type_engine, kdl_transmission, kdl_volume_cars, kdl_year_from, kdl_year_to, kdl_name_engine, kdl_price FROM `kpp_dlya_legkovyh` WHERE `kdl_mark` = '".DataBase::mysql_prep($mark)."' AND `kdl_model` = '".DataBase::mysql_prep($model)."'";
		else $query = "SELECT kdl_id, kdl_mark, kdl_mark_title, kdl_model, kdl_model_title, kdl_type_engine, kdl_transmission, kdl_volume_cars, kdl_year_from, kdl_year_to, kdl_name_engine, kdl_price FROM `kpp_dlya_legkovyh` WHERE `kdl_mark` = '".DataBase::mysql_prep($mark)."' GROUP BY kdl_model";
		$reply = $db->select($query);
		return $reply;
	}
}