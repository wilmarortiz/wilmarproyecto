<?php
session_start();
 ini_set('display_errors','1');
  error_reporting(E_ALL);
   $_SESSION['permitido'];
    $_SESSION['id_tipopermitido'];
     if($_SESSION['permitido']=='ok'and $_SESSION['id_tipopermitido']==1){

      if (!empty($_POST)) {
         $id=htmlentities($_POST['id']);
         include('../../clases/conexion.php');
          include('../../clases/usuarioDAO.php');
           $conexion=new conexion();
            $usuarioDAO = new usuarioDAO($conexion);
            $resultado=$usuarioDAO->selecionarusuario($id);
            //<?php echo $res[0]->getdocumento();*/
 ?>

<div class="respuesta">

</div>

<div class="panel panel-default" style="margin-top:5px;">

  <div class="panel-heading">
 Ingrese la informacion del cliente
  </div>

  <div class="panel-body">
    <form role="form" id="datos_cliente">
      <input type="hidden" id="id_cliente" name="id_cliente" value="<?php echo $resultado[0]->getid_user() ?>">
    <div class="row">

      <div class="col-sm-4">
        <div class="form-group">
          <label for="pers_documento"> Documento </label>
          <input type="text" id="pers_documento" name="pers_documento" class="form-control
          validate[required, custom[onlyNumberSp]]" maxlength="15" value="<?php echo $resultado[0]->getdocumento();?>">
        </div>
      </div>

      <div class="col-sm-4">
        <div class="form-group">
          <label for="pers_nombre"> Nombre </label>
          <input type="text" id="pers_nombre" name="pers_nombre" class="form-control
          validate[required]" maxlength="50" value="<?php echo $resultado[0]->getnombre();?>">
        </div>
      </div>

       <div class="col-sm-4">
        <div class="form-group">
          <label for="pers_apellido">Apellido</label>
          <input type="text" id="pers_apellido" name="pers_apellido" class="form-control
          validate[required]" maxlength="50" value="<?php echo $resultado[0]->getapellido();?>">
        </div>
      </div>
    </div>

      <div class="row">

        <div class="col-sm-4">
        <div class="form-group">
          <label for="pers_genero">Genero</label>
          <select name="pers_genero" class="form-control validate[required]">
       		<option value="">Selecionar</option>
       		<option value="M">Masculino</option>
       		<option value="F">Femenino</option>
          </select>
         </div>
      </div>


       <div class="col-sm-4">
        <div class="form-group">
          <label for="direccion">Direccion</label>
          <input type="text" id="pers_direccion" name="pers_direccion" class="form-control
          validate[required]" maxlength="15" value="<?php echo $resultado[0]->getdireccion();?>">
        </div>
       </div>


      <div class="col-sm-4">
        <div class="form-group">
          <label for="email">E-mail</label>
          <input type="emal" id="pers_email" name="pers_email" class="form-control"
          maxlength="50" value="<?php echo $resultado[0]->getcorreo();?>">

        </div>
      </div>


    </div>


  <input type="button" class="btn btn-primary pull-right" onClick="actualizacliente()" value="Actualizar">

    </form>
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
function actualizacliente()
{
  if ($("#datos_cliente").validationEngine('validate'))
  {
    var datos=$('#datos_cliente').serialize();
    $.post('modelo/actualizarcliente.php',datos,function(respuesta){
      $('.respuesta').html(respuesta);
    });
  }
}
</script>
