<?php
session_start();
require_once ("../php/dataDB.php");
$idComunio = $_SESSION['idComunio'];
$idEC = $_SESSION['idEC'];
?>
<html>
	<head>
		<meta name="viewport" content="width=device-width,intial-scale=1.0">
		<link rel="stylesheet" href="../css/main.css">
		<script>
			function validateOferta(form){
				var r=form.oferta.value;
				if(+r>60000){
				
				alert("no se puede ofertar mas de 60000 tulios");
					return false;
				}
				
				return true;
				
			}
		</script>
	</head>
	<body>
		<div class="row">
		<?php
		include_once ("cabecera.php");
		?>
		<div class="col-8">
			<?php
			if(isset($_SESSION['errormercado'])){
				echo $_SESSION['errormercado'];
				unset($_SESSION['errormercado']);
			}
			$query="SELECT dinero from equipocom where idec=$idEC";
			$conn3=createConn();
			$dinero=$conn3->query($query);
			$dinero=mysqli_fetch_assoc($dinero);
			$dinero=$dinero['dinero'];
			?>
			<h3>Presupuesto(sin contar ofertas realizadas)=<?=$dinero?></h3>
			<table>
				<tr>
					<th>Jugador</th>
					<th>Valor</th>
					<th>Equipo</th>
					<th>Tu oferta</th>
				</tr>
			<?php
			$query ="select ec.dinero as money,jc.idJC as jcid ,j.nombre as nombre,j.valor as valor,ec.nombre as nam ,ec.idEC as idec  from jugcom jc left JOIN equipocom ec on jc.idEquipo=ec.idEC left join jugadores j on jc.idJugador=j.idJugador WHERE jc.idComunio=$idComunio and mercado=1";
			$conn=createConn();
			$res=$conn->query($query);
			foreach($res as $x){
				?>
				<tr>
					<td><?=$x['nombre'] ?></td>
					<td><?=$x['valor'] ?></td>
					<td><?=$x['nam'] ?></td>
				<?php
				$z=$x['jcid'];
				if($x['idec']!=$idEC){
				
				
				//$query="SELECT * from ofertas  of, equipocom eq, jugcom jc where ofertante=$idEC and eq.idEC=$idEC and idjugcom=$z";
				$query="select * from ofertas of left join equipocom ec on of.ofertante=ec.idEC where of.idjugcom=$z and ec.idEC=$idEC";
				$res =$conn->query($query);
				?>
				<td><form method="get" action="anadirOferta.php" onsubmit="return validateOferta(this)" >
					<input type="text" name="oferta" value="Ofertar">
					<input type="hidden" name="jugador" value=<?=$x['jcid'] ?>  >
					<input type="hidden" name="valor" value=<?=$x['valor']?>>
					<input type="submit">
				</form>
				</td>
				
				<?php
				if (mysqli_num_rows($res) == 1) {
					$x = mysqli_fetch_assoc($res);

					echo "<td><p>Tu actual oferta:" . $x['oferta'] . "</p></td>";

				}
				}
				else{
				$query="SELECT * from equipocom eq,ofertas of WHERE of.ofertante=eq.idEC and of.idJugCom=$z";
				$res=$conn->query($query);
				foreach($res as $oferta){
	?>
					<td><table>
						<td><?=$oferta['nombre'] ?></td>
						<td><?=$oferta['oferta'] ?></td>
						<td>(<?=$oferta['aceptada'] ?>)</td>
						<td><form action="aceptarOferta.php" method="post">
							<input type="hidden" name="idOferta" value=<?=$oferta['idOferta'] ?>>
							<input type="hidden" name="jugador" value=<?= $z ?>>
							<input type="submit" value="aceptar">
						</form></td>
					</table>
					</td>
	<?php
	}
	}
				?>
				<td>
					<form action="rechazarTodas.php" method="post">
						<input type="submit" value="Rechazar todas">
						<input type="hidden" name="jugador" value=<?= $z ?>>
					</form>
				</td>
				</tr>
				<?php
				}
			?>
			</table>
		</div>
		</div>
	</body>
</html>
