<?php
session_start();
require_once("../php/dataDB.php");
$idComunio=$_SESSION['idComunio'];
$idEC=$_SESSION['idEC'];
echo $idEC;
//precio mayor q valor?

//conseguir el dinero de ec
$conn2=createConn();
$query="select dinero as money from equipocom where idec=$idEC";
$res=$conn2->query($query);
$money=mysqli_fetch_assoc($res);
$money=$money['money'];
echo $money;
$oferta =$_REQUEST['oferta'];
$idjc=$_REQUEST['jugador'];
$valor=$_REQUEST['valor'];
if($oferta<$valor){
	$_SESSION['errormercado']="La oferta debe ser mínimo del valor del jugador";
	header('Location:mercado.php');
}else{

$conn=createConn();
$query="SELECT * from ofertas   where ofertante=$idEC and idJugcom=$idjc";
$res =$conn->query($query);
$query="select count(*) as rows from ofertas where ofertante=$idEC";
$count=$conn->query($query);

$stid1=mysqli_fetch_assoc($count);
$mm=0;
if($stid1['rows']>0){

$query="SELECT SUM(oferta) as x from ofertas where ofertante=$idEC";
$result=$conn->query($query);
$stid=mysqli_fetch_assoc($result);
$mm=$stid['x'];
echo $mm;
}

echo $money;
if(mysqli_num_rows($res)==1){
	
	
	$x=mysqli_fetch_assoc($res);
	$y=$x['idOferta'];
	$z=$x['oferta'];
	if($money-$mm-$oferta+$z<0){
		
	$_SESSION['errormercado']="No tienes dinero para ofrecer dicha cantidad";
		header('Location:mercado.php');
}
else{
	
	$query="update ofertas set oferta=$oferta where idOferta=$y";	
	$conn->query($query);
}
	
}
else{if($money-$mm-$oferta<0){
	$_SESSION['errormercado']="No tienes dinero para ofrecer dicha cantidad";
	header('Location:mercado.php');
}
else{
	$query="insert into ofertas values($idjc,$oferta,$idEC,null,null,0)";
	
	$conn->query($query);
}
}
header('Location:mercado.php');
}

?>