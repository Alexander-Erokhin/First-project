<?php
//Если пусто выдает база, то выводим сообщение
if(!empty($data['filter_page']) && !empty($data['data_table']) && !empty($data_selection)){
	switch($data['filter_page']){
		case "dvigateli_dlya_legkovyh":
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

			//Фильтр Тип двигателя
			$data_selection['filter_type_engine'] = '<select name="filter_type_engine"><option value="0">Тип двигателя</option>';
			foreach($data['data_filter_form']['type_engine'] as $value_select_type_engine)
				{
					$data_selection['filter_type_engine'] .= '<option value="'.$value_select_type_engine.'">'.$value_select_type_engine.'</option>';

				}
			$data_selection['filter_type_engine'] .= '</select>';

			//Фильтр Тип коробки
			$data_selection['filter_transmission'] = '<select name="filter_transmission"><option value="0">Тип коробки</option>';
			foreach($data['data_filter_form']['transmission'] as $value_select_type_engine)
				{
					$data_selection['filter_transmission'] .= '<option value="'.$value_select_type_engine.'">'.$value_select_type_engine.'</option>';

				}
			$data_selection['filter_transmission'] .= '</select>';

			//Фильтр Объем
			$data_selection['filter_volume_cars'] = '<select name="filter_volume_cars"><option value="0">Объем (л)</option>';
			foreach($data['data_filter_form']['volume_cars'] as $value_select_type_engine)
				{
					$data_selection['filter_volume_cars'] .= '<option value="'.$value_select_type_engine.'">'.$value_select_type_engine.'</option>';

				}
			$data_selection['filter_volume_cars'] .= '</select>';

			//Фильтр Год выпуска
			$data_selection['filter_year'] = '<select name="filter_year"><option value="0">Год выпуска</option>';
			foreach($data['data_filter_form']['date'] as $value_select_type_engine)
				{
					$data_selection['filter_year'] .= '<option value="'.$value_select_type_engine.'">'.$value_select_type_engine.'</option>';

				}
			$data_selection['filter_year'] .= '</select>';
			
			//Отдаем Json данные таблицы
			$answer = array('status' => 200, 'form_select' => $data_selection, 'data_table' => $data_table);echo json_encode($answer);
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

			//Фильтр Тип двигателя
			$data_selection['filter_type_engine'] = '<select name="filter_type_engine"><option value="0">Тип двигателя</option>';
			foreach($data['data_filter_form']['type_engine'] as $value_select_type_engine)
				{
					$data_selection['filter_type_engine'] .= '<option value="'.$value_select_type_engine.'">'.$value_select_type_engine.'</option>';

				}
			$data_selection['filter_type_engine'] .= '</select>';

			//Фильтр Тип коробки
			$data_selection['filter_transmission'] = '<select name="filter_transmission"><option value="0">Тип коробки</option>';
			foreach($data['data_filter_form']['transmission'] as $value_select_type_engine)
				{
					$data_selection['filter_transmission'] .= '<option value="'.$value_select_type_engine.'">'.$value_select_type_engine.'</option>';

				}
			$data_selection['filter_transmission'] .= '</select>';

			//Фильтр Объем
			$data_selection['filter_volume_cars'] = '<select name="filter_volume_cars"><option value="0">Объем (л)</option>';
			foreach($data['data_filter_form']['volume_cars'] as $value_select_type_engine)
				{
					$data_selection['filter_volume_cars'] .= '<option value="'.$value_select_type_engine.'">'.$value_select_type_engine.'</option>';

				}
			$data_selection['filter_volume_cars'] .= '</select>';

			//Фильтр Год выпуска
			$data_selection['filter_year'] = '<select name="filter_year"><option value="0">Год выпуска</option>';
			foreach($data['data_filter_form']['date'] as $value_select_type_engine)
				{
					$data_selection['filter_year'] .= '<option value="'.$value_select_type_engine.'">'.$value_select_type_engine.'</option>';

				}
			$data_selection['filter_year'] .= '</select>';
			
			//Отдаем Json данные таблицы
			$answer = array('status' => 200, 'form_select' => $data_selection, 'data_table' => $data_table);echo json_encode($answer);
		break;

		case "dvigateli_dlya_gruzovyh":
			$data_table = '
			<table id="perechen">		
			<tr>
				<th>Модель</th>
				<th>Модификация</th>
				<th>Объем (л)</th>
				<th>Мощность(л.с.)</th>
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
			
			//Фильтр Объем
			$data_selection['filter_volume'] = '<select name="filter_volume"><option value="0">Объем (л)</option>';
			foreach($data['data_filter_form']['volume'] as $value_select_volume)
				{
					$data_selection['filter_volume'] .= '<option value="'.$value_select_volume.'">'.$value_select_volume.'</option>';

				}
			$data_selection['filter_volume'] .= '</select>';
			
			//Фильтр Мощность
			$data_selection['filter_capacity'] = '<select name="filter_capacity"><option value="0">Мощность(л.с.)</option>';
			foreach($data['data_filter_form']['capacity'] as $value_select_capacity)
				{
					$data_selection['filter_capacity'] .= '<option value="'.$value_select_capacity.'">'.$value_select_capacity.'</option>';

				}
			$data_selection['filter_capacity'] .= '</select>';
			
			//Фильтр Год выпуска
			$data_selection['filter_year'] = '<select name="filter_year"><option value="0">Год выпуска</option>';
			foreach($data['data_filter_form']['date'] as $value_select_type_engine)
				{
					$data_selection['filter_year'] .= '<option value="'.$value_select_type_engine.'">'.$value_select_type_engine.'</option>';

				}
			$data_selection['filter_year'] .= '</select>';
		
			//Отдаем Json данные таблицы
			$answer = array('status' => 200, 'form_select' => $data_selection, 'data_table' => $data_table);echo json_encode($answer);
		break;		
		
		default:
		break;
		
	}
}
else{
	$data_table = '<table id="perechen"><tr><td>'.MESSAGE_NOT_MODEL.'</td></tr><table>';
	//Отдаем Json данные таблицы
	$answer = array('status' => 200, 'data_table' => $data_table);echo json_encode($answer);
}
?>