<?php 
if($data['data_table_all']){//Если есть кабины то выводим
echo $data['data_bd_view'][0]['text'];
	echo "<h2>Полный перечень кабин по этой марке</h2>
			<table id=\"perechen\">		
				<tr>
					<th>Фото</th>
					<th>Модель</th>
					<th>Год выпуска</th>
					<th>Цена от (руб.)</th>
					<th>Информация</th>
				</tr>";
			
		foreach($data['data_table_all'] as $value){
			echo '<tr id="'.$value['kdg_id'].'">';
			
			if(!empty($value['kdg_images'])){//Проверяем есть ли фотографии в БД, если есть выводим их
				$image_all_array = explode(';', $value['kdg_images']);
				
				//Выводим фотографии
				if(file_exists("images/kabiny_dlya_gruzovyh/".$image_all_array[0])){
					echo "<td>";
					for($i=0;$i <count($image_all_array);$i++){
						if(file_exists("images/kabiny_dlya_gruzovyh/".$image_all_array[$i])){
							if($i === 0) echo '<img src="/images/kabiny_dlya_gruzovyh/'.$image_all_array[$i].'" alt="'.$value['kdg_mark_title'].$value['kdg_model_title'].'" onclick="fotoViewOn('.$value['kdg_id'].')">';
							else echo '<img style= "display:none" src="/images/kabiny_dlya_gruzovyh/'.$image_all_array[$i].'" alt="'.$value['kdg_mark_title'].$value['kdg_model_title'].'" onclick="fotoViewOn('.$value['kdg_id'].')">';
						}
					}
					echo "</td>";				
				}
				else{//Если нет фотографий в базе
					echo '<td><img src="/images/kabiny_dlya_gruzovyh/no_photo.png"></td>';
				}

			}else echo '<td><img src="/images/kabiny_dlya_gruzovyh/no_photo.png"></td>';
			echo "<td>".$value['kdg_model_title']."</td>";
			echo "<td>".$value['kdg_year']."</td>";
			echo "<td>".$value['kdg_price']."</td>";
			echo '<td><span class="kras" onclick="bgPopup('.$value['kdg_id'].')">Запросить</span></td>';
			echo "</tr>";
		}

	echo "</table>";
	if(count($data['data_filter_form']) > 20){
		echo '<div id="pos_vse" class="sin">Посмотреть все</div>';
	
	}
}
?>	