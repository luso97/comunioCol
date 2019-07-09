<?php
session_start();
$idComunio=$_SESSION['idComunio'];
$idEC=$_SESSION['idEC'];
require_once ("../php/dataDB.php");
$idJC = $_REQUEST['id'];
$conn = createConn();
//posicion jugador
$query="select posicion from jugadores j left join jugcom jc on jc.idJugador=j.idJugador where jc.idJC=$idJC";
$res=$conn->query($query);
$posicion=mysqli_fetch_assoc($res);
$posicion=$posicion['posicion'];
//jornada
$query = "select jornada from comunios where idComunio=$idComunio";
$result = $conn -> query($query);
$jornada = mysqli_fetch_assoc($result);
$jornada = $jornada['jornada'];
//numero de jug con misma posicion jug
$query="select count(*) as sum from alineaciones a left join jugcom jc on a.idJugCom=jc.idJC left join jugadores j on j.idJugador=jc.idJugador where a.jornada=$jornada and a.idEquipo=$idEC and j.posicion='$posicion'";
$res=$conn->query($query);
if(!$res){
	die($conn->error);
}
$sumaPos=mysqli_fetch_assoc($res);
$sumaPos=$sumaPos['sum'];
//si el jugador esta alineado
$query="SELECT count(*) as sum from alineaciones where idJugCom=$idJC and jornada=$jornada";
$res=$conn->query($query);
if(!$res){
	die($conn->error);
}
$res=mysqli_fetch_assoc($res);
if($res['sum']==0){
	if($posicion=='DEL' and $sumaPos==1){
		$_SESSION['errormercado']="Ya tienes un delantero alineado";
		header('Location:mercado.php');
	}
	else if($posicion=='MED' and $sumaPos==2){
		$_SESSION['errormercado']="Ya tienes dos medios";
		header('Location:mercado.php');
	}
	else if($posicion=='DEF' and $sumaPos==1){
		$_SESSION['errormercado']="Ya tienes un defensa alineado";
		header('Location:mercado.php');
	}
	else if($posicion=='POR' and $sumaPos==1){
		$_SESSION['errormercado']="Ya tienes un portero alineado";
		header('Location:mercado.php');
	}
else{
	//conseguir dinero
	$query="select dinero from equipocom where idEC=$idEC";
	$res2=$conn->query($query);
	$res2=mysqli_fetch_assoc($res2);
	$res2=$res2['dinero'];
	//añadir la alineacion
	$query="insert into alineaciones values(null,$idJC,$jornada,$idEC,$res2)";
	$res=$conn->query($query);
	if(!$res){
	die($conn->error);
}
	}
}
else{
	echo "eh";
	$query="delete from alineaciones where idJugCom=$idJC and jornada=$jornada ";
	$res=$conn->query($query);
	if(!$res){
	die($conn->error);
}
}

header('Location:equipo.php');
?>