<?php
require_once ("dataDB.php");
$n = $_REQUEST['n'];
$equipo = $_REQUEST['nombre'];
$conn = createConn();
$query1="insert into equipos values('$equipo')";
$conn->query($query1);
$i;
for ($i = 0; $i < $n; $i++) {
	$x= $_REQUEST['nombreJug'][$i];
	$y= $_REQUEST['posJug'][$i];
	$z= $_REQUEST['valorJug'][$i];
	$query="insert into jugadores values(null,0,'$x','$y','$equipo',$z	)";
	$conn->query($query);	

}
header('Location:../appUsers/admin.php');	
?>