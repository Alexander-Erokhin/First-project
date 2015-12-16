<?php
if(!empty($data['filter_page']) && !empty($data['data_table'])){
	switch($data['filter_page']){
		case "dvigateli_dlya_legkovyh";
			$data_table = '
			<table id="perechen">		
				<tr>
					<th>Модель</th>
					<th>Тип двигателя</th>
					<th>Тип коробки</th>
					<th>Объем (л)</th>
					<th>Год выпуска</th>
					<th>Модификация</th>
					<th>Цена от (руб.)</th>
					<th>Информация</th>
				</tr>';
				//Выводим весь запрос
				foreach($data['data_table'] as $value){
					$data_table .= '<tr id="'.$value['ddl_id'].'">
					<td>'.$value['ddl_model_title'].'</td>
					<td>'.$value['ddl_type_engine'].'</td>
					<td>'.$value['ddl_transmission'].'</td>
					<td>'.$value['ddl_volume_cars'].'</td>
					<td>'.$value['ddl_year_from'].' - '.$value['ddl_year_to'].'</td>
					<td>'.$value['ddl_name_engine'].'</td>
					<td>'.$value['ddl_price'].'</td>
					<td><span class="kras" onclick="bgPopup('.$value['ddl_id'].')">Запросить</span></td>
					</tr>';
				}

			$data_table .= '</table>';
		break;

		case "dvigateli_dlya_gruzovyh";
			$data_table = '
			<table id="perechen">		
				<tr>
					<th>Модель</th>
					<th>Модификация</th>
					<th>Объем (л)</th>
					<th>Мощность (л.с.)</th>
					<th>Год выпуска</th>
					<th>Цена от (руб.)</th>
					<th>Информация</th>
				</tr>';
				//Выводим весь запрос
				foreach($data['data_table'] as $value){
					$data_table .= '<tr id="'.$value['ddg_id'].'">
					<td>'.$value['ddg_model_title'].'</td>
					<td>'.$value['ddg_modification_tittle'].'</td>
					<td>'.$value['ddg_volume'].'</td>
					<td>'.$value['ddg_capacity'].'</td>
					<td>'.$value['ddg_year_from'].' - '.$value['ddg_year_to'].'</td>
					<td>'.$value['ddg_price'].'</td>					
					<td><span class="kras" onclick="bgPopup('.$value['ddg_id'].')">Запросить</span></td>
					</tr>';
				}

			$data_table .= '</table>';
		break;
		
		case "kpp_dlya_legkovyh":
			$data_table = '
			<table id="perechen">		
				<tr>
					<th>Модель</th>
					<th>Тип двигателя</th>
					<th>Тип коробки</th>
					<th>Объем (л)</th>
					<th>Год выпуска</th>
					<th>Модификация</th>
					<th>Цена от (руб.)</th>
					<th>Информация</th>
				</tr>';
				//Выводим весь запрос
				foreach($data['data_table'] as $value){
					$data_table .= '<tr id="'.$value['kdl_id'].'">
					<td>'.$value['kdl_model_title'].'</td>
					<td>'.$value['kdl_type_engine'].'</td>
					<td>'.$value['kdl_transmission'].'</td>
					<td>'.$value['kdl_volume_cars'].'</td>
					<td>'.$value['kdl_year_from'].' - '.$value['kdl_year_to'].'</td>
					<td>'.$value['kdl_name_engine'].'</td>
					<td>'.$value['kdl_price'].'</td>
					<td><span class="kras" onclick="bgPopup('.$value['kdl_id'].')">Запросить</span></td>
					</tr>';
				}

			$data_table .= '</table>';		
		break;
	}
	//Отдаем Json данные таблицы
	$answer = array('status' => 200, 'data_table' => $data_table);echo json_encode($answer);
}
else{
	$data_table = '<table id="perechen"><tr><td>'.MESSAGE_NOT_MODEL.'</td></tr><table>';
	//Отдаем Json данные таблицы
	$answer = array('status' => 200, 'data_table' => $data_table);echo json_encode($answer);	
}
?>