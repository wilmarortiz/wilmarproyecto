<!DOCTYPE html>

<html>

<head>

  <meta charset="utf-8">

  <title>div centrado verticalmente y horizontalmente</title>

  <style>

  .contenedor

  {

    width:700px;

    height:700px;

    line-height:300px;

    border:2px solid;

    text-align:center;

  }

  .contenedor>span {

    display:inline-block;

    vertical-align:middle;

    line-height:normal;

  }

  </style>

</head>

<center><body>

  <div class='contenedor'>

    <span><div id="datosaenviar"></div>
<div class="container animated bounceInRight">
  <div class="row">
    <div class="col-sm-6">
      <H3><b>Crea tu Cuenta</b></H3>
      <p><b>Para puedas disfrutarde las mejores promociones, que tenemos para ti.</b></p>
      <p class=""><b>Los campos que tengo es simbolo (<span style="color: red">*</span>) son obligatorios</b></p>
      <form id="DatosUsuario"  class="" >

      <label for="documento" class="control.label">Documento<span class="red">*</span></label>  
      <input  type="text" class="form-control" id="documento" name="documento">
      <br>
      <label for="nombre" class="control.label" >Nombre<span class="red">*</span></label>  
      <input  type="text" class="form-control" id="nombre" name="nombre" >
       <br>
       <label for="apellido" class="control.label" >Apellido<span style="color: red">*</span></label>
       
       <input type="text" class="form-control"   id="apellido" name="apellido" >
       <br>
       
       <label for="sexo" class="control.label" >Genero<span style="color: red">*</span></label>
       <br>
       
        <select name="sexo" id="sexo" class="form-control">
        <option value=" ">Seleccionar</option>
       
            <option value="Hombre">Hombre</option>
            <option value="Mujer">Mujer</option>
       </select>
       <br>
     
       <label for="telefono" class="control.label" >telefono<!-- <span class="red">*</span> --></label>
            <input type="text" class="form-control" id="telefono" name="telefono" onkeypress='return validaNumericos(event)'>  
          
      <br>
       <label for="direccion" class="control.label" >Direccion<span style="color: red">*</span></label>
      <input type="text" class="form-control"   id="direccion" name="direccion">
       <br>
       <label for="correo" class="control.label">Correo<span style="color: red">*</span></label>
            <input type="text" class="form-control"  id="correo" name="correo" >
      
      <br>
      <label for="clave" class="control.label" id="clave">Contraseña<span style="color: red">*</span></label>
            <input type="password" class="form-control"   id="clave" name="clave">
    
            <br>
</center>
         <center> <div class="container">
            <button type="button" id="datos" class="btn btn-success" value="" onclick="guardar()">Crear cuenta  <span class="glyphicon glyphicon-user"></span></button></center>
           </div>  

      
  </span>

    </div>
    </div>
    </div>
  </div>


    <script>
      function validaNumericos(event) {
        if(event.charCode >= 48 && event.charCode <= 57){
        return true;
        }
        return false;        
      }
    </script>

     <script type="text/javascript">

          
              
              function guardar(){
                    var datos=$('#DatosUsuario').serialize();
                    $.post("guardarcliente.php",datos,function(data){
                    $("#datosaenviar").html(data);
                    });
                      
              }

        </script> 
</body>

</html>

