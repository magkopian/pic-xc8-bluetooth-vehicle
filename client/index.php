<?php
/**********************************************\
* Copyright (c) 2015 Manolis Agkopian          *
* See the file LICENCE for copying permission. *
\**********************************************/
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Bluetooth Vehicle Control</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0;">
		<link href="controller.css" rel="stylesheet" type="text/css">
		<script type="text/javascript" src="http://code.jquery.com/jquery-2.1.3.min.js"></script>
		<script type="text/javascript" src="controller.js"></script>
	</head>
	<body>
		<textarea id="cmd" readonly="readonly"></textarea>
		
		<a href="#" data-action="tl" data-cmd="Turning Left" title="Click to turn reft">Turn Left</a>
		<a href="#" data-action="fw" data-cmd="Moving Forward" title="Click to move forward">Move Forward</a>
		<a href="#" data-action="bw" data-cmd="Moving Backwards" title="Click to move backwards">Move Backwards</a>
		<a href="#" data-action="tr" data-cmd="Turning Right" title="Click to turn right">Turn Right</a><br>
		
		<a href="#" data-action="sp:1" data-cmd="Setting Speed to 1" title="Click to set speed to 1">Speed 1</a>
		<a href="#" data-action="sp:2" data-cmd="Setting Speed to 2" title="Click to set speed to 2">Speed 2</a>
		<a href="#" data-action="sp:3" data-cmd="Setting Speed to 3" title="Click to set speed to 3">Speed 3</a>
		<a href="#" data-action="sp:4" data-cmd="Setting Speed to 4" title="Click to set speed to 4">Speed 4</a>
		<a href="#" data-action="sp:5" data-cmd="Setting Speed to 5" title="Click to set speed to 5">Speed 5</a>
		<a href="#" data-action="sp:6" data-cmd="Setting Speed to 6" title="Click to set speed to 6">Speed 6</a>
		<a href="#" data-action="sp:7" data-cmd="Setting Speed to 7" title="Click to set speed to 7">Speed 7</a>
		<a href="#" data-action="sp:8" data-cmd="Setting Speed to 8" title="Click to set speed to 8">Speed 8</a>
		<a href="#" data-action="sp:9" data-cmd="Setting Speed to 9" title="Click to set speed to 9">Speed 9</a>
	</body>
</html>
