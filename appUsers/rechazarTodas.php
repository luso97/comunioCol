<?php 
session_start();
require_once("../php/dataDB.php");
$idJC=$_REQUEST['jugador'];
$idOFerta=$_REQUEST['idOferta'];
$conn=createConn();

$query="update ofertas set aceptada=0 where idJugCom=$idJC";
$conn->query($query);
header('Location:mercado.php');
?>
