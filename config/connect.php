<?php 
	//connect to database
	$conn = mysqli_connect('localhost','andy','1234','tcas');

	//check connection
	if(!$conn)
		echo 'Connection error: '. mysqli_connect_error();
 ?>