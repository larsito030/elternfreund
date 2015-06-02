<?php
//$db_conx = mysqli_connect('localhost','root','');
try {
$user = "root";
$pass = "";
$db = new PDO('mysql:host=localhost;dbname=elternfreund',$user, $pass);	

} catch (Exception $e) {
	echo $e->getMessage();
	die();
	
}

