<?php 
$conn = new mysqli('localhost', 'root', 'root', 'proyectos_db',3306);
if($conn->connect_error){
    echo $error = $conn->connect_error;
}


function pagar($estado_id, $mes, $anio)
                  {
                    $sql = " SELECT SUM(presupuesto) as total FROM cuentas ";
                    $sql .= " INNER JOIN proyectos ";
                    $sql .= " ON proyectos.proyecto_id= cuentas.proyecto_id ";
                    $sql .= " INNER JOIN registros ";
                    $sql .= " ON registros.registros_id= cuentas.registros_id ";
                    $sql .= " WHERE estado_id = $estado_id AND (MONTH(anio) = $mes AND YEAR(anio) = $anio) ";
                    return $sql;
                  }

                  date_default_timezone_set('America/Guayaquil');


function getPresupuesto($proyecto_id){
  
   $sql = " SELECT * FROM proyectos WHERE proyecto_id = $proyecto_id ";
   return $sql;
  }

  function getTotalInversionProyecto_id($proyecto_id){
    $sql = " SELECT  SUM(presupuesto) AS total FROM cuentas ";
    $sql .= " INNER JOIN registros ON registros.registros_id = cuentas.registros_id ";
    $sql .= " WHERE proyecto_id = $proyecto_id ";
    return $sql;
  }



?>