<?php

$host = "localhost";
$user = "root";
$password = "root";
$db = "futebol_db"; 

$conn = mysqli_connect ($host, $user, $password, $db); 

if (!$conn) {
    echo "Falha na conexão!";
}
?>