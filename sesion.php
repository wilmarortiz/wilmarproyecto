<?php
session_start();
ini_set('display_errors','1');
error_reporting(E_ALL & ~E_NOTICE);
  if($_SESSION['AUTENTICADO']=='OK'and $_SESSION['id_tipopermitido']==1){
   header("Location:principal/cpanel.php");
   exit();
  }



 ?>
 <!doctype html>
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
     <title></title>

   </head>
   <body>
		<!-- incluyo el archivo que tiene el menu -->
		<?php include("menu.php"); ?>

		 <div id="contenido" class="container">

		<div class="container">
    	
    <div class="row">

    <div class="col-xs-2"></div>

    <div class="col-xs-8">
      <?php 

        if (isset($_SESSION['mensaje'])) {
            $mensaje=$_SESSION['mensaje'];
            unset($_SESSION['mensaje']);


            ?>
            <div class="alert alert-danger"><?php echo $mensaje; ?></div>
          <?php
           } 
       ?>



       <div class="panel panel-default">

           <div class="panel-heading">
               Iniciar sesión
           </div>

         <div class="panel-body">
         <form role="form" method="POST" action="validar.php">

             <div class="form-group">
                  <div class="input-group">
                        <span class="input-group-addon">@</span>
                       <input type="text" id="correo" name="correo" class="form-control" placeholder="Correo">
                   </div>
               </div>

            <div class="form-group">
                <div class="input-group">
                  <div class="input-group-addon"><span id="iconoclave" class="glyphicon glyphicon-eye-open" onClick="verClave()" style="cursor:pointer"></span></div>
                   <input type="password" id="pass" name="pass" class="form-control" placeholder="Contaseña">
                  </div>
               </div>

            <input  type="submit" value="Iniciar" id="submit" class="btn btn-primary">
         </form>

         </div>
       </div>

     </div>

     <div class="col-xs-2"></div>

  </div>

  <script>
  var visto=true;

  function verClave(){

    if(visto)
    {
        $('#pass').attr('type','text');
          $('#iconoclave').removeClass('glyphicon glyphicon-eye-open');
              $('#iconoclave').addClass('glyphicon glyphicon-eye-close');
    }
    else
    {
      $('#pass').attr('type','password');
      $('#iconoclave').removeClass('glyphicon glyphicon-eye-close');
          $('#iconoclave').addClass('glyphicon glyphicon-eye-open');

    }
      visto=!visto;;
  }

  </script>
		</div>
			
		 </div>
   </body>
 </html>
 <?php
// }
//  else
//   {
// echo "Usuario no permitido";
//   }

  ?>
<script>
  function ruta(ruta){
    $.post('procesamenucliente.php',{'ruta':ruta},function(respuesta){
      $('#contenido').html(respuesta);
    });
  }
</script>
