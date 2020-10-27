'use strict';

function onDrop(event){
	event.preventDefault();

	var f = event.dataTransfer.files;
	for(var i = 0; i < f.length; i++){
		var reader = new FileReader();
		var disp = document.getElementById("disp");
		var drop = document.getElementById("drop");
		drop.classList.toggle('process');
		disp.textContent ="データ処理中";

		reader.onload = function (e) {
			//データ読み込み
			var data_row = e.target.result;
			var xhr = new XMLHttpRequest();
			xhr.open('POST', 'log.php');
			xhr.setRequestHeader('Content-Type', 'application/octet-stream');
			xhr.send(data_row);

			//結果表示
			drop.classList.toggle('process');
			disp.textContent ="送信完了";
		}

		reader.fileName = f[i].name;
		reader.readAsArrayBuffer(f[i]);
	}
}

function onDragOver(event){ 
	event.preventDefault(); 
}

var hash = {};
var arDiv = ['drop', 'disp'];
arDiv.forEach((st) => {
	hash[st] = document.createElement('div');
	hash[st].id = st;
	hash[st].classList.add(st);
	document.body.appendChild(hash[st]);
})

hash['drop'].textContent = "ここにファイルをドロップ";
hash['drop'].addEventListener('dragover', onDragOver, false);
hash['drop'].addEventListener('drop', onDrop, false);

hash['drop'].addEventListener('click', function(){
		hash['drop'].classList.toggle('warning');
		hash['drop'].textContent = "ファイルをドロップしてください";
	}, false);

hash['disp'].textContent = "ドロップ待機中";

