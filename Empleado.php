<?php 
include_once "empleado.php";
class Empleado {

    public function setId($id) {
        $this->id = $id;
    }

    public function setNombre($nombre) {
        try {
            if (is_int($nombre)) {
                throw new Exception("Se espera un string para el Nombre");
            }else{
                $this->nombre = $nombre;
            }
        } catch (Exception $e) {
            echo $e->getMessage();
            die();
        }
    }

    public function setApellido($apellido) {
        try {
            if (is_int($apellido)) {
                throw new Exception("Se espera un string para el Apellido");
            }else{
                $this->apellido = $apellido;
            }
        } catch (Exception $e) {
            echo $e->getMessage();
            die();
        }
    }

    public function setEdad($edad) {
        try {
            if (!is_int($edad) || $edad <= 0) {
                throw new Exception("Para Edad se espera un valor entero positivo");
            }else{
                $this->edad = $edad;
            }
        } catch (Exception $e) {
            echo $e->getMessage();
            die();
        }
    }

    public function getId() {
        return $this->id;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getApellido() {
        return $this->apellido;
    }

    public function getEdad() {
        return $this->edad;
    }

    public static function mostrarEmpleados($empleados) { ?>
    
        <?php 
        /**
        * Muestra en pantalla los usuarios creados pero no insertados
        *
        * Es usado para visualizar la creacion de los empleados.
        *
        * @access public
        * @param array $empleados empleados cargados
        * @return void
        */
        ?>
        <table>
            <thead>
                <tr>
                    <th>id</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Edad</th>
                    <th>Cargo</th>
                    <th>Id Tecnologia</th>
                </tr>
            </thead>
        <tbody>
        <?php for ($i=0; $i < count($empleados) ; $i++) {
            if ($empleados[$i] instanceof Programador) { ?>
            <tr>
                <td><?= $empleados[$i]->id; ?></td>
                <td><?= $empleados[$i]->nombre;?></td>
                <td><?= $empleados[$i]->apellido;?></td>
                <td><?= $empleados[$i]->edad;?></td>
                <td><?=get_class($empleados[$i]);?> </td>
                <td><?= $empleados[$i]->lenguaje->nombre;?></td>
            </tr>
        <?php } elseif($empleados[$i] instanceof Disenador) { ?>
            <tr>
                <td><?= $empleados[$i]->id; ?></td>
                <td><?= $empleados[$i]->nombre;?></td>
                <td><?= $empleados[$i]->apellido;?></td>
                <td><?= $empleados[$i]->edad;?></td>
                <td><?=get_class($empleados[$i]);?></td>
                <td><?= $empleados[$i]->tipoDisenador->nombre;?></td>
            </tr>
        <?php } 
        }?>
        </tbody>
    </table>
<?php }
}?>