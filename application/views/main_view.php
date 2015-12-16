<?php
	if(isset($data['data_bd_view'][0]['text'])) {
		echo $data['data_bd_view'][0]['text'];
	}
	else Route::ErrorPage404();
?>