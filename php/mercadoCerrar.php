<?php
/* seleccionas todos los jugcom en mercado, se miran las ofertas*/
require_once ("dataDB.php");
$conn = createConn();
$query = "select * from jugcom where mercado=1 and idequipo is null";
$jugadoresMercadoSinEquipo = $conn -> query($query);
foreach ($jugadoresMercadoSinEquipo as $jug) {
	//seleccionas las ofertas
	$x = $jug['idJC'];
	
	$query = "select * from ofertas where idjugcom=$x order by oferta desc";
	$ofertas = $conn -> query($query);
	if (mysqli_num_rows($ofertas) >= 1) {
		$oferta=mysqli_fetch_assoc($ofertas);
		
		$ofertante =$oferta['ofertante'];
		echo $ofertante;
		$precio=$oferta['oferta'];
		
		$query="insert into fichajes values(null,null,null,null,$ofertante,$precio,$x)";
		
		$conn->query($query);
		$query="update jugcom set idequipo=$ofertante where idjc=$x";
		$conn->query($query);
		$query="update jugcom set mercado=0 where idjc=$x";
	$conn->query($query);
		$query="update equipocom set dinero=dinero-$precio where idec=$ofertante";
		$conn->query($query);
		}
	 else {
	 	$query="update jugcom set mercado=0 where idjc=$x";
	$conn->query($query);
	echo"esto sale?";
		
	}
	 $query="delete from ofertas where idjugcom=$x";
	 $conn->query($query);
	
}

$query="select * from jugcom where idequipo is not null and mercado=1";
$res=$conn->query($query);
foreach($res as $y){
	$id2=$y['idJC'];
	$equipo1=$y['idEquipo'];
	echo ",,,".$equipo1.",".$id2."</br>";
	$query="select *  from ofertas where aceptada=1 and idjugcom=$id2";
	$res2=$conn->query($query);
	echo mysqli_num_rows($res2);
	if(mysqli_num_rows($res2) > 0){
	$res3=mysqli_fetch_assoc($res2);
		$ofertante=$res3['ofertante'];
		$precio=$res3['oferta'];
	$query="insert into fichajes values(null,null,null,$equipo1,$ofertante,$precio,$id2)";
	$conn->query($query);
	
	$query="update jugcom set idequipo=$ofertante where idjc=$id2";
	$conn->query($query);
	$query="update jugcom set mercado=0 where idjc=$id2";
	$conn->query($query);
	$query ="update equipocom set dinero=dinero+$precio where idec=$equipo1";
	$conn->query($query);
	$query ="update equipocom set dinero=dinero-$precio where idec=$ofertante";
	$conn->query($query);
		//quitar la alineacion de esa jornada
	$query="select c.jornada as j from jugcom jc left comunios c on jc.idComunio=c.jornada where jc.idJC=$id2";
	$res=$conn->query($query);
		$res=mysqli_fetch_assoc($res);
		$j=$res['j'];
		$query="delete from alineaciones where idJugCom=$id2 and jornada=$j";
	
	$conn->query($query);
		
	}
	else{
	$quer2="select * from jugcom jc left join jugadores j on j.idJugador=jc.idJugador where jc.idJc=$id2";
	$res=$conn->query($quer2);
	$stid=mysqli_fetch_assoc($res);
	$valor=$stid['valor'];
	echo "valor:".$valor;
	
	$query="insert into fichajes values(null,null,null,$equipo1,null,$valor,$id2)";
	$conn->query($query);
	$query="update jugcom set idequipo=null where idjc=$id2";
	
	$conn->query($query);
	$query="update jugcom set mercado=0 where idjc=$id2";
	$conn->query($query);
	$query ="update equipocom set dinero=dinero+$valor where idec=$equipo1"; 
	$conn->query($query);
		//quitar la alineacion de esa jornada
		$query="select c.jornada as j from jugcom jc left comunios c on jc.idComunio=c.jornada where jc.idJC=$id2";
	$res=$conn->query($query);
		$res=mysqli_fetch_assoc($res);
		$j=$res['j'];
				$query="delete from alineaciones where idJugCom=$id2 and jornada=$j";
	
		$conn->query($query);
	
	}
	}
		 $query="delete from ofertas where idjugcom=$id2";
	 $conn->query($query);
}
header("gestionMercado.php");
?>