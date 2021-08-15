<?php
  session_start();

  session_unset(); // apaga as variáveis da sessão

  session_destroy(); // apaga o cookie do navegador

  header("Location: " . dirname($_SERVER['SCRIPT_NAME']) . "/index.php");
  // redireciona p página principal do portal
?>
