<?php
include( 'usuarioVO.php' );
include( 'productoVO.php' );

class usuarioDAO {
	function __construct( $conexion ) {
		$this->conexion = $conexion;
	}

	function consultarLogin( $usuarioVO ) {

		$sql = "SELECT * FROM principal.usuario WHERE correo='" . $usuarioVO->getcorreo() . "' and
          pass='" . $usuarioVO->getpass() . "'";


		$rs = $this->conexion->consulta( $sql );
		$cantidad = $this->conexion->cuentaFilas( $rs );
		if ( $cantidad > 0 ) {
			while ( $row = $this->conexion->extraerRegistros() ) {

				return $row;
			}

		} else {
			return 0;
		}
	}


	function listarcliente() {
		$lisda = array();
		$sql = "SELECT *
           FROM principal.usuario WHERE id_tipo='2' AND activo='SI'";
		$rs = $this->conexion->consulta( $sql );
		$cantidad = $this->conexion->cuentaFilas( $rs );
		if ( $cantidad > 0 ) {
			while ( $row = $this->conexion->extraerRegistros() ) {

				$lista[] = $row;
			}

			return $lista;

		} else {
			return 0;
		}
	}

	function listarcliente2( $id ) {
		$lisda = array();
		$sql = "SELECT * FROM principal.usuario WHERE id_tipo='2' AND activo='SI' AND id_user='$id'";

		$rs = $this->conexion->consulta( $sql );
		$cantidad = $this->conexion->cuentaFilas( $rs );
		if ( $cantidad > 0 ) {
			while ( $row = $this->conexion->extraerRegistros() ) {

				$lista[] = $row;
			}

			return $lista;

		} else {
			return 0;
		}
	}



	function listarcategoria() {
		$lista = array();
		$sql = "SELECT * FROM principal.categoria";
		$rs = $this->conexion->consulta( $sql );

		$cantidad = $this->conexion->cuentaFilas( $rs );
		if ( $cantidad > 0 ) {
			while ( $row = $this->conexion->extraerRegistros() ) {

				$lista[] = $row;
			}
			return $lista;
		} else {
			return 0;
		}
	}


	function listarproducto() {
		$lisda = array();
		$sql = "SELECT * FROM 
                principal.producto a, principal.categoria b 
                WHERE activo='SI' 
                AND a.id_categoria=b.id_categoria";
		$rs = $this->conexion->consulta( $sql );
		$cantidad = $this->conexion->cuentaFilas( $rs );

		if ( $cantidad > 0 ) {
			while ( $row = $this->conexion->extraerRegistros() ) {

				$lista[] = $row;
			}

			return $lista;

		} else {
			return 0;
		}
	}


	function listarproductoespecifico( $id ) {
		$lisda = array();
		$sql = "SELECT * FROM 
                principal.producto a, principal.categoria b 
                WHERE activo='SI' 
                AND a.id_categoria=b.id_categoria
                AND a.id_categoria='$id'";
		$rs = $this->conexion->consulta( $sql );
		$cantidad = $this->conexion->cuentaFilas( $rs );

		if ( $cantidad > 0 ) {
			while ( $row = $this->conexion->extraerRegistros() ) {

				$lista[] = $row;
			}

			return $lista;

		} else {
			return 0;
		}
	}

	function listarproductoperfumes() {
		$lisda = array();
		$sql = "SELECT * FROM 
                principal.producto a, principal.categoria b 
                WHERE activo='SI' 
                AND a.id_categoria=b.id_categoria
                AND a.id_categoria='5'";
		$rs = $this->conexion->consulta( $sql );
		$cantidad = $this->conexion->cuentaFilas( $rs );

		if ( $cantidad > 0 ) {
			while ( $row = $this->conexion->extraerRegistros() ) {

				$lista[] = $row;
			}

			return $lista;

		} else {
			return 0;
		}
	}



	function eliminarcliente( $id ) {

		$sql = "UPDATE principal.usuario SET activo='NO' WHERE id_user='" . $id . "'";

		$rs = $this->conexion->consulta( $sql );
		$afectados = $this->conexion->filasafectadas();
		if ( $afectados ) {
			return true;
		} else {
			return false;
		}


	}


	function eliminarproducto( $id ) {
		$sql1 = "";
		$sql = "DELETE FROM principal.producto WHERE id_producto='" . $id . "'";
		//echo $sql;
		$rs = $this->conexion->consulta( $sql );
		$afectados = $this->conexion->filasafectadas();

		if ( $afectados ) {
			return true;

		} else {
			return false;
		}
	}

