<?php
    include_once('funciones/funciones.php');
    $detalle = $_POST['detalle'];
    $objetivo_estrategico = $_POST['objetivo_estrategico'];
    $presupuesto_inicial = $_POST['presupuesto_inicial'];
    $portafolio_id = $_POST['area'];
    $programa_id = $_POST['descripcion'];
    $cuenta_id = $_POST['cuenta'];
    $estado_neural = $_POST['estado_neural'];
    $estado = $_POST['estado'];
    $url_video = $_POST['url_video'];
    $id_registro = $_POST['id_registro'];
    
// Crear nuevo registro
if ($_POST['registro'] == 'nuevo') {
  //  die(json_encode(($_POST))); 
    try {
        $stmt = $conn->prepare('INSERT INTO proyectos (detalle, objetivo_estrategico, presupuesto_inicial, estado_neural, estado_id, portafolio_id, programa_id, url_video) VALUES(?,?,?,?,?,?,?,?)');
        $stmt->bind_param('ssdsiiis', $detalle, $objetivo_estrategico, $presupuesto_inicial, $estado_neural, $estado, $portafolio_id, $programa_id, $url_video );
        $stmt->execute();
        $id_registro = $stmt->insert_id;
         
        if ($stmt->affected_rows) {
            $respuesta = array(
                'respuesta' => 'exito',
                'id_insertado' => $id_registro
            );
        }else{
            $respuesta = array(
                'respuesta' => 'error'
            );
        }
        $stmt->close();
        $conn->close();
    } catch (Exception $e) {
        $respuesta = array(
            'respuesta' => $e->getMessage()
        ); 
        
    }
    die(json_encode(($respuesta)));
}

//Editar Registro
if ($_POST['registro'] == 'actualizar') {
   // die(json_encode($_POST));
    try {
            $stmt = $conn->prepare('UPDATE proyectos SET detalle= ?, objetivo_estrategico= ?, presupuesto_inicial =? , estado_neural= ?, estado_id= ?, portafolio_id= ?, programa_id= ?,url_video = ?, editado = NOW() WHERE proyecto_id =?');
            $stmt->bind_param('ssdsiiisi', $detalle, $objetivo_estrategico, $presupuesto_inicial, $estado_neural, $estado, $portafolio_id, $programa_id,$url_video, $id_registro );
            $stmt->execute();
        if ($stmt->affected_rows) {
            $respuesta = array(
                'respuesta' => 'exito',
                'id_actualizado' => $id_registro
            );
        }else{
            $respuesta = array(
                'respuesta' => 'error'
            );
        }
        $stmt->close();
        $conn->close();
    } catch (Exception $e) {
        $respuesta = array(
            'respuesta' => $e->getMessage()
        );
    }
    die(json_encode($respuesta));
}

// Eliminar Registro
if ($_POST['registro'] == 'eliminar') {
$id_borrar = $_POST['id'];
try {
    $stmt = $conn->prepare('DELETE FROM proyectos WHERE proyecto_id = ?');
    $stmt->bind_param('i', $id_borrar);
    $stmt->execute();
    if ($stmt->affected_rows) {
        $respuesta = array(
            'respuesta' => 'exito',
            'id_eliminado' => $id_borrar
        );
    }else{
        $respuesta=array(
            'respuesta' => 'error'
        );
    }
} catch (Exception $e) {
    $respuesta = array(
        'respuesta' => $e->getMessage()
    );
}
die(json_encode($respuesta));
}
