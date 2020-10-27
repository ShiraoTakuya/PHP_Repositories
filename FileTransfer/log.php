<?php
	$fp = fopen("data.log", "wb");									// ファイルを開く
	fwrite($fp, file_get_contents('php://input'));	// 開いたファイルからデータを読み出す
	fclose($fp);																		// ファイルを閉じる
?>
