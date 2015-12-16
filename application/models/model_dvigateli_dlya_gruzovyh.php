<?php

class Model_Dvigateli_dlya_gruzovyh extends Model
{
	//Достаем все модели из БД
	public function get_data_filter_form($mark)
	{
		$db = DataBase::getDB(); // Создаём объект базы данных	
		$query = "SELECT ddg_id, ddg_model, ddg_model_title, ddg_volume, ddg_capacity, ddg_year_from, ddg_year_to FROM `dvigateli_dlya_gruzovyh` WHERE `ddg_mark` = '".DataBase::mysql_prep($mark)."'";
		$reply = $db->select($query);
		return $reply;
		
	}
	//Достаем все модели из БД
	public function get_data_table_all($mark, $model = 0)
	{
		$db = DataBase::getDB(); // Создаём объект базы данных
		//Если выбрана марка и модель то подгружаем и марку и модель иначе марку
		if($model) $query = "SELECT ddg_id, ddg_mark, ddg_mark_title, ddg_model, ddg_model_title, ddg_modification_tittle, ddg_volume, ddg_capacity, ddg_year_from, ddg_year_to, ddg_price FROM `dvigateli_dlya_gruzovyh` WHERE `ddg_mark` = '".DataBase::mysql_prep($mark)."' AND `ddg_model` = '".DataBase::mysql_prep($model)."'";
		else $query = "SELECT ddg_id, ddg_mark, ddg_mark_title, ddg_model, ddg_model_title, ddg_modification_tittle, ddg_volume, ddg_capacity, ddg_year_from, ddg_year_to, ddg_price FROM `dvigateli_dlya_gruzovyh` WHERE `ddg_mark` = '".DataBase::mysql_prep($mark)."' GROUP BY ddg_model";
		$reply = $db->select($query);
		return $reply;
	}
}