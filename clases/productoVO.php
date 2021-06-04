<?php
 ini_set('display_errors', '1');
  error_reporting(E_ALL);

   class productoVO
   {

   	var $id_producto;
   	var $descripcion;
   	var $valor;
    var $cantidad;
	var $hectareas;
    var $ruta;
   	var $categoria;
    var $factura;
    var $cliente;
    var $subtotal;
    var $fecha;

    function getid_producto()
	  {
		return $this->id_producto;
		}
		function setid_producto($id_producto2)
		{
		$this->id_producto=$id_producto2;
		}


		function getdescripcion()
	    {
		return $this->descripcion;
		}
		function setdescripcion($descripcion2)
		{
		$this->descripcion=$descripcion2;
		}


		function getvalor()
	    {
		return $this->valor;
		}
		function setvalor($valor2)
		{
		$this->valor=$valor2;
		}
	   
	

    function getcantidad()
      {
    return $this->cantidad;
    }
    function setcantidad($cantidad2)
    {
    $this->cantidad=$cantidad2;
    }
	   
	   function gethectareas()
      {
    return $this->hectareas;
    }
    function sethectareas($hectareas2)
    {
    $this->hectareas=$hectareas2;
    }

    function getruta()
    {
    return $this->ruta;
    }
    function setruta($ruta2)
    {
    $this->ruta=$ruta2;
    }

    function getcliente()
	    {
		return $this->cliente;
		}
		function setcliente($cliente2)
		{
		$this->cliente=$cliente2;
		}

    function getcategoria()
	    {
		return $this->categoria;
		}
		function setcategoria($categoria2)
		{
		$this->categoria=$categoria2;
		}

		function getfactura()
	    {
		return $this->factura;
		}
		function setfactura($factura2)
		{
		$this->factura=$factura2;
		}

    function getsubtotal()
      {
    return $this->subtotal;
    }
    function setsubtotal($subtotal2)
    {
    $this->subtotal=$subtotal2;
    }

    function gettotalvendido()
      {
    return $this->totalvendido;
    }
    function settotalvendido($totalvendido2)
    {
    $this->totalvendido=$totalvendido2;
    }

    function getfecha()
      {
    return $this->fecha;
    }
    function setfecha($fecha2)
    {
    $this->fecha=$fecha2;
    }

    }
