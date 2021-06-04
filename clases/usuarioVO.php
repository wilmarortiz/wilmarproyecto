<?php
ini_set('display_errors', '1');
error_reporting(E_ALL);

class usuarioVO
    {

  	var $id_user;
  	var $documento;
    var $nombre;
    var $apellido;
    var $sexo;
   	var $genero;
    var $direccion;
    var $telefono;
    var $correo;
    var $pass;
    var $id_tipo;

	    function getid_user()
	    {
		return $this->id_user;
		}
		function setid_user($id_user2)
		{
		$this->id_user=$id_user2;
		}


	    function getnombre()
	    {
		return $this->nombre;
		}
		function setnombre($nombre2)
		{
		$this->nombre=$nombre2;
		}

	    function getdocumento()
	    {
		return $this->documento;
		}
		function setdocumento($documento2)
		{
		$this->documento=$documento2;
		}



	     function getapellido()
	    {
		return $this->apellido;
		}
		function setapellido($apellido2)
		{
		$this->apellido=$apellido2;
		}

		 function getsexo()
	    {
		return $this->sexo;
		}
		function setsexo($sexo2)
		{
		$this->sexo=$sexo2;
		}

	     function getgenero()
	    {
		return $this->genero;
		}
		function setgenero($genero2)
		{
		$this->genero=$genero2;
		}





	  function getpass()
	  {
		return $this->pass;
		}
		function setpass($pass2)
		{
		$this->pass=$pass2;
		}



	  function getcorreo()
	  {
		return $this->correo;
		}
		function setcorreo($correo2)
		{
		$this->correo=$correo2;
		}


		function getdireccion()
	    {
		return $this->direccion;
		}
		function setdireccion($direccion2)
		{
		$this->direccion=$direccion2;
		}

		function gettelefono()
	    {
		return $this->telefono;
		}
		function settelefono($telefono2)
		{
		$this->telefono=$telefono2;
		}

		function getid_tipo()
	    {
		return $this->id_tipo;
		}
		function setid_tipo($id_tipo2)
		{
		$this->id_tipo=$id_tipo2;
		}




	}





?>
