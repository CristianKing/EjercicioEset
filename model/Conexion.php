<?php
class Conexion{
    public $conectarme;

    public function conectar() {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        try {
            $this->conectarme =  mysqli_connect("localhost","root","","eset");
        } catch (mysqli_sql_exception $e) {
            die("Los datos de ingreso son incorrectos!");
        }
    }
}

