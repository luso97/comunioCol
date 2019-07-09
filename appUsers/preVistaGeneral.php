<?php
session_start();
if(!isset($_REQUEST['idEC']) || !isset($_REQUEST['idComunio'])){
	header('Location:index.php');
}
else{
	$x=$_REQUEST['idEC'];
	$y=$_REQUEST['idComunio'];
	$_SESSION['idEC']=$x;
	$_SESSION['idComunio']=$y;
	header('Location:vistaGeneral.php');
}

?>
