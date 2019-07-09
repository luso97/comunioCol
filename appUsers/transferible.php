<?php 
session_start();
require_once("../php/dataDB.php");
$idJC=$_REQUEST['id'];
$conn=createConn();
$query="SELECT jugcom.mercado as merc from jugcom where idjc=$idJC";
$res=$conn->query($query);
$stid=mysqli_fetch_assoc($res);
if($stid['merc']==0){
	$query="update jugcom set mercado=1 where idJC=$idJC";
}
else{
	$query="update jugcom set mercado=0 where idJC=$idJC";
	$query2="delete ofertas where idjugcom=$idJC";
	$conn->query($query);
}
$res=$conn->query($query);
header('Location:equipo.php');
?>