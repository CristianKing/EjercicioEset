<style type="text/css">
    table, th, td {
    border: 1px solid black;
    }
</style>
<?php
    include_once "empleado.php";
    include_once "programador.php";
    include_once "disenador.php";
    include_once "empresa.php";

    //IMPORTANTE! Leer readme_es.txt.
        $empleados = array();

        //Inicializo Empresa
        $empresa = new Empresa(1,'ESET');
        //$empresa->getId();
        echo 'EMPRESA: ';
        $empresa->getNombre();
        echo '--------------------------------------------------------------------------------------'.'<br>';
        echo '<b>Empleados Creados</b>'.'<br>';

    // Descomentar esta seccion para agregar un PROGRAMADOR.
    
        // Creo Empleado 1 (Programador)
        $empleado = new Programador();
        $empleado->setId(1);
        //Set Nombre
        $empleado->setNombre('Gabriel');
        //Set Apellido
        $empleado->setApellido('sciancalepore');
        //Set Edad
        $empleado->setEdad(30);
        //Ingrese un valor numerico en la variable para cambiar el lenguaje de programacion
        // 0 -> PHP, 1 -> .NET 2-> PYTHON
        $tipo = 2;
        $empleado->setLenguajeProgramador($tipo);

        //Agrego Enpleado a mi array de Empleados para insertar
        array_push($empleados, $empleado);
    
    //DESCOMENTAR ESTA SECCION PARA CREAR DISEÑADOR.
/*
        //Creo Empleado 2 (DISEÑADOR)
        $empleado2 = new Disenador();
        $empleado2->setId(2);
        //Set Nombre
        $empleado2->setNombre('Rodrigo');
        //Set Apellido
        $empleado2->setApellido('borquez');
        //Set Edad
        $empleado2->setEdad(34);
        //Ingrese un valor numerico en la variable para cambiar el tipo de diseñador
        // 3 -> GRAFICO, 4->WEB
        $tipo = 3;
        $empleado2->setTipoDisenador($tipo);
        //Agrego Enpleado a mi array de Empleados para insertar.
        array_push($empleados, $empleado2);
    */
    //DESCOMENTAR ESTA SECCION PARA VISUALIZAR EN PANTALLA LOS EMPLEADOS CREADOS PERO AUN NO INSERTADOS.
    
        //Muestro Empleados creados 
        Empleado::mostrarEmpleados($empleados);
    

        

    //CARGA PREVIA DE DATOS A INSERTAR - DESCOMENTAR PARA INSERTAR.

        echo '--------------------------------------------------------------------------------------'.'<br>';
        echo '<b>Empleados insertados en DB</b>'.'<br>';

        //Agrego Empleados Creados a mi Empresa
        $empresa->addEmpleados($empleados);

        //Muestro en pantalla los Empleados a insertar en DB
        $empresa->getEmpleados();

        //Inserto Empleados en DB
        $empresa->addEmpleado();
    

    //LISTADO DE EMPLEADOS EN DB - DESCOMENTAR PARA VISUALIZAR.
    
        echo '--------------------------------------------------------------------------------------'.'<br>';
        echo '<b>Listado de empleados en DB</b>'.'<br>';

        //Muestro Listado de empleados en DB
        $empleados_empresa = Empresa::mostrarTodosEmpleados();

    
    ?>
    <table>
            <thead>
                <tr>
                    <th>id</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Edad</th>
                    <th>Cargo</th>
                    <th>Tipo</th>
                </tr>
            </thead>
        <tbody>
    <?php while ($obj = $empleados_empresa->fetch_object()) { ?>
            <tr>
                <td><?= $obj->id; ?></td>
                <td><?= $obj->nombre;?></td>
                <td><?= $obj->apellido;?></td>
                <td><?= $obj->edad;?></td>
                <td><?= $obj->empleado_tipo;?></td>
                <td><?= $obj->tnombre;?></td>
            </tr>
        <?php }?>
        </tbody>
    </table>
    <?php 

    //DESCOMENTAR ESTA SESSION PARA BUSCAR EMPLEADO POR ID.

         // Busco Empleado por Id.
        echo '--------------------------------------------------------------------------------------'.'<br>';
        echo '<b>Listado de empleado buscado por ID en DB</b>'.'<br>';

        //Cambiar el valor de la variable($id) para obtener un nuevo empleado por ID.
        $id = 2;
        $empleado = Empresa::getEmpleadoById($id);
        
        ?>
        <table>
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Edad</th>
                        <th>Cargo</th>
                        <th>Tipo</th>
                    </tr>
                </thead>
            <tbody>
        <?php while ($obj = $empleado->fetch_object()) { ?>
                <tr>
                    <td><?= $obj->id; ?></td>
                    <td><?= $obj->nombre;?></td>
                    <td><?= $obj->apellido;?></td>
                    <td><?= $obj->edad;?></td>
                    <td><?= $obj->empleado_tipo;?></td>
                    <td><?= $obj->tnombre;?></td>
                </tr>
            <?php }?>
            </tbody>
        </table>
    
    <?php

    //DESCOMENTAR ESTA SECCION PARA OBTENER EL PROMEDIO DE EDAD DE LOS EMPLEADOS
    

        echo '--------------------------------------------------------------------------------------'.'<br>';
        echo '<b>Resultado del cálculo de la edad promedio: </b>'.'<br>';

        $edad_promedio = Empresa::getEdadPromedio();
        $obj = $edad_promedio ->fetch_object();
        ?>  
        <table>
            <thead>
                <tr>
                    <th>Edad Promedio</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?= $obj->Promedio;?> Años</td>
                </tr>
            </tbody>
        </table>
    


