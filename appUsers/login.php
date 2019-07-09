<?php
	session_start();
	require_once("../php/dataDB.php");
	if(isset($_REQUEST['nick']) && isset($_REQUEST['pass'])){
	// Si no existen datos del formulario en la sesi�n, se crea una entrada con valores por defecto
	
		
		$user = $_REQUEST['nick'];
		echo $user;
		
		$password=$_REQUEST['pass'];
		echo $password;
		$conn=createConn();
		
		$query="SELECT COUNT(*) AS TOTAL FROM users WHERE nick='$user' AND pass='$password'";
		$res= $conn->query($query);
		$result=mysqli_fetch_assoc($res);
		$size=$result['TOTAL'];
		if($size<1){
			$login="error";
		
		}
		else{
			$_SESSION['user']=$user;
			if($user==prensaColona){
				$_SESSION['admin']=1;
			}
			
			$res2=$conn->query("SELECT idUser FROM users  WHERE nick='$user'");
			
			$result=mysqli_fetch_assoc($res2);
			$_SESSION['iduser']=$result['idUser'];
			header('Location:index.php');
		}
	}
	
	
	
?>
<html>
	<head>
		<link rel="stylesheet" href="../css/main.css">
		<meta name="viewport" content="width=device-width,intial-scale=1.0">
	</head>
	<body>
		<div class="row">
		<?php
		include_once ("cabecera.php");
		echo "puta".$_SESSION['iduser'].$_SESSION['user'];
	?>
	
		<div class="col-4" style="float: left">
			<p>
				Entra con tu cuenta:
			</p>
		</div>
		<div class="col-4">
			<form method="get" action="login.php">
				Nick:<input type="text" name="nick" ></br>
				Contrase�a:<input type="password" name="pass"></br>
				<input type="submit" value="entrar">
				
			</form>
	Si no estás registrado, regístrate <a href="signup.php">aquí</a>
		</div>
	</div>
	</body>
</html>