<?php
session_start();
require_once ("../php/dataDB.php");
$id=$_SESSION['iduser'];
$name=$_REQUEST['name'];
$pass=$_REQUEST['pass'];
$conn=createConn();
$query="insert into comunios values(null,$id,0,'$pass','$name',1)";
$res=$conn->query($query);
if (!$res) die($conn->error);
$query="SELECT LAST_INSERT_ID() as id";
	$res=$conn->query($query);
	$stid=mysqli_fetch_assoc($res);
	$id2=$stid['id'];
	$query="SELECT * FROM jugadores";
	$jugcoms=$conn->query($query);
	foreach($jugcoms as $jug){
		$r=$jug['idJugador'];
		$i=rand(1,3);
		$query="insert into jugcom values($r,null,null,0,$i,$id2)";
		$conn->query($query);
	}
	header('Location:index.php')
?>