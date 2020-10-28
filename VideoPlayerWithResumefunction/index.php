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
	var media = [];
	<?php
		foreach($files as $index => $file){
			echo 'media['.strval($index).'] = document.getElementById("'.$file.'");'."\r\n";
			echo 'media['.strval($index).'].currentTime = ';
			$data = file("./data.log");
			$result = array();
			foreach($data as $row){
				$params = explode(",", $row);
				$result[$params[0]] = $params[1];
			}
			if (empty($result[$file])) {
				echo "0\r\n";
			}else{
				echo $result[$file]."\r\n";
			}
		}
	?>

	var timesend = function(){
		var ar = [];
		for (var i = 0; i < media.length; i++){
			ar[i] = media[i].currentTime;
		}
		var xhr = new XMLHttpRequest();
		xhr.open('POST', './log.php');
		xhr.setRequestHeader('Content-Type', 'application/octet-stream');
		var arFiles = "<?php echo implode(",", $files) ?>".split(',')

		var stData = ""
		for(var i = 0; i < arFiles.length; i++){
			stData += arFiles[i]+","+ar[i] + "\r\n"
		}
		xhr.send(stData);
	} 
	setInterval(timesend, 1000);
</script>

</body>
</html>
