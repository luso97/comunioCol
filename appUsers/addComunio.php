<?php
session_start();
require_once("../php/dataDB.php");
$pass=$_REQUEST['passComunio'];
$nombre=$_REQUEST['nombreEquipo'];
$conn=createConn();
$query="select * from comunios where pass='$pass'";
$res=$conn->query($query);
if (!$res) die($conn->error);
$idUser=$_SESSION['iduser'];
if(mysqli_num_rows($res)==1){
	$fila=mysqli_fetch_assoc($res);
	$x=$fila['idComunio'];
	$query="insert into equipocom values(null,$x,$idUser,'$nombre',0,30000)";
	$res=$conn->query($query);
	if (!$res) die($conn->error);
	header('Location:index.php');
}
else{
	header('Location:index.php?message=yes');
}



?>