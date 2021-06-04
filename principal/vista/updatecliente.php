<?php
// session_start();
 ini_set('display_errors','1');
  error_reporting(E_ALL);
  if($_SESSION['AUTENTICADO']=='OK'and $_SESSION['id_tipopermitido']==1){
   include('../clases/conexion.php');
    include('../clases/usuarioDAO.php');
     $conexion=new conexion();
      $usuarioDAO = new usuarioDAO($conexion);
      $resultado=$usuarioDAO->listarcliente();

      // print_r($resultado);exit();
 ?>
<div class="respuesta">

</div>
 <h2>Listado de clientes</h2>
<table class="table table-bordered">
<tr class="success">
  <th>
    N°
  </th>
<th>Nombre</th>
<th>Apellidos</th>
<th>Genero</th>
<th>direccion</th>
<th>E-mail</th>
<th>Aciones</th>
</tr>
<?php

    if($resultado>0)
     {
      $n=0;
      foreach ($resultado as $resultado) 
       {
      $n=$n+1;

      ?>
      <tr>
           <td><?php echo $n; ?></td>
             <td><?php echo $resultado['nombre']; ?></td>
             <td><?php echo $resultado['apellido']; ?></td>
		         <td><?php echo $resultado['sexo']; ?></td>
             <td><?php echo $resultado['direccion']; ?></td>
		         <td><?php echo $resultado['correo']; ?></td>
            <td>
			<button value='Actualizar' type='button' class='btn btn-primary btn-sm' onclick='actualizar("<?php echo $resultado['id_user']; ?>")' >
      <strong>Actualizar</strong><span class='glyphicon glyphicon-pencil'></span></button>

			<button value='Actualizar' type='button' class='btn btn-danger btn-sm 'onclick='eliminar("<?php echo $resultado['id_user']; ?>")' >
      <strong>Eliminar</strong><span class='glyphicon glyphicon-remove'></span></button>
          </td>
		   </tr>
      

       <?php
}
}
else
{
  echo "No se han encontrado clientes";
}

?>
</table>


<?php

 }
 else
 {
 	header('Location:../index.php');
 }
?>




<script>
	function actualizar(id)
	{  
		$.post('modelo/actualizar.php',{'id':id},function(respuesta)
		{
		 $('#contenido').html(respuesta);
		});
	}

	function eliminar(id){
     alertify.confirm("Confirmacion","Esta seguro de querer eliminar este cliente.",
     function(){

	   $.post( "modelo/eliminarcliente.php",{'id_user':id}, function( data ) {
        $( ".respuesta" ).html( data );
        alertify.success("Usuario eliminado");
   	  });
  },
  function(){
    alertify.error('Usuario no eliminado');
  });
  }
</script>
