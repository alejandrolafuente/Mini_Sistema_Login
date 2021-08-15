<?php
require "db_functions.php";

$error = false;
$success = false;
$name = $email = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_POST["name"]) && isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["confirm_password"])) {

    $conn = connect_db();

    $name = mysqli_real_escape_string($conn,$_POST["name"]); // impede sql injection
    $email = mysqli_real_escape_string($conn,$_POST["email"]);
    $password = mysqli_real_escape_string($conn,$_POST["password"]);
    $confirm_password = mysqli_real_escape_string($conn,$_POST["confirm_password"]);

    if ($password == $confirm_password) { // se T, insere usuário no BD
      $password = md5($password);

      $sql = "INSERT INTO $table_users
              (name, email, password) VALUES
              ('$name', '$email', '$password');";

      if(mysqli_query($conn, $sql)){
        $success = true;
      }
      else {
        $error_msg = mysqli_error($conn);
        $error = true;
      }
    }
    else {
      $error_msg = "Senha não confere com a confirmação, digite novamente.";
      $error = true;
    }
  }
  else { // if (isset($_POST["name"]) && isset($_POST["email"]) && isset .....
    $error_msg = "Por favor, preencha todos os dados.";
    $error = true;
  }
} // if ($_SERVER["REQUEST_METHOD"] == "POST")
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Tela de Cadastro</title>
  <link type="text/css" rel="stylesheet" href="css/estilo.css">
</head>
<body>
 <div class="container">
   <div>
      <h1>Dados para registro de novo usuário</h1>

      <?php if ($success): ?>
        <h3 style="color:blue;">Usuário criado com sucesso!</h3>
        <p>
          Seguir para <a href="login.php">login</a>.
        </p>
      <?php endif; ?>

      <?php if ($error): ?>
        <h3 style="color:red;"><?php echo $error_msg; ?></h3>
      <?php endif; ?>

      <form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="post">
        <label for="name">Nome: </label><br>
        <input type="text" name="name" value="<?php echo $name; ?>" required><br>

        <label for="email">Email: </label><br>
        <input type="text" name="email" value="<?php echo $email; ?>" required><br>

        <label for="password">Senha: </label><br>
        <input type="password" name="password" value="" required><br>

        <label for="confirm_password">Confirmação da Senha: </label><br>
        <input type="password" name="confirm_password" value="" required><br><br>

        <input type="submit" name="submit" value="Criar usuário">
      </form>

      <ul>
        <li><a href="index.php">Voltar</a></li>
      </ul>
      </p>
    </div>
 </div>
</body>
</html>
