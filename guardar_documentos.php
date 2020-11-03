<?php
include_once('funciones/funciones.php');
$proyecto_id = $_POST['proyecto_id'];

// Crear nuevo registro
if ($_POST['registro'] == 'nuevo') {

/* 	$respuesta = array(
		'post' => $_POST,
		'file' => $_FILES
	);
  die(json_encode(($respuesta)));  */

$valores = array();
  //Como el elemento es un arreglos utilizamos foreach para extraer todos los valores
	foreach($_FILES["archivo"]['tmp_name'] as $key => $tmp_name)
	{
		//Validamos que el archivo exista
		if($_FILES["archivo"]["name"][$key]) {
			$filename = $_FILES["archivo"]["name"][$key]; //Obtenemos el nombre original del archivo
			$source = $_FILES["archivo"]["tmp_name"][$key]; //Obtenemos un nombre temporal del archivo
			
			$directorio = 'docs/'; //Declaramos un  variable con la ruta donde guardaremos los archivos
			
			//Validamos si la ruta de destino existe, en caso de no existir la creamos
			if(!file_exists($directorio)){
				mkdir($directorio, 0777, true) or die("No se puede crear el directorio");	
			}
			
			$dir=opendir($directorio); //Abrimos el directorio de destino
			$target_path = $directorio.'/'.$filename; //Indicamos la ruta de destino, así como el nombre del archivo
			
			//Movemos y validamos que el archivo se haya cargado correctamente
			//El primer campo es el origen y el segundo el destino
			if(move_uploaded_file($source, $target_path)) {	
				$valores[]= $filename;
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
        $stmt = $conn->prepare('INSERT INTO documentos (url_documento) VALUES(?)');
        $stmt->bind_param('s', $cadena);
		$stmt->execute();
		$valores = [];
		$id_registro = $stmt->insert_id;

        if ($stmt->affected_rows) {

			$stmt = $conn->prepare('INSERT INTO proyecto_documento (proyecto_id, documento_id) VALUES(?,?)');
            $stmt->bind_param('ii', $proyecto_id, $id_registro);
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
