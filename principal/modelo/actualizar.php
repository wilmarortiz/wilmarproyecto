<?php
//session_start();
 ini_set('display_errors','1');
  error_reporting(E_ALL);
  if (!empty($_POST['id'])) {
  
      include('../../clases/conexion.php');
      include('../../clases/usuarioDAO.php');
      $conexion=new conexion();
      $usuarioDAO = new usuarioDAO($conexion);
      $resultado=$usuarioDAO->listarcliente2($_POST['id']);


        foreach ($resultado as $resultado) {
 ?>

<div class="respuesta">

</div>

<div class="panel panel-default" style="margin-top:5px;">

  <div class="panel-heading">
 Actualizar la informacion del cliente
  </div>

  <div class="panel-body">
    <form role="form" id="datos_cliente">

    <div class="row">

      <div class="col-sm-4">
        <div class="form-group">
          <input type="hidden" value="<?php echo $_POST['id'];?>" name="pers_id">
          <label for="pers_documento"> Documento </label>
          <input type="text" id="pers_documento" name="pers_documento" class="form-control
          validate[required, custom[onlyNumberSp]]" maxlength="15" value="<?php echo $resultado['documento'] ?>">
        </div>
      </div>

      <div class="col-sm-4">
        <div class="form-group">
          <label for="pers_nombre"> Nombre </label>
          <input type="text" id="pers_nombre" name="pers_nombre" class="form-control
          validate[required]" maxlength="50" value="<?php echo $resultado['nombre'] ?>">
        </div>
      </div>

       <div class="col-sm-4">
        <div class="form-group">
          <label for="pers_apellido">Apellido</label>
          <input type="text" id="pers_apellido" name="pers_apellido" class="form-control
          validate[required]" maxlength="50" value="<?php echo $resultado['apellido'] ?>">
        </div>
      </div>
    </div>

      <div class="row">

        <div class="col-sm-4">
        <div class="form-group">
          <label for="pers_genero">Genero</label>
          <select name="pers_genero" class="form-control validate[required]">
          <option value="<?php echo $resultado['sexo'] ?>"><?php echo $resultado['sexo'] ?></option>
          <option value="1">Hombre</option>
          <option value="2">Mujer</option>
          </select>
         </div>
      </div>


       <div class="col-sm-4">
        <div class="form-group">
          <label for="pers_direccion">Direccion</label>
          <input type="text" id="pers_direccion" name="pers_direccion" class="form-control
          validate[required]" maxlength="15" value="<?php echo $resultado['direccion'] ?>">
        </div>
       </div>


      <div class="col-sm-4">
        <div class="form-group">
          <label for="pers_email">E-mail</label>
          <input type="emal" id="pers_email" name="pers_email" maxlength="50" class="form-control
          validate[required]"  value="<?php echo $resultado['correo'] ?>">
        </div>
      </div>


    </div>


    <div class="row">
      <div class="col-sm-4">
        <div class="form-group">
            <label for="pers_telefono">Telefono</label>
            <input type="emal" id="pers_telefono" name="pers_telefono" class="form-control" maxlength="50" value="<?php echo $resultado['telefono'] ?>">
            </div>
      </div>
    </div>


  <input type="button" class="btn btn-primary pull-right" onClick="guardarcliente()" value="Actualizar">

    </form>
  </div>


<?php
 // }
 // else
 // {
 //  header('Location:../index.php');
 // }
       }

    }
?>
<script>
function guardarcliente()
{
  if ($("#datos_cliente").validationEngine('validate'))
  {
    var datos=$('#datos_cliente').serialize();
    alert(datos);
    $.post('modelo/actualizarcliente.php',datos,function(respuesta){
     $('.respuesta').html(respuesta);

    });
  }
}
</script>
