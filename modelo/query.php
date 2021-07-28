<?php

class Query{

    //funciones para guardar 
    //Guardar usuario
    public function saveUser($userName,$name, $last_name, $rol, $password ){
        $pass = md5($password);
        $model = new Conection();
        $connection  = $model->_getConection();
        $sql  = "INSERT INTO usuario (usario, nombres, apellidos, rol, password) VALUES ( :username , :name, :last_name, :rol,:password )";
        $sentencia= $connection->prepare($sql);
        $sentencia ->bindParam(":username", $userName);
        $sentencia->bindParam(":name", $name);
        $sentencia->bindParam(":last_name", $last_name);
        $sentencia->bindParam(":rol", $rol);
        $sentencia -> bindParam(":password", $pass);

        if(!$sentencia){
                return "Error, por favor revisar los datos ingresados";
        }else{
            $sentencia -> execute();
            return "Datos ingresados de manera exitosa";
        }

    }
    //Login
    public function _UserBus($user, $pass){
        $conexion = new Conection();
        $connection  = $model->_getConection();
        $sql="SELECT * FROM usuario WHERE idUsuario= :user AND password = : pass ";
        $estado= $connection->prepare($sql);
            $estado->bindParam(':user', $user);
            $estado->bindParam(':pass', $pass);
            $estado->execute();
            $usuarios=$estado->rowCount();
            return $usuarios;
    }
    
    //Guardar Rubrica
    public function saveRubrica($id_rubrica, $name, $id_Materia, $id_nivel){
        $conexion = new Conection();
        $sql = "INSERT INTO rubrica(idrubrica, nombre, materia_idmateria, nivel_idnivel) VALUES(:idrubric, :name, :materia, :nivel)";
        $sentencia= $conexion->prepare($sql);
        $sentencia->bindParam(":idrubric", $id_rubrica);
        $sentencia->bindParam(":name", $name);
        $sentencia->bindParam(":nivel ", $id_nivel);
        $sentencia->bindParam(":materia", $id_materia);
        if(!$sentencia){
            return "Error, existe un fallo";
        }else{
            $sentencia->execute();
            return "Registro hecho";
        }
    }
    //Guardar criterio
    public function saveCriterio($tittle, $puntos, $rubricaID){
        $conexion = new Conection();
        $sql = "INSERT INTO criterios(titulo, puntaje, rubrica_idrubrica) VALUES(:titulo, :puntaje, :rubrica)";
        $sentencia= $conexion->prepare($sql);
        $sentencia->bindParam(":titulo", $tittle);
        $sentencia->bindParam(":puntaje", $puntos);
        $sentencia->bindParam(":rubrica", $rubricaID);
        if(!$sentencia){
            return "Error, existe un fallo";
        }else{
            $sentencia->execute();
            return "Registro hecho";
        }
    }

    //Guardar nivel de aprobacion
    public function savenAprobacion($description, $range, $note, $id_criterio){
        $conexion = new Conection();
        $sql = "INSERT INTO naprovacion(descripcion, rango, nota, criterios_idcriterios) VALUES(:descrip, :rang, :note, :idcrit)";
        $sentencia= $conexion->prepare($sql);
        $sentencia->bindParam(":descrip", $tittle);
        $sentencia->bindParam(":rang", $puntos);
        $sentencia->bindParam(":note", $rubricaID);
        $sentencia->bindParam(":idcrit", $rubricaID);
        if(!$sentencia){
            return "Error, existe un fallo";
        }else{
            $sentencia->execute();
            return "Registro hecho";
        }
    }

    //guardat Grado
    public function saveGrado($name, $seccion, $nivel_idnivel){
        $conexion = new Conection();
        $sql = "INSERT INTO grado(nombre, seccion, nivel_idnivel) VALUES(:name, :seccion, :idnivel)";
        $sentencia = $conexion->prepare($sql);
        $sentencia->bindParam(":name", $name);
        $sentencia->bindParam(":seccion", $seccion);
        $sentencia->bindParam(":idnivel", $nivel_idnivel);
        if(!$sentencia){
            return "Error, existe un fallo";
        }else{
            $sentencia->execute();
            return "Registro hecho";
        }
    }
    //guardar nivel
    public function saveNivel($name){
        $conexion = new Conection();
        $sql = "INSERT INTO grado(nombrel) VALUES(:name)";
        $sentencia = $conexion->prepare($sql);
        $sentencia->bindParam(":name", $name);
        if(!$sentencia){
            return "Error, existe un fallo";
        }else{
            $sentencia->execute();
            return "Registro hecho";
        }
    }
    //guardar equipo
    public function saveTeam($id_estudiante, $proyecto){
        $conexion = new Conection();
        $sql = "INSERT INTO equipo(estudiante_idestudiante, proyecto_idproyecto) VALUES(:student, :proyecto)";
        $sentencia= $conexion->prepare($sql);
        $sentencia->bindParam(":student", $id_estudiante);
        $sentencia->bindParam(":proyecto", $proyecto);
        if(!$sentencia){
            return "Error, existe un fallo";
        }else{
            $sentencia->execute();
            return "Registro hecho";
        }
    }
    