	function productosvendidos() {

		$lista = array();

		$sql = "SELECT * FROM principal.venta a, principal.detalle b, principal.usuario c
            WHERE a.id_venta=b.id_venta
            AND b.id_user=c.id_user";

		$rs = $this->conexion->consulta( $sql );
		$cantidad = $this->conexion->cuentaFilas( $rs );
		if ( $cantidad > 0 ) {

			while ( $row = $this->conexion->extraerRegistros() ) {

				$lista[] = $row;
			}

			return $lista;

		} else {
			return false;
		}

	}


	function productosmasvendidos() {
		$lista = array();

		$sql = "SELECT * FROM principal.masvendidos";

		$rs = $this->conexion->consulta( $sql );
		$cantidad = $this->conexion->cuentaFilas( $rs );
		if ( $cantidad > 0 ) {

			while ( $row = $this->conexion->extraerRegistros() ) {
				$productoVO = new productoVO();
				$productoVO->setid_producto( $row[ "id_producto" ] );
				$productoVO->setdescripcion( $row[ "descripcion" ] );
				$productoVO->setcantidad( $row[ "cantidad" ] );
				$productoVO->setsubtotal( $row[ "total" ] );

				$lista[] = $productoVO;
			}

			return $lista;

		} else {
			return false;
		}


	}


	function productosagotados() {
		$lista = array();

		$sql = "SELECT * FROM principal.agotados";

		$rs = $this->conexion->consulta( $sql );
		$cantidad = $this->conexion->cuentaFilas( $rs );
		if ( $cantidad > 0 ) {

			while ( $row = $this->conexion->extraerRegistros() ) {
				$productoVO = new productoVO();
				$productoVO->setid_producto( $row[ "id_producto" ] );
				$productoVO->setdescripcion( $row[ "descripcion" ] );
				$productoVO->setvalor( $row[ "valor" ] );
				$productoVO->setcantidad( $row[ "cantidad" ] );
				$lista[] = $productoVO;
			}

			return $lista;

		} else {
			return false;
		}

	}


	function menosvendidos() {
		$lista = array();

		$sql = "SELECT * FROM principal.menosvendidos";

		$rs = $this->conexion->consulta( $sql );
		$cantidad = $this->conexion->cuentaFilas( $rs );
		if ( $cantidad > 0 ) {

			while ( $row = $this->conexion->extraerRegistros() ) {
				$productoVO = new productoVO();
				$productoVO->setid_producto( $row[ "id_producto" ] );
				$productoVO->setdescripcion( $row[ "descripcion" ] );
				$productoVO->setcantidad( $row[ "cantidad" ] );
				$productoVO->setsubtotal( $row[ "total" ] );
				$lista[] = $productoVO;
			}

			return $lista;

		} else {
			return false;
		}

	}

	function selecionarusuario( $id ) {
		$sql = "SELECT * FROM principal.producto WHERE id_producto='" . $id . "'";
		$rs = $this->conexion->consulta( $sql );
		$cantidad = $this->conexion->cuentaFilas( $rs );
		if ( $cantidad > 0 ) {
			while ( $row = $this->conexion->extraerRegistros() ) {
				$usuarioVO = new usuarioVO();

				$usuarioVO->setid_user( $row[ "id_cliente" ] );
				$usuarioVO->setdocumento( $row[ "documento" ] );
				$usuarioVO->setnombre( $row[ "nombre" ] );
				$usuarioVO->setapellido( $row[ "apellido" ] );
				// $usuarioVO->setedad($row["edad"]);
				$usuarioVO->setgenero( $row[ "genero" ] );
				$usuarioVO->setdireccion( $row[ "direccion" ] );
				//$usuarioVO->setpass($row["pass"]);
				$usuarioVO->setcorreo( $row[ "email" ] );
				//$usuarioVO->setid_tipo($row["id_tipo"]);
				$lista[] = $usuarioVO;
			}
			return $lista;
		} else {
			return 0;
		}
	}

	function seleccionarproducto( $id ) {
		$lisda = array();
		$sql = "SELECT * FROM principal.producto a, principal.categoria b WHERE a.id_producto='$id'
          AND a.id_categoria=b.id_categoria";
		$rs = $this->conexion->consulta( $sql );
		$cantidad = $this->conexion->cuentaFilas( $rs );

		if ( $cantidad > 0 ) {
			while ( $row = $this->conexion->extraerRegistros() ) {
				$productoVO = new productoVO();
				$productoVO->setid_producto( $row[ "id_producto" ] );
				$productoVO->setdescripcion( $row[ "nombre" ] );
				$productoVO->setcantidad( $row[ "cantidad" ] );
				$productoVO->setvalor( $row[ "valor" ] );
				$productoVO->setruta( $row[ "imagen" ] );
				$productoVO->setcategoria( $row[ "cate_nombre" ] );
				$productoVO->sethectareas( $row[ "hectareas" ] );
				
				

				$lista[] = $productoVO;
			}

			return $lista;

		} else {
			return 0;
		}
	}


