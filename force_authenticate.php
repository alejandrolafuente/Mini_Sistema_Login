<?php
// usa este arquivo quando usuário pode acessar determinada página somente
// quando estiver logado
  require "authenticate.php";

  if(!$login){
    die("Você não tem permissão para acessar essa página.");
  }

?>
