<?php
include_once 'empleado.php';
include_once "tipoDisenador.php";
class Disenador extends Empleado {
    public $id;
    public $nombre;
    public $apellido;
    public $edad;
    public $tipoDisenador;

    public function setTipoDisenador($ind = false) {
        /**
        * Seteo el atributo tipoDisenador
        *
        * Es usado para setear los distintos tipos de diseñador.
        *
        * @access public
        * @param array $ind opcion del tipo de diseñador a setear
        * @return void
        */
        try {
            if (!is_int($ind) || $ind < 0 || $ind > 4 ) {
                throw new Exception("Para setear el lenguaje se espera un valor entero positivo menor a 5");
            }else{
                if (!$ind) {
                    $ind = rand(3,4);
                }
                $tipoDisenador = new TipoDisenador();
                $tipoDisenador->getDisenadorTipos();
                $this->tipoDisenador = $tipoDisenador->tipoDisenador[$ind];
            }
        } catch (Exception $e) {
            echo $e->getMessage();
            die();
        }
    }
}