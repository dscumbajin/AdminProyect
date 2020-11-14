<?php
include_once('funciones/funciones.php');
$cuenta = $_POST['cuenta'];
$anio = $_POST['anio'];
$ncuenta =$_POST['ncuenta'];
$anio_formateada = date('Y-m-d', strtotime($anio));
$presupuesto = $_POST['presupuesto'];
$id_registro = $_POST['id_registro'];

// Crear nuevo registro
if ($_POST['registro'] == 'nuevo') {
    /* die(json_encode(($_POST)));  */
    try {

        // registrar en registros
        // true
        // registramos proyecto id y despues id registro

        $stmt = $conn->prepare('INSERT INTO registros (presupuesto, anio) VALUES(?,?)');
        $stmt->bind_param('ds', $presupuesto, $anio_formateada);
        $stmt->execute();
        $id_registro = $stmt->insert_id;

        if ($stmt->affected_rows) {


            $stmt = $conn->prepare('INSERT INTO cuentas (proyecto_id, registros_id, cuenta) VALUES(?,?,?)');
            $stmt->bind_param('iis', $cuenta, $id_registro, $ncuenta);
            $stmt->execute();

            $respuesta = array(
                'respuesta' => 'exito',
                'id_insertado' => $id_registro
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
    die(json_encode(($respuesta)));
}

//Editar Registro
if ($_POST['registro'] == 'actualizar') {
    // die(json_encode($_POST));
    try {
        $stmt = $conn->prepare('UPDATE registros SET presupuesto = ?, anio = ?, editado = NOW() WHERE registros_id =?');
        $stmt->bind_param('dsi', $presupuesto, $anio_formateada, $id_registro);
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

// Eliminar Registro
if ($_POST['registro'] == 'eliminar') {
    $id_borrar = $_POST['id'];
    try {
        $stmt = $conn->prepare('DELETE FROM registros WHERE registros_id = ?');
        $stmt->bind_param('i', $id_borrar);
        $stmt->execute();
        if ($stmt->affected_rows) {
            $stmt = $conn->prepare('DELETE FROM cuentas WHERE registros_id = ?');
            $stmt->bind_param('i', $id_borrar);
            $stmt->execute();
            $respuesta = array(
                'respuesta' => 'exito',
                'id_eliminado' => $id_borrar
            );
        } else {
            $respuesta = array(
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
