<?php
	if(isset($_GET['time'])){
		$fp = fopen("data.log", "w");
		foreach($_GET['time'] as $key => $value){
			fputcsv($fp, array($key, $value));
		}
		fclose($fp);
	}
?>
