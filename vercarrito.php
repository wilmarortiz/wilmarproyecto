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
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>TU HOSTAL</title>
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
</head>
<body>

<div></div>

<?php require("menu.php"); ?>

<div class="container" id="datosaenviar">

<div class="container">
  <div class="row">
  
   <h3 >Informacion de tu carrito</h3>


<?php
$total=0;
if (isset($_SESSION['carrito'])) {

?>
    
    <table class="table table-bordered">
      
       <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Imagen</th>
            <th scope="col">Nombre</th>
            <th scope="col">Categoria</th>
            <th scope="col">Cantidad</th>
            <th scope="col">Precio</th>
            <th scope="col">Subtotal</th>
          </tr>
        </thead>

         <tbody>
<?php
$datos=$_SESSION['carrito'];
for ($i=0; $i <count($datos) ; $i++) { 
?>

          <tr>
            <th scope="row"><?php echo($i+1); ?></th>
            <td>
            <img class="img-thumbnail" src="principal/temporal/<?php echo $datos[$i]['Img'];?>" alt="" style="width: 50px;height: 50px;">
            </td>
            <td><?php echo $datos[$i]['Nombre'];?></td>
            <td><?php echo $datos[$i]['Categoria'];?></td>
            <td><?php echo $datos[$i]['Cantidad'];?></td>
            <td>$ <?php echo $datos[$i]['Precio'];?></td>
            <td>$ <?php echo $datos[$i]['Cantidad']*$datos[$i]['Precio']; ?></td>
          </tr>
        

<?php
$total=($datos[$i]['Cantidad']*$datos[$i]['Precio'])+$total;
}

?>

          <tr>
            
              <td colspan="6">Total</td>
              <td colspan="1">$ <?php echo($total); ?></td>
            
          </tr>
          
        </tbody>
    </table>

     <input type="button" class="btn btn-primary" value="Comprar" onclick="pagar()">
     <input type="button" class="btn btn-success" value="Seguir viendo" onclick="ver()">
     <input type="button" class="btn btn-danger " value="Cancelar compra" onclick="cancelar()"> 
     <br>

<?php
}
else
{

echo "No haz agregado nada a tu carrito";
?>
<br>
 <input type="button" class="btn btn-success" value="Seguir viendo" onclick="ver()">
<?php
}

        // echo "<h3 id='total'>Total de su compra: $total </h3>";

        ?>


  </div>
</div>

   


	    <script type="text/javascript">
            $(function(){
                $('#ctd').validCampoFranz('0123456789');    
            });
        </script> 

        <script lenguage="javascript">
          function ver() {
        	window.location="index.php";
            }
        </script>

        <script type="text/javascript">
        function cancelar(){
        	window.location="cancelar.php";
            }
        </script>
			
	 <script type="text/javascript">

        function pagar(){
        $.post( "compra.php",function( data ) {
        $( "#datosaenviar" ).html( data );
        });
        }
        </script>
	</div>	
</body>
</html>