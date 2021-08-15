<?php
  require "authenticate.php";
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Tela principal</title>
  <link type="text/css" rel="stylesheet" href="css/estilo.css">
</head>
<body>
  <div class="container">
    <div class="agrupa">
      <h1>Seja Bem-vindo
        <?php
          if ($login) {
            echo ", $user_name!";
          }
          else {
            echo "!";
          }
        ?>
      </h1>
      <p>
        <strong>Escolha uma das opções:</strong>
      </p>
      <ul>
        <?php if ($login): //se está logado mostra botão logout?>
          <li><a href="logout.php">Logout</a></li>
        <?php else: ?>
          <li><a href="login.php">Login</a></li>
          <li><a href="register.php">Registrar-se</a></li>
        <?php endif; ?>
      </ul>
      </p>
    </div>
  </div>
</body>
</html>
