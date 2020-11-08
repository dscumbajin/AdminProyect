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
?>