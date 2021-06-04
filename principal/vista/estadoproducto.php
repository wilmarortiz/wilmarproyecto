<?php
//session_start();
 ini_set('display_errors','1');
  error_reporting(E_ALL);
   $_SESSION['permitido'];
    $_SESSION['id_tipopermitido'];
     if($_SESSION['permitido']=='ok'and $_SESSION['id_tipopermitido']==1){
 ?>

<?php

 }
 else
 {
 	header('Location:../index.php');
 }
?>