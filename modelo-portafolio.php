<?php
    include_once('funciones/funciones.php');
    $area = $_POST['area'];

    $id_registro = $_POST['id_registro'];
    
// Crear nuevo registro
if ($_POST['registro'] == 'nuevo') {
 //die(json_encode(($_POST))); 
    try {
        $stmt = $conn->prepare('INSERT INTO portafolios (area) VALUES(?)');
        $stmt->bind_param('s', $area);
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
            $stmt = $conn->prepare('UPDATE portafolios SET area = ?, editado = NOW() WHERE portafolio_id =?');
            $stmt->bind_param('si', $area, $id_registro);
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
    $stmt = $conn->prepare('DELETE FROM portafolios WHERE portafolio_id = ?');
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
