<?php 
error_reporting(0);

	$hostname = "localhost";
	$user = "root";
	$password = "password";
	$database = "webtech";
	$port = 4306;


	$con = mysqli_connect($hostname,$user,$password,$database,$port);	

    /*
    if($con)
    {
        echo "connected";
    }
    else
    {
        echo "disconnected";
    }
    */
?>