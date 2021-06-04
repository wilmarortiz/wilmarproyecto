<?php
session_start();
ini_set('display_errors','1');
error_reporting(E_ALL);

 if(!empty($_POST['pass']) and !empty($_POST['correo'])){

  include('clases/conexion.php');
   include('clases/usuarioDAO.php');

     $correo=$_POST['correo'];
      $pass=$_POST['pass'];


      // echo $correo."+".$pass;exit();

      $conexion=new conexion();
       $usuarioDAO = new usuarioDAO($conexion);
        $usuarioVO = new usuarioVO();
         $usuarioVO->setcorreo($correo);
          $usuarioVO->setpass($pass);

          $resultado=$usuarioDAO->consultarLogin($usuarioVO);
          $conexion->cerrar();

          // print_r($resultado);exit();
         // echo $resultado['nombre'];exit();

          if ($resultado>0) {

            $_SESSION['AUTENTICADO']='OK';
            $_SESSION['DATOS']=$resultado;

           
              if($resultado['id_tipo']==1){
                $_SESSION['id_tipopermitido']=$resultado['id_tipo'];
                header("Location:./principal/cpanel.php");
                // alertify.success('Administrador');
                exit();
              }

              if($resultado['id_tipo']==2){
                $_SESSION['id_tipopermitido']=$resultado['id_tipo'];
                echo "<script>location.href='index.php';</script>";
                exit();
              }



          }
          else
           {
          /*   echo "<script>
                   alertify.alert('Atencion', 'Correo o contraseña incorrectos!').set('', '').show();
                   </script>";
*/
                // echo "Correo o contraseña incorrectos";
                $_SESSION['mensaje']="Correo o contraseña incorrectos";
                echo "<script>location.href='sesion.php';</script>";
                exit();
           }

}
else
{
echo "Los campos estan vacios";
}
 ?>
