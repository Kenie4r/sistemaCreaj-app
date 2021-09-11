<?php

use function PHPSTORM_META\sql_injection_subst;

class Query{

    //funciones para guardar 
    //Guardar usuario
    public function saveUser($userName, $name, $last_name, $rol, $password, $email){
        $pass = md5($password);
        $model = new Conection();
        $connection  = $model->_getConection();
        $sql  = "INSERT INTO usuario (usuario, nombres, apellidos, rol, password, email) VALUES ( :username , :name, :last_name, :rol,:password, :correo)";
        $sentencia= $connection->prepare($sql);
        $sentencia->bindParam(":username", $userName);
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
    
    //Guardar asignacion jurado
    public function saveAsignacionj($idUser, $idMatter, $idGrade){
        $model = new Conection();
        $connection  = $model->_getConection();
        $sql  = "INSERT INTO asignacionj (usuario_idUsuario, materia_idmateria, grado_idgrado) VALUES (:iduser, :idmatter, :idgrade)";
        $sentencia= $connection->prepare($sql);
        $sentencia->bindParam(":iduser", $idUser);
        $sentencia->bindParam(":idmatter", $idMatter);
        $sentencia->bindParam(":idgrade", $idGrade);
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
    public function getAlumnosByGrados($grado_idgrado){
        $model = new Conection();
        $connection  = $model->_getConection();
        $sql = "SELECT idestudiante, nombre, apellidos FROM estudiante WHERE estudiante.grado_idgrado = :grado_idgrado ORDER BY apellidos ASC";
        $sentencia= $connection->prepare($sql);
        $sentencia->bindParam(":grado_idgrado", $grado_idgrado);

        if(!$sentencia){
            return "Error";
        }else{
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
            
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
    public function saveTeam($id_alumno, $idProyecto){
        $model = new Conection();
        $connection  = $model->_getConection();
        $sql = "INSERT INTO equipo(estudiante_idestudiante, proyecto_idproyecto) VALUES(:student, :proyecto)";
        $sentencia= $connection->prepare($sql);
        $sentencia->bindParam(":student", $id_alumno);
        $sentencia->bindParam(":proyecto", $idProyecto);
        if(!$sentencia){
            return "Error, existe un fallo";
        }else{
            $sentencia->execute();
            return "Registro hecho";
        }
    }
    
    //guardar estudiante
    public function saveStudent($id, $name, $last_name, $grado_idgrado){
        $model = new Conection();
        $connection  = $model->_getConection();
        $sql = "INSERT INTO estudiante VALUES ( :id, :name, :last_name, :grado_idgrado)";
        $sentencia= $connection->prepare($sql);
        $sentencia->bindParam(":id", $id);
        $sentencia->bindParam(":name", $name);
        $sentencia->bindParam(":last_name", $last_name);
        $sentencia->bindParam(":grado_idgrado", $grado_idgrado);
        if(!$sentencia){
            return "Error, existe un fallo";
        }else{
            $sentencia->execute();
            return "Registro hecho";
        }
    }
    //Guardar Proyectos
    public function saveProjects($name, $descripcion, $idGrado, $idMateria){
        $model = new Conection();
        $connection  = $model->_getConection();
        $sql = "INSERT INTO proyecto(nombreProyecto, descripcion, grado_idgrado, materia_idmateria) VALUES (:name, :descripcion, :idGrado, :idMateria)";
        $sentencia= $connection->prepare($sql);
        $sentencia->bindParam(":name", $name);
        $sentencia->bindParam(":descripcion", $descripcion);
        $sentencia->bindParam(":idGrado", $idGrado);
        $sentencia->bindParam(":idMateria", $idMateria);
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
    public function savePuntaje($proyecto,  $usuario, $puntaje){
        $model = new Conection();
        $connection  = $model->_getConection();
        $sql= "INSERT INTO puntaje(proyecto_idproyecto, usuario_idUsuario, puntaje) VALUES(:proyecto, :user, :puntaje)";
        $sentencia= $connection->prepare($sql);
        $sentencia->bindParam(":proyecto", $proyecto);
        $sentencia->bindParam(":user", $usuario);
        $sentencia->bindParam(":puntaje", $puntaje);
        if(!$sentencia){
            return "Error, existe un fallo";
        }else{
            $sentencia->execute();
            return "Registro hecho";
        }
    }

    //guardar puntos
    public function savePuntos($puntos, $criterio, $user, $proyecto){
        $model = new Conection();
        $connection  = $model->_getConection();
        $sql= "INSERT INTO puntos VALUES(NULL, :usuarioID, :criterio,:proyecto,  :puntos)";
        $sentencia= $connection->prepare($sql);
        $sentencia->bindParam(":usuarioID", $user);
        $sentencia->bindParam(":puntos", $puntos);
        $sentencia->bindParam(":proyecto", $proyecto);
        $sentencia->bindParam(":criterio", $criterio);
        if(!$sentencia){
            return "Error, existe un fallo";
        }else{
            $sentencia->execute();
            return "Registro hecho";
        }
    }
        //Guardar parámetros 
        public function saveParametros($idparametros, $nombre, $paramFecha, $paramFechaF ){
            $model = new Conection();
            $connection  = $model->_getConection();
            $sql = "INSERT INTO parametros VALUES ( :idparametros, :nombre, :paramFecha, :paramFechaF)";
            $sentencia= $connection->prepare($sql);
            $sentencia->bindParam(":idparametros", $idparametros);
            $sentencia->bindParam(":nombre", $nombre);
            $sentencia->bindParam(":paramFecha", $paramFecha);
            $sentencia->bindParam(":paramFechaF", $paramFechaF);
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
        $conexion  = $model->_getConection();
        $sql =  "INSERT INTO ranking VALUES(NULL, :idProyecto, :idGrado, :idMateria, :puntaje)";
        $sentencia = $conexion->prepare($sql);
        $sentencia->bindParam(":idProyecto",$proyecto );
        $sentencia->bindParam(":idMateria", $materia);
        $sentencia->bindParam(":idGrado", $grado);
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

    //obtener los datos de asignación de proyectos
    public function getProjectsinfo($userID){
        $model = new Conection();
        $connection = $model->_getConection();
        $sql = "SELECT * FROM asignacionj WHERE asignacionj.usuario_idUsuario = :userID";
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
    //revisar si está calificado un proyecto
    public function isSavedProject($idProject, $idUser){
        $model = new Conection();
        $connection = $model->_getConection();
        $sql = "SELECT COUNT(*)FROM puntaje WHERE puntaje.proyecto_idproyecto =:idProject  AND puntaje.usuario_idUsuario =:idUser";
        $sentencia = $connection->prepare($sql);
        $sentencia ->bindParam(":idProject", $idProject);
        $sentencia->bindParam(":idUser", $idUser);
        if(!$sentencia){
            return false;
        }else{
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        }
    }

    //Obtenr el ID del proyecto segun el ID del quipo
    public function getIdestudianteByIdproyecto($proyecto_idproyecto){
        $model = new Conection();
        $connection  = $model->_getConection();
            $sql = "SELECT estudiante_idestudiante FROM equipo WHERE proyecto_idproyecto = :proyecto_idproyecto";
        $sentencia= $connection->prepare($sql);
        $sentencia->bindParam(":proyecto_idproyecto", $proyecto_idproyecto);

        if(!$sentencia){
            return "Error";
        }else{
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            
            return $resultado;
        }
    }

    //obtener los proyectos asignados
    public function getAllProjects($idMateria, $idGrado){
        $model = new Conection();
        $connection = $model->_getConection();
        $sql = "SELECT * FROM proyecto WHERE proyecto.grado_idgrado =:idGrado  AND proyecto.materia_idmateria =:idMateria";
        $sentencia = $connection->prepare($sql);
        $sentencia->bindParam(":idGrado", $idGrado);
        $sentencia ->bindParam(":idMateria", $idMateria);

        if(!$sentencia){
            return false;
        }else{
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        }
    }


    public function getTeambyID($idTeam){
        $model = new Conection();
        $connection = $model->_getConection();
        $sql = "SELECT *  FROM proyecto  WHERE proyecto.idproyecto =:idTeam";
        $sentencia = $connection->prepare($sql);
        $sentencia->bindParam(":idTeam", $idTeam);
        if(!$sentencia){
            return false;
        }else{
            $sentencia->execute();
            $result = $sentencia->fetch();
            return $result;
        }
    }
    //Obtener todos los Id de los estudiantes que pertenezcan a un proyecto
    public function getIDestudiantes($proyecto_idproyecto){
        $model = new Conection();
        $connection = $model->_getConection();
        $sql ="SELECT `idestudiante` FROM `estudiante` e inner join equipo eq on e.idestudiante = eq.estudiante_idestudiante inner join proyecto p on eq.proyecto_idproyecto = p.idproyecto where p.idproyecto= :idproyecto";
        $sentencia = $connection->prepare($sql);
        $sentencia->bindParam(":idproyecto", $proyecto_idproyecto);
        if(!$sentencia){
            return false;
        }else{
            $sentencia->execute();
            $result = $sentencia->fetch();
            return $result;
        }
    }
    //Obtener el nombre y apellidos de los estudiantes de un proyecto
    public function getNameApellidos($proyecto_idproyecto){
        $model = new Conection();
        $connection = $model->_getConection();
        $sql ="SELECT e.nombre, e.apellidos FROM `estudiante` e inner join equipo eq on e.idestudiante = eq.estudiante_idestudiante inner join proyecto p on eq.proyecto_idproyecto = p.idproyecto where p.idproyecto= :idproyecto";
        $sentencia = $connection->prepare($sql);
        $sentencia->bindParam(":idproyecto", $proyecto_idproyecto);
        if(!$sentencia){
            return false;
        }else{
            $sentencia->execute();
            $result = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }
    }
    //Obtener el nombre de la materia de un proyecto
    public function getNameMateria($grado_idgrado){
        $model = new Conection();
        $connection = $model->_getConection();
        $sql ="SELECT m.nombre FROM `materia` m inner join proyecto p on m.idmateria = p.materia_idmateria where p.materia_idmateria=:idmateria";
        $sentencia = $connection->prepare($sql);
        $sentencia->bindParam(":idmateria", $grado_idgrado);
        if(!$sentencia){
            return false;
        }else{
            $sentencia->execute();
            $result = $sentencia->fetchColumn();
            return $result;
        }
    }
    //Obtener el nombre del grado de un proyecto
    public function getNameGrado($grado_idgrado){
        $model = new Conection();
        $connection = $model->_getConection();
        $sql ="SELECT g.nombre FROM `grado` g inner join proyecto p on g.idgrado = p.grado_idgrado where p.grado_idgrado=:idgrado";
        $sentencia = $connection->prepare($sql);
        $sentencia->bindParam(":idgrado", $grado_idgrado);
        if(!$sentencia){
            return false;
        }else{
            $sentencia->execute();
            $result = $sentencia->fetchColumn();
            return $result;
        }
    }
    //obtener el nombre del grado de un estudiante
    public function getNameGradoEstudiantes($grado_idgrado){
        $model = new Conection();
        $connection = $model->_getConection();
        $sql ="SELECT g.nombre FROM `grado` g inner join estudiante e on g.idgrado = e.grado_idgrado where e.grado_idgrado=:idgrado";
        $sentencia = $connection->prepare($sql);
        $sentencia->bindParam(":idgrado", $grado_idgrado);
        if(!$sentencia){
            return false;
        }else{
            $sentencia->execute();
            $result = $sentencia->fetchColumn();
            return $result;
        }
    }
    //obtener datos de equipo
    public function getTeamData($idTeam){
        $model = new Conection();
        $connection = $model->_getConection();
        $sql = "SELECT proyecto.idproyecto, proyecto.nombreProyecto, proyecto.descripcion, grado.*, materia.idmateria, materia.nombre AS nombreMateria FROM proyecto JOIN grado JOIN materia WHERE proyecto.idproyecto =:idTeam AND proyecto.grado_idgrado = grado.idgrado AND proyecto.materia_idmateria = materia.idmateria";
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
    public function getPointsbyUserandTeam($usuario, $team){
        $model = new Conection();
        $conexion = $model->_getConection();
        $sql = "SELECT * FROM `puntos` WHERE puntos.usuario_idUsuario =:user AND puntos.proyecto_idproyecto =:proyecto ";
        $sentencia = $conexion->prepare($sql);
        $sentencia->bindParam(':user', $usuario);
        $sentencia->bindParam(':proyecto', $team);
        if(!$sentencia){
            return false;
        }else{
            $sentencia->execute();
            $result = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }
    }
    public function getCriterioByID($criterio){
        $model = new Conection();
        $conexion = $model->_getConection();
        $sql = "SELECT * FROM `criterios` WHERE criterios.idcriterios = :idCriterio";
        $sentencia = $conexion->prepare($sql);
        $sentencia->bindParam(':idCriterio', $criterio);
        if(!$sentencia){
            return false;
        }else{
            $sentencia->execute();
            $result = $sentencia->fetch(PDO::FETCH_ASSOC);
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
          return   print_r($conexion->errorInfo());
        }else{
            $sentencia->execute();
            $result = $sentencia->fetch(PDO::FETCH_ASSOC);
            return $result;
        }
    }
    
       //Obtener la fecha de inicio de la tabla Parametros
       public function getFechaInicio($idparametros){
        $model = new Conection();
        $connection  = $model->_getConection();
            $sql = "SELECT paramFecha FROM parametros WHERE idparametros = :idparametros";
        $sentencia= $connection->prepare($sql);
        $sentencia->bindParam(":idparametros", $idparametros);

        if(!$sentencia){
            return "Error";
        }else{
            $sentencia->execute();
            $resultado = $sentencia->fetchColumn();
            
            return $resultado;
        }
    }
    //Obtener la fecha e cierre de la tabla Parametros
    public function getFechaFin($idparametros){
        $model = new Conection();
        $connection  = $model->_getConection();
            $sql = "SELECT paramFechaF FROM parametros WHERE idparametros = :idparametros";
        $sentencia= $connection->prepare($sql);
        $sentencia->bindParam(":idparametros", $idparametros);

        if(!$sentencia){
            return "Error";
        }else{
            $sentencia->execute();
            $resultado = $sentencia->fetchColumn();
            
            return $resultado;
        }
    }
     //Obtener la fecha e cierre de la tabla Parametros
     public function getFechas($nombre){
        $model = new Conection();
        $connection  = $model->_getConection();
            $sql = "SELECT paramFecha, paramFechaF FROM parametros WHERE nombre = :nombre";
        $sentencia= $connection->prepare($sql);
        $sentencia->bindParam(":nombre", $nombre);

        if(!$sentencia){
            return "Error";
        }else{
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            
            return $resultado[0];
        }
    }

    //Obtener el ID del proyecto segun el nombre
    public function getIdprojectsByNombre(){
        $model = new Conection();
        $connection  = $model->_getConection();
        $sql = "SELECT idproyecto FROM proyecto ORDER BY idproyecto DESC limit 1";
        $sentencia= $connection->prepare($sql);
        if(!$sentencia){
            return "Error";
        }else{
            $sentencia->execute();
            $resultado = $sentencia->fetchColumn();
            
            return $resultado;
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
    //Obtener los estudiantes filtrados segun el ID
    public function searchEstudiantesByName($nombre){
        $nombre = "%".$nombre."%";
        $model = new Conection();
        $connection  = $model->_getConection();
        $sql = "SELECT * FROM estudiante WHERE nombre LIKE :nombre";
        $sentencia= $connection->prepare($sql);
        $sentencia->bindParam(":nombre", $nombre);
        if(!$sentencia){
            return "Error";
        }else{
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            
            return $resultado;
        }
    }
    //Obtener los proyectos filtrados segun el nombre
    public function searchProyectsByName($nombreProyecto){
        $nombreProyecto = "%".$nombreProyecto."%";
        $model = new Conection();
        $connection  = $model->_getConection();
        $sql = "SELECT * FROM proyecto WHERE nombreProyecto LIKE :nombreProyecto";
        $sentencia= $connection->prepare($sql);
        $sentencia->bindParam(":nombreProyecto", $nombreProyecto);
        if(!$sentencia){
            return "Error";
        }else{
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            
            return $resultado;
        }
    }
    //Obtener los proyectos filtrados segun el ID
    public function searchProyectById($idproyecto){
        $idproyecto = "%".$idproyecto."%";
        $model = new Conection();
        $connection  = $model->_getConection();
        $sql = "SELECT * FROM proyecto WHERE idproyecto LIKE :idproyecto";
        $sentencia= $connection->prepare($sql);
        $sentencia->bindParam(":idproyecto", $idproyecto);
        if(!$sentencia){
            return "Error";
        }else{
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            
            return $resultado;
        }
    }
    //Obtener los estudiantes filtrados segun el ID
    public function searchAlumnosById($idestudiante){
        $idestudiante = "%".$idestudiante."%";
        $model = new Conection();
        $connection  = $model->_getConection();
        $sql = "SELECT * FROM estudiante WHERE idestudiante LIKE :idestudiante";
        $sentencia= $connection->prepare($sql);
        $sentencia->bindParam(":idestudiante", $idestudiante);
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
    public function searchUserByUsername($nameRubric){
        $nameRubric = "%".$nameRubric."%";
        $model = new Conection();
        $connection  = $model->_getConection();
        $sql = "SELECT * FROM usuario WHERE usuario LIKE :userName";
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

    //Obtener los usuarios filtrados según el nombre
    public function searchUserByName($filtro){
        $filtro = "%".$filtro."%";
        $model = new Conection();
        $connection  = $model->_getConection();
        $sql = "SELECT * FROM usuario WHERE nombres LIKE :filtro";
        $sentencia= $connection->prepare($sql);
        $sentencia->bindParam(":filtro", $filtro);
        if(!$sentencia){
            return "Error";
        }else{
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            
            return $resultado;
        }
    }

    //Obtener los usuarios filtrados según el apellido
    public function searchUserByLastName($filtro){
        $filtro = "%".$filtro."%";
        $model = new Conection();
        $connection  = $model->_getConection();
        $sql = "SELECT * FROM usuario WHERE apellidos LIKE :filtro";
        $sentencia= $connection->prepare($sql);
        $sentencia->bindParam(":filtro", $filtro);
        if(!$sentencia){
            return "Error";
        }else{
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            
            return $resultado;
        }
    }

    //Obtener los usuarios filtrados según el rol
    public function searchUserByRol($filtro){
        $filtro = "%".$filtro."%";
        $model = new Conection();
        $connection  = $model->_getConection();
        $sql = "SELECT * FROM usuario WHERE rol LIKE :filtro";
        $sentencia= $connection->prepare($sql);
        $sentencia->bindParam(":filtro", $filtro);
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
    //Obtener el id de los estudiantes segun el ID 

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
    //Obtener los parametros segun el de ID parametros
    public function getParametrosById($idparametros){
        $model = new Conection();
        $connection  = $model->_getConection();
        $sql = "SELECT * FROM parametros WHERE idparametros = :idparametros";
        $sentencia= $connection->prepare($sql);
        $sentencia->bindParam(":idparametros", $idparametros);
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
    //Obtener el grado por medio del ID
    public function getGradeById($idgrado){
        $model = new Conection();
        $connection  = $model->_getConection();
        $sql = "SELECT * FROM grado WHERE idgrado = :gradoID";
        $sentencia= $connection->prepare($sql);
        $sentencia->bindParam(":gradoID", $idgrado['grado_idgrado']);
        if(!$sentencia){
            return "Error";
        }else{
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            
            return $resultado;
        }
    }
//ver 2
    public function getGradeById2($idgrado){
        $model = new Conection();
        $connection  = $model->_getConection();
        $sql = "SELECT * FROM grado WHERE idgrado = :gradoID";
        $sentencia= $connection->prepare($sql);
        $sentencia->bindParam(":gradoID", $idgrado);
        if(!$sentencia){
            return "Error";
        }else{
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            
            return $resultado;
        }
    }
    public function getLevelbyGradeID($idgrado){
        $modelo = new Conection();
        $conexion = $modelo->_getConection();
        $sql = "SELECT grado.nivel_idnivel AS idnivel FROM grado WHERE  grado.idgrado = :idGrado";
        $sentencia = $conexion->prepare($sql);
        $sentencia->bindParam(":idGrado", $idgrado);
        if(!$sentencia){
            return false;
        }else{
            $sentencia->execute();
            $resultado = $sentencia->fetch();
            return $resultado;
        }
    }
    //get Level by name
    public function isALevelCreated($Nivel){
        $modelo = new Conection();
        $conexion = $modelo->_getConection();
        $sql = "SELECT nivel.idnivel FROM `nivel` WHERE nivel.nombre LIKE :Nivel LIMIT 1";
        $sentencia = $conexion->prepare($sql);
        $sentencia->bindParam(":Nivel", $Nivel);
        if(!$sentencia){
            return false;
        }else{
            $sentencia->execute();
            $resultado = $sentencia->fetch();
            return $resultado;
        }
    }
    //ver si existe el grado por el nombre 
    public function isAGradeCreated($idNivel, $nameGrado, $seccion){
        $modelo = new Conection();
        $conexion = $modelo->_getConection();
        $sql = "SELECT grado.idgrado FROM `grado` WHERE grado.nombre LIKE :grado AND grado.seccion LIKE :seccion AND grado.nivel_idnivel = :idNivel LIMIT 1";
        $sentencia = $conexion->prepare($sql);
        $sentencia->bindParam(":idNivel", $idNivel);
        $sentencia->bindParam(":grado", $nameGrado);
        $sentencia->bindParam(":seccion", $seccion);
        if(!$sentencia){
            return false;
        }else{
            $sentencia->execute();
            $resultado = $sentencia->fetch();
            return $resultado;
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

    //Obtener todos los jurados
    public function getJurys(){
        
        $modelo = new Conection;
        $conexion = $modelo->_getConection();
        $sql = "SELECT * FROM usuario WHERE rol = 'j'";
        $sentencia = $conexion->prepare($sql);
        if(!$sentencia){
            return false;
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
        $sql = "SELECT * FROM usuario WHERE usuario = :nombre AND password = :pass";
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

    //Obtener todos el usuario por el ID
    public function getUserById($idUser){
        $modelo = new Conection;
        $conexion = $modelo->_getConection();
        $sql = "SELECT * FROM usuario WHERE idUsuario = :iduser";
        $sentencia = $conexion->prepare($sql);
        $sentencia->bindParam(":iduser", $idUser);
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
        $sql = "SELECT * FROM usuario WHERE usuario = :nombre";
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
        $sql = "SELECT * FROM usuario WHERE usuario = :nameuser";
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
    //obtener asignacion
    public function getAsignacion(){
        
        $modelo = new Conection;
        $conexion = $modelo->_getConection();
        $sql = "SELECT * FROM asignacionj";
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
    //Obtener el estudiante por medio del ID
    public function getEstudiantesById($idestudiante){
        $modelo = new Conection;
        $conexion = $modelo->_getConection();
        $sql = "SELECT * FROM estudiante WHERE idestudiante= :idestudiante";
        $sentencia = $conexion->prepare($sql);
        $sentencia->bindParam(":idestudiante", $idestudiante);
        if(!$sentencia){
            return "";
        }else{
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            
            return $resultado;
        }
    }
    //Obtener el proyecto por medio del ID
    public function getProjectById($idproyecto){
        $modelo = new Conection;
        $conexion = $modelo->_getConection();
        $sql = "SELECT * FROM proyecto WHERE idproyecto= :idproyecto";
        $sentencia = $conexion->prepare($sql);
        $sentencia->bindParam(":idproyecto", $idproyecto);
        if(!$sentencia){
            return "";
        }else{
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            
            return $resultado;
        }
    }
    //Obtener todos los parametros

    public function getParametros(){
        $modelo = new Conection;
        $conexion = $modelo->_getConection();
        $sql = "SELECT * FROM parametros";
        $sentencia = $conexion->prepare($sql);
        if(!$sentencia){
            return "";
        }else{
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            
            return $resultado;
        }
    }
    //Obtener el iD de los parametros
    public function getIDparametros($nombre){
        $modelo = new Conection;
        $conexion = $modelo->_getConection();
        $sql = "SELECT idparametros FROM parametros WHERE nombre = :nombre";
        $sentencia= $conexion->prepare($sql);
        $sentencia->bindParam(":nombre", $nombre);
        if(!$sentencia){
            return "Error";
        }else{
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            
            return $resultado;
        }
    }
        //Obtener los equipos según el ID de equipo
        public function getEquipos($idequipo){
            $model = new Conection();
            $connection  = $model->_getConection();
            $sql = "SELECT * FROM equipo WHERE  = :idequipo";
            $sentencia= $connection->prepare($sql);
            $sentencia->bindParam(":idequipo", $idequipo);
            if(!$sentencia){
                return "Error";
            }else{
                $sentencia->execute();
                $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
                
                return $resultado;
            }
        }
        public function getPoints($userID, $teamID){
            $modelo = new Conection;
            $conexion = $modelo->_getConection();
            $sql = "SELECT puntaje.puntaje as points FROM puntaje WHERE puntaje.proyecto_idproyecto=:teamID AND puntaje.usuario_idUsuario=:userID";
            $sentencia = $conexion->prepare($sql);
            $sentencia->bindParam(":teamID", $teamID);
            $sentencia->bindParam(":userID", $userID);
            if(!$sentencia){
                return false;
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
    public function getMatterIdInproyects($idMateria){
        
        $modelo = new Conection;
        $conexion = $modelo->_getConection();
        $sql = "SELECT idmateria FROM materia WHERE idmateria IN(SELECT materia_idmateria FROM proyecto)AND idmateria=:idmateria";
        $sentencia = $conexion->prepare($sql);
        $sentencia->bindParam(":idmateria", $idMateria);
        
        if(!$sentencia){
            return "";
        }else{
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            
            return $resultado;
        }
    }
    #ver cuantas foraneas de niveles en grados
    public function getLevelIdInGrades($idnivel){
        
        $modelo = new Conection;
        $conexion = $modelo->_getConection();
        $sql = "SELECT COUNT(*) FROM nivel JOIN grado WHERE nivel.idnivel=grado.nivel_idnivel AND nivel.idnivel=:idnivel";
        $sentencia = $conexion->prepare($sql);
        $sentencia->bindParam(":idnivel", $idnivel);
        
        if(!$sentencia){
            return "";
        }else{
            $sentencia->execute();
            $resultado = $sentencia->fetchColumn();
            
            return $resultado;
        }
    }
    #ver cuantas foraneas de niveles en grados
    public function getLevelIdInRubrics($idnivel){
        
        $modelo = new Conection;
        $conexion = $modelo->_getConection();
        $sql = "SELECT COUNT(*) FROM nivel JOIN rubrica WHERE nivel.idnivel=rubrica.nivel_idnivel AND nivel.idnivel=:idnivel";
        $sentencia = $conexion->prepare($sql);
        $sentencia->bindParam(":idnivel", $idnivel);
        
        if(!$sentencia){
            return "";
        }else{
            $sentencia->execute();
            $resultado = $sentencia->fetchColumn();
            
            return $resultado;
        }
    }

    //Buscar el poryecto por nombre , grado y materia
    public function findPorjectbyNGM($nombre, $idGrado, $idMateria){
        $modelo = new Conection;
        $conexion = $modelo->_getConection();
        $sql = "SELECT proyecto.idproyecto FROM `proyecto` WHERE proyecto.nombreProyecto LIKE :nombre AND proyecto.grado_idgrado =:idGrado AND proyecto.materia_idmateria =:idMateria LIMIT 1";
        $sentencia = $conexion->prepare($sql);
        $sentencia->bindParam(":nombre", $nombre);
        $sentencia->bindParam(":idGrado", $idGrado);
        $sentencia->bindParam(":idMateria", $idMateria);
        if(!($sentencia)){
            return false;

        }else{
            $sentencia->execute();
            $result= $sentencia->fetch();
            return $result;
        }
    }
    public function findStudent($idStudent){
        $modelo = new Conection;
        $conexion = $modelo->_getConection();
        $sql = "SELECT COUNT(*) FROM estudiante WHERE estudiante.idestudiante = :idStudent LIMIT 1";
        $sentencia = $conexion->prepare($sql);
        $sentencia->bindParam(":idStudent", $idStudent);
        if(!($sentencia)){
            return false;

        }else{
            $sentencia->execute();
            $result= $sentencia->fetch();
            return $result;
        }
    }
    #ver cuantas foraneas de materia en rubrica
    public function getMatterIdInRubrics($idmateria){
        
        $modelo = new Conection;
        $conexion = $modelo->_getConection();
        $sql = "SELECT COUNT(*) FROM materia JOIN rubrica WHERE materia.idmateria=rubrica.materia_idmateria AND materia.idmateria=:idmateria";
        $sentencia = $conexion->prepare($sql);
        $sentencia->bindParam(":idmateria", $idmateria);
        
        if(!$sentencia){
            return "";
        }else{
            $sentencia->execute();
            $resultado = $sentencia->fetchColumn();
            
            return $resultado;
        }
    }
    public function getMatterIdInProyectos($idmateria){
        
        $modelo = new Conection;
        $conexion = $modelo->_getConection();
        $sql = "SELECT COUNT(*) FROM materia JOIN proyecto WHERE materia.idmateria=proyecto.materia_idmateria AND materia.idmateria=:idmateria";
        $sentencia = $conexion->prepare($sql);
        $sentencia->bindParam(":idmateria", $idmateria);
        
        if(!$sentencia){
            return "";
        }else{
            $sentencia->execute();
            $resultado = $sentencia->fetchColumn();
            
            return $resultado;
        }
    }
    public function getMatterIdInAssign($idmateria){
        
        $modelo = new Conection;
        $conexion = $modelo->_getConection();
        $sql = "SELECT COUNT(*) FROM materia JOIN asignacionj WHERE materia.idmateria=asignacionj.materia_idmateria AND materia.idmateria=:idmateria";
        $sentencia = $conexion->prepare($sql);
        $sentencia->bindParam(":idmateria", $idmateria);
        
        if(!$sentencia){
            return "";
        }else{
            $sentencia->execute();
            $resultado = $sentencia->fetchColumn();
            
            return $resultado;
        }
    }
    public function getGradeIdInProjects($idgrado){
        
        $modelo = new Conection;
        $conexion = $modelo->_getConection();
        $sql = "SELECT COUNT(*) FROM grado JOIN proyecto WHERE grado.idgrado=proyecto.grado_idgrado AND grado.idgrado=:idgrado";
        $sentencia = $conexion->prepare($sql);
        $sentencia->bindParam(":idgrado", $idgrado);
        
        if(!$sentencia){
            return "";
        }else{
            $sentencia->execute();
            $resultado = $sentencia->fetchColumn();
            
            return $resultado;
        }
    }
    public function getGradeIdInAssing($idgrado){
        
        $modelo = new Conection;
        $conexion = $modelo->_getConection();
        $sql = "SELECT COUNT(*) FROM grado JOIN asignacionj WHERE grado.idgrado=asignacionj.grado_idgrado AND grado.idgrado=:idgrado";
        $sentencia = $conexion->prepare($sql);
        $sentencia->bindParam(":idgrado", $idgrado);
        
        if(!$sentencia){
            return "";
        }else{
            $sentencia->execute();
            $resultado = $sentencia->fetchColumn();
            
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
    public function getIdLevelByGrado(){
        $modelo = new Conection;
        $conexion = $modelo->_getConection();
        $sql = "SELECT nivel_idnivel FROM grado";
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

    //Obtener proyectos
    public function getProject(){
        $modelo = new Conection;
        $conexion = $modelo->_getConection();
        $sql = "SELECT * FROM proyecto";
        $sentencia = $conexion->prepare($sql);
        if(!$sentencia){
            return "";
        }else{
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            
            return $resultado;
        }
    }
    //ranking desc
    public function getRankingDESC($idGrado, $idMateria){
        $modelo = new Conection;
        $conexion = $modelo->_getConection();
        $sql = "SELECT * FROM ranking WHERE ranking.grado_idgrado = :idGrado AND ranking.materia_idmateria = :idMateria ORDER BY ranking.notafinal DESC";
        $sentencia = $conexion->prepare($sql);
        $sentencia->bindParam(":idGrado", $idGrado);
        $sentencia->bindParam(":idMateria", $idMateria);
        if(!$sentencia){
            return "";
        }else{
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            
            return $resultado;
        }

    }
    public function getRankingbyID($idProject){
        $modelo = new Conection;
        $conexion = $modelo->_getConection();
        $sql = "SELECT * FROM ranking WHERE ranking.proyecto_idproyecto = :idproyecto LIMIT 1";
        $sentencia = $conexion->prepare($sql);
        $sentencia->bindParam(":idproyecto", $idProject);
        if(!$sentencia){
            return "";
        }else{
            $sentencia->execute();
            $resultado = $sentencia->fetch();
            
            return $resultado;
        }

    }
    //obtener grado por id
    public function getGradobyID($idGrado){
        $modelo = new Conection;
        $conexion = $modelo->_getConection();
        $sql = "SELECT * FROM grado WHERE grado.idgrado = :idGrado";
        $sentencia = $conexion->prepare($sql);
        $sentencia->bindParam(":idGrado", $idGrado);
        if(!$sentencia){
            return "";
        }else{
            $sentencia->execute();
            $resultado = $sentencia->fetch();
            
            return $resultado;
        }
    }
    //obtener cuantos proyecto hay con una grado 
    public function getCountPojectsByGrade($idGrado){
        $modelo = new Conection;
        $conexion = $modelo->_getConection();
        $sql = "SELECT COUNT(*) FROM proyecto WHERE proyecto.grado_idgrado = :idGrado";
        $sentencia = $conexion->prepare($sql);
        $sentencia->bindParam(":idGrado", $idGrado);
        if(!$sentencia){
            return false;
        }else{
            $sentencia->execute();
            $resultado = $sentencia->fetch();
            return $resultado;
        }
    }
    //obtener ids de materias que tienen los proyectos por grado
    public function getSubjectByGradeP($idGrade){
        $modelo = new Conection;
        $conexion = $modelo->_getConection();
        $sql = "SELECT proyecto.materia_idmateria FROM proyecto WHERE proyecto.grado_idgrado = :idGrado GROUP BY proyecto.materia_idmateria";
        $sentencia = $conexion->prepare($sql);
        $sentencia->bindParam(":idGrado", $idGrade);
        if(!$sentencia){
            return false;
        }else{
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        }
    }

    //ver si hay proyectos ya calificados por grado y materia
    public function getCountRatedPbyIDs($idGrado, $idSubject){
        $modelo = new Conection;
        $conexion = $modelo->_getConection();
        $sql = "SELECT COUNT(*) FROM proyecto WHERE proyecto.grado_idgrado = :idGrado AND  proyecto.materia_idmateria = :idMateria";
        $sentencia = $conexion->prepare($sql);
        $sentencia->bindParam(":idGrado", $idGrado);
        $sentencia->bindParam(":idMateria", $idSubject);
        if(!$sentencia){
            return false;
        }else{
            $sentencia->execute();
            $resultado = $sentencia->fetch();
            return $resultado;
        }
    }
    public function getCountRatedProject($idProject){
        $model = new Conection();
        $conexion = $model->_getConection();
        $sql = "SELECT COUNT(*) FROM `puntaje` WHERE puntaje.proyecto_idproyecto = :id";
        $sentencia = $conexion->prepare($sql);
        $sentencia->bindParam(":id", $idProject);
        if(!$sentencia){
            return false;
        }else{
            $sentencia->execute();
            $result = $sentencia->fetch();
            return $result;
        }
    }
    public function getRatedsProject($idProject){
        $model = new Conection();
        $conexion = $model->_getConection();
        $sql = "SELECT puntaje.puntaje FROM `puntaje` WHERE puntaje.proyecto_idproyecto = :id";
        $sentencia = $conexion->prepare($sql);
        $sentencia->bindParam(":id", $idProject);
        if(!$sentencia){
            return false;
        }else{
            $sentencia->execute();
            $result = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }

    }

    public function  getProjectsRateData($idProject){
        $model = new Conection();
        $conexion = $model->_getConection();
        $sql = "SELECT puntaje.puntaje, puntaje.usuario_idUsuario FROM `puntaje` WHERE puntaje.proyecto_idproyecto = :id";
        $sentencia = $conexion->prepare($sql);
        $sentencia->bindParam(":id", $idProject);
        if(!$sentencia){
            return false;
        }else{
            $sentencia->execute();
            $result = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }
    }
    //obtener la  materia por nombre 
    public function isASubjectSaved($nombre){
        $model = new Conection();
        $conexion = $model->_getConection();
        $sql = "SELECT materia.idmateria FROM materia WHERE  materia.nombre LIKE :materia LIMIT 1";
        $sentencia = $conexion->prepare($sql);
        $sentencia->bindParam(":materia", $nombre);
        if(!$sentencia){
            return false;
        }else{
            $sentencia->execute();
            $result = $sentencia->fetch();
            return $result;
        }

    }
    
    //obtener equipop por el proyecto y estudiante
    public function equipoExiste($codigo ,$idproyecto){
        $model = new Conection();
        $conexion = $model->_getConection();
        $sql = "SELECT COUNT(*) FROM equipo  WHERE  equipo.estudiante_idestudiante =:estudiante AND equipo.proyecto_idproyecto = :idProyecto LIMIT 1";
        $sentencia = $conexion->prepare($sql);
        $sentencia->bindParam(":estudiante", $codigo);
        $sentencia->bindParam(":idProyecto", $idproyecto);
        if(!$sentencia){
            return false;
        }else{
            $sentencia->execute();
            $result = $sentencia->fetch();
            return $result;
        }
    }
    //UPDATE

    //Usuario
    public function updateUser($idUser, $nameUser, $name, $last_name, $rol){
        $modelo = new Conection;
        $conexion = $modelo->_getConection();
        $sql = "UPDATE usuario SET usuario = :usuario, nombres = :nombre, apellidos = :apellido, rol = :rol WHERE usuario.idUsuario = :idUsuario";
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

    //Usuario
    public function updatePersonalData($nameUser, $name, $last_name, $email){
        $modelo = new Conection;
        $conexion = $modelo->_getConection();
        $sql = "UPDATE usuario SET nombres = :nombre, apellidos = :apellido, email = :correo WHERE usuario = :username";
        $sentencia = $conexion->prepare($sql);
        $sentencia->bindParam(":nombre", $name);
        $sentencia->bindParam(":apellido", $last_name);
        $sentencia->bindParam(":correo", $email);
        $sentencia->bindParam(":username", $nameUser);
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
        $sql = "UPDATE usuario SET 	password = :contra WHERE usuario = :username";
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
    public function updateRanking($proyecto, $puntaje){
        $modelo = new Conection;
        $conexion = $modelo->_getConection();
        $sql = "UPDATE ranking SET   notafinal = :puntaje WHERE proyecto_idproyecto = :proyecto";
        $sentencia = $conexion->prepare($sql);
        $sentencia->bindParam(":proyecto", $proyecto);
        $sentencia->bindParam(":puntaje", $puntaje);
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
    public function updateEstudiante($idestudiante, $name, $last_name, $grado_idgrado){
        $modelo = new Conection;
        $conexion = $modelo->_getConection();
        $sql = "UPDATE estudiante SET nombre = :nombre, apellidos = :apellidos, grado_idgrado = :grado_idgrado WHERE idestudiante = :idestudiante";
        
        $sentencia = $conexion->prepare($sql);
        $sentencia->bindParam(":nombre", $name);
        $sentencia->bindParam(":apellidos", $last_name);
        $sentencia->bindParam(":grado_idgrado", $grado_idgrado);
        $sentencia->bindParam(":idestudiante", $idestudiante);
        if(!$sentencia){
            return false;
        }else{
            $sentencia->execute();
            return true;
        }
    }
    //Proyectos
    public function updateProjects($idproyecto, $nombreProyecto, $descripcion){
        $modelo = new Conection;
        $conexion = $modelo->_getConection();
        $sql = "UPDATE proyecto SET nombreProyecto = :nombreProyecto,  descripcion = :descripcion WHERE idproyecto = :idproyecto";
        
        $sentencia = $conexion->prepare($sql);
        $sentencia->bindParam(":nombreProyecto", $nombreProyecto);
        $sentencia->bindParam(":descripcion", $descripcion);
        $sentencia->bindParam(":idproyecto", $idproyecto);
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
    // Equipo sin ID
    public function updataEquipos($estudiante, $proyecto){
        $modelo = new Conection;
        $conexion = $modelo->_getConection();
        $sql = "UPDATE equipo SET estudiante_idestudiante = :estudiante, proyecto_idproyecto = :proyecto WHERE equipo.idequipo = :idEquipo";
        $sentencia = $conexion->prepare($sql);
        $sentencia->bindParam(":estudiante", $estudiante);
        $sentencia->bindParam(":proyecto", $estudiante);
        if(!$sentencia){
            return false;
        }else{
            $sentencia->execute();
            return true;
        }
    }
    public function updataParametros($idparametros, $paramFecha, $paramFechaF){
        $modelo = new Conection;
        $conexion = $modelo->_getConection();
        $sql = "UPDATE parametros SET paramFecha = :paramFecha, paramFechaF = :paramFechaF WHERE idparametros = :idparametros";
        $sentencia = $conexion->prepare($sql);
        $sentencia->bindParam(":paramFecha", $paramFecha);
        $sentencia->bindParam(":paramFechaF", $paramFechaF);
        $sentencia->bindParam(":idparametros", $idparametros);
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
    //Eliminar el proyecto por el ID
    public function deleteprojects($proyecto_idproyecto){
        $model = new Conection();
        $connection  = $model->_getConection();
        $sql = "DELETE FROM proyecto WHERE idproyecto = :idproyecto";
        $sentencia= $connection->prepare($sql);
        $sentencia->bindParam(":idproyecto", $proyecto_idproyecto);
        if(!$sentencia){
            return "Error";
        }else{
            $sentencia->execute();
            
            return "Hecho";
        }
    }
    public function deleteLevel($IdLevel){
        $modelo = new Conection;
        $conexion = $modelo->_getConection();
        $sql="DELETE FROM nivel WHERE idnivel=:idnivel";
        $sentencia = $conexion->prepare($sql);
        $sentencia->bindParam(":idnivel", $IdLevel);
        if(!$sentencia){
            return false;
        }else{
            $sentencia->execute();
            return true;
        }
    }
    public function deleteMatter($idmateria){
        $modelo = new Conection;
        $conexion = $modelo->_getConection();
        $sql="DELETE FROM materia WHERE idmateria=:idnivel";
        $sentencia = $conexion->prepare($sql);
        $sentencia->bindParam(":idnivel", $idmateria);
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

    //Eliminar los equipos por el ID
    public function deleteequipo($proyecto_idproyecto){
        $model = new Conection();
        $connection  = $model->_getConection();
        $sql = "DELETE FROM equipo WHERE proyecto_idproyecto = :proyecto_idproyecto";
        $sentencia= $connection->prepare($sql);
        $sentencia->bindParam(":proyecto_idproyecto", $proyecto_idproyecto);
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

    //Eliminar usuarios según el ID
    public function deleteUserById($idUser){
        $model = new Conection();
        $connection  = $model->_getConection();
        $sql = "DELETE FROM usuario WHERE idUsuario = :usuarioID";
        $sentencia= $connection->prepare($sql);
        $sentencia->bindParam(":usuarioID", $idUser);
        if(!$sentencia){
            return false;
        }else{
            $sentencia->execute();
            
            return true;
        }
    }
    //Eliminar estudiante segun el ID
    public function deleteStudents($id_estudiantes){
        $model = new Conection();
        $connection  = $model->_getConection();
        $sql = "DELETE FROM estudiante WHERE idestudiante = :idestudiante";
        $sentencia= $connection->prepare($sql);
        $sentencia->bindParam(":idestudiante", $id_estudiantes);
        if(!$sentencia){
            return false;
        }else{
            $sentencia->execute();
            
            return true;
        }
    }
    //Eliminar asignaciones según el ID
    public function deleteAssignById($idassign){
        $model = new Conection();
        $connection  = $model->_getConection();
        $sql = "DELETE FROM asignacionj WHERE idasignacionJ = :asignacionID";
        $sentencia= $connection->prepare($sql);
        $sentencia->bindParam(":asignacionID", $idassign);
        if(!$sentencia){
            return false;
        }else{
            $sentencia->execute();
            
            return true;
        }
    }
    public function selectGradobyID($idGrado){
        $modelo = new Conection;
        $conexion = $modelo->_getConection();
        $sql = "SELECT nombre,seccion,nivel_idnivel FROM grado WHERE idgrado=:id";
        $sentencia = $conexion->prepare($sql);
        $sentencia->bindParam(":id", $idGrado);
        /*$sentencia->bindParam(":seccion", $name);
        $sentencia->bindParam(":nivel", $seccion);
        $sentencia->bindParam(":idGrado", $nivel);*/
        if(!$sentencia){
            return false;
        }else{
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        }
    }

}

?>