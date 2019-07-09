<?php
require_once ("dataDB.php");
$gol1=$_REQUEST['goles1'];
$asis1=$_REQUEST['asist1'];
$punt1=$_REQUEST['punt1'];
$id1=$_REQUEST['id1'];
$n1=$_REQUEST['n1'];
$partido=$_REQUEST['partido'];
$conn=createConn();

$i;
for($i=0; $i<$n1 ; $i++){
	$x=$gol1[$i];
	$y=$asis1[$i];
	$z=$punt1[$i];
	$a=$id1[$i];
	
	$query="insert into statsjugadores values(null,$a,$partido,$x,$y,$z)";
	$conn->query($query);
	/*$query="SELECT eq.idEC as idec,eq.dinero as money from equipocom eq, jugcom jc where jc.idJugador=$a and jc.idEquipo=eq.idEC";
	$res=$conn->query($query);
	foreach($res as $c){
		if($c['money']>0){
			$d=$c['idec'];
			$query="update equipocom set puntos=puntos+$z where idEC=$d";
			$conn->query($query);
		}
	}*/
}
$gol2=$_REQUEST['goles2'];
$asis2=$_REQUEST['asist2'];
$punt2=$_REQUEST['punt2'];
$id2=$_REQUEST['id2'];
$n2=$_REQUEST['n2'];
for($i=0; $i<$n2 ; $i++){
	$x=$gol2[$i];
	$y=$asis2[$i];
	$z=$punt2[$i];
	$a=$id2[$i];
	
	$query="insert into statsjugadores values(null,$a,$partido,$x,$y,$z)";
	$conn->query($query);
	/*$query="SELECT eq.idEC as idec,eq.dinero as money from equipocom eq, jugcom jc where jc.idJugador=$a and jc.idEquipo=eq.idEC";
	$res=$conn->query($query);
	foreach($res as $c){
		if($c['money']>0){
			$d=$c['idec'];
			$query="update equipocom set puntos=puntos+$z where idEC=$d";
			$conn->query($query);
		}
	}*/
}
header('Location:../appUsers/admin.php');
?>
