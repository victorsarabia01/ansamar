<?php
 require_once('../modelo/conexion.php');
class Materia extends datos{ 



    public function consultar(){
        $co = $this->conecta();
            
            $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            try{
                
                
                $resultado = $co->prepare("SELECT
                materias.id AS id_materias,
                materias.nombre AS materias,
                GROUP_CONCAT(DISTINCT años.id) AS id_anos,
                GROUP_CONCAT(DISTINCT años.anos) AS Años,
                GROUP_CONCAT(DISTINCT CONCAT(docentes.nombre, ' ', docentes.apellido) ORDER BY docentes.nombre) AS docente_nombre_apellido,
                GROUP_CONCAT(DISTINCT docentes.cedula ORDER BY docentes.nombre) AS docente_cedula
            FROM
                materias
            LEFT JOIN
                años_materias ON materias.id = años_materias.id_materias
            LEFT JOIN
                años ON años_materias.id_anos = años.id
            LEFT JOIN
                materias_docentes ON materias.id = materias_docentes.id_materias
            LEFT JOIN
                docentes ON materias_docentes.id_docente = docentes.cedula
            WHERE
                materias.estado = 1
                AND materias_docentes.estado = 1  -- Agregar esta línea para filtrar por estado en materias_docentes
            GROUP BY
                materias.id;
            
                ");
                
                $resultado->execute();
                $r = $resultado->fetchAll(PDO::FETCH_ASSOC);
                return $r;
                 
                
            }catch(Exception $e){
                
                return false;
            }
    }
}

?>