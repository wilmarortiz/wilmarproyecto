<?php
//session_start();
 ini_set('display_errors','1');
  error_reporting(E_ALL);
     if($_SESSION['AUTENTICADO']=='OK'and $_SESSION['id_tipopermitido']==1){
       include('../clases/conexion.php');
        include('../clases/usuarioDAO.php');
         $conexion=new conexion();
          $usuarioDAO = new usuarioDAO($conexion);
          $resultado=$usuarioDAO->productosvendidos();
          if($resultado>0)
           {

 ?>

       <h2>Listado de cabañas mas alquiladas</h2>
      <a  class="btn btn-success" href="modelo/imprimir.php?query=fgdf">Descargar <i class="glyphicon glyphicon-download" 
      aria-hidden="true"></i></a>
       <br>
      <table class="table table-bordered" style="">
      <br>
      <thead>
      <tr class="success">
      <th>N°</th>
      <th>Cod. factura</th>
      <th>Cliente</th>
      <th>Producto</th>
      <th>Precio</th>
      <th>Cantidad</th>
      <th>Subtotal</th>
      </tr>
      </thead>
      <tbody>
      <?php
          $n=0;
            $totalvendido=0;
             foreach ($resultado as $resultado) {

              $totalvendido=$totalvendido+$resultado['cantidad']*$resultado['valor'];

              $n=$n+1;

              ?>
             
              <tr>
                   <td><?php echo $n ?></td>
                   <td><?php echo $resultado['id_venta'] ?></td>
                   <td><?php echo $resultado['documento'] ?></td>
                   <td><?php echo $resultado['id_producto'] ?></td>
                   <td>$ <?php echo $resultado['valor'] ?></td>
                   <td><?php echo $resultado['cantidad'] ?></td>
                   <td>$ <?php echo $resultado['cantidad']*$resultado['valor']?></td>
                  </tr>

           
          <?php } ?>

         

                  <tr  bgcolor='#E6E6FA'>
                     <td colspan=6>Total:</td>
                     <td colspan=1>$ <?php echo $totalvendido; ?></td>
                  </tr>


        </tbody>
      </table>


<?php
}
else
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
    $.post("modelo/imprimir.php",function(respuesta){
      $('#contenido').html(respuesta);
    });
  }
</script>
