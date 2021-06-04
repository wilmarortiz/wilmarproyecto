<?php
session_start();
// session_name('Mipagina');
ini_set('display_errors','1');
error_reporting(E_ALL);
 if($_SESSION['AUTENTICADO']=='OK'and $_SESSION['id_tipopermitido']==2){
       
     include('clases/conexion.php');
     include ('clases/usuarioDAO.php');
     $conexion=new conexion();
     $usuarioDAO=new usuarioDAO($conexion);
     $codigo=$_POST['id'];     

if (isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])) {
   
	if (isset($codigo)) {

	$arreglo=$_SESSION['carrito'];
	$encontro=false;
	$numero=0;
	for ($i=0; $i<count($arreglo);$i++) { 

		if ($arreglo[$i]['Id']==$codigo){
	
			$encontro=true;
			$numero=$i;
			
		}
	}
	if ($encontro==true) {
	
		$arreglo[$numero]['Cantidad']=$arreglo[$numero]['Cantidad']+1;
		$_SESSION['carrito']=$arreglo;
	}else{
        $img="";
		$nombre="";
		$genero="";
		$autor="";
		$precio=0;

	   $productoVO=new productoVO();
	   $productoVO->setid_producto($codigo);
	   $res=$usuarioDAO->seleccionarproducto($codigo);

	   if ($res) {
	
             $img=$res[0]->getruta();
	   	     $nombre=$res[0]->getdescripcion();
	   	   	 $autor=$res[0]->getcategoria();
	   	   	 $precio=$res[0]->getvalor();
	   }
	   $datosnuevos= array('Id' => $codigo,
                           'Img'=>$img,
	                       'Nombre'=>$nombre,
	                       'Categoria'=>$autor,
	                       'Precio'=>$precio,
	                       'Cantidad'=>1);
	   array_push($arreglo,$datosnuevos);
	  $_SESSION['carrito']=$arreglo; 
	}
}
    


}else{

	if (isset($codigo)) {
		# code...
        $img="";
		$nombre="";
		$genero="";
		$autor="";
		$precio=0;

	
	   $productoVO=new productoVO();
	   $productoVO->setid_producto($codigo);
	   $res=$usuarioDAO->seleccionarproducto($codigo);


	  if ($res){
	   	# code...
             $img=$res[0]->getruta();
	   	     $nombre=$res[0]->getdescripcion();
	   	     $autor=$res[0]->getcategoria();
	   	   	 $precio=$res[0]->getvalor();
	   }
	   $arreglo[]= array('Id' => $codigo,
                         'Img'=>$img,
	                     'Nombre'=>$nombre,
	                     'Categoria'=>$autor,
	                     'Precio'=>$precio,
	                     'Cantidad'=>1);
	   $_SESSION['carrito']=$arreglo;

	}
}

 // print_r($_SESSION['carrito']);exit();

?>



<div id="datosaenviar"></div>

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

<?php
}
else
{
echo "No haz agregado nada a tu carrito";
}

        // echo "<h3 id='total'>Total de su compra: $total </h3>";

        ?>


  </div>
</div>
	 
		 <input type="button" class="btn btn-primary" value="Comprar" onclick="pagar()">
         <input type="button" class="btn btn-success" value="Seguir viendo" onclick="ver()">
         <input type="button" class="btn btn-danger " value="Cancelar compra" onclick="cancelar()">	
		 <br>
		
	    <script type="text/javascript">

            $(function(){
            $('#ctd').validCampoFranz('0123456789');    
            });
   
          function ver(){
          	// alert();
        	window.location="index.php";
        	// reload();
            }
    
           function cancelar(){
        	window.location="cancelar.php";
            }
     
        function pagar(){  
			$.post( "compra.php",function( data ) {
        $( "#contenido" ).html( data );
         });
        }
        </script>
	</div>	

<?php
}
else
{
echo "<script>location.href='sesion.php';</script>";		
}

?>