<?php
session_start();
require_once("../php/dataDB.php");
if(isset($_SESSION['idEC']) && isset($_SESSION['idComunio'])){
$idEC=$_SESSION['idEC'];
$idComunio=$_SESSION['idComunio'];

?>
<html>
	<head>
		<meta name="viewport" content="width=device-width,intial-scale=1.0">
		<link rel="stylesheet" href="../css/main.css">
	</head>
	<body>
		<div class="row">
		<?php
			include_once("cabecera.php");
		?>
		
			<div class="col-4" style="float:left">
				<h3 style="padding-left: 4%">Equipo</h3>
				<table class="equipo">
					
						
					<tr>
						<th>Nombre</th>
						<th>Posicion</th>
						<th>Valor</th>
					</tr>
					
					<?php
						$query="SELECT * FROM jugadores J,jugcom JC where JC.idJugador=J.idJugador AND JC.idEquipo=$idEC";
						$conn=createConn();
						$res=$conn->query($query);
						foreach($res as $jug){
							?>
							<tr>
								<td><?= $jug['nombre']?></td>
								<td><?= $jug['posicion']?></td>
								<td><?= $jug['valor']?></td>
							</tr>
							<?php
						}
					?>
				</table>
			</div>
			<div class="col-4 equipo" style="float:left">
				<h3>�ltimos fichajes</h3>
				<table class="fichajes">
					<tr>
						<th>Jugador</th>
						<th>Precio</th>
						<th>Equipo1</th>
						<th>Equipo2</th>
					</tr>
					<?php
						$query="SELECT j.nombre as nombre, f.precio as oferta,ec.nombre as equipo1,ec2.nombre as equipo2 from fichajes f left join jugcom jc on jc.idJC=f.idjugcom left join jugadores j on j.idJugador=jc.idjugador left join equipocom ec on f.equipo1=ec.idec left join equipocom ec2 on f.equipo2=ec.idec where jc.idComunio=$idComunio order by fecha desc limit 8";
						$conn2=createConn();
						$res1=$conn2->query($query);
						foreach($res1 as $x){						
					?>
					<tr>
								<td><?= $x['nombre']?></td>
								<td><?= $x['oferta']?></td>
								<td><?= $x['equipo1']?></td>
								<td><?= $x['equipo2']?></td>
							</tr>
					<?php
					}
					?>
					
				</table>
			</div>
			<div class="col-4" style="float:left">
				<h3>Comunio</h3>
				<table class="fichajes">
					<tr>
						<th>Equipos</th>
						<th>Puntos</th>
						
					</tr>
					<?php
						$query="SELECT * FROM equipocom where idComunio=$idComunio";
						$conn2=createConn();
						$res1=$conn2->query($query);
						foreach($res1 as $x){						
					?>
					<tr>
								<td><?= $x['nombre']?></td>
								<td><?= $x['puntos']?></td>
								
							</tr>
					<?php
					}
					?>
					
				</table>
				
			</div>
		</div>
	</body>
</html>

<?php
}
else{
header('Location:index.php');
}
?>