	function guardarproducto( $productoVO ) {
		$sql = "INSERT INTO principal.producto(nombre,imagen,valor,cantidad,activo,id_categoria,hectareas)
          VALUES('" . $productoVO->getdescripcion() . "',
          '" . $productoVO->getruta() . "',
          '" . $productoVO->getvalor() . "',
          '" . $productoVO->getcantidad() . "',
          'SI',
          '" . $productoVO->getcategoria() . "',
		  '" . $productoVO->gethectareas() . "')";


		//echo($sql);exit;


		$rs = $this->conexion->consulta( $sql );
		$afectados = $this->conexion->filasafectadas();

		if ( $afectados ) {
			return true;
		} else {
			return false;
		}
	}

	public
	function validadocumento( $usuarioVO ) {
		$sql = "SELECT * FROM principal.usuario WHERE documento='" . $usuarioVO->getdocumento() . "'";

		$rs = $this->conexion->consulta( $sql );
		$cantidad = $this->conexion->cuentaFilas( $rs );

		if ( $cantidad > 0 ) {
			return false;
		} else {
			return true;
		}
	}

	function guardarcliente( $usuarioVO ) {
		$sql = "INSERT INTO principal.usuario(
                                    documento,
                                    nombre,
                                    apellido,
                                    sexo,
                                    direccion,
                                    correo,
                                    pass,
                                    id_tipo,
                                    activo)
                        VALUES('" . $usuarioVO->getdocumento() . "',
                               '" . $usuarioVO->getnombre() . "',
                               '" . $usuarioVO->getapellido() . "',
                               '" . $usuarioVO->getsexo() . "',
                               '" . $usuarioVO->getdireccion() . "',
                               '" . $usuarioVO->getcorreo() . "',
                               '" . $usuarioVO->getpass() . "',
                               2,
                               'SI')";

		$rs = $this->conexion->consulta( $sql );
		$afectados = $this->conexion->filasafectadas();

		if ( $afectados ) {
			return true;
		} else {
			return false;
		}

	}


	function actualizarcliente( $usuarioVO ) {
		$sql = "UPDATE principal.usuario
              SET nombre='" . $usuarioVO->getnombre() . "',
                  apellido='" . $usuarioVO->getapellido() . "',
                  sexo='" . $usuarioVO->getgenero() . "',
                  direccion='" . $usuarioVO->getdireccion() . "',
                  correo='" . $usuarioVO->getcorreo() . "',
                  telefono='" . $usuarioVO->gettelefono() . "',
                  documento='" . $usuarioVO->getdocumento() . "'
              WHERE id_user='" . $usuarioVO->getid_user() . "'";

		//  echo $sql;
		$rs = $this->conexion->consulta( $sql );
		$afectados = $this->conexion->filasafectadas();

		if ( $afectados ) {
			return true;
		} else {
			return false;
		}
	}

	function actualizarproducto( $productoVO ) {
		$sql = "UPDATE principal.producto
              SET nombre='" . $productoVO->getdescripcion() . "',
                  valor='" . $productoVO->getvalor() . "',
                  cantidad='" . $productoVO->getcantidad() . "',
                  id_categoria='" . $productoVO->getcategoria() . "',
				  hectareas='" . $productoVO->gethectareas() . "'
				  
            WHERE id_producto='" . $productoVO->getid_producto() . "'";

		$rs = $this->conexion->consulta( $sql );
		$afectados = $this->conexion->filasafectadas();

		if ( $afectados ) {
			return true;
		} else {
			return false;
		}
	}

	//   function guardarcliente($usuarioVO)
	//   {
	//   $sql="INSERT INTO 
	//   principal.usuario(nombre,
	//                     apellido,
	//                     direccion,
	//                     telefono,
	//                     pass,
	//                     correo,
	//                     id_tipo,
	//                     sexo)
	// values('".$usuarioVO->getnombre()."',
	//        '".$usuarioVO->getapellido()."',
	//        '".$usuarioVO->getdireccion()."',
	//        '".$usuarioVO->gettelefono()."',
	//        '".$usuarioVO->getpass()."',
	//        '".$usuarioVO->getcorreo()."',
	//        '".$usuarioVO->getid_tipo()."',
	//        '".$usuarioVO->getsexo()."')";

	//   // echo($sql);exit();

	//       $rs=$this->conexion->consulta($sql);
	//       $afectados=$this->conexion->filasafectadas();

	//       if($afectados){
	//          return true;
	//          }else{
	//           return false;
	//          }
	//        }



}

?>