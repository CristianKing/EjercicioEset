<?php
include_once 'model/conexion.php';

class Empresa {
    private $id;
    private $nombre;
    private $empleados = array();

    function __construct($id, $nombre) {
        try {
            if (!is_int($id) || $id <= 0) {
                throw new Exception("Id de Empresa se espera un valor entero positivo");
            }else{
                $this->id = $id;
                $this->nombre = $nombre;
            }

        } catch (Exception $e) {
            echo $e->getMessage();
            die();
        }
    }

    public function getId() {
        echo $this->id."<br>";
    }

    public function getNombre() {
        echo $this->nombre."<br>";
    }    

    public function addEmpleado() {
        /**
        * inserto los empleados.
        *
        * Inserta en la base de datos uno o mas empleados previamente cargados .
        *
        * @access public
        * @param 
        * @return void
        */

        $conexion =  new conexion;
        $conexion->conectar();
        for ($i=0; $i < count($this->empleados) ; $i++) {

            $prepare = mysqli_prepare($conexion->conectarme, "INSERT INTO empleados(nombre, apellido, edad, id_tipo_empleado, tecnologia) VALUES (?,?,?,?,?)");
          
            if($this->empleados[$i] instanceof Programador){
                $tipo = 1; // Cod Programador
                $tecnologia =  $this->empleados[$i]->lenguaje->id;
                $prepare->bind_param("ssiii", $this->empleados[$i]->nombre, $this->empleados[$i]->apellido, $this->empleados[$i]->edad, $tipo,  $tecnologia);
            }else{
                $tipo = 2;// Cod Disenador
                $tecnologia =  $this->empleados[$i]->tipoDisenador->id;
                $prepare->bind_param("ssiii", $this->empleados[$i]->nombre, $this->empleados[$i]->apellido, $this->empleados[$i]->edad, $tipo, $tecnologia);
            }
            $prepare->execute();
            $prepare->close();
            
            /*
            Preparado para extender el proyecto
            $prepare->execute();
            $insert_id = $prepare->insert_id;
            $prepare->close();
            $area = 1; // Sistemas
            $prepare = mysqli_prepare($conexion->conectarme, "INSERT INTO area_general(id_area, id_empleado) VALUES (?,?)");
            $prepare->bind_param("ii", $area, $insert_id);
            $prepare->execute();
            $insert_id_area = $prepare->insert_id;
            $id_empresa = 1;//ESET;
            $prepare = mysqli_prepare($conexion->conectarme, "INSERT INTO empresas_general(id_empresa, id_area_general) VALUES (?,?)");
            $prepare->bind_param("ii",  $id_empresa, $insert_id_area);
            $prepare->execute();
            $prepare->close();
            $prepare = mysqli_prepare($conexion->conectarme, "INSERT INTO tecnologia_aplica(id_tipo_empleado, id_tecnologia) VALUES (?,?)");
            $prepare->bind_param("ii", $tipo, $tecnologia);
            $prepare->execute();
            $prepare->close();
            */
        }
        $conexion->conectarme->close();
    }

    public function addEmpleados($empleados) {
        for ($i=0; $i < count($empleados) ; $i++) {
            array_push($this->empleados, $empleados[$i]);
        }
    }

    public function getEmpleados() {
        /**
        * Obtengo los empleados cargados
        *
        * Es usado para mostrar loe empleados cargados en esta clase .
        *
        * @access public
        * @param
        * @return void
        */
        for ($i=0; $i < count($this->empleados) ; $i++) { ?>
            <table>
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Edad</th>
                        <th>Id Cargo</th>
                        <th>Id Tecnologia</th>
                    </tr>
                </thead>
            <tbody>
        <?php for ($i=0; $i < count($this->empleados) ; $i++) {
                if ($this->empleados[$i] instanceof Programador) { ?>
                <tr>
                    <td><?= $this->empleados[$i]->id; ?></td>
                    <td><?=$this->empleados[$i]->nombre;?></td>
                    <td><?= $this->empleados[$i]->apellido;?></td>
                    <td><?= $this->empleados[$i]->edad;?></td>
                    <td> 1 </td>
                    <td><?= $this->empleados[$i]->lenguaje->id;?></td>
                </tr>
        <?php } elseif($this->empleados[$i] instanceof Disenador) { ?>
                <tr>
                    <td><?= $this->empleados[$i]->id; ?></td>
                    <td><?=$this->empleados[$i]->nombre;?></td>
                    <td><?= $this->empleados[$i]->apellido;?></td>
                    <td><?= $this->empleados[$i]->edad;?></td>
                    <td>2</td>
                    <td><?= $this->empleados[$i]->tipoDisenador->id;?></td>
                </tr>
        <?php } 
            }?>
            </tbody>
        </table>
    <?php }
    }
    
    public static function getEmpleadoById($id) {
        $conexion =  new conexion;
        $conexion->conectar();
        $prepare = mysqli_prepare($conexion->conectarme, "SELECT em.id, em.nombre, em.apellido,  em.edad, emt.empleado_tipo, tec.nombre AS tnombre FROM empleados AS em LEFT JOIN empleado_tipo AS emt ON emt.id = em.id_tipo_empleado LEFT JOIN tecnologias AS tec ON tec.id = em.tecnologia where em.id = ?");
        $prepare->bind_Param('i', $id);
        $prepare->execute();
        $resultado = $prepare->get_result();
        return $resultado;
    }

    public static function getEdadPromedio() {
        $conexion =  new conexion;
        $conexion->conectar();
        $prepare = mysqli_prepare($conexion->conectarme, "SELECT CAST(AVG(edad) AS INT) AS Promedio FROM empleados");
        $prepare->execute();
        $resultado = $prepare->get_result(); 
        return $resultado;
    }

    public static function mostrarTodosEmpleados() {
        $conexion =  new conexion;
        $conexion->conectar();
        $prepare = mysqli_prepare($conexion->conectarme, "SELECT em.id, em.nombre, em.apellido,  em.edad, emt.empleado_tipo, tec.nombre AS tnombre FROM empleados AS em LEFT JOIN empleado_tipo AS emt ON emt.id = em.id_tipo_empleado LEFT JOIN tecnologias AS tec ON tec.id = em.tecnologia;
        ");
        $prepare->execute();
        $resultado = $prepare->get_result(); 
        return $resultado;
    }
}