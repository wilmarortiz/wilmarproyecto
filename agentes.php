<?php
session_start();
ini_set('display_errors','1');
error_reporting(E_ALL & ~E_NOTICE);
  if($_SESSION['AUTENTICADO']=='OK'and $_SESSION['id_tipopermitido']==1){
   header("Location:principal/cpanel.php");
   exit();
  }
 ?>
<!DOCTYPE html>
<html>
<head>
     <meta charset="utf-8">
     <link rel="stylesheet" href="css/css.css">
      <link rel="stylesheet" href="css/bootstrap.min.css">
       <link rel="stylesheet" href="css/alertify.min.css">
       <link rel="stylesheet" href="css/validationEngine.jquery.css">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
         <meta name="viewport" content="width=device-width, initial-scale=1">
          <script src="js/jquery.min.js"></script>
          <script src="js/jquery.validationEngine.js"></script>
           <script src="js/jquery.validationEngine-es.js"></script>
           <script src="js/bootstrap.min.js"></script>
              <script type="text/javascript" src="../js/alertify.min.js"></script>
     <title>TU HOSTAL</title>

   </head>
<body>

	<?php require('menu.php'); ?>

			 <div id="contenido" class="container">

			<div class="container">
    		<div class="row">
          <section>

            <?php
            include('clases/conexion.php');
              include ('clases/usuarioDAO.php');
              $conexion=new conexion();
              $usuarioDAO=new usuarioDAO($conexion);
                $res=$usuarioDAO->listarproductoespecifico(5);
                  if($res){
                    foreach ($res as $res) {
                         ?>
                <div class="producto ">
                <div class="container">
                <img class="img-thumbnail" style="width: 230px; height: 300px;" src="principal/temporal/<?php echo $res['imagen'] ?>"><br>
                   <label >
                   <?php echo $res['nombre']?></label>
           
                   <br>
                   <label ><span class="glyphicon glyphicon-tag" aria-hidden="true"></span>
                   <?php echo $res['cate_nombre']?></label>
                   <br>
                   <label ><span class="glyphicon glyphicon-usd" aria-hidden="true"></span>
                   <?php echo $res['valor'] ?></label>
                   <br>


                          <button id="btntamaño2" value="" type="button" class="btn btn-success animated fadeInDown"
                                  onclick="carrito(<?php echo $res['id_producto'] ?>);">Añadir
                                   <span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>
                                  </button>

                </div>

              </div>
            <?php
            }
            }else{
            	echo "Lo sentimos no se encontraron resultados";
            }
            ?>
            </section>

  </div>
			</div>
			
		 </div>
	
</body>
</html>
<script>
  function ruta(ruta){
    $.post('procesamenucliente.php',{'ruta':ruta},function(respuesta)
    {
      $('#contenido').html(respuesta);
    });
  }


    function carrito(id){
       $.post( "agregarcarrito.php",{'id':id},function( data ) {
     //) alert(data);
      $( "#contenido" ).html( data );
      });
       }
</script>