<?php
//seleccionas cada comunio
require_once ("dataDB.php");
$conn = createConn();
$query = "select * from comunios";
$comunios = $conn -> query($query);
foreach($comunios as $com){
	$cid=$com['idComunio'];
	
	$query="SELECT * from jugcom where idequipo is null and idComunio=$cid order by numbermercado limit 5";
	$res=$conn->query($query);
	foreach($res as $jug){
		$jid=$jug['idJC'];
		echo $jid;
		$query="update jugcom set mercado=1 where idjc=$jid ";
		
		$conn->query($query);
		$query="update jugcom set numbermercado=numberMercado+2 where idjc=$jid ";
		$conn->query($query);
	}
	
}
