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
		<div class="row">
			<?php
				include_once("cabecera.php");
			?>
			<div class="col-6">
				<table>
				<?php
					$query="select * from jugadores order by equipo";
					$conn=createConn();
					$res=$conn->query($query);
					foreach($res as $r){
						?>
							<tr>
								<td><?=$r['nombre']?></td>
								<td><?=$r['equipo']?></td>
								<td><form method="post" action="jugador.php">
									<input type="hidden" name="id" value=<?=$r['idJugador']?>>
									<input type="submit" value="Ver Jugador">
								</form></td>
							</tr>	
						<?php
					}
				?>
				</table>
			</div>
		</div>
	</body>
</html>