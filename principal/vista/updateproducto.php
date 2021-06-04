<?php
//session_start();
 ini_set('display_errors','1');
  error_reporting(E_ALL);
  if($_SESSION['AUTENTICADO']=='OK'and $_SESSION['id_tipopermitido']==1){
       include('../clases/conexion.php');
        include('../clases/usuarioDAO.php');
         $conexion=new conexion();
          $usuarioDAO = new usuarioDAO($conexion);
           $resultado=$usuarioDAO->listarproducto();
 ?>

<h2>Listado de productos</h2>
<table class="table table-bordered">
<tr class="success">
  <th>N°</th>
  <th>Codigo</th>
  <th>Descripcion</th>
  <th>Categoria</th>
  <th>valor</th>
  <th>C. Disponible</th>
  <th>Aciones</th>
  </tr>
<?php

	     if($resultado>0){
            $n=0;
            foreach ($resultado as $resultado)
             {
              $n=$n+1;

              ?>
           <tr>
            <td><?php echo $n ?></td>
            <td><?php echo $resultado["id_producto"] ?></td>
            <td><?php echo $resultado["nombre"] ?> </td>
            <td><?php echo $resultado["cate_nombre"] ?></td>
            <td><?php echo $resultado["valor"] ?> </td>
            <td><?php echo $resultado["cantidad"] ?> Unidades</td>
           
           
             
                <td>
			<button value='Actualizar' type='button' class='btn btn-primary btn-sm' onclick='actualizar("<?php echo $resultado["id_producto"] ?>")' ><strong>Actualizar</strong><span class='glyphicon glyphicon-pencil'></span></button>

			<button value='Actualizar' type='button' class='btn btn-danger btn-sm 'onclick='eliminar("<?php echo $resultado["id_producto"] ?>")' ><strong>Eliminar</strong><span class='glyphicon glyphicon-remove'></span></button>
                </td>
		   </tr>

<?php
	    	}
	 	 //fin for
	     }
			 //fin si resultado>0

		else
			{
			    echo "No se han agregado productos";
	  ?>
			    <br>
				 <button type='button' class='btn btn-primary btn-sm pull-left'
				 onclick='redirecnuevo("newproducto.php")'>Nuevo
				 <span class='glyphicon glyphicon-plus'>
				 </span></button>
         <br>
<?php
			
    }

?>
</table>

<?php

 }
 else
 {
 	header('Location:../index.php');
 }
 //fin valida usuario
 ?>

<script>
	function actualizar(id)
	{
	    //alert('function');
		$.post('modelo/actualizarproductofinal.php',{'id':id},function(respuesta)
		{
		$('#contenido').html(respuesta);
		});
	}



	function eliminar(id){
     alertify.confirm("Confirmacion","Esta seguro de querer eliminar este producto.",
     function(){
      alertify.success("Producto eliminado");
	   $.post( "modelo/eliminarproducto.php",{'id_user':id}, function( data ) {
        $( "#contenido" ).html( data );
   	  });

     },
    function(){
    alertify.error('Producto no eliminado');
    });
  }


 function redirecnuevo(ruta)
  {
    alert();
    $.post('proceMenu.php',{'ruta':ruta},function(respuesta)
    {
      $('#contenido').html(respuesta);
    });
  }
</script>
