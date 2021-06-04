<?php
// session_start();
//  ini_set('display_errors','1');
//   error_reporting(E_ALL);
//    $_SESSION['permitido'];
//     $_SESSION['id_tipopermitido'];
//     if ($_SESSION['permitido']=='ok'and $_SESSION['id_tipopermitido']==1) {
      $opcion=$_POST['ruta'];
      //echo $opcion;
      //exit;
     if ($opcion) {


      if ($opcion=='login.php')
      {
        include('vistas/login.php');
      }

      if ($opcion=='registro.php')
      {
        include('vistas/registro.php');
      }

      if ($opcion=='contacto.php')
      {
        include('vistas/contacto.php');
      }


      if($opcion=='updateproducto.php')
      {
        include('vista/updateproducto.php');
      }

      if($opcion=='newcliente.php')
      {
        include('vista/newcliente.php');
      }
      if ($opcion=='newproducto.php')
      {
        include('vista/newproducto.php');
      }
      //fin de mantenimiento

      //reportes
       if ($opcion=='productovendido.php')
      {
        include('vista/productovendido.php');
      }
       if ($opcion=='productomasvendido.php')
      {
        include('vista/productomasvendido.php');
      }

      if ($opcion=='estadoproducto.php')
      {

        include('vista/menosvendidos.php');
      }
       if ($opcion=='productagotado.php')
       {

        include('vista/productagotado.php');
      }
      //fin de reportes

      elseif ($opcion=='cerra.php')
      {
        header('Location:cerrar.php');
      }

     }
   // }

 ?>
