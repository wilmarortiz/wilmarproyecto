<?php
session_start();
 ini_set('display_errors','1');
  error_reporting(E_ALL);
 if($_SESSION['AUTENTICADO']=='OK'and $_SESSION['id_tipopermitido']==1){
     

       if ($_POST)
       {

        include ('../../clases/conexion.php');
        include ('../../clases/usuarioDAO.php');
        $conexion = new conexion();
        $usuarioDAO = new usuarioDAO($conexion);
        $usuarioVO= new usuarioVO();
        $usuarioVO->setid_user($_POST['pers_id']);
        $usuarioVO->setdocumento($_POST['pers_documento']);
        $usuarioVO->setnombre($_POST['pers_nombre']);
        $usuarioVO->setapellido($_POST['pers_apellido']);
        $usuarioVO->setgenero($_POST['pers_genero']);
        $usuarioVO->setdireccion($_POST['pers_direccion']);
        $usuarioVO->setcorreo($_POST['pers_email']);
        $usuarioVO->settelefono($_POST['pers_telefono']);

        //$respuesta=$usuarioDAO->validadocumento($usuarioVO);

        $resultado=$usuarioDAO->actualizarcliente($usuarioVO);
        //echo $resultado;
        if ($resultado==true)
        {           
          echo '<div class="alert alert-success">Cliente se actualizado exitosamente</div>';
        }
        else if($resultado==false)
        {
      echo '<div class="alert alert-danger">Lo sentimos hubo eun error al actualizar el cliente</div>';
        }

      /*  if ($respuesta==true)
         {

        }
        else
        {
          echo "Lo sentimos pero este usuario ya esta registrado";
        }*/


       }
       else
        {
          echo "Bedes llenar los datos requeridos";
       }

     }
     else
     {
 	    header('Location:../index.php');
     }
?>
