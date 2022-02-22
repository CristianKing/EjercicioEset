<?php
include_once "empleado.php";
include_once "lenguajes.php";
class Programador extends Empleado {
    public $id;
    public $nombre;
    public $apellido;
    public $edad;
    public $lenguaje;

    public function setLenguajeProgramador($ind) {
        /**
        * Seteo el atributo lenguaje 
        *
        * Es usado para setear los distintos lenguajes de programacion .
        *
        * @access public
        * @param array $ind opcion del lenguaje a setear
        * @return void
        */
        try {
            if (!is_int($ind) || $ind < 0) {
                throw new Exception("Para setear el lenguaje se espera un valor entero positivo");
            }else{
                $lenguajes = new Lenguajes;
                $lenguajes->getLenguajesProg();
                $this->lenguaje = $lenguajes->lenguajesProg[$ind];
            }
        } catch (Exception $e) {
            echo $e->getMessage();
            die();
        }
    }
}
?>
