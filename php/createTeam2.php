<?php
    $n=$_REQUEST['num']
?>
<html>
	<head>
		
	</head>
	<body>
		<div>
			<form method="get" action="createTeamFinal.php">
				Nombre<input type="text" name="nombre"></br>
			<input type="hidden" name="n" value="<?= $n ?>">
			<?php
			$i;
			for ($i=0;$i<$n;$i++){
			?>	
			Nombre <input type="text" name="nombreJug[]">
			Valor <input type="text" name="valorJug[]">
			Posicion <input type="text" name="posJug[]"></br>
			<?php	
			}
			?>
			<input type="submit">
			</form>
		</div>
	</body>
</html>