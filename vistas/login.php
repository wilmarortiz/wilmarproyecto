	<div class="row">

		<div class="col-xs-2"></div>

		<div class="col-xs-8">
<!-- 		 <h2 class="text-center">Bienvenido</h2>
 -->
		   <div class="panel panel-default">

			     <div class="panel-heading">
	             Iniciar sesión
			     </div>

			   <div class="panel-body">
			   <form role="form" method="POST" action="validar.php">

						 <div class="form-group">
					        <div class="input-group">
			  	            	<span class="input-group-addon">@</span>
					             <input type="text" id="correo" name="correo" class="form-control" placeholder="Correo">
						       </div>
						   </div>

						<div class="form-group">
					      <div class="input-group">
					        <div class="input-group-addon"><span id="iconoclave" class="glyphicon glyphicon-eye-open" onClick="verClave()" style="cursor:pointer"></span></div>
					         <input type="password" id="pass" name="pass" class="form-control" placeholder="Contaseña">
					        </div>
					     </div>

						<input  type="submit" value="Iniciar" id="submit" class="btn btn-primary">
			   </form>

			   </div>
		   </div>

		 </div>

	   <div class="col-xs-2"></div>

	</div>

	<script>
	var visto=true;

	function verClave(){

		if(visto)
		{
				$('#pass').attr('type','text');
					$('#iconoclave').removeClass('glyphicon glyphicon-eye-open');
							$('#iconoclave').addClass('glyphicon glyphicon-eye-close');
		}
		else
		{
			$('#pass').attr('type','password');
			$('#iconoclave').removeClass('glyphicon glyphicon-eye-close');
					$('#iconoclave').addClass('glyphicon glyphicon-eye-open');

		}
			visto=!visto;;
	}

	</script>