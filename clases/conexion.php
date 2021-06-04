<?php
ini_set('display_errors', '1');
error_reporting(E_ALL);

class conexion{

  private $conexion;
  private $resultado;

  public function __construct(){
    if(!isset($this->conexion)){
    $this->conexion = pg_connect("host=localhost port=5432 dbname=TuHostal user=postgres password=1234")
    or die ("error para conectarse a la base de datos");

    }

}


public function consulta($sql){

  $this->resultado=pg_query($this->conexion,$sql);

  }

public function extraerRegistros()
     {
  if($fila=pg_fetch_array($this->resultado))
      {
    return $fila;
    }
    else
    {
    return false;

      }
      }
//funcion para contar las filas
  public function cuentaFilas(){
    return pg_num_rows($this->resultado);
    }

    //funcion para ver las filas afectadas
    public function filasafectadas()
        {
      if(pg_affected_rows($this->resultado))
         {
        //exito
        return true;
        }
        else
        {
          //error
          return false;
          }
      }

    //funcion cerrar para cerrar la conecxion ala base de datos
    public function cerrar(){
      if(isset($this->conexion)){
        return pg_close($this->conexion);
        }

      }


}

 ?>
