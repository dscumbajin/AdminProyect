<?php
    include_once('funciones/funciones.php');
    $descripcion = $_POST['descripcion'];
    $id_registro = $_POST['id_registro'];
    
// Crear nuevo registro
if ($_POST['registro'] == 'nuevo') {
 //die(json_encode(($_POST))); 
    try {
        $stmt = $conn->prepare('INSERT INTO programas (descripcion) VALUES(?)');
        $stmt->bind_param('s', $descripcion);
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
            $stmt = $conn->prepare('UPDATE programas SET descripcion = ?, editado = NOW() WHERE programa_id =?');
            $stmt->bind_param('si', $descripcion, $id_registro);
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
    $stmt = $conn->prepare('DELETE FROM programas WHERE programa_id = ?');
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
