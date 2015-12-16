<?php

class Model_Kabiny_dlya_gruzovyh extends Model
{
	//Достаем все модели из БД
	public function get_data_filter_form($mark)
	{
		$db = DataBase::getDB(); // Создаём объект базы данных
		$query = "SELECT kdg_id, kdg_mark, kdg_mark_title, kdg_model, kdg_model_title, kdg_year, kdg_price, kdg_images, kdg_show FROM `kabiny_dlya_gruzovyh` WHERE `kdg_mark` = '".DataBase::mysql_prep($mark)."'";
		$reply = $db->select($query);
		return $reply;
		
	}
	//Достаем все модели из БД
	public function get_data_table_all($mark, $number_view = 'all')
	{
		$db = DataBase::getDB(); // Создаём объект базы данных
		//Проверяем показывать все модели или первые 20
		if($number_view === 'all'){
			$query = "SELECT kdg_id, kdg_mark, kdg_mark_title, kdg_model, kdg_model_title, kdg_year, kdg_price, kdg_images, kdg_show FROM `kabiny_dlya_gruzovyh` WHERE `kdg_mark` = '".DataBase::mysql_prep($mark)."'";
		}
		else{
			$query = "SELECT kdg_id, kdg_mark, kdg_mark_title, kdg_model, kdg_model_title, kdg_year, kdg_price, kdg_images, kdg_show FROM `kabiny_dlya_gruzovyh` WHERE `kdg_mark` = '".DataBase::mysql_prep($mark)."' GROUP BY kdg_model LIMIT ".DataBase::mysql_prep($number_view);
		}
		$reply = $db->select($query);
		return $reply;	
	}
}