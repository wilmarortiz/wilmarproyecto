<?php
//session_start();
 ini_set('display_errors','1');
  error_reporting(E_ALL);
   $_SESSION['permitido'];
    $_SESSION['id_tipopermitido'];
     if($_SESSION['permitido']=='ok'and $_SESSION['id_tipopermitido']==1){
       include('../clases/conexion.php');
        include('../clases/usuarioDAO.php');
         $conexion=new conexion();
          $usuarioDAO = new usuarioDAO($conexion);
          $resultado=$usuarioDAO->menosvendidos();

          if($resultado>0)
           {

 ?>
      <h2>Listado de cabañas Menos alquiladas</h2>
      <a  class="btn btn-success" href="modelo/imprimir.php?query=fgdf">Descargar <i class="glyphicon glyphicon-download" 
      aria-hidden="true"></i></a>
       <br>
      <table class="table table-hover">
        <br>
      <tr>
      <th>N°</th>
      <th>Cod. Producto</th>
      <th>Producto</th>
      <th>cantidad vendidad</th>
      <th>Total vendido</th>
      </tr>
      <?php


             for($i=0;$i<count($resultado);$i++)
             {
            $n=$i+1;
            echo"<tr>
                 <td>".$n."</td>
                   <td>".$resultado[$i]->getid_producto()."</td>
                   <td>".$resultado[$i]->getdescripcion()."</td>
                   <td>".$resultado[$i]->getcantidad()."</td>
                   <td id='red'>".$resultado[$i]->getsubtotal()."</td>

            </tr>";

      }



      ?>
      </table>


<?php
}else
{
  echo "No se han encontrado productos agotados";
}

 }
 else
 {
 	header('Location:../index.php');
 }
?>

<script>
  function Imprimir() {
    $.post("modelo/imprimir.php",function(respuesta){
      $('#contenido').html(respuesta);
    });
  }
</script>
