<?php
	if(isset($_GET['time'])){
		$fp = fopen("data.log", "w");				// ファイルを開く
		fwrite($fp, $_GET['time']."\r\n");	// 開いたファイルからデータを読み出す
		fclose($fp);												// ファイルを閉じる
	}
?>
