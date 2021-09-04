<?php

require_once("../modelo/conection.php");
require_once("../modelo/query.php");

$consulta = new Query; //Consulta
$tipoFiltro = $_POST["tipoBusqueda"]; //Tipo de filtro
$fitro = $_POST["filtro"]; //Filtro
$rolActivo = $_POST["rolActivo"]; //Rol del usuario

//Se hace la consulta según el filtro que estamos aplicando
switch ($tipoFiltro) {
    case 'usuario':
        $usuarios = $consulta->searchUserByUsername($fitro);
        break;

    case 'nombre':
        $usuarios = $consulta->searchUserByName($fitro);
        break;

    case 'apellido':
        $usuarios = $consulta->searchUserByLastName($fitro);
        break;

    case 'rol':
        $usuarios = $consulta->searchUserByRol($fitro);
        break;
    
    default:
        $usuarios = $consulta->searchUserByUsername($fitro);
        break;
}

//Se escribe las consultas en filas
if(!empty($usuarios)){
    //Se recorre el array
    for ($i=0; $i < count($usuarios); $i++) { 
        //Variables
        $id = $usuarios[$i]["idUsuario"];
        $username = $usuarios[$i]["usuario"];
        $nombres = $usuarios[$i]["nombres"];
        $apellidos = $usuarios[$i]["apellidos"];
        $email = $usuarios[$i]["email"];
        $rol = $usuarios[$i]["rol"];

        //Escritura según el rol del usuario activo
        if($rolActivo == "a"){
            echo "<tr class='lol'>";
            echo "\t<td class='p-4'>" . $username . "</td>";
            echo "\t<td class='p-4'>" . $nombres . "</td>";
            echo "\t<td class='p-4'>" . $apellidos . "</td>";
            echo "\t<td class='p-4'>" . $email . "</td>";

            //Según el rol del usuario a escribir se hacen ciertas acciones
            switch ($rol) {
                case 'a':
                    echo "\t<td class='p-4'>Administrador</td>";
                    if($username == "Admin"){
                        echo "\t<td class='p-4' colspan='2'>No se puede modificar</td>";
                    }else{
                        echo "\t<td class='p-4' colspan='2'><a href='deleteUser.php?iduser=" . $id . "' class='hover:text-blue-900 btn-delete'><span class='icon-cross'></span> Eliminar</a></td>";
                    }
                    break;
                case 'c':
                    echo "\t<td class='p-4'>Técnico-Científico</td>";
                    echo "\t<td class='p-4' colspan='2'><a href='deleteUser.php?iduser=" . $id . "' class='hover:text-blue-900 btn-delete'><span class='icon-cross'></span> Eliminar</a></td>";
                    break;
                case 'j':
                    echo "\t<td class='p-4'>Jurado</td>";
                    echo "\t<td class='p-4'><a href='assignJury.php?iduser=" . $id . "' class='hover:text-blue-900'><span class='icon-pencil'></span> Asignar Proyectos</a></td>";
                    echo "\t<td class='p-4'><a href='deleteUser.php?iduser=" . $id . "' class='hover:text-blue-900 btn-delete'><span class='icon-cross'></span> Eliminar</a></td>";
                    break;
            }
            echo "</tr>";
        }else{
            //Roles activos que no sean admin
            if($rol != "a"){
                echo "<tr class='lol'>";
                echo "\t<td class='p-4'>" . $username . "</td>";
                echo "\t<td class='p-4'>" . $nombres . "</td>";
                echo "\t<td class='p-4'>" . $apellidos . "</td>";
                echo "\t<td class='p-4'>" . $email . "</td>";

                //Según el rol del usuario a escribir se hacen ciertas acciones
                switch ($rol) {
                    case 'c':
                        echo "\t<td class='p-4'>Técnico-Científico</td>";
                        echo "\t<td class='p-4' colspan='2'>No se puede modificar</td>";
                        break;
                    case 'j':
                        echo "\t<td class='p-4'>Jurado</td>";
                        echo "\t<td class='p-4'><a href='assignJury.php?iduser=" . $id . "' class='hover:text-blue-900'><span class='icon-pencil'></span> Asignar Proyectos</a></td>";
                        echo "\t<td class='p-4'><a href='deleteUser.php?iduser=" . $id . "' class='hover:text-blue-900 btn-delete'><span class='icon-cross'></span> Eliminar</a></td>";
                        break;
                }
                echo "</tr>";
            }
        }
        
    }
}else{
    //En caso de que este vacío
    echo "<tr class='lol'>";
    echo "\t<td colspan='8' class='p-4'><span class='icon-blocked'></span> No hay usuarios en el sistema.</td>";
    echo "</tr>";
}

?>