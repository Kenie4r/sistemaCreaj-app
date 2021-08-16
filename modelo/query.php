<?php

class Query{

    //funciones para guardar 
    //Guardar usuario
    public function saveUser($userName, $name, $last_name, $rol, $password, $email){
        $pass = md5($password);
        $model = new Conection();
        $connection  = $model->_getConection();
        $sql  = "INSERT INTO usuario (usario, nombres, apellidos, rol, password, email) VALUES ( :username , :name, :last_name, :rol,:password, :correo)";
        $sentencia= $connection->prepare($sql);
        $sentencia ->bindParam(":username", $userName);
        $sentencia->bindParam(":name", $name);
        $sentencia->bindParam(":last_name", $last_name);
        $sentencia->bindParam(":rol", $rol);
        $sentencia->bindParam(":password", $pass);
        $sentencia->bindParam(":correo", $email);
        if(!$sentencia){
            return "Error";
        }else{
            $sentencia->execute();
            return "Hecho";
        }

    }
    //Guardar Rubrica
    public function saveRubrica($id_rubrica, $name, $id_materia, $id_nivel){
        $model = new Conection();
        $connection  = $model->_getConection();
        $sql = "INSERT INTO rubrica (idrubrica, nombre, materia_idmateria, nivel_idnivel) VALUES(:idrubric, :nombr, :materia, :nivel)";
        $sentencia= $connection->prepare($sql);
        $sentencia->bindParam(":idrubric", $id_rubrica, PDO::PARAM_STR);
        $sentencia->bindParam(":nombr", $name, PDO::PARAM_STR);
        $sentencia->bindParam(":materia", $id_materia, PDO::PARAM_INT);
        $sentencia->bindParam(":nivel", $id_nivel, PDO::PARAM_INT);
        if(!$sentencia){
            return "Error, existe un fallo";
        }else{
            $sentencia->execute();
            return "Registro hecho";
        }
    }
    //Guardar criterio
    public function saveCriterio($tittle, $puntos, $rubricaID){
        $model = new Conection();
        $connection  = $model->_getConection();
        $sql = "INSERT INTO criterios(titulo, puntaje, rubrica_idrubrica) VALUES(:titulo, :puntaje, :rubrica)";
        $sentencia= $connection->prepare($sql);
        $sentencia->bindParam(":titulo", $tittle, PDO::PARAM_STR);
        $sentencia->bindParam(":puntaje", $puntos, PDO::PARAM_INT);
        $sentencia->bindParam(":rubrica", $rubricaID, PDO::PARAM_STR);
        if(!$sentencia){
            return "Error, existe un fallo";
        }else{
            $sentencia->execute();
            return "Registro hecho";
        }
    }

    //Guardar nivel de aprobacion
    public function savenAprobacion($description, $range, $note, $id_criterio){
        $model = new Conection();
        $connection  = $model->_getConection();
        $sql = "INSERT INTO naprobacion(descripcion, rango, nota, criterios_idcriterios) VALUES(:descrip, :rang, :note, :idcrit)";
        $sentencia= $connection->prepare($sql);
        $sentencia->bindParam(":descrip", $description, PDO::PARAM_STR);
        $sentencia->bindParam(":rang", $range, PDO::PARAM_STR);
        $sentencia->bindParam(":note", $note);
        $sentencia->bindParam(":idcrit", $id_criterio, PDO::PARAM_INT );
        if(!$sentencia){
            return "Error, existe un fallo";
        }else{
            $sentencia->execute();
            return "Registro hecho";
        }
    }

