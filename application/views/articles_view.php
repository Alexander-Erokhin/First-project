<?php
echo "<h1>Статьи</h1>";
foreach($data['data_bd_view'] as $value_data_bd_view){
	echo '<h2>'.$value_data_bd_view['ap_title'].'</h2>';
	echo "<p>".$value_data_bd_view['ap_content']."</p>";
	echo "<br>";
}
