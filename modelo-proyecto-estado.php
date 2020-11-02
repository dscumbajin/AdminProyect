<?php
include_once('funciones/funciones.php');
$proyecto_id = $_POST['proyecto_id'];
$estado_id = $_POST['estado'];
$comentario = $_POST['comentario'];
$id_registro = $_POST['id_registro'];


//Editar Registro
if ($_POST['registro'] == 'actualizar') {
    // die(json_encode($_POST));
    try {
        $stmt = $conn->prepare('UPDATE proyecto_estado SET proyecto_id=?, estado_id = ?, comentario = ?, editado = NOW() WHERE id_pe =?');
        $stmt->bind_param('iisi',$proyecto_id,  $estado_id, $comentario, $id_registro);
        $stmt->execute();
        if ($stmt->affected_rows) {
            $respuesta = array(
                'respuesta' => 'exito',
                'id_actualizado' => $id_registro
            );
        } else {
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

