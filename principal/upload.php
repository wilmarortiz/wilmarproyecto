<?php

$nombre_variable=$_GET["archivo"];

// echo $nombre;exit();

//obtenemos el archivo a subir
$file = $_FILES[$nombre_variable]['name'];
list($nombre_imagen,$tipo_imagen)=explode('.',$file);
$nombre_imagen=date('YmdHis').'.'.$tipo_imagen;

//comprobamos si existe un directorio para subir el archivo
//si no es así, lo creamos
if(!is_dir("temporal/"))
{
   mkdir("temporal/", 0777);
}
 
//comprobamos si el archivo ha subido
if($file && move_uploaded_file($_FILES[$nombre_variable]['tmp_name'],"temporal/".$nombre_imagen))
{
   echo $nombre_imagen;//devolvemos el nombre del archivo para pintar la imagen
}
?>