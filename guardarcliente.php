<?php

session_start();
ini_set('display_errors','1');
error_reporting(E_ALL);

// if ( empty($_POST['nombre']) and 
//      empty($_POST['apellido']) and 
//      empty($_POST['documento']) and 
//      empty($_POST['sexo']) and 
//      empty($_POST['direccion']) and 
//      empty($_POST['correo'])  and 
//      empty($_POST['clave'])){

//  echo "<script>
//        alertify.alert('Atencion','Debes llenar los campos obligatorios!').set('', '').show(); 
//        </script>";
//        exit();
    
//     }
            
            if (!filter_var($_POST['correo'],FILTER_VALIDATE_EMAIL)){
            echo "<script>
            alertify.alert('Atencion','Formato de correo no valido').set('', '').show(); 
            </script>";
            exit();
            }

            include('clases/conexion.php');
            include('clases/usuarioDAO.php');
            $conexion=new conexion();
            $usuarioDAO=new usuarioDAO($conexion);
            $usuarioVO=new usuarioVO();
            $usuarioVO->setdocumento($_POST['documento']);
            $usuarioVO->setnombre($_POST['nombre']);
            $usuarioVO->setapellido($_POST['apellido']);
            $usuarioVO->setsexo($_POST['sexo']);
            $usuarioVO->setcorreo($_POST['correo']);
            $usuarioVO->setdireccion($_POST['direccion']);
            $usuarioVO->settelefono($_POST['telefono']);
            $usuarioVO->setpass($_POST['clave']);

            $respuestadocumento=$usuarioDAO->validadocumento($usuarioVO);
            if ($respuestadocumento==false) {
            echo "<script>
            alertify.alert('Atencion','El documento ingresado ya exite').set('', '').show(); 
            </script>";
            exit();
            }

            $respuestaguardarcliente=$usuarioDAO->guardarcliente($usuarioVO);

            if($respuestaguardarcliente==true)
            {   



             $respuestalogin=$usuarioDAO->consultarLogin($usuarioVO);

             if (count($respuestalogin)>0){

            $_SESSION['AUTENTICADO']='OK';
            $_SESSION['DATOS']=$respuestalogin;

            if($respuestalogin['id_tipo']==2){
          
               $_SESSION['id_tipopermitido']=$respuestalogin['id_tipo'];
               echo "<script>location.href='index.php';</script>";
               exit();
              }



            } 
            // fin login

            }
            // fin de registro del cliente



?>