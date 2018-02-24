<!DOCTYPE html>
<html>
<head>
	<title>OOP in PHP</title>
	<meta charset="UTF-8">

	<?php require_once("class_lib.php"); ?>

</head>
<body>

<?php 
	$stefan=new person("Stefan Mischook");
	$jimmy=new person("Nick Waddles");
	$akash=new person("Pritom Saha Akash");

	echo "Stefan's full name : ". $stefan->getName()."<br> ";
	echo "Jimmy's full name :". $jimmy->getName()."<br> ";
	echo "akash's full name :". $akash->getName()."<br> ";
?>
</body>
</html>