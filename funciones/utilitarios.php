<?php 

function pagar($estado_id, $mes, $anio){

    $sql = " SELECT SUM(presupuesto) as total FROM cuentas ";
$sql .= " INNER JOIN proyectos ";
$sql .= " ON proyectos.proyecto_id= cuentas.proyecto_id ";
$sql .= " INNER JOIN registros ";
$sql .= " ON registros.registros_id= cuentas.registros_id ";
$sql .= " WHERE estado_id = $estado_id AND (MONTH(anio) = $mes AND YEAR(anio) = $anio) ";
$resultado = $conn->query($sql);
$registrados = $resultado->fetch_assoc();

return $registrados['total'];  
}


?>