<?php

class Model_articles extends Model
{
	//Достаем все статьи из БД
	public function get_data()
	{
		$db = DataBase::getDB(); // Создаём объект базы данных
		$query = "SELECT ap_id, ap_url, ap_time, ap_title, ap_anons, ap_content FROM articles_pages WHERE `ap_enable` = '1'";
		$reply = $db->select($query);
		return $reply;
	}
}