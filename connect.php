<?php
	$servername ="localhost";
	$username = "root";
	$password = "";
	$database = "addressdb";

	$conn= new mysqli($servername,$username,$password);
	if($conn->connect_error)
    {
		die("Connection Failed: " .$conn->connect_error);
	}

	if($conn->select_db($database) == false)
    {
		$sql = "CREATE DATABASE $database";
		if($conn->query($sql)==true)
        {
			echo "Database Created";
		}
		else
        {
			echo "Database Error" .$conn->error;
		}
	}
	else
    {
		echo "Database Connected";
	}

	$conn= new mysqli($servername,$username,$password,$database);

	if($conn->query("CREATE TABLE address_book (
					No INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
					Nama VARCHAR(30) NOT NULL,
					Alamat VARCHAR(50) NOT NULL,
					Telfon VARCHAR(15) NOT NULL
					)") === true) {
		echo "Table Created<br>";
	}
	else
    {
		echo " <br>";
	}
	
	?>