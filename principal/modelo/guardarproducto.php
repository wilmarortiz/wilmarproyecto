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
        $productoVO = new productoVO();
        $productoVO->setdescripcion($_POST['prod_nombre']);
        $productoVO->setvalor($_POST['prod_precio']);
        $productoVO->setcantidad($_POST['prod_cantidad']);
        $productoVO->setruta($_POST['ruta_foto']);
        $productoVO->setcategoria($_POST['categoria']);
		$productoVO->sethectareas($_POST['hectareas']);
		
		 
        $resultado=$usuarioDAO->guardarproducto($productoVO);

        if ($resultado==true)
        {
        echo '<div class="alert alert-success">Cabaña agregada exitosamente</div>';
         
        }
        else
        {

       echo '<div class="alert alert-danger">Lo sentimos hubo un error al agregar la cabaña</div>';
       }

       }
       else
        {
          echo "Debes llenar los datos requeridos";
       }

     }
     else
     {
 	    header('Location:../index.php');
    }
?>
