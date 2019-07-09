<?php

function createConn(){
	$server='localhost';
$database='comunio';
$user='luso97';
$password='00000';
	$conn = new mysqli($server, $user, $password, $database);
	return $conn;
}
?>