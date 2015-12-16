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
	<select name="filter_type_engine">
		<option value="0">Тип КПП</option>
		<?php foreach($data['data_filter_form']['type_engine'] as $value_select_type_engine)
		{
			echo '<option value="'.$value_select_type_engine.'">'.$value_select_type_engine.'</option>';

		}?>	
	</select>
</div>
<div>
	<select name="filter_transmission">
		<option value="0">Тип коробки</option>
		<?php foreach($data['data_filter_form']['transmission'] as $value_select_transmission)
		{
			echo '<option value="'.$value_select_transmission.'">'.$value_select_transmission.'</option>';

		}?>	
	</select>
</div>
<div>
	<select name="filter_volume_cars">
		<option value="0">Объем (л)</option>
		<?php foreach($data['data_filter_form']['volume_cars'] as $value_select_volume_cars)
		{
			echo '<option value="'.$value_select_volume_cars.'">'.$value_select_volume_cars.'</option>';

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
		<th>Тип двигателя</th>
		<th>Тип коробки</th>
		<th>Объем (л)</th>
		<th>Год выпуска</th>
		<th>Модификация</th>
		<th>Цена от (руб.)</th>
		<th>Информация</th>
	</tr>
	<?php
	foreach($data['data_table_all'] as $value){
		if($data['data_filtr_form']['count_table_view'] > 0){
			echo '<tr id="'.$value['kdl_id'].'">';
			echo "<td>".$value['kdl_model_title']."</td>";
			echo "<td>".$value['kdl_type_engine']."</td>";
			echo "<td>".$value['kdl_transmission']."</td>";
			echo "<td>".$value['kdl_volume_cars']."</td>";
			echo "<td>".$value['kdl_year_from']." - ".$value['kdl_year_to']."</td>";
			echo "<td>".$value['kdl_name_engine']."</td>";
			echo "<td>".$value['kdl_price']."</td>";
			echo '<td><span class="kras" onclick="bgPopup('.$value['kdl_id'].')">Запросить</span></td>';
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
			