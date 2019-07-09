<?php

session_start();
require_once ("../php/dataDB.php");
?>
<html>
	<head>
		<meta name="viewport" content="width=device-width,intial-scale=1.0">
		<link rel="stylesheet" href="../css/main.css">
	</head>
	<body>
		<?php
			include_once("cabecera.php");
		?>
		<div class="row">
			<div class="col-4" style="float:left">
				<h3>Maximos goleadores</h3>
				<table>
				<?php
					//aqiu hacemos la query de los jugadores con mas goles, q no me sale jejejeje
					$query="SELECT jugadores.nombre, SUM(statsjugadores.goles) AS exp FROM jugadores LEFT JOIN statsjugadores ON jugadores.idJugador=statsjugadores.idJugador GROUP BY jugadores.nombre ORDER BY exp desc limit 10";
					$conn=createConn();
					$res=$conn->query($query);
					foreach($res as $x){
						
				?>
					<tr>
						<td><?=$x['nombre']?></td>
						<td><?=$x['exp']?></td>
				</tr>
						
				<?php
					}
						?>
				
				
				</table>
			</div>
			<div class="col-4" style="float:left">
				<h3>Maximos asistentes</h3>
				<table class="table1">
				<?php
					//aqiu hacemos la query de los jugadores con mas goles, q no me sale jejejeje
					$query="SELECT jugadores.nombre, SUM(statsjugadores.asist) AS exp FROM jugadores LEFT JOIN statsjugadores ON jugadores.idJugador=statsjugadores.idJugador GROUP BY jugadores.nombre ORDER BY exp desc limit 10";
					$conn=createConn();
					$res=$conn->query($query);
					foreach($res as $x){
						
				?>
					<tr>
						<td><?=$x['nombre']?></td>
						<td><?=$x['exp']?></td>
				</tr>
						
				<?php
					}
						?>
				
				
				</table>
			</div>
			<div class="col-4" style="float:left">
				<h3>Más puntuación</h3>
				<table class="table1">
				<?php
					//aqiu hacemos la query de los jugadores con mas goles, q no me sale jejejeje
					$query="SELECT jugadores.nombre, SUM(statsjugadores.puntos) AS exp FROM jugadores LEFT JOIN statsjugadores ON jugadores.idJugador=statsjugadores.idJugador GROUP BY jugadores.nombre ORDER BY exp desc limit 10";
					$conn=createConn();
					$res=$conn->query($query);
					foreach($res as $x){
						
				?>
					<tr>
						<td><?=$x['nombre']?></td>
						<td><?=$x['exp']?></td>
				</tr>
						
				<?php
					}
						?>
				
				
				</table>
			</div>
		</div>
	</body>
</html>