function redirect()
{
document.location.replace('index.php?img=1#canvas');
document.location.reload();

}
window.addEventListener("DOMContentLoaded", function() {
	// Grab elements, create settings, etc.
				video = document.getElementById("video"),
				videoObj = { "video": true },
				errBack = function(error) {
					console.log("Video capture error: ", error.code); 
				};

	// Put video listeners into place
	if(navigator.getUserMedia) { // Standard
		navigator.getUserMedia(videoObj, function(stream) {
			video.src = stream;
			video.play();
		}, errBack);
	} else if(navigator.webkitGetUserMedia) { // WebKit-prefixed
		navigator.webkitGetUserMedia(videoObj, function(stream){
			video.src = window.URL.createObjectURL(stream);
		//	video.play();
		}, errBack);
	} else if(navigator.mozGetUserMedia) { // WebKit-prefixed
		navigator.mozGetUserMedia(videoObj, function(stream){
			video.src = window.URL.createObjectURL(stream);
			video.play();
		}, errBack);
	}

	
//	 Trigger photo take
	document.getElementById("snap").addEventListener("click", function() {
		var div = document.getElementById('canvas');
		div.scrollTop = div.scrollHeight - div.clientHeight;
		var canvas = document.getElementById("canvas1");
		var context = canvas.getContext("2d");
		var video = document.getElementById("video");
		context.drawImage(video, 0, 0, 640, 480);
		var	canvas = document.getElementById("canvas1");
		var canvasData = canvas.toDataURL("image/png");
		var ajax = new XMLHttpRequest();
		ajax.open("POST",'index.php',false);
		ajax.setRequestHeader('Content-Type', 'application/upload');
		ajax.send(canvasData);
		redirect();
	});


}, false);
