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
		<style>
			.table2 td{
				padding-top:30px;
    display: inline-block;
    overflow: auto;
    alignment-adjust:central;
    	font-size: 18px;
    	font-family: "Courier New";
    	 color:"red";
			}
			.field{
				background-image: url('../img/campo.jpg');
			}
		</style>
	</head>
	<body>
		<div class="row">
			<?php
			include_once ("cabecera.php");
		?>
		<div class="col-6" style="float:left">
			<?php
					if(isset($_SESSION['errormercado'])){
				echo $_SESSION['errormercado'];
				unset($_SESSION['errormercado']);
			}
			?>
			<table>
				<?php
				$conn = createConn();
				$query = "SELECT * from jugadores j,jugcom jc where j.idJugador=jc.idJugador and jc.idEquipo=$idEC ";
				$res = $conn -> query($query);
				?>
				<tr>
					<th>Jugador</th>
					<th>Posicion</th>
					<th>Valor</th>
					<th>Estado transferible</th>
					<th>Acciones</th>
				</tr>
				<?php
					foreach($res as $x){
						if ($x['mercado'] == 1) 
								$mess= "transferible";
							else 
								$mess="no transferible";
				?>
					<tr>
						<td><?=$x['nombre'] ?></td>
						<td><?=$x['posicion'] ?></td>
						<td><?=$x['valor'] ?></td>
						<td><?=$mess ?></td>
							
						
						<td>
							<form action="transferible.php" method="post">
								<input type="submit" value="Cambiar estado transferible">
								<input type="hidden" name="id" value=<?=$x['idJC']?>>
							</form>
						</td>
						<td>
							<form action="alinear.php" method="post">
								<input type="submit" value="alinear">
								<input type="hidden" name="id" value=<?=$x['idJC']?>>
							</form>
						</td>
					</tr>
				<?php
						}
					?>

					


			</table>
		</div>
			<div class="col-6" style="float: left">
			<h3>Alineacion</h3><?php
				$query="select jornada from comunios where idComunio=$idComunio";
				$conx=createConn();
				$res=$conx->query($query);
				$res=mysqli_fetch_assoc($res);
				echo "jornada ".$res['jornada'];
	?>
			<div class="col-4 field" style="height: 250px" >
				
			<table class="table2">
				<tr>
					<td>DEL</td>
					<?php
					$query="select jornada from comunios where idComunio=$idComunio";
					$result=$conn->query($query);
					$jornada=mysqli_fetch_assoc($result);
					$jornada=$jornada['jornada'];
					
						$query="select j.nombre as name from alineaciones a left join jugcom jc on a.idJugCom=jc.idJC left join jugadores j on j.idJugador=jc.idJugador where a.idEquipo=$idEC and j.posicion='DEL' and a.jornada=$jornada";
						$res=$conn->query($query);	
						foreach($res as $x){
							?>
							<td><?=$x['name']?></td>
							<?php
						}
					?>
				</tr>
				<tr>
					<td>MED</td>
					<?php
					$query="select j.nombre as name from alineaciones a left join jugcom jc on a.idJugCom=jc.idJC left join jugadores j on j.idJugador=jc.idJugador where jc.idEquipo=$idEC and j.posicion='MED' and a.jornada=$jornada";
						$res=$conn->query($query);
						foreach($res as $x){
							?>
							<td><?=$x['name']?></td>
							<?php
						}
					?>
				</tr>
				<tr>
					<td>DEF</td>
					<?php
					$query="select j.nombre as name from alineaciones a left join jugcom jc on a.idJugCom=jc.idJC left join jugadores j on j.idJugador=jc.idJugador where jc.idEquipo=$idEC and j.posicion='DEF' and a.jornada=$jornada";
						$res=$conn->query($query);
						foreach($res as $x){
							?>
							<td><?=$x['name']?></td>
							<?php
						}
					?>
				</tr>
				<tr>
					<td>POR</td>
					<?php
					$query="select j.nombre as name from alineaciones a left join jugcom jc on a.idJugCom=jc.idJC left join jugadores j on j.idJugador=jc.idJugador where jc.idEquipo=$idEC and j.posicion='POR' and a.jornada=$jornada";
						$res=$conn->query($query);
						foreach($res as $x){
							?>
							<td><?=$x['name']?></td>
							<?php
						}
					?>
				</tr>
			</table>
			</div>
		</div>
		<div class="col-6">
			<h3>Puntuación por jornadas</h3>
			<?php
				$query="select distinct jornada from alineaciones";
				$res=$conn->query($query);
				if(!$res){
					die($conn->error);
				}
				foreach($res as $jornada){
					$jornada=$jornada['jornada'];
				?>
				<p>
					
					Jornada <?=$jornada?>:
					<?php
					$puntos=0;
					$negativo="";
					$query="select * from jugcom jc inner join alineaciones a on a.idJugCom=jc.idJC and a.jornada=$jornada and dinero>0";
					$res=$conn->query($query);
					if(!$res){
							die($conn->error);
						}
					
					foreach($res as $x){
						$id=$x['idJugador'];
						
					$query= "select * from statsjugadores s left join partidos par on s.idPartido=par.idPartido where s.idJugador=$id and par.jornada=$jornada";
					$res=$conn->query($query);
						if(!$res){
							die($conn->error);
						}
						$res=mysqli_fetch_assoc($res);
						$puntos=$puntos+$res['puntos'];
						
					}
					?>
					<?=$puntos?> <?=$negativo?>
			</p>
			<?php
				}
			?>
		</div>
		</div>
	
	</body>
</html>
<?php 
}
?>