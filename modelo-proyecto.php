<?php
include_once('funciones/funciones.php');
$inicio = date('Y-m-d',time());
$detalle = $_POST['detalle'];
$objetivo_estrategico = $_POST['objetivo_estrategico'];
$alcance = $_POST['alcance'];
$presupuesto_inicial = $_POST['presupuesto_inicial'];
$portafolio_id = $_POST['area'];
$programa_id = $_POST['descripcion'];
$estado_neural = $_POST['estado_neural'];
$estado = $_POST['estado'];
$url_video = $_POST['url_video'];
$url_documento = $_POST['url_documento'];
$comentario = " ";
$cuenta = $_POST['cuenta'];
$id_registro = $_POST['id_registro'];

// Crear nuevo registro
if ($_POST['registro'] == 'nuevo') {
    /* $respuesta = array(
        'post' => $_POST,
        'file' => $_FILES
    );
    die(json_encode(($respuesta))); */

    $valores = array();
    //Como el elemento es un arreglos utilizamos foreach para extraer todos los valores
    foreach ($_FILES["archivo"]['tmp_name'] as $key => $tmp_name) {
        //Validamos que el archivo exista
        if ($_FILES["archivo"]["name"][$key]) {
            $filename = $_FILES["archivo"]["name"][$key]; //Obtenemos el nombre original del archivo
            $source = $_FILES["archivo"]["tmp_name"][$key]; //Obtenemos un nombre temporal del archivo

            $directorio = 'docs/'; //Declaramos un  variable con la ruta donde guardaremos los archivos

            //Validamos si la ruta de destino existe, en caso de no existir la creamos
            if (!file_exists($directorio)) {
                mkdir($directorio, 0777, true) or die("No se puede crear el directorio");
            }

            $dir = opendir($directorio); //Abrimos el directorio de destino
            $target_path = $directorio . '/' . $filename; //Indicamos la ruta de destino, así como el nombre del archivo

            //Movemos y validamos que el archivo se haya cargado correctamente
            //El primer campo es el origen y el segundo el destino
            if (move_uploaded_file($source, $target_path)) {
                $valores[] = $filename;
                $resultado_doc = "Se subio correctamente";
            } else {
                $respuesta = array(
                    'respuesta' => error_get_last()
                );
            }
            closedir($dir); //Cerramos el directorio de destino
        }
    }

    $cadena = implode(",", $valores);

    try {
        $stmt = $conn->prepare('INSERT INTO proyectos (inicio, detalle, objetivo_estrategico, alcance, presupuesto_inicial, estado_neural, estado_id, portafolio_id, programa_id, url_video, url_documento, cuenta) VALUES(?,?,?,?,?,?,?,?,?,?,?,?)');
        $stmt->bind_param('ssssdsiiisss',$inicio, $detalle, $objetivo_estrategico,$alcance, $presupuesto_inicial, $estado_neural, $estado, $portafolio_id, $programa_id, $url_video, $cadena, $cuenta);
        $stmt->execute();

        $id_registro = $stmt->insert_id;
        $valores = [];
        if ($stmt->affected_rows) {

            $stmt = $conn->prepare('INSERT INTO proyecto_estado (proyecto_id, estado_id) VALUES(?,?)');
            $stmt->bind_param('ii', $id_registro, $estado);
            $stmt->execute();

            $respuesta = array(
                'respuesta' => 'exito',
                'id_insertado' => $id_registro,
                'resultado_doc' => $resultado_doc
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
    /* $respuesta = array(
        'post' => $_POST,
        'file' => $_FILES
    );
    die(json_encode(($respuesta))); */


    $valores = array();
    //Como el elemento es un arreglos utilizamos foreach para extraer todos los valores
    foreach ($_FILES["archivo"]['tmp_name'] as $key => $tmp_name) {
        //Validamos que el archivo exista
        if ($_FILES["archivo"]["name"][$key]) {
            $filename = $_FILES["archivo"]["name"][$key]; //Obtenemos el nombre original del archivo
            $source = $_FILES["archivo"]["tmp_name"][$key]; //Obtenemos un nombre temporal del archivo

            $directorio = 'docs/'; //Declaramos un  variable con la ruta donde guardaremos los archivos

            //Validamos si la ruta de destino existe, en caso de no existir la creamos
            if (!file_exists($directorio)) {
                mkdir($directorio, 0777, true) or die("No se puede crear el directorio");
            }

            $dir = opendir($directorio); //Abrimos el directorio de destino
            $target_path = $directorio . '/' . $filename; //Indicamos la ruta de destino, así como el nombre del archivo

            //Movemos y validamos que el archivo se haya cargado correctamente
            //El primer campo es el origen y el segundo el destino
            if (move_uploaded_file($source, $target_path)) {
                $valores[] = $filename;
                $resultado_doc = "Se subio correctamente";
            } else {
                $respuesta = array(
                    'respuesta' => error_get_last()
                );
            }
            closedir($dir); //Cerramos el directorio de destino
        }
    }
    $cadena = implode(",", $valores);

    try {

        //Como el elemento es un arreglos utilizamos foreach para extraer todos los valores
        foreach ($_FILES["archivo"]['tmp_name'] as $key => $tmp_name) {


            if ($_FILES['archivo']['size'][$key] > 0) {

                $stmt = $conn->prepare('UPDATE proyectos SET detalle= ?, objetivo_estrategico= ? , alcance= ?, presupuesto_inicial =? , estado_neural= ?, estado_id= ?, portafolio_id= ?, programa_id= ?,url_video = ?, url_documento = ?, cuenta=?, editado = NOW() WHERE proyecto_id =?');
                $stmt->bind_param('sssdsiiisssi', $detalle, $objetivo_estrategico,$alcance, $presupuesto_inicial, $estado_neural, $estado, $portafolio_id, $programa_id, $url_video, $cadena, $cuenta, $id_registro);
            } else {
                // Sin Archivos
                $stmt = $conn->prepare('UPDATE proyectos SET detalle= ?, objetivo_estrategico= ? , alcance= ?, presupuesto_inicial =? , estado_neural= ?, estado_id= ?, portafolio_id= ?, programa_id= ?,url_video = ?, url_documento = ?, cuenta=?, editado = NOW() WHERE proyecto_id =?');
                $stmt->bind_param('sssdsiiisssi', $detalle, $objetivo_estrategico, $alcance, $presupuesto_inicial, $estado_neural, $estado, $portafolio_id, $programa_id, $url_video, $url_documento, $cuenta, $id_registro);
            }
        }
        $stmt->execute();
        $valores = [];

        if ($stmt->affected_rows) {
            $stmt = $conn->prepare('UPDATE proyecto_estado SET estado_id= ?,comentario=?, editado = NOW() WHERE proyecto_id =?');
            $stmt->bind_param('isi', $estado, $comentario, $id_registro);
            $stmt->execute();

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
    //buscar el proyecto por id
    $sql = "SELECT * FROM proyectos WHERE proyecto_id = $id_borrar";
    $resultado = $conn->query($sql);
    $proyecto = $resultado->fetch_assoc();
    // extraer el valor del url_documento
    // convertir a array

    if (!$proyecto['url_documento'] == "") {
        $array = explode(",", $proyecto['url_documento']);
    }

    try {
        $stmt = $conn->prepare('DELETE FROM proyectos WHERE proyecto_id = ?');
        $stmt->bind_param('i', $id_borrar);
        $stmt->execute();

        if ($stmt->affected_rows) {
            
            if(sizeof($array)>0){
                foreach ($array as $clave => $valor) {
                    unlink('docs/'.$valor);
                }
            }

            $stmt = $conn->prepare('DELETE ca FROM registros ca  LEFT JOIN cuentas cc ON ca.registros_id = cc.registros_id  WHERE cc.proyecto_id = ?');            
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
