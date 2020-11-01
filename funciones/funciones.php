<?php 
$conn = new mysqli('localhost', 'root', 'root', 'proyectos_db',3307);
if($conn->connect_error){
    echo $error = $conn->connect_error;
}
?>