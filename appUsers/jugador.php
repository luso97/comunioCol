<?php
session_start();
require_once("../php/dataDB.php");
$id=$_REQUEST['id'];
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
				$conn=createConn();
				$jugador="select * from jugadores where idJugador=$id";
				$jugador=$conn->query($jugador);
				$jugador=mysqli_fetch_assoc($jugador);
			?>
			<div class="col-4" style="border-right-width: 30px;float:left;border-color:black;border-style:solid">
				<h3>Datos</h3>
				Nombre: <?=$jugador['nombre']?></br>
				Posicion: <?=$jugador['posicion']?></br>
				Equipo: <?=$jugador['equipo']?></br>
				Valor: <?=$jugador['valor']?></br>
				
				
			</div>
			<div class="col-4" style="float:left;border-left-width: 20px;border-color:black;border-style:solid">
				<h3>Estadísticas</h3>
					<?php
				$jugador="select sum(goles) as goles, sum(asist) as asis,sum(puntos) as punts  from statsjugadores where idJugador=$id";
				$jugador=$conn->query($jugador);
				$jugador=mysqli_fetch_assoc($jugador);
				?>
			Goles: <?=$jugador['goles']?></br>
				Asistencias: <?=$jugador['asis']?></br>
				Equipo: <?=$jugador['punts']?></br>
				
			</div>
			<div class="col-6" ></br>
				<h3>Partidos</h3>
				<?php 
				$query="select * from statsjugadores s left join partidos p on s.idPartido=p.idPartido where s.idJugador=$id";
				$res=$conn->query($query);
				
				?>
				<table>
					<tr><th>Equipo1</th>
						<th>Equipo2</th>
						<th>Resultado</th>
						<th>Goles</th>
						<th>Asistencias</th>
						<th>Puntos</th>
					</tr>
					<?php foreach($res as $a){
						?>
						<tr>
							<td><?=$a['equipo1']?></td>
							<td><?=$a['equipo2']?></td>
							<td><?=$a['resultado']?></td>
							<td><?=$a['goles']?></td>
							<td><?=$a['asist']?></td>
							<td><?=$a['puntos']?></td>
						</tr>
						<?php
					}
					?>
				</table>
			</div>
		</div>
	</body>
</html>