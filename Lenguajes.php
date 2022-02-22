<?php
include_once "model/conexion.php";
class Lenguajes extends Programador {
	public $lenguajesProg = array();

	public  function getLenguajesProg() {
		/**
        * obtengo los lenguajes de programacion
        *
        * Es usado para obtener los lenguajes disponibles en la base de datos. .
        *
        * @access public
        * @param 
        * @return array
        */
		$conexion =  new conexion;
        $conexion->conectar();
        $prepare = mysqli_prepare($conexion->conectarme, "SELECT * FROM tecnologias");
        $prepare->execute();
        $resultado = $prepare->get_result();
		
		while ($obj =  $resultado->fetch_object()){
			$this->lenguajesProg[] = $obj;
		};
		return $this->lenguajesProg;
	}
}
?>