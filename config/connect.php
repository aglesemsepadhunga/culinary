<?php
	//connect to database
	$conn = mysqli_connect('fdb25.atspace.me','3341351_tcas','andy@1234','3341351_tcas');

	//check connection
	if(!$conn)
		echo 'Connection error: '. mysqli_connect_error();
 ?>
