<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset=utf-8>
<title>動画再生、時間記録機能付き</title>
</head>
<body>
<video id="video" width="400" height="300" src="./video/sample.mp4" controls></video>

<script>
var media = document.getElementById("video");
media.currentTime = <?php 
	$fname = "./data.log";
	$fp = fopen($fname, "r");							// ファイルを開く
	$buf = fread($fp, filesize($fname));	// 開いたファイルからデータを読み出す
	fclose($fp);													// ファイルを閉じる
	echo $buf;
?>

var timesend = function(){
	var request = new XMLHttpRequest();
	request.open('GET', './log.php?time='+String(media.currentTime), true);
	request.send();
} 
setInterval(timesend, 1000);
</script>

</body> 
</html>