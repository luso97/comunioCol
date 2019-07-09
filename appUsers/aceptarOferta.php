<?php 
session_start();
require_once("../php/dataDB.php");
$idJC=$_REQUEST['jugador'];
$idOFerta=$_REQUEST['idOferta'];
$conn=createConn();
$query="UPDATE ofertas SET aceptada=1 WHERE idOferta=$idOFerta";
$conn->query($query);
$query="update ofertas set aceptada=0 where idOferta!=$idOFerta and idJugCom=$idJC";
$conn->query($query);
header('Location:mercado.php');
?>
