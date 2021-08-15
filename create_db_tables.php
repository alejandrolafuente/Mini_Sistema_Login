<?php
require 'db_credentials.php';

// Create connection
$conn = mysqli_connect($servername, $username, $db_password);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


$sql = "CREATE DATABASE $dbname";
if (mysqli_query($conn, $sql)) {
    echo "<br>Banco de Dados criado com sucesso!<br>";
} else {
    echo "<br>Erro ao criar o Banco de Dados: " . mysqli_error($conn);
}; echo "<br>";


$sql = "USE $dbname";
if (mysqli_query($conn, $sql)) {
    echo "<br>Banco de dados trocado com sucesso!<br>";
} else {
    echo "<br>Error changing database: " . mysqli_error($conn);
}


$sql = "CREATE TABLE $table_users (
  id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  email VARCHAR(100) NOT NULL,
  password VARCHAR(128) NOT NULL,
  UNIQUE (email)
)";

if (mysqli_query($conn, $sql)) {
    echo "<br>Table created successfully<br>";
} else {
    echo "<br>Erro ao criar tabela: " . mysqli_error($conn);
}

mysqli_close($conn)
?>
