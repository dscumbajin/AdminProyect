<?php 
$conn = new mysqli('localhost', 'root', 'root', 'proyectos_db',3306);
if($conn->connect_error){
    echo $error = $conn->connect_error;
}

function suma($a, $b){
    return $a+$b;
}

?>