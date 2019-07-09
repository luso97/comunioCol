<?php
require_once("dataDB.php");
//conseguir jornada actual
$query="SELECT jornada from comunios";
$conn=createConn();
$res=$conn->query($query);
$res=mysqli_fetch_assoc($res);
$jornada=$res['jornada'];
//actualizar el dinero de cada alineacion
$query="select e.dinero as din,a.idAlineacion as id from alineaciones a left join equipocom e on a.idEquipo=e.idEC where a.jornada=$jornada";
$res=$conn->query($query);
foreach($res as $r){
	$money=$r['din'];
	$id=$r['id'];
	$query="update alineaciones set dinero=$money where idAlineacion=$id";
	$conn->query($query);
}
//cambiar jornada
$query="update comunios set jornada=jornada+1";
$conn=createConn();
$conn->query($query);
header('Location:../appUsers/admin.php');
?>