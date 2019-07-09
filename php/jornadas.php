Recuerda siempre cambair jornada antes de hacer efectivas de la jornada .</br>
<?php
require_once("dataDB.php");
$query="select distinct jornada from alineaciones";
$conn=createConn();
$res=$conn->query($query);
foreach($res as $j){
	?>

	<a href="jornada2.php?jornada=<?=$j['jornada']?>"><?=$j['jornada']?></a>
	<?php
}

?>
<a href="cambiarJornada.php">Cambiar jornada</a>
