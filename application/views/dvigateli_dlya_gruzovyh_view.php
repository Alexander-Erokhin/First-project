<?php echo $data['data_bd_view'][0]['text']?>
<form id="filter" method="post" action="" name="ajaxfilter">
<div>
	<select name="filter_model">
		<option value="0">Модель</option>
		<?php foreach($data['data_filter_form']['model'] as $key_selet_model => $value_select_model)
		{
			$routes_url = URL::routes_url(3);
			if(!empty($routes_url) && $routes_url == $key_selet_model) echo '<option selected value="'.$key_selet_model.'">'.$value_select_model.'</option>';
			else echo '<option value="'.$key_selet_model.'">'.$value_select_model.'</option>';

		}?>
	</select>
</div>
<div>
	<select name="filter_volume">
		<option value="0">Объем (л)</option>
		<?php foreach($data['data_filter_form']['volume'] as $value_select_volume_cars)
		{
			echo '<option value="'.$value_select_volume_cars.'">'.$value_select_volume_cars.'</option>';

		}?>	
	</select>
</div>
<div>
	<select name="filter_capacity">
		<option value="0">Мощность (л.с.)</option>
		<?php foreach($data['data_filter_form']['capacity'] as $value_select_transmission)
		{
			echo '<option value="'.$value_select_transmission.'">'.$value_select_transmission.'</option>';

		}?>	
	</select>
</div>
<div>
	<select name="filter_year">
		<option value="0">Год выпуска</option>
		<?php foreach($data['data_filter_form']['date'] as $value_select_volume_cars)
		{
			echo '<option value="'.$value_select_volume_cars.'">'.$value_select_volume_cars.'</option>';

		}?>		
	</select>
</div>
</form>
<h2>Полный перечень двигателей по этой марке</h2>
<table id="perechen">		
	<tr>
		<th>Модель</th>
		<th>Модификация</th>
		<th>Объем (л)</th>
		<th>Мощность (л.с.)</th>
		<th>Год выпуска</th>
		<th>Цена от (руб.)</th>
		<th>Информация</th>
	</tr>
	<?php
	foreach($data['data_table_all'] as $value){
		if($data['data_filtr_form']['count_table_view'] > 0){
			echo '<tr id="'.$value['ddg_id'].'">';
			echo "<td>".$value['ddg_model_title']."</td>";
			echo "<td>".$value['ddg_modification_tittle']."</td>";
			echo "<td>".$value['ddg_volume']."</td>";
			echo "<td>".$value['ddg_capacity']."</td>";
			echo "<td>".$value['ddg_year_from']." - ".$value['ddg_year_to']."</td>";
			echo "<td>".$value['ddg_price']."</td>";
			echo '<td><span class="kras" onclick="bgPopup('.$value['ddg_id'].')">Запросить</span></td>';
			echo "</tr>";
			$data['data_filtr_form']['count_table_view']--;
		}
	}
	?>
</table>
<?php
if($data['data_filter_form']['count_query'] > $data['data_filtr_form']['count_view']){
	echo '<div id="pos_vse" class="sin">Посмотреть все</div>';
}
?>
			