<?php
/**********************************************\
* Copyright (c) 2015 Manolis Agkopian          *
* See the file LICENCE for copying permission. *
\**********************************************/

$serialPort = '/dev/ttySx'; // or /dev/ttyUSBx sometimes and if you run Windows COMx

if ( !isset($_POST['cmd']) && empty($_POST['cmd']) ) {
	$status = 1; 
	$msg = 'No command has been specified.';
}
else if ( !in_array($_POST['cmd'], array('fw', 'bw', 'tl', 'tr', 'sp:1', 'sp:2', 'sp:3', 'sp:4', 'sp:5', 'sp:6', 'sp:7', 'sp:8', 'sp:9')) ) {
	$status = 2;
	$msg = 'Invalid command has been specified.';
}
else {
	// Important! Make sure apache has write access to the serial port, otherwise you will get an "Unable to open serial port." message caused by an access denied error.
	exec("stty -F $serialPort 9600 -parenb cs8 -cstopb -crtscts") // or for Windows: exec("mode $serialPort BAUD=9600 PARITY=N data=8 stop=1 xon=off");
	$fp = @fopen($serialPort, 'w');

	if ( !$fp ) {
		$status = 3;
		$msg = 'Unable to open serial port.';
	}
	else {
		switch ( $_POST['cmd'] ) {
			case 'fw':
				fwrite($fp, 'F');
				break;
			case 'bw':
				fwrite($fp, 'B');
				break;
			case 'tl':
				fwrite($fp, 'L');
				break;
			case 'tr':
				fwrite($fp, 'R');
				break;
			default:
				$sp = explode(':', $_POST['cmd']);
				fwrite($fp, end($sp));
				break;
		}

		fclose($fp);

		$status = 0;
		$msg = 'Success';
	}
}

header('Content-Type: application/json');
echo json_encode( array(
	'status' => $status,
	'msg' => $msg
));

