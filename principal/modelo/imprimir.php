<?php
@session_start();
@session_name('Mipagina');
ini_set('display_errors','1');
error_reporting(E_ALL);
if($_SESSION['AUTENTICADO']=='OK'and $_SESSION['id_tipopermitido']==1){
$hoy = date('Y-m-d');
  include('../../clases/conexion.php');
   include('../../clases/usuarioDAO.php');
    $conexion=new conexion();
     $usuarioDAO = new usuarioDAO($conexion);
     $resultado=$usuarioDAO->productosvendidos();

require_once("../../dom/dompdf_config.inc.php");
 ?>

 <!--<link rel="stylesheet" href="../../css/bootstrap.min.css">
 -->

 <?php
 $codigoHTML='<h2>Listado de cabañas alquiladas</h2>
  <table width="100%" border="0">
  <tr >
  <td>Fecha: '.$hoy.'</td>
  </tr>
  </table>';

   $codigoHTML.='<table  width="100%" border="0" text-align: center;>
     <tr bgcolor="#E6E6FA">
     <th>#</th>
     <th>Cod. factura</th>
     <th>Cliente</th>
     <th>Producto</th>
     <th>Precio</th>
     <th>Cantidad</th>
     <th>Subtotal</th>
     </tr>';


if($resultado>0){
$n=0;
$totalvendido=0;
foreach ($resultado as $resultado) {
$totalvendido=$totalvendido+$resultado['cantidad']*$resultado['valor'];
$n=$n+1;
           
            $codigoHTML.='<tr>
                          <td>'.$n.'</td>
                          <td>'.$resultado["id_venta"].'</td>
                          <td>'.$resultado["documento"].'</td>
                          <td>'.$resultado["id_producto"].'</td>
                          <td>$ '.$resultado["valor"].'</td>
                          <td>'.$resultado["cantidad"].'</td>
                          <td>$ '.$resultado['cantidad']*$resultado['valor'].'</td>
                          </tr>';
}
}


     $codigoHTML.='<tr bgcolor="#E6E6FA">
                   <td colspan="6">Total:</td> 
                   <td  colspan="1">$ '.$totalvendido.'</td>
                   </tr>
                   </table>';
$codigoHTML = utf8_decode($codigoHTML);
$dompdf=new DOMPDF();
$dompdf->load_html($codigoHTML);
ini_set("memory_limit","128M");
$dompdf->render();
$pdf=$dompdf->output();
$dompdf->stream("Factura.pdf",array('Attachment' => 1));

  }
  else
  {
  header("Location:../../index.php");
  }
?>