    //guardar estudiante
    public function saveStudent($id, $name, $last_name){
        $conexion = new Conection();
        $sql = "INSERT INTO estudiante VALUES ( :id, :name, :last_name)";
        $sentencia= $conexion->prepare($sql);
        $sentencia->bindParam(":id", $id);
        $sentencia->bindParam(":name", $name);
        $sentencia->bindParam(":last_name", $last_name);
        if(!$sentencia){
            return "Error, existe un fallo";
        }else{
            $sentencia->execute();
            return "Registro hecho";
        }
    }

    //save materia
    public function saveMateria($nombre ){
        $conexion = new Conection();
        $sql = "INSERT INTO materia(nombre) VALUES(:name) ";
        $sentencia= $conexion->prepare($sql);
        $sentencia->bindParam(":name", $nombre);
        if(!$sentencia){
            return "Error, existe un fallo";
        }else{
            $sentencia->execute();
            return "Registro hecho";
        }

    }

    //guardar puntaje
    public function savePuntaje($proyecto,  $usuario, $puntaje, $puntos){
        $conexion = new Conection();
        $sql= "INSERT INTO puntaje(proyecto_idproyecto, usuario_idUsario, puntaje, puntos_idpuntos) VALUES(:proyecto, :user, :puntaje, :puntos)";
        $sentencia= $conexion->prepare($sql);
        $sentencia->bindParam(":proyecto", $proyecto);
        $sentencia->bindParam(":user", $usuario);
        $sentencia->bindParam(":puntaje", $puntaje);
        $sentencia->bindParam(":puntos", $puntos);
        if(!$sentencia){
            return "Error, existe un fallo";
        }else{
            $sentencia->execute();
            return "Registro hecho";
        }
    }

    //guardar puntos
    public function savePuntos($puntos, $criterio){
        $conexion = new Conection();
        $sql= "INSERT INTO puntos(puntos, criterios_idcriterios) VALUES(:puntos , :criterio)";
        $sentencia= $conexion->prepare($sql);
        $sentencia->bindParam(":puntos", $puntos);
        $sentencia->bindParam(":criterio", $criterio);
        if(!$sentencia){
            return "Error, existe un fallo";
        }else{
            $sentencia->execute();
            return "Registro hecho";
        }
    }
    //guardar rango
    public function saveRank($proyecto, $materia, $grado,$puntaje){
        $conexion = new Conection();
        $sql="INSERT INTO ranking(proyecto_idproyecto, proyecto_grado_idgrado, proyecto_materia_idmateria, puntaje_idpuntaje) VALUES (
        :poyecto, :grado, :materia, :puntaje)";
        $sentencia= $conexion->prepare($sql);
        $sentencia->bindParam(":proyecto", $proyecto);
        $sentencia->bindParam(":grado", $grado);
        $sentencia->bindParam(":materia", $materia);
        $sentencia->bindParam(":puntaje", $puntaje);
        if(!$sentencia){
            return "Error, existe un fallo";
        }else{
            $sentencia->execute();
            return "Registro hecho";
        }
    }

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

    //Obtener todos las rúbricas
    public function getRubrics(){
        
        $modelo = new Conection;
        $conexion = $modelo->_getConection();
        $sql = "SELECT * FROM rubrica";
        $sentencia = $conexion->prepare($sql);
        if(!$sentencia){
            return "";
        }else{
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            
            return $resultado;
        }
    }

    //Obtener todos los niveles
    public function getMatter(){
        
        $modelo = new Conection;
        $conexion = $modelo->_getConection();
        $sql = "SELECT * FROM materia";
        $sentencia = $conexion->prepare($sql);
        if(!$sentencia){
            return "";
        }else{
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            
            return $resultado;
        }
    }

    //Obtener todos los niveles
    public function getLevel(){
        
        $modelo = new Conection;
        $conexion = $modelo->_getConection();
        $sql = "SELECT * FROM nivel";
        $sentencia = $conexion->prepare($sql);
        if(!$sentencia){
            return "";
        }else{
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            
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