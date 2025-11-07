<?php
$host = 'localhost';
$user = 'root';
$pass = ''; // senha do seu MySQL
$dbname = 'MockyCode';

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
} // else {
//     echo 'sucesso na conexao';
// }
?>