<?php
	$bindata = file_get_contents('php://input');
	$fname = "data.log";
	$fp = fopen($fname, "wb");           // ファイルを開く
	fwrite($fp, $bindata);     // 開いたファイルからデータを読み出す
	fclose($fp);                            // ファイルを閉じる
	//echo "「".$comment."」と書き込みました";
?>