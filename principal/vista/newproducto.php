<?php
//session_start();
ini_set( 'display_errors', '1' );
error_reporting( E_ALL );
if ( $_SESSION[ 'AUTENTICADO' ] == 'OK'
	and $_SESSION[ 'id_tipopermitido' ] == 1 ) {
	?>
	<div id="respuesta"></div>
	<div class="panel panel-default" style="margin-top:5px;">

		<div class="panel-heading">
			Ingrese la informacion de la cabaña
		</div>

		<div class="panel-body">
			<form role="form" id="datos_producto">

				<div class="row">

					<div class="col-sm-3">
						<div class="form-group">
							<label for="categoria">Categoria</label>
							<select id="selectbasic" name="categoria" class="form-control validate[required]">
								<option value="">Seleccionar categoria</option>

								<?php 

      include('../clases/conexion.php');
      include('../clases/usuarioDAO.php');
       
        $conexion=new conexion();
        $usuarioDAO=new usuarioDAO($conexion);

       $categoria=$usuarioDAO->listarcategoria();
       if($categoria){
      foreach ($categoria as $categoria) {

       ?>
								<option value="
    <?php
    echo $categoria['id_categoria']
    ?>
    ">
									<?php 
       echo $categoria['cate_nombre']
       ?>

								</option>
								<?php
								}
								}
								?>
							</select>
						</div>
					</div>

					<div class="col-sm-3">
						<div class="form-group">
							<label for="prod_nombre"> Nombre </label>
							<input type="text" id="prod_nombre" name="prod_nombre" class="form-control validate[required]" maxlength="50">
						</div>
					</div>

					<div class="col-sm-3">
						<div class="form-group">
							<label for="prod_precio">Precio</label>
							<input type="text" id="prod_precio" name="prod_precio" class="form-control
          validate[required, custom[onlyNumberSp]]" maxlength="50" onkeypress='return validaNumericos(event)'>
						</div>
					</div>

					<div class="col-sm-3">
						<div class="form-group">
							<label for="prod_cantidad">Cantidad</label>
							<input type="text" id="prod_cantidad" name="prod_cantidad" class="form-control
         validate[required, custom[onlyNumberSp]]" maxlength="50" onkeypress='return validaNumericos(event)'>
						</div>
					</div>
			<div class="col-sm-3">
						<div class="form-group">
							<label for="hectareas">Hectareas</label>
							<input type="text" id="hectareas" name="tamaño" class="form-control
         validate[required, custom[onlyNumberSp]]" maxlength="50" onkeypress='return validaNumericos(event)'>
						</div>
					</div>
					
					<div class="col-md-4" center>
						<input id="ruta_foto_file" name="ruta_foto_archivo" class="input-file" type="file" onChange="subir('ruta_foto','datos_producto')">
						<input type="hidden" name="ruta_foto" id="ruta_foto" value=""/>
						<div id="img"></div>
					</div>
				</div>

				<input type="button" class="btn btn-primary pull-right" onClick="guardarproducto()" value="Guardar">

			</form>
		</div>
	</div>
	<script>
		function guardarproducto() {
			if ( $( "#datos_producto" ).validationEngine( 'validate' ) ) {
				var datos = $( '#datos_producto' ).serialize();
				$.post( 'modelo/guardarproducto.php', datos, function ( respuesta ) {
					$( '#respuesta' ).html( respuesta );
					//  alertify.success(respuesta);
				} );
			}
		}


		function subir( elemento, formulario ) {
			//información del formulario
			var formData = new FormData( $( "#" + formulario )[ 0 ] );
			$.ajax( {

				// url: '../librerias/upload.php?archivo='+elemento+'_archivo',
				url: 'upload.php?archivo=' + elemento + '_archivo',
				type: 'POST',
				// Form data
				//datos del formulario
				data: formData,
				//necesario para subir archivos via ajax
				cache: false,
				contentType: false,
				processData: false,
				//una vez finalizado correctamente
				success: function ( data ) {


					if ( data == 'ERROR' ) {

						error( 'Este archivo no se puede subir' );
					} else {

						var arreglo = data.split( "." );
						if ( arreglo[ 1 ] == 'png' || arreglo[ 1 ] == 'jpg' ) {
							$( "#img" ).append( ' <img  id="ruta_foto_mostrar" class="img-thumbnail" style="width: 144px; height: 144px;">' );
							$( "#" + elemento + "_mostrar" ).attr( "src", "temporal/" + data + "" );
							$( "#" + elemento + "_mostrar" ).attr( "width", "144" );
							$( "#" + elemento + "_mostrar" ).attr( "height", "144" );
						}
						$( "#" + elemento ).val( data );
					}
				},
				error: function () {

					error( "Ha ocurrido un error" );
				}
			} );
		}

		function validaNumericos( event ) {
			if ( event.charCode >= 48 && event.charCode <= 57 ) {
				return true;
			}
			return false;
		}
	</script>
	<?php

} else {
	header( 'Location:../index.php' );
}
?>