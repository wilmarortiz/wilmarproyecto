<?php
session_start();
ini_set( 'display_errors', '1' );
error_reporting( E_ALL );
if ( $_SESSION[ 'AUTENTICADO' ] == 'OK'
	and $_SESSION[ 'id_tipopermitido' ] == 1 ) {
	?>
	<!doctype html>
	<html >
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="../css/bootstrap.min.css">
		<link rel="stylesheet" href="../css/alertify.min.css">
		<link rel="stylesheet" href="../css/validationEngine.jquery.css">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<script src="../js/jquery.min.js"></script>
		<script src="../js/jquery.validationEngine.js"></script>
		<script src="../js/jquery.validationEngine-es.js"></script>
		<script src="../js/bootstrap.min.js"></script>
		<script type="text/javascript" src="../js/alertify.min.js"></script>
		<title></title>
	</head>

	<body background="fondo1.jpg" bgcolor="FFCECB">
		<nav class="navbar navbar-default" role="navigation">
			<div class="container-fluid">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
       <span class="sr-only">Toggle navigation</span>
       <span class="icon-bar"></span>
       <span class="icon-bar"></span>
       <span class="icon-bar"></span>
     </button>
				
					<a class="navbar-brand" href="#"> <span style="color: black" class="glyphicon glyphicon-cog" aria-hidden="true"></span>
           TU HOSTAL</h1></a>
				</div>

				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Archivo <span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="cpanel.php" onclick="">Inicio</a>
								</li>
							</ul>
						</li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Gestionar<span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="#" onclick="ruta('updatecliente.php')">Cliente</a>
								</li>
								<li><a href="#" onclick="ruta('updateproducto.php')">Cabañas Alquiler</a>
								</li>

							</ul>
						</li>
					</ul>

					<ul class="nav navbar-nav navbar-left">

						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Procesos<span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="#" onclick="ruta('newcliente.php')">Nuevo cliente</a>
								</li>
								<li><a href="#" onclick="ruta('newproducto.php')">Nuevo producto</a>
								</li>

							</ul>
						</li>

						<ul class="nav navbar-nav navbar-left">
							<!--   <li><a href="#">Link</a></li>-->
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Reportes<span class="caret"></span></a>
								<ul class="dropdown-menu">
									<li><a href="#" onclick="ruta('productovendido.php')">Alquileres Realizados</a>
		
								</ul>
							</li>
						</ul>

						<ul class="nav navbar-nav navbar-right">
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Cerrar Seccion<span class="caret"></span></a>
								<ul class="dropdown-menu">
									<li><a href="cerrar.php" onclick="ruta('cerrar.php')">Salir</a>
									</li>

								</ul>
							</li>
						</ul>

					</ul>
				</div>
				<!-- /.navbar-collapse -->
			</div>
			<!-- /.container-fluid -->
		</nav>
		<div id="contenido" class="container">

		</div>
	</body>
	</html>
	<?php
} else {
	echo "Usuario no permitido";
	header( 'Location: ../index.php' );
}

?>
<script>
	function ruta( ruta ) {
		$.post( 'proceMenu.php', {
			'ruta': ruta
		}, function ( respuesta ) {
			$( '#contenido' ).html( respuesta );
		} );
	}
</script>