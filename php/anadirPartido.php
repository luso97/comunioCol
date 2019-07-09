<?php
session_start();
require_once("dataDB.php");
if(isset($_SESSION['admin'])){
?>

<?php


?>
<?php
$conn=createConn();
$query="SELECT * FROM equipos";
$res=$conn->query($query);

?>
<form action="anadePartido2.php" method="get">
	<select name="team1">
		<?php
		foreach ($res as $team){
		?>
		<option value=<?=$team['nombre']?>><?=$team['nombre']?> </option>
		<?php	
		}
		?>
		</select>
		<select name="team2">
		<?php
		foreach ($res as $team){
		?>
		<option value=<?=$team['nombre']?>><?=$team['nombre']?></option>
		<?php
		}
		?>
	</select></br>
	Resultado<input type="text" name="resultado"></br>
		Jornada<input type="number" name="jornada"></br>
		<input type="submit">
</form>
<?php
}
?>