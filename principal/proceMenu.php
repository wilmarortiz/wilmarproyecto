<?php
session_start();
 ini_set('display_errors','1');
  error_reporting(E_ALL);
      if($_SESSION['AUTENTICADO']=='OK'and $_SESSION['id_tipopermitido']==1){
      $opcion=$_POST['ruta'];
      //echo $opcion;
      //exit;
     if ($opcion) {

      //inicio de mantenimiento
      if ($opcion=='updatecliente.php')
      {
        include('vista/updatecliente.php');
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
   }

 ?>
