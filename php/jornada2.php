<?php
require_once("dataDB.php");
$jornada=$_REQUEST['jornada'];
$conn=createConn();
$query="select a.idEquipo as idec,a.dinero as money ,a.idJugCom as jc,jc.idJugador as jugador from alineaciones a left join jugcom jc on a.idJugCom=jc.idJC where a.jornada=$jornada";
	$res=$conn->query($query);
	if(!$res){
		die($conn->error);
	}
	foreach($res as $c){
		$id=$c['jugador'];
			
		if($c['money']>0){
			//coger los puntos de dicho stats jugadores
			$query="select * from statsjugadores s left join partidos p on s.idPartido=p.idPartido  where s.idJugador=$id and p.jornada=$jornada ";
			$res=$conn->query($query);
			if(!$res){
		die($conn->error);
	}
			$res=mysqli_fetch_assoc($res);
			
			$z=$res['puntos'];
			
			
			$d=$c['idec'];
			$query="update equipocom set puntos=puntos+$z where idEC=$d";
			$conn->query($query);
		}
	}
?>