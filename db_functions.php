<?php
require "db_credentials.php";

function connect_db(){ // apenas "junta" os processos para estabelecer conn
  global $servername, $username, $db_password, $dbname;
  $conn = mysqli_connect($servername, $username, $db_password, $dbname);

  if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
  }

  return($conn);
}

function disconnect_db($conn){ // fecha a conexão com db
  mysqli_close($conn);
}

?>
