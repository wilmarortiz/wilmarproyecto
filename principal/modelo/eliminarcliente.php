<?php
session_start();
ini_set('display_errors','1');
 error_reporting(E_ALL);
 if($_SESSION['AUTENTICADO']=='OK'and $_SESSION['id_tipopermitido']==1){

include('../../clases/conexion.php');
include('../../clases/usuarioDAO.php');
$conexion=new conexion();
$usuarioDAO=new usuarioDAO($conexion);
$id=$_POST['id_user'];
$res=$usuarioDAO->eliminarcliente($id);
if($res==true)
    {
    echo '<div class="alert alert-success">Cliente eliminado exitosamente</div>';
	// header('Location../cpanel.php');
	}
	else
	{
	echo '<div class="alert alert-danger">Lo sentimos hubo eun error al intentar eliminar al cliente</div>';
	}

?>

<?php
}else
{
 	header('Location:../index.php');
}
?>
