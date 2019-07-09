<?php
session_start();
require_once("../php/dataDB.php");
if(isset($_SESSION['admin'])){
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
			<div class="col-6">
			Aqu� podr�is a�adir los partidos, los equipos y dem�s.</br>
			<a href="../php/createTeam.php">Crear equipo(con sus jugadores)</a></br>
			<a href="../php/anadirPartido.php">A�adir partido</a></br>
			<a href="../php/gestionMercado.php">Gestion mercado</a></br>
<a href="../php/jornadas.php">Jornadas</a></br>
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