<?php
session_start();
require_once("dataDB.php");
if(isset($_SESSION['admin'])){
	$team1=$_REQUEST['team1'];
	$team2=$_REQUEST['team2'];
	$resultado=$_REQUEST['resultado'];
	$jornada=$_REQUEST['jornada'];
$conn=createConn();
if($team1!=$team2){
	$query="INSert into partidos values(NULL,'$team1','$team2','$resultado',$jornada)";
	$conn->query($query);
	$query="SELECT LAST_INSERT_ID() as id";
	$res=$conn->query($query);
	$stid=mysqli_fetch_assoc($res);
	$id=$stid['id'];
	echo $id;
?>
<html>
	<head>

	</head>
	<body>
		<div class="row">
			<form action="anadePartidoFinal.php" method="get">
			<div class="col-6" style="float:left">
				<h3><?=$team1?></h3>
				<table>
					<tr>
						<th>nombre</th>
						<th>goles</th>
						<th>Asist</th>
						<th>Puntos</th>
					</tr>
					<?php
$query="SELECT * FROM jugadores where equipo='$team1'";

$res=$conn->query($query);
?>
<input type="hidden" name="n1" value=<?=mysqli_num_rows($res)?>>
<?php
foreach($res as $x){
					?>
					<tr>
				<td><?= $x['nombre']?></td>
				<input type="hidden" value=<?=$x['idJugador']?> name="id1[]">
			<td><input type="text" name="goles1[]"></td>
			 <td><input type="text" name="asist1[]"></td>
			<td><input type="text" name="punt1[]"></td></br>
			</tr>
				<?php
}
				?>
				</table>
			</div>
			<div class="col-6" style="float:left">
				<h3><?=$team2?></h3>
				<table>
				<tr>
						<th>nombre</th>
						<th>goles</th>
						<th>Asist</th>
						<th>Puntos</th>
					</tr>
<?php
$query="SELECT * FROM jugadores where  equipo='$team2'";
$conn=createConn();
$res=$conn->query($query);
?>
<input type="hidden" name="n2" value=<?=mysqli_num_rows($res)?>>
<?php
foreach($res as $y){
					?>
					
<tr>
				<td><?= $y['nombre']?></td>
				<input type="hidden" value=<?=$y['idJugador']?> name="id2[]">
			<td><input type="text" name="goles2[]"></td>
			 <td><input type="text" name="asist2[]"></td>
			<td><input type="text" name="punt2[]"></td></br>
			</tr>
			<?php
}
			?>
		</table>
			</div>
			<input type="hidden" name="partido" value=<?=$id?>>
			<input type="submit">
			
			</form>
		</div>
	</body>
</html>

<?php
}
}
else{
	header('Location:../appUsers/index.php');
}
?>