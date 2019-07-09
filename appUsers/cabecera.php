<div class="col-12" style="text-align: center">
	<h1>
		COMUNIO COLONO BITCHES
	</h1>
</div>
<div class="mainNavigator col-12">
    <div class="menuButtons col-12">
        <ul class="navButtons">
            <a href="index.php">
                <li class="navSelect">
                    Inicio
                </li></a>
            <a href="vistaGeneral.php">
                <li class="navButton">
                    Vista general comunio
                </li></a>
            <a href="mercado.php">
                <li class="navButton">
                    Mercado
                </li></a>
                  <a href="equipo.php">
                <li class="navButton">
                    Equipo
                </li></a>
           
            

            <?php

            if(isset($_SESSION['iduser'])){ ?>
                <a href="cerrarSesion.php">
                    <li class="navButton" style="color: #c82c2f">
                        Cerrar Sesión
                    </li></a>
            <?php } ?>
             <?php

            if(isset($_SESSION['admin'])){ ?>
                <a href="admin.php">
                    <li class="navButton" style="color: #c82c2f">
                        admin
                    </li></a>
            <?php } ?>
			 <a href="estadisticas.php">
                    <li class="navButton" style="color: #c82c2f">
                        Estadísticas
                    </li></a>
                   <a href="jugadores.php">
                    <li class="navButton" style="color: #c82c2f">
                        Jugadores
                    </li></a>
        </ul>
    </div>
</div>
