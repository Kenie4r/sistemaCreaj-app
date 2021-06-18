<?php

class Query{

    //SELECT

    //Obtener todos los usuarios existentes
    public function getUsers(){
        
        $modelo = new Conection;
        $conexion = $modelo->_getConection();
        $sql = "SELECT * FROM usuario";
        $sentencia = $conexion->prepare($sql);
        if(!$sentencia){
            return "Error";
        }else{
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            
            return $resultado;
        }
    }

    //Obtener todos el usuario activo
    public function getUserActivo($nombre, $pass){
        
        $modelo = new Conection;
        $conexion = $modelo->_getConection();
        $sql = "SELECT * FROM usuario WHERE usario = :nombre AND password = :pass";
        $sentencia = $conexion->prepare($sql);
        $sentencia->bindParam(":nombre", $nombre);
        $sentencia->bindParam(":pass", $pass);
        if(!$sentencia){
            return "";
        }else{
            $sentencia->execute();
            $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
            
            return $resultado;
        }
    }

    //UPDATE

    //Usuario
    public function updateUser($idUser, $nameUser, $name, $last_name, $rol, $password){
        $modelo = new Conection;
        $conexion = $modelo->_getConection();
        $sql = "UPDATE usuario SET usario = :usuario, nombres = :nombre, apellidos = :apellido, rol = :rol, password = :contra WHERE usuario.idUsuario = :idUsuario";
        $sentencia = $conexion->prepare($sql);
        $sentencia->bindParam(":usuario", $nameUser);
        $sentencia->bindParam(":nombre", $name);
        $sentencia->bindParam(":apellido", $last_name);
        $sentencia->bindParam(":rol", $rol);
        $sentencia->bindParam(":contra", $password);
        $sentencia->bindParam(":idUsuario", $idUser);
        if(!$sentencia){
            return false;
        }else{
            $sentencia->execute();
            return true;
        }
    }

    //Rúbrica
    public function updateRubrica($idRubrica, $name, $idMateria, $idNivel){
        $modelo = new Conection;
        $conexion = $modelo->_getConection();
        $sql = "UPDATE rubrica SET nombre = :usuario, materia_idmateria = :materia, nivel_idnivel = :nivel WHERE rubrica.idrubrica = :idRubrica";
        $sentencia = $conexion->prepare($sql);
        $sentencia->bindParam(":idRubrica", $idRubrica);
        $sentencia->bindParam(":nombre", $name);
        $sentencia->bindParam(":materia", $idMateria);
        $sentencia->bindParam(":nivel", $idNivel);
        if(!$sentencia){
            return false;
        }else{
            $sentencia->execute();
            return true;
        }
    }

    //Ranking
    public function updateRanking($idRanking, $proyecto, $grado, $materia, $puntaje){
        $modelo = new Conection;
        $conexion = $modelo->_getConection();
        $sql = "UPDATE ranking SET proyecto_idproyecto = :proyecto, proyecto_grado_idgrado = :grado, proyecto_materia_idmateria = :materia, puntaje_idpuntaje = :puntaje WHERE ranking.idRanking = :idRanking";
        $sentencia = $conexion->prepare($sql);
        $sentencia->bindParam(":proyecto", $proyecto);
        $sentencia->bindParam(":grado", $grado);
        $sentencia->bindParam(":materia", $materia);
        $sentencia->bindParam(":puntaje", $puntaje);
        $sentencia->bindParam(":idRanking", $idUser);
        if(!$sentencia){
            return false;
        }else{
            $sentencia->execute();
            return true;
        }
    }

    //Punto
    public function updatePuntos($idPunto, $puntos, $idCriterios){
        $modelo = new Conection;
        $conexion = $modelo->_getConection();
        $sql = "UPDATE puntos SET puntos = :puntos, criterios_idcriterios = :criterio WHERE puntos.idpuntos = :idPuntos";
        $sentencia = $conexion->prepare($sql);
        $sentencia->bindParam(":puntos", $puntos);
        $sentencia->bindParam(":criterio", $idCriterios);
        $sentencia->bindParam(":idPuntos", $idPunto);
        if(!$sentencia){
            return false;
        }else{
            $sentencia->execute();
            return true;
        }
    }

    //Puntaje
    public function updatePuntaje($idPuntaje, $proyecto, $usuario, $puntaje, $puntos){
        $modelo = new Conection;
        $conexion = $modelo->_getConection();
        $sql = "UPDATE puntaje SET proyecto_idproyecto = :proyecto, usuario_idUsuario = :usuario, puntaje = :puntaje, puntos_idpuntos = :punto WHERE puntaje.idpuntaje = :idPuntaje";
        $sentencia = $conexion->prepare($sql);
        $sentencia->bindParam(":proyecto", $proyecto);
        $sentencia->bindParam(":usuario", $usuario);
        $sentencia->bindParam(":puntaje", $puntaje);
        $sentencia->bindParam(":punto", $puntos);
        $sentencia->bindParam(":idPuntaje", $idPuntaje);
        if(!$sentencia){
            return false;
        }else{
            $sentencia->execute();
            return true;
        }
    }

