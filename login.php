<?php
require "db_functions.php";
require "authenticate.php";

$error = false;
$password = $email = "";

if (!$login && $_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_POST["email"]) && isset($_POST["password"])) {

    $conn = connect_db();

    $email = mysqli_real_escape_string($conn,$_POST["email"]);
    $password = mysqli_real_escape_string($conn,$_POST["password"]);
    $password = md5($password);
// agora vai comparar com as tuplas do BD:
    $sql = "SELECT id,name,email,password FROM $table_users
            WHERE email = '$email';";

    $result = mysqli_query($conn, $sql);
    if($result){
      if (mysqli_num_rows($result) > 0) { //  se achou vai ser um
        $user = mysqli_fetch_assoc($result);

        if ($user["password"] == $password) { // verifica se o que está no bd
                                              // eh igual ao digitado
          $_SESSION["user_id"] = $user["id"];
          $_SESSION["user_name"] = $user["name"];// ficam disponiveis entre
          $_SESSION["user_email"] = $user["email"]; // os acessos

          header("Location: " . dirname($_SERVER['SCRIPT_NAME']) . "/index.php");
          exit(); // usuario eh redirecionado para o index.php
        }
        else {
          $error_msg = "Senha incorreta!";
          $error = true;
        }
      }
      else{
        $error_msg = "Email incorreto!";
        $error = true;
      }
    }
    else {
      $error_msg = mysqli_error($conn);
      $error = true;
    }
  } // if (isset($_POST["email"]) && isset($_POST["password"]))
  else {
    $error_msg = "Por favor, preencha todos os dados.";
    $error = true;
  }
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Tela de Login</title>
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

</head>
<body style= "background-color: lightgreen" class="jumbotron text-center">
 <html>
 <div >
  <div>
    <h1>Tela de Login</h1>
    <?php if ($login): ?>
        <h3>Você já está logado!</h3>

      <?php exit(); ?>
    <?php endif; ?>

    <?php if ($error): ?>
      <h3 style="color:red;"><?php echo $error_msg; ?></h3>
    <?php endif; ?>

    <form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="post">
      <label for="email">Email: </label><br>
      <input type="text" name="email" value="<?php echo $email; ?>" required><br><br>

      <label for="password">Senha: </label><br>
      <input type="password" name="password" value="" required><br><br>

      <input type="submit" name="submit" value="Entrar"><br><br>
      <ul>
        <li><a href="index.php">Voltar</a></li>
      </ul>
    </form>

    </p>
  </div>
</div>
</body>
</html>
