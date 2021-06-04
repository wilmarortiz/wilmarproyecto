
 <nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
       <a class="navbar-brand" href="#">
       <span style="color: black" class="glyphicon glyphicon-cog" aria-hidden="true"></span>
           TU HOSTAL</h1></a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="index.php">Inicio</a></li>
      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Categorias <span class="caret"></span></a>
        <ul class="dropdown-menu">
           <li><a href="CABAÑAS_AMPLIAS.php" >CABAÑAS AMPLIAS</a></li>
           <li><a href="CABAÑAS_ECONOMICAS.php" >CABAÑAS ECONOMICAS</a></li>
           <li><a href="CABAÑAS_VIP.php" >CABAÑAS VIP</a></li>
        </ul>
      </li>
               <li><a href="#" onclick="ruta('contacto.php')">Contacto</a></li>
    </ul>

  <?php if ($_SESSION['AUTENTICADO']=='OK'and $_SESSION['id_tipopermitido']==2){ ?>

    <ul class="nav navbar-nav navbar-right">

      <li><a href="vercarrito.php" ><span class="glyphicon glyphicon-shopping-cart"></span> </a></li>

      <li><a href="#" onclick="ruta('registro.php')"><span class="glyphicon glyphicon-user"></span> <?php echo $_SESSION['DATOS']['nombre'] ?></a></li>

      <li><a href="cerrar.php" ><span class="glyphicon glyphicon-log-in"></span> Salir</a></li>

    </ul>
    
  <?php 
      }else{ ?>

    <ul class="nav navbar-nav navbar-right">
      <li><a href="#" onclick="ruta('login.php')"><span class="glyphicon glyphicon-log-in"></span> Iniciar sesion</a></li>
      <li><a href="#" onclick="ruta('registro.php')"><span class="glyphicon glyphicon-user"></span> Registrate</a></li>
      
    </ul>
    <?php 
      } 
    ?>


  </div>
</nav>