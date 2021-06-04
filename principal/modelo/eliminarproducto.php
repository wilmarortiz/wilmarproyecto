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
$res=$usuarioDAO->eliminarproducto($id);
if($res==true)
    {
    echo "Producto eliminado exitosamente";
	//	header('Location:../cpanel.php');
	}
	else
	{
		echo "Lo sentimos ah ocurriodo un error al eliminar el cliente.";
	}

?>

<?php
}else
{
 	header('Location:../../index.php');
}
?>
