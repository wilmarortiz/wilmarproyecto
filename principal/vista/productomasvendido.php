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
          $resultado=$usuarioDAO->productosmasvendidos();

          if($resultado>0)
           {

 ?>
      <h2>Listado de productos mas vendidos</h2>
      <button value='Actualizar' type='button' class='btn btn-primary btn-sm'
      onclick='Imprimir()' >
      <strong>Imprimir </strong><span class='glyphicon glyphicon-print'></span></button>
       <br>
      <table class="table table-hover">
        <br>
      <tr>
      <th>N°</th>
      <th>Cod. Producto</th>
      <th>descripcion</th>
      <th>cantidad Vendida</th>
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
                   <td>".$resultado[$i]->getsubtotal()."</td>

            </tr>";

      }



      ?>
      </table>


<?php
}else
{
  echo "No se han encontrado Compras realizadas";
}

 }
 else
 {
 	header('Location:../index.php');
 }
?>

<script>
  function Imprimir() {
    $.post("modelo/imprimirmasvendidos.php",function(respuesta){
      $('#contenido').html(respuesta);
    });
  }
</script>
