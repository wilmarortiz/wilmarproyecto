<?php
session_start();
 ini_set('display_errors','1');
  error_reporting(E_ALL);
 
  if($_SESSION['AUTENTICADO']=='OK'and $_SESSION['id_tipopermitido']==1){
       if ($_POST)
       {

        include ('../../clases/conexion.php');
      //  require_once ('../../clases/productoVO.php');
        include ('../../clases/usuarioDAO.php');
        $conexion = new conexion();
        $usuarioDAO = new usuarioDAO($conexion);
        $productoVO = new productoVO();
        $productoVO->setid_producto($_POST['prod_id']);
        $productoVO->setdescripcion($_POST['prod_nombre']);
        $productoVO->setcategoria($_POST['categoria']);
        $productoVO->setvalor($_POST['prod_precio']);
        $productoVO->setcantidad($_POST['prod_cantidad']);
		$productoVO->sethectareas($_POST['hectareas']);
		
		

        // print_r($productoVO);exit();
        $resultado=$usuarioDAO->actualizarproducto($productoVO);

        if ($resultado==true)
        {
         echo '<div class="alert alert-success">Cabaña actualizado exitosamente</div>';
        }
        else
        {
           echo '<div class="alert alert-danger">Lo sentimos hubo un error al actualizar la cabaña</div>';
       }

       }
       else
        {
           echo '<div class="alert alert-danger">Dedes llenar los datos requeridos</div>';
        
       }

     }
     else
     {
 	    header('Location:../../index.php');
    }
?>
