<?php
	$hostName = "localhost";
	$username = "qqdgtzmy_ticket";
	$password = "123Nexer@1";
	$dbName = "qqdgtzmy_ticketing";

	$connect = mysqli_connect($hostName,$username,$password,$dbName);
	
	date_default_timezone_set('Asia/Jakarta');
	$query = mysqli_query($connect, "UPDATE `ticket` SET `status` = 'Expired' WHERE `status` = 'Tiket terkirim' OR `status` = 'Tiket diteruskan' OR `status` = 'dikonfirmasi' AND Now() > `expired`");
?>