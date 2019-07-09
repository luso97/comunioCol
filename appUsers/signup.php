<?php

session_start();
require_once ("../php/dataDB.php");
if(isset($_REQUEST['nick']) and isset($_REQUEST['pass']) and isset($_REQUEST['hab'])){
	$x=$_REQUEST['nick'];
	$y=$_REQUEST['pass'];
	$z=$_REQUEST['hab'];
	$conn=createConn();
	$query="insert into users values(null,'$x','$y','none',$z)";
	$conn->query($query);
	header('Location:index.php');
}
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
				<form action="signup.php" method="post">
					Nick<input type="text" name="nick"></br>
					
					Contraseña<input type="password" name="pass"></br>
					Habitación<input type="number" name="hab"></br>
					<input type="submit" value="Crear">
<				</form>				
			</div>
			
		</div>1
	</body>
	</html>
	