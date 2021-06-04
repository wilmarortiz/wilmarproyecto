<?php
session_start();
 ini_set('display_errors','1');
  error_reporting(E_ALL);

  if($_SESSION['AUTENTICADO']=='OK'and $_SESSION['id_tipopermitido']==1){

      if (!empty($_POST)) {
         $id=htmlentities($_POST['id']);
         include('../../clases/conexion.php');
          include('../../clases/usuarioDAO.php');
           $conexion=new conexion();
            $usuarioDAO = new usuarioDAO($conexion);
            $respuesta=$usuarioDAO->seleccionarproducto($id);
            //<?php echo $res[0]->getdocumento();*/
 ?>
 <div id="respuesta"></div>
 <div class="panel panel-default" style="margin-top:5px;">

 <div class="panel-heading">
 Ingrese la informacion de la cabaña
 </div>

 <div class="panel-body">
   <form role="form" id="datos_producto">

   <div class="row">


     <div class="col-sm-3">
       <div class="form-group">
         <label for="prod_nombre"> Nombre </label>
         <input type="hidden" value="<?php echo $id ?>" name="prod_id">
         <input type="text" id="prod_nombre" name="prod_nombre" class="form-control validate[required]"
         maxlength="50" value="<?php echo $respuesta[0]->getdescripcion() ?>">
       </div>
     </div>

      <div class="col-sm-3">
       <div class="form-group">
        <label for="categoria">Categoria</label>
        <select id="selectbasic" name="categoria" class="form-control validate[required]">
        <option value="">Seleccionar categoria</option>

      <?php 

       $categoria=$usuarioDAO->listarcategoria();
       if($categoria){
      foreach ($categoria as $categoria) {

       ?>
    <option value="
    <?php
    echo $categoria['id_categoria']
    ?>
    ">
       <?php 
       echo $categoria['cate_nombre']
       ?>
         
       </option>
       <?php
       }
       }
      ?>
       </select>
      </div>
     </div>

      <div class="col-sm-3">
       <div class="form-group">
         <label for="prod_precio">Precio</label>
         <input type="text" id="prod_precio" name="prod_precio" class="form-control
         validate[required, custom[onlyNumberSp]]" maxlength="50" value="<?php echo $respuesta[0]->getvalor() ?>">
       </div>
     </div>

     <div class="col-sm-3">
      <div class="form-group">
        <label for="prod_cantidad">Cantidad</label>
        <input type="text" id="prod_cantidad" name="prod_cantidad" class="form-control
        validate[required, custom[onlyNumberSp]]" maxlength="50" value="<?php echo $respuesta[0]->getcantidad() ?>">
      </div>
    </div>
	<div class="col-sm-3">
      <div class="form-group">
        <label for="hectareas">Hectareas</label>
        <input type="text" id="hectareas" name="hectareas" class="form-control
        validate[required, custom[onlyNumberSp]]" maxlength="50" value="<?php echo $respuesta[0]->gethectareas() ?>">
      </div>
   

   </div>

 <input type="button" class="btn btn-primary pull-right" onClick="actualizarproducto()" value="Actualizar">

   </form>
 </div>
 </div>
<?php
  }
  else
  {
  header('Location:../../index.php');
}
 }
 else
 {
 	header('Location:../../index.php');
 }
?>
<script>
function actualizarproducto()
{
  if ($("#datos_producto").validationEngine('validate'))
  {

    var datos=$('#datos_producto').serialize();
    $.post('modelo/actualizacionproducto.php',datos,function(respuesta){
      $('#respuesta').html(respuesta);
    });
  }
}
</script>