    //guardat Grado
    public function saveGrado($name, $seccion, $nivel_idnivel){
        $model = new Conection();
        $connection  = $model->_getConection();
        $sql = "INSERT INTO grado(nombre, seccion, nivel_idnivel) VALUES(:name, :seccion, :idnivel)";
        $sentencia = $connection->prepare($sql);
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
        $model = new Conection();
        $connection  = $model->_getConection();
        $sql = "INSERT INTO nivel(nombre) VALUES(:name)";
        $sentencia = $connection->prepare($sql);
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
        $model = new Conection();
        $connection  = $model->_getConection();
        $sql = "INSERT INTO equipo(estudiante_idestudiante, proyecto_idproyecto) VALUES(:student, :proyecto)";
        $sentencia= $connection->prepare($sql);
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
        $model = new Conection();
        $connection  = $model->_getConection();
        $sql = "INSERT INTO estudiante VALUES ( :id, :name, :last_name)";
        $sentencia= $connection->prepare($sql);
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
    public function saveMateria($nombre){
        $model = new Conection();
        $connection  = $model->_getConection();
        $sql = "INSERT INTO materia(nombre) VALUES(:name) ";
        $sentencia= $connection->prepare($sql);
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
        $model = new Conection();
        $connection  = $model->_getConection();
        $sql= "INSERT INTO puntaje(proyecto_idproyecto, usuario_idUsario, puntaje, puntos_idpuntos) VALUES(:proyecto, :user, :puntaje, :puntos)";
        $sentencia= $connection->prepare($sql);
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
        $model = new Conection();
        $connection  = $model->_getConection();
        $sql= "INSERT INTO puntos(puntos, criterios_idcriterios) VALUES(:puntos , :criterio)";
        $sentencia= $connection->prepare($sql);
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
        $model = new Conection();
        $connection  = $model->_getConection();
        $sql="INSERT INTO ranking(proyecto_idproyecto, proyecto_grado_idgrado, proyecto_materia_idmateria, puntaje_idpuntaje) VALUES (
        :poyecto, :grado, :materia, :puntaje)";
        $sentencia= $connection->prepare($sql);
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
    //obtener la cantidad de proyectos asignados  a un usuario 
    public function getCountProjects($userID){
        $model = new Conection();
        $connection = $model->_getConection();
        $sql = "SELECT COUNT(*) FROM asignacionj WHERE asignacionj.usuario_idUsuario = :userID";
        $sentencia = $connection->prepare($sql);
        $sentencia->bindParam(":userID", $userID);
        if(!$sentencia){
            return false;
        }else{
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        }
    }





    //obtener datos de equipo
    public function getTeamData($idTeam){
        $model = new Conection();
        $connection = $model->_getConection();
        $sql = "SELECT proyecto.idproyecto, proyecto.nombreProyecto, proyecto.descripcion, grado.*, materia.idmateria, materia.nombre AS nombreMateria FROM proyecto JOIN grado JOIN materia WHERE proyecto.idproyecto =:idTeam  ";
        $sentencia = $connection->prepare($sql);
        $sentencia->bindParam(":idTeam", $idTeam);
        if(!$sentencia){
            return false;
        }else{
            $sentencia->execute();
            $result = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }
    }

    public function obtainTeamMates($idTeam){
        $model = new Conection();
        $connection = $model->_getConection();
        $sql = "SELECT equipo.idequipo, estudiante.idestudiante, estudiante.nombre, estudiante.apellidos FROM equipo INNER JOIN estudiante ON estudiante_idestudiante = estudiante.idestudiante WHERE proyecto_idproyecto = :idTeam";
        $sentencia = $connection->prepare($sql);
        $sentencia->bindParam(":idTeam", $idTeam);
        if(!$sentencia){
            return false;
        }else{
            $sentencia->execute();
            $result = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }
    }
    //Obtener Rubricar por nivel y materia
    public function getNewRubric($idMateria, $idNivel){
        $model = new Conection();
        $conexion = $model->_getConection();
        $sql = "SELECT rubrica.idrubrica FROM rubrica  WHERE rubrica.materia_idmateria =:idMateria AND rubrica.nivel_idnivel = :idNivel";
        $sentencia = $conexion->prepare($sql);
        $sentencia->bindParam(':idMateria', $idMateria);
        $sentencia->bindParam(':idNivel', $idNivel);
        if(!$sentencia){
            return false;
        }else{
            $sentencia->execute();
            $result= $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }
    }
    //obtener información de 1 nivel por el IDCRITERIO y RANGO
    public function getRange($idCriterio, $rangeName){
        $model = new Conection();
        $conexion = $model->_getConection();
        $sql = "SELECT * FROM naprobacion WHERE naprobacion.criterios_idcriterios = :idCriterio AND naprobacion.rango = :rangeName ";
        $sentencia = $conexion->prepare($sql);
        $sentencia->bindParam(':idCriterio', $idCriterio);
        $sentencia->bindParam(':rangeName', $rangeName);
        if(!$sentencia){
            return false;
        }else{
            $sentencia->execute();
            $result = $sentencia->fetch(PDO::FETCH_ASSOC);
            return $result;
        }
    }
    //Get ID Criterio
    public function getIDCriterio($titulo, $rubricaID){
        $model = new Conection();
        $connection  = $model->_getConection();
        $sql = "SELECT idcriterios FROM criterios WHERE titulo = :nombre AND rubrica_idrubrica = :idrubric";
        $sentencia= $connection->prepare($sql);
        $sentencia->bindParam(":nombre", $titulo);
        $sentencia->bindParam(":idrubric", $rubricaID);
        if(!$sentencia){
            return "Error";
        }else{
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            
            return $resultado;
        }
    }

    //Obtener las rubricas filtradas según el ID
    public function searchRubricById($idrubrica){
        $idrubrica = "%".$idrubrica."%";
        $model = new Conection();
        $connection  = $model->_getConection();
        $sql = "SELECT * FROM rubrica WHERE idrubrica LIKE :rubricaID";
        $sentencia= $connection->prepare($sql);
        $sentencia->bindParam(":rubricaID", $idrubrica);
        if(!$sentencia){
            return "Error";
        }else{
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            
            return $resultado;
        }
    }

    //Obtener las rubricas filtradas según el nombre
    public function searchRubricByName($namerubrica){
        $namerubrica = "%".$namerubrica."%";
        $model = new Conection();
        $connection  = $model->_getConection();
        $sql = "SELECT * FROM rubrica WHERE nombre LIKE :rubricaName";
        $sentencia= $connection->prepare($sql);
        $sentencia->bindParam(":rubricaName", $namerubrica);
        if(!$sentencia){
            return "Error";
        }else{
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            
            return $resultado;
        }
    }

    //Obtener las rubricas filtradas según el ID
    public function searchRubricsByIdAndName($namerubrica){
        $model = new Conection();
        $connection  = $model->_getConection();
        $sql = "SELECT idrubrica FROM rubrica WHERE nombre = :namerubrica";
        $sentencia= $connection->prepare($sql);
        $sentencia->bindParam(":namerubrica", $namerubrica);
        if(!$sentencia){
            return "Error";
        }else{
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            
            return $resultado;
        }
    }

    //Obtener los usuarios filtrados según el nombre de usuario
    public function searchUserByName($nameRubric){
        $nameRubric = "%".$nameRubric."%";
        $model = new Conection();
        $connection  = $model->_getConection();
        $sql = "SELECT * FROM usuario WHERE usario LIKE :userName";
        $sentencia= $connection->prepare($sql);
        $sentencia->bindParam(":userName", $nameRubric);
        if(!$sentencia){
            return "Error";
        }else{
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            
            return $resultado;
        }
    }

    //Obtener las ultima rubrica
    public function getEndRubric($idrubrica){
        $idrubrica = "%".$idrubrica."%";
        $model = new Conection();
        $connection  = $model->_getConection();
        $sql = "SELECT * FROM rubrica WHERE idrubrica LIKE :rubricaID ORDER BY idrubrica DESC LIMIT 1";
        $sentencia= $connection->prepare($sql);
        $sentencia->bindParam(":rubricaID", $idrubrica);
        if(!$sentencia){
            return "Error";
        }else{
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            
            return $resultado;
        }
    }

    //Obtener la rubrica según el ID
    public function getRubricById($idrubrica){
        $model = new Conection();
        $connection  = $model->_getConection();
        $sql = "SELECT * FROM rubrica WHERE idrubrica = :rubricaID";
        $sentencia= $connection->prepare($sql);
        $sentencia->bindParam(":rubricaID", $idrubrica);
        if(!$sentencia){
            return "Error";
        }else{
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            
            return $resultado[0];
        }
    }

    //Obtener el id de los criterios según el ID rubric
    public function getIdCriterioByIdRubric($idrubrica){
        $model = new Conection();
        $connection  = $model->_getConection();
        $sql = "SELECT idcriterios FROM criterios WHERE rubrica_idrubrica = :rubricaID";
        $sentencia= $connection->prepare($sql);
        $sentencia->bindParam(":rubricaID", $idrubrica);
        if(!$sentencia){
            return "Error";
        }else{
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            
            return $resultado;
        }
    }

    //Obtener el id de los niveles según el ID criterio
    public function getIdNivelByIdCriterio($idcriterio){
        $model = new Conection();
        $connection  = $model->_getConection();
        $sql = "SELECT idnaprobacion FROM naprobacion WHERE criterios_idcriterios = :criterioID";
        $sentencia= $connection->prepare($sql);
        $sentencia->bindParam(":criterioID", $idcriterio);
        if(!$sentencia){
            return "Error";
        }else{
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            
            return $resultado;
        }
    }

    //Obtener los criterios según el ID rubric
    public function getCriteriosByIdRubric($idrubrica){
        $model = new Conection();
        $connection  = $model->_getConection();
        $sql = "SELECT * FROM criterios WHERE rubrica_idrubrica = :rubricaID";
        $sentencia= $connection->prepare($sql);
        $sentencia->bindParam(":rubricaID", $idrubrica);
        if(!$sentencia){
            return "Error";
        }else{
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            
            return $resultado;
        }
    }

    //Obtenerlos niveles según el ID criterio
    public function getLevelsByIdCriterio($idcriterio){
        $model = new Conection();
        $connection  = $model->_getConection();
        $sql = "SELECT * FROM naprobacion WHERE criterios_idcriterios = :criterioID";
        $sentencia= $connection->prepare($sql);
        $sentencia->bindParam(":criterioID", $idcriterio);
        if(!$sentencia){
            return "Error";
        }else{
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            
            return $resultado;
        }
    }

    //Obtener la materia según el ID
    public function getMatterById($idmateria){
        $model = new Conection();
        $connection  = $model->_getConection();
        $sql = "SELECT * FROM materia WHERE idmateria = :materiaID";
        $sentencia= $connection->prepare($sql);
        $sentencia->bindParam(":materiaID", $idmateria);
        if(!$sentencia){
            return "Error";
        }else{
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            
            return $resultado[0];
        }
    }

    //Obtener el nivel según el ID
    public function getLevelById($idnivel){
        $model = new Conection();
        $connection  = $model->_getConection();
        $sql = "SELECT * FROM nivel WHERE idnivel = :nivelID";
        $sentencia= $connection->prepare($sql);
        $sentencia->bindParam(":nivelID", $idnivel);
        if(!$sentencia){
            return "Error";
        }else{
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            
            return $resultado[0];
        }
    }

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
        $pass = md5($pass);
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

    //Obtener todos el usuario por el username
    public function getUserByUsername($username){
        $modelo = new Conection;
        $conexion = $modelo->_getConection();
        $sql = "SELECT * FROM usuario WHERE usario = :nombre";
        $sentencia = $conexion->prepare($sql);
        $sentencia->bindParam(":nombre", $username);
        if(!$sentencia){
            return "";
        }else{
            $sentencia->execute();
            $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
            
            return $resultado;
        }
    }

    //Obtener las rubricas filtradas según el ID
    public function getUsersByUsername($nameuser){
        $model = new Conection();
        $connection  = $model->_getConection();
        $sql = "SELECT * FROM usuario WHERE usario = :nameuser";
        $sentencia= $connection->prepare($sql);
        $sentencia->bindParam(":nameuser", $nameuser);
        if(!$sentencia){
            return "Error";
        }else{
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            
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
    //obtener todos los estudiantes

    public function getEstudiantes(){
        $modelo = new Conection;
        $conexion = $modelo->_getConection();
        $sql = "SELECT * FROM estudiante";
        $sentencia = $conexion->prepare($sql);
        if(!$sentencia){
            return "";
        }else{
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            
            return $resultado;
        }
    }

    //Obtener todos las rúbricas DESC
    public function getRubricsDESC(){
        
        $modelo = new Conection;
        $conexion = $modelo->_getConection();
        $sql = "SELECT * FROM rubrica ORDER BY idrubrica DESC";
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
    //Obtener todos los grados
    public function getGrado(){
        $modelo = new Conection;
        $conexion = $modelo->_getConection();
        $sql = "SELECT * FROM grado";
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
    public function updateUser($idUser, $nameUser, $name, $last_name, $rol){
        $modelo = new Conection;
        $conexion = $modelo->_getConection();
        $sql = "UPDATE usuario SET usario = :usuario, nombres = :nombre, apellidos = :apellido, rol = :rol WHERE usuario.idUsuario = :idUsuario";
        $sentencia = $conexion->prepare($sql);
        $sentencia->bindParam(":usuario", $nameUser);
        $sentencia->bindParam(":nombre", $name);
        $sentencia->bindParam(":apellido", $last_name);
        $sentencia->bindParam(":rol", $rol);
        $sentencia->bindParam(":idUsuario", $idUser);
        if(!$sentencia){
            return false;
        }else{
            $sentencia->execute();
            return true;
        }
    }

    //Usuario password
    public function updateUserPassword($nameUser, $contra){
        $contra = md5($contra);
        $modelo = new Conection;
        $conexion = $modelo->_getConection();
        $sql = "UPDATE usuario SET 	password = :contra WHERE usario = :username";
        $sentencia = $conexion->prepare($sql);
        $sentencia->bindParam(":contra", $contra);
        $sentencia->bindParam(":username", $nameUser);
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
        $sql = "UPDATE rubrica SET nombre = :nombreR, materia_idmateria = :materia, nivel_idnivel = :nivel WHERE rubrica.idrubrica = :idRubrica";
        $sentencia = $conexion->prepare($sql);
        $sentencia->bindParam(":nombreR", $name);
        $sentencia->bindParam(":materia", $idMateria);
        $sentencia->bindParam(":nivel", $idNivel);
        $sentencia->bindParam(":idRubrica", $idRubrica);
        if(!$sentencia){
            return false;
        }else{
            $sentencia->execute();
            return true;
        }
    }

    //Niveles de aprobación
    public function updateNAprobacion($idNAprobacion, $descripcion){
        $modelo = new Conection;
        $conexion = $modelo->_getConection();
        $sql = "UPDATE naprobacion SET descripcion = :descr WHERE naprobacion.idnaprobacion = :naprobacionID";
        $sentencia = $conexion->prepare($sql);
        $sentencia->bindParam(":descr", $descripcion);
        $sentencia->bindParam(":naprobacionID", $idNAprobacion);
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
    public function updateCriterio($idCriterio, $titulo, $puntaje){
        $modelo = new Conection;
        $conexion = $modelo->_getConection();
        $sql = "UPDATE criterios SET titulo = :titulo, puntaje = :puntaje WHERE criterios.idcriterios = :idCriterio";
        $sentencia = $conexion->prepare($sql);
        $sentencia->bindParam(":titulo", $titulo);
        $sentencia->bindParam(":puntaje", $puntaje);
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
    public function deleteGrado($idgrado){
        $modelo = new Conection;
        $conexion = $modelo->_getConection();
        $sql="DELETE FROM grado WHERE idgrado=:idgrado";
        $sentencia = $conexion->prepare($sql);
        $sentencia->bindParam(":idgrado", $idgrado);
        if(!$sentencia){
            return false;
        }else{
            $sentencia->execute();
            return true;
        }
    }

    //Eliminar la rubrica según el ID
    public function deleteRubricById($idrubrica){
        $model = new Conection();
        $connection  = $model->_getConection();
        $sql = "DELETE FROM rubrica WHERE idrubrica = :rubricaID";
        $sentencia= $connection->prepare($sql);
        $sentencia->bindParam(":rubricaID", $idrubrica);
        if(!$sentencia){
            return "Error";
        }else{
            $sentencia->execute();
            
            return "Hecho";
        }
    }

    //Eliminar el criterio según el ID
    public function deleteCiterioById($idcriterio){
        $model = new Conection();
        $connection  = $model->_getConection();
        $sql = "DELETE FROM criterios WHERE idcriterios = :criteriosID";
        $sentencia= $connection->prepare($sql);
        $sentencia->bindParam(":criteriosID", $idcriterio);
        if(!$sentencia){
            return "Error";
        }else{
            $sentencia->execute();
            
            return "Hecho";
        }
    }

    //Eliminar los niveles de aprobación según el ID
    public function deleteNivelesAById($idnivel){
        $model = new Conection();
        $connection  = $model->_getConection();
        $sql = "DELETE FROM naprobacion WHERE idnaprobacion = :nivelID";
        $sentencia= $connection->prepare($sql);
        $sentencia->bindParam(":nivelID", $idnivel);
        if(!$sentencia){
            return "Error";
        }else{
            $sentencia->execute();
            
            return "Hecho";
        }
    }
}

?>