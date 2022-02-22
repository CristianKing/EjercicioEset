<?php
class TipoDisenador {
	public $tipoDisenador = array();
	
    public  function getDisenadorTipos() {
		$conexion =  new conexion;
        $conexion->conectar();
        $prepare = mysqli_prepare($conexion->conectarme, "SELECT * FROM tecnologias");
        $prepare->execute();
        $resultado = $prepare->get_result();
		
		while ($obj =  $resultado->fetch_object()){
			$this->tipoDisenador[] = $obj;
		};
		return $this->tipoDisenador;
	}
}

?>