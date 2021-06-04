<?php
@session_start();
@session_name('Mipagina');
ini_set('display_errors','1');
error_reporting(E_ALL);
if($_SESSION['permitido']=='ok'and $_SESSION['id_tipopermitido']==1){
$hoy = getdate();
  //echo $hoy['mon'];
  //print_r($hoy);//  exit;
  include('../../clases/conexion.php');
   include('../../clases/usuarioDAO.php');
    $conexion=new conexion();
     $usuarioDAO = new usuarioDAO($conexion);
     $resultado=$usuarioDAO->menosvendidos();

require_once("../../dompdf/dompdf_config.inc.php");
 ?>

 <!--<link rel="stylesheet" href="../../css/bootstrap.min.css">
 -->

 <?php
 $codigoHTML='<h2>Listado de cabañas menos alquiladas</h2>
 <p></p>
  <table >
  <tr>
  <td><h3>Mes: '.$hoy['mon'].'</h3></td>
  <td><h3>Dia: '.$hoy['mday'].'</h3></td>
  <td><h3>Año: '.$hoy['year'].'</h3></td>
   <td><h3>Hora: '.$hoy['hours'].":".$hoy['minutes'].":".$hoy['seconds'].'</h3></td>
   </tr>
   </table>
     <table class="normal" border="0.5">
     <tr>
     <th>N°</th>
     <th>Cod. Producto</th>
     <th>Producto</th>
     <th>cantidad vendidad</th>
     <th>Total vendido</th>
     </tr>';


         if($resultado>0)
          {
            $lista=array();
            $lista=$resultado;
            for($i=0;$i<count($resultado);$i++)
            {
            $n=$i+1;
            $codigoHTML.='<tr>
                          <td>'.$n.'</td>
                          <td>'.$resultado[$i]->getid_producto().'</td>
                          <td>'.$resultado[$i]->getdescripcion().'</td>
                          <td>'.$resultado[$i]->getcantidad().'</td>
                          <td>'.$resultado[$i]->getsubtotal().'</td>
                          </tr>';
     }
   }

     $codigoHTML.='</table>';
$codigoHTML = utf8_decode($codigoHTML);
$dompdf=new DOMPDF();
$dompdf->load_html($codigoHTML);
ini_set("memory_limit","128M");
$dompdf->render();
$pdf=$dompdf->output();
file_put_contents("Factura.pdf", $pdf);
echo '<center><a href="modelo/Factura.pdf"  target="_blank" >Imprimir</a><center><BR>';
  }
  else
  {
  header("Location:../../index.php");
  }
?>
