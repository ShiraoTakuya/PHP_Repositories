<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset=utf-8>
<title>動画再生、時間記録機能付き</title>
</head>
<body>
<?php
	$files = glob('./video/*');
	foreach($files as $file){
		echo '<video id="'.$file.'" width="400" height="300" src="'.$file.'" controls></video>'."\r\n";
	}
?>

<script>
	<?php
		foreach($files as $file){
			echo 'var media = document.getElementById("'.$file.'");'."\r\n";
			echo 'media.currentTime = ';
			$fname = "./data.log";
			$fp = fopen($fname, "r");							// ファイルを開く
			$buf = fread($fp, filesize($fname));	// 開いたファイルからデータを読み出す
			fclose($fp);													// ファイルを閉じる
			echo $buf;
		}
	?>

	var timesend = function(){
		var xhr = new XMLHttpRequest();
		xhr.open('POST', 'log.php');
		xhr.setRequestHeader('Content-Type', 'application/octet-stream');
		xhr.send("<?php echo implode(",", $files) ?>");
	} 
	setInterval(timesend, 1000);
</script>

</body>
</html>