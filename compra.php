<?php
session_start();
//session_name('Mipagina');
ini_set('display_errors','1');
error_reporting(E_ALL);
use Dompdf\Dompdf;


if($_SESSION['AUTENTICADO']=='OK'and $_SESSION['id_tipopermitido']==1){
  header("Location:principal/cpanel.php");
  exit();
}

if($_SESSION['AUTENTICADO']=='OK'and $_SESSION['id_tipopermitido']==2){
    $r=0;
     $datos=$_SESSION['carrito'];
      $valortotal=0;
       for($i=0;$i<count($datos);$i++){
        $valortotal+=$datos[$i]['Cantidad']*$datos[$i]['Precio']; 
 }
      $campos="(id_user,valor)";

      $datos="('".$_SESSION['DATOS']['id_user']."','".$valortotal."')";   
      
      $sSql="insert into principal.venta $campos values $datos  ";  

      include ("clases/conexion.php");
   
      $conexion= new conexion();
    
      $res= new Compra($conexion);
 
      $f=$res->insertar($sSql);
  
      $datosCarro=$_SESSION['carrito'];
 
      if($f==true){
      
        $Sql="SELECT * FROM principal.venta ORDER BY id_venta ASC" ;
      
         $res2=$res->consultar($Sql);

           for($i=0;$i<count($datosCarro);$i++){

           $campos="(id_venta,id_producto,cantidad,precio,id_user)";
          
           $datos="('".$res2."',
           '".$datosCarro[$i]['Id']."',
           '".$datosCarro[$i]['Cantidad']."',
           '".$datosCarro[$i]['Precio']."',
           '".$_SESSION['DATOS']['id_user']."')";     
 
           $sSql="insert into principal.detalle $campos values $datos "; 
 
           $f2=$res->insertar($sSql);   
 
          }  //fin for


          // for para descontar la cantidad la de producto

          for ($i=0; $i <count($datosCarro) ; $i++) { 
            $id_producto=$datosCarro[$i]['Id'];
           
            $query="SELECT cantidad FROM principal.producto WHERE id_producto='$id_producto'" ;

            $res2=$res->consultar2($query);


            $cantidadfinal=$res2-$datosCarro[$i]['Cantidad'];


            $query2="UPDATE principal.producto
                     SET cantidad = '$cantidadfinal'
                     WHERE id_producto='$id_producto';";

            $respuesta=$res->insertar($query2);


            
          } // fin for         
          

          if($f2==true){

           unset($_SESSION['carrito']); 
     
           echo '<center><h3>¡Gracias por su compra!</h3></center><br>';
      
            require_once("dompdf/autoload.inc.php");
            require_once 'dompdf/lib/html5lib/Parser.php';
            require_once 'dompdf/lib/php-font-lib/src/FontLib/Autoloader.php';
            require_once 'dompdf/lib/php-svg-lib/src/autoload.php';
            require_once 'dompdf/src/Autoloader.php';
            //Dompdf\Autoloader::register();
      
$codigoHTML='<h1>Alquiler De Cabañas</h1>';

 $fecha=date('Y-m-d');

$codigoHTML.="<table width='100%'' border='0'>
              <tr bgcolor='#E6E6FA'>
              <td collpan=2>Factura No: $res2</td>
              <td collpan=2>Fecha: $fecha</td>
              </tr>

              <tr>
              <td collpan=2>Cliente: ".$_SESSION['DATOS']['nombre']." ".$_SESSION['DATOS']['apellido']."
              </td>
              <td collpan=2>Documento: ".$_SESSION['DATOS']['documento']."</td>
              </tr>

              <tr>
              <td collpan=2>Direccion: ".$_SESSION['DATOS']['direccion']."</td>
              <td collpan=2>Telefono: ".$_SESSION['DATOS']['telefono']."</td>
              </tr>

              </table>";


$codigoHTML.='<table width="100%" border="0">
              <tr bgcolor="#E6E6FA">
              <td>#</td>
              <td>Nombre</td>
              <td>Cantidad</td>
              <td>Precio</td>
              <td>Subtotal</td>
              </tr>';
    
      $g=0; $gt=0; $n=0;
      for($i=0; $i<count($datosCarro); $i++){
      $g= $datosCarro[$i]['Precio']*$datosCarro[$i]['Cantidad'];
      $gt+=$g;
      $n=$n+1;
         $codigoHTML.='<tr>
                       <td>'.$n.'</td>
                       <td>'.$datosCarro[$i]['Nombre'].'</td>
                       <td>'.$datosCarro[$i]['Cantidad'].'</td>
                       <td>$ '.$datosCarro[$i]['Precio'].'</td>
                       <td>$ '.$g.'</td>
                       </tr>'
                       ;
 
 }
     $codigoHTML.="<tr bgcolor='#E6E6FA'>
                   <td colspan='4'>Valor Total:</td>
                    <td colspan='1'> $gt</td>
                   </tr>";
     $codigoHTML.='</table>
                    </body>
                    </html>';
                    
$codigoHTML = utf8_decode($codigoHTML);
$dompdf=new Dompdf();
$dompdf->set_option('defaultFont', 'Roboto-Regular.ttf');
$dompdf->load_html($codigoHTML);
ini_set("memory_limit","128M");
$dompdf->render();
$pdf=$dompdf->output();
file_put_contents("Factura.pdf", $pdf);    
echo '<center><a href="Factura.pdf"  target="_blank" >Imprimir Factura</a><center><BR>'

. '<div class="container"><input  type="button" class="btn btn-success " value="Seguir viendo" onclick="ver()"></div>';

      
  }   
 }
 
 }
else
{
 echo "<script>location.href='sesion.php';</script>";	
}
 
 class Compra{
 
 var $miConexion;
  
    function __construct($conexion){
		$this->miConexion=$conexion;
                
	}
        function consultar($consulta){
        $todo='';
        $rs = $this->miConexion->consulta($consulta);
	     	while($dato=$this->miConexion->extraerRegistros()) {
	     	$todo=$dato[0];
       
        }
        
         return $todo;
       }

        function consultar2($consulta){
        $datos='';
        $rs = $this->miConexion->consulta($consulta);
        while($dato=$this->miConexion->extraerRegistros()) {
        $datos=$dato[0];
        }
        
         return $datos;
       }


         function insertar($sql){        
			   $rs = $this->miConexion->consulta($sql);        
				 $afectado = $this->miConexion->filasAfectadas();
         return $afectado;
         }
 
 }
?>