    //Proyecto
    public function updateProyecto($idProyecto, $name, $description, $grado, $materia){
        $modelo = new Conection;
        $conexion = $modelo->_getConection();
        $sql = "UPDATE proyecto SET nombreProyecto = :proyecto, descripcion = :descripcion, grado_idgrado = :grado, materia_idmateria = :materia WHERE proyecto.idproyecto = :idProyecto";
        $sentencia = $conexion->prepare($sql);
        $sentencia->bindParam(":proyecto", $name);
        $sentencia->bindParam(":descripcion", $description);
        $sentencia->bindParam(":grado", $grado);
        $sentencia->bindParam(":materia", $materia);
        $sentencia->bindParam(":idProyecto", $idProyecto);
        if(!$sentencia){
            return false;
        }else{
            $sentencia->execute();
            return true;
        }
    }

    //Nivel
    public function updateNivel($idNivel, $nivel){
        $modelo = new Conection;
        $conexion = $modelo->_getConection();
        $sql = "UPDATE nivel SET nombre = :nivel WHERE nivel.idnivel = :idNivel";
        $sentencia = $conexion->prepare($sql);
        $sentencia->bindParam(":nivel", $nivel);
        $sentencia->bindParam(":idNivel", $idNivel);
        if(!$sentencia){
            return false;
        }else{
            $sentencia->execute();
            return true;
        }
    }

    //Materia
    public function updateMateria($idMateria, $materia){
        $modelo = new Conection;
        $conexion = $modelo->_getConection();
        $sql = "UPDATE materia SET nombre = :materia WHERE materia.idmateria = :idMateria";
        $sentencia = $conexion->prepare($sql);
        $sentencia->bindParam(":materia", $materia);
        $sentencia->bindParam(":idMateria", $idMateria);
        if(!$sentencia){
            return false;
        }else{
            $sentencia->execute();
            return true;
        }
    }

    //Grado
    public function updateGrado($idGrado, $name, $seccion, $nivel){
        $modelo = new Conection;
        $conexion = $modelo->_getConection();
        $sql = "UPDATE grado SET nombre	 = :nombre, seccion = :seccion, nivel_idnivel = :nivel WHERE grado.idgrado = :idGrado";
        $sentencia = $conexion->prepare($sql);
        $sentencia->bindParam(":nombre", $idGrado);
        $sentencia->bindParam(":seccion", $name);
        $sentencia->bindParam(":nivel", $seccion);
        $sentencia->bindParam(":idGrado", $nivel);
        if(!$sentencia){
            return false;
        }else{
            $sentencia->execute();
            return true;
        }
    }

    //Estudiante
    public function updateEstudiante($idEstudiante, $name, $last_name){
        $modelo = new Conection;
        $conexion = $modelo->_getConection();
        $sql = "UPDATE estudiante SET nombre = :nombre, apellidos = :apellido, password = :contra WHERE estudiante.idestudiante = :idEstudiante";
        $sentencia = $conexion->prepare($sql);
        $sentencia->bindParam(":nombre", $name);
        $sentencia->bindParam(":apellido", $last_name);
        $sentencia->bindParam(":idEstudiante", $idEstudiante);
        if(!$sentencia){
            return false;
        }else{
            $sentencia->execute();
            return true;
        }
    }

    //Equipo
    public function updateEquipo($idEquipo, $estudiante, $proyecto){
        $modelo = new Conection;
        $conexion = $modelo->_getConection();
        $sql = "UPDATE equipo SET estudiante_idestudiante = :estudiante, proyecto_idproyecto = :proyecto WHERE equipo.idequipo = :idEquipo";
        $sentencia = $conexion->prepare($sql);
        $sentencia->bindParam(":estudiante", $estudiante);
        $sentencia->bindParam(":proyecto", $estudiante);
        $sentencia->bindParam(":idEquipo", $idEquipo);
        if(!$sentencia){
            return false;
        }else{
            $sentencia->execute();
            return true;
        }
    }

    //Criterio
    public function updateCriterio($idCriterio, $titulo, $descripcion, $puntaje, $rubrica){
        $modelo = new Conection;
        $conexion = $modelo->_getConection();
        $sql = "UPDATE criterios SET titulo = :titulo, descripcion = :descripcion, puntaje = :puntaje, rubrica_idrubrica = :rubrica WHERE criterios.idcriterios = :idCriterio";
        $sentencia = $conexion->prepare($sql);
        $sentencia->bindParam(":titulo", $titulo);
        $sentencia->bindParam(":descripcion", $descripcion);
        $sentencia->bindParam(":puntaje", $puntaje);
        $sentencia->bindParam(":rubrica", $rubrica);
        $sentencia->bindParam(":idCriterio", $idCriterio);
        if(!$sentencia){
            return false;
        }else{
            $sentencia->execute();
            return true;
        }
    }

    //Asignaciones
    public function updateAsignacion($idAsignacion, $user, $materia, $grado){
        $modelo = new Conection;
        $conexion = $modelo->_getConection();
        $sql = "UPDATE asignacionj SET usuario_idUsuario = :usuario, materia_idmateria = :materia, grado_idgrado = :grado WHERE asignacionj.idasignacionJ = :idAsignacion";
        $sentencia = $conexion->prepare($sql);
        $sentencia->bindParam(":usuario", $user);
        $sentencia->bindParam(":materia", $materia);
        $sentencia->bindParam(":grado", $grado);
        $sentencia->bindParam(":idAsignacion", $idAsignacion);
        if(!$sentencia){
            return false;
        }else{
            $sentencia->execute();
            return true;
        }
    }
    
}

?>