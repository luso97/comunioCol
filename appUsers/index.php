<?php
session_start();
require_once ("../php/dataDB.php");
?>
<html>
	<head>
		<meta name="viewport" content="width=device-width,intial-scale=1.0">
		<link rel="stylesheet" href="../css/main.css">
		<script>
		function validatePasswordComunio(value){

			if(value.length>12){
			return "Las contraseñas no tienen mas de 12 caracteres\n";
			}
			else if(value==""){
				return "La contraseña no puede ser vacia\n";
			}
			else{
			return "";
			}
			}
			function validateNameComunio(value){

			if(value.length>12){
			return "El nombre del comunio no tienen mas de 12 caracteres\n";
			}
				
			return "";
				
			}
			function validateEquipoComName(value){
				if(value.length>12){
					return "El nombre del equipo debe tener menos de 12 caracteres \n";
				}else{
					
				return "";
				}
			}
		      function validateNewComunio(form)
      {
        var fail  = validatePasswordComunio(form.passComunio.value);
        fail += validateEquipoComName(form.nombreEquipo.value)
        
        if   (fail == "")   return true;
        else { alert(fail); return false; }
      }
			function validateCrearComunio(form){
			
        var fail  = validatePasswordComunio(form.pass.value);
        fail += validateNameComunio(form.name.value)
        
        if   (fail == "")   return true;
        else { alert(fail); return false;}
				
			}
	</script>
	</head>
	<body>
		<?php

		include_once ("cabecera.php");
	?>
		<?php
	if (!isset($_SESSION['iduser'])) {
		header('Location:login.php');
	} else {
		$id = $_SESSION['iduser'];
	}
?>
<div class="row">
		<div class="col-5" style="float:left">
			<h4>
				Equipos
			</h4>
			<table class="col-5">
				<?php
$conn=createConn();
$query="SELECT * from equipocom where iduser=$id";
$res=$conn->query($query);
foreach($res as $x){
				?>
				<tr>
					<form action="preVistaGeneral.php" method="post" >
						<input type="hidden" name="idEC" value=<?=$x['idEC']?>>
						<input type="hidden" name="idComunio" value=<?= $x['idComunio'] ?>>
					<td><?=$x['nombre'] ?></td><td><input type="submit" value="Ver"></td>
					</form>
				</tr>
				<?php
				}
				?>
			</table>

		</div>
			<div class="col-5" style="float:left">
				<h4>
					Comunios de los que eres admin
				</h4>
			<table class="col-5 tabla1">
				<?php
$conn=createConn();
$query="SELECT * from comunios where iduser=$id";
$res=$conn->query($query);
foreach($res as $x){
				?>
				<tr>
					<form action="vistaGeneral.php" method="post">
						<input type="hidden" name="idEC" value=<?=$x['idComunio']?>>
					<td><?=$x['name'] ?></td><td><input type="submit" value="Ver"></td>
					</form>
				</tr>
				<?php
				}
				?>
				
			</table>

		</div>
	
	
		<div class="col-3" style="padding-top: 13%">
			<form method="post" action="addComunio.php" onsubmit="return validateNewComunio(this)">
			Entrar en nuevo comunio (pon la contrase�a)<input type="password" name="passComunio"></br>
			Entrar el nombre de tu equipo en dicho comunio <input type="text" name="nombreEquipo"></br>
			<?php if(isset($_REQUEST['message'])){
				echo "No existe el comunio con dicha contrase�a";
			}
			?>
			<input type ="submit">
			</form>
		</div>
		<div class="col-4">
			<h3>Crear comunio</h3>
			<form action="crearComunio.php" method="get" onsubmit="return validateCrearComunio(this)">
				Nombre<input type="text" name="name"></br>
				Contrase�a<input type="password" name="pass"></br>
				<input type="submit" value="Crear">
			</form>
			
		</div>
	</div>
	</body>
</html>