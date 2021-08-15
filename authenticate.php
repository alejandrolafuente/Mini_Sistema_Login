
<?php
// chamamos esta pagina sempre que queremos verificar se usuário está logado
//este arquivo incicialmente verifica se existem informações do usuário
//salvas na sessão, ou seja, se está logado se sim, salva nas variaveis
//encapsuladas no if, $login = T somente se usuário está logado
  session_start(); // a sessão ainda não foi aberta no começo!
//
  if (isset($_SESSION["user_id"]) && isset($_SESSION["user_name"]) && isset($_SESSION["user_email"])) {
    $login = true;
    $user_id = $_SESSION["user_id"];
    $user_name = $_SESSION["user_name"];
    $user_email = $_SESSION["user_email"];
  }
  else{ // começa atribuindo false para a variavel $login
    $login = false;
  }

?>
