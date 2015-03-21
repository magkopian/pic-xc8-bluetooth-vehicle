/**********************************************\
* Copyright (c) 2015 Manolis Agkopian          *
* See the file LICENCE for copying permission. *
\**********************************************/

$(document).ready( function () {
	$('body').on('click', 'a', function() {
		var cmd = $(this).data('action'),
			cmd_msg = $(this).data('cmd');
		
		$.ajax({
			type: 'POST',
			url: 'controller.php',
			dataType: 'json',
			data: { 
				'cmd': cmd
			},
			success: function (data) {
				if ( data.status != 0 ) {
					alert(data.msg);
				}
				else {
					if ( $('#cmd').text() == '' ) {
						$('#cmd').text(cmd_msg);
					}
					else {
						$('#cmd').text($('#cmd').text() + "\n" + cmd_msg );
					}
					
					$('#cmd').scrollTop($('#cmd')[0].scrollHeight);
				}
			},
			error: function ( jqXHR, exception ) {
				if (jqXHR.status === 0) {
					console.log('Not connect.\n Verify Network.');
				}
				else if (jqXHR.status == 404) {
					console.log('Requested page not found. [404]');
				}
				else if (jqXHR.status == 500) {
					console.log('Internal Server Error [500].');
				}
				else if (exception === 'parsererror') {
					console.log('Requested JSON parse failed.');
				}
				else if (exception === 'timeout') {
					console.log('Time out error.');
				}
				else if (exception === 'abort') {
					console.log('Ajax request aborted.');
				}
				else {
					console.log('Uncaught Error.\n' + jqXHR.responseText);
				}
			}
		});
	});
});

