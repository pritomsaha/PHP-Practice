<?php
	
$servername="localhost";
$username="pritom";
$password="saq123";
$database="myDB";

$conn = new mysqli($servername,$username,$password);

if ($conn->connect_error) {
 	die("connection failed : " .$conn->connect_error);
} 

$conn->close();

?>