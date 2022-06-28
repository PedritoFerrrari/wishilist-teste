<?php
session_start();
include('lib/conn.php');
if (isset($_POST['register'])) {
  $connection = DB::getInstance();
  $username = $_POST['nome'];
  $email = $_POST['email'];
  $password = $_POST['senha'];
  $password_hash = password_hash($password, PASSWORD_BCRYPT);
  $query = $connection->prepare("SELECT * FROM login WHERE email=:email");
  $query->bindParam("email", $email, PDO::PARAM_STR);
  $query->execute();
  if ($query->rowCount() > 0) {
    echo '<p class="alert alert-warning text-center error">Email já resgistrado!</p>';
  }
  if ($query->rowCount() == 0) {
    $query = $connection->prepare("INSERT INTO login(nome,senha,email) VALUES (:nome,:password_hash,:email)");
    $query->bindParam("nome", $username, PDO::PARAM_STR);
    $query->bindParam("password_hash", $password_hash, PDO::PARAM_STR);
    $query->bindParam("email", $email, PDO::PARAM_STR);
    $result = $query->execute();
    if ($result) {
      echo '<p class="alert alert-info text-center success">Registrado com sucesso!</p>';
    } else {
      echo '<p class="alert alert-warning text-center error">Algo deu errado!</p>';
    }
  }
}
?>

<html lang="pt-BR">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link type="text/css" href="frontend/style.css" rel="stylesheet" />
  <title>Registro</title>

  <link rel="apple-touch-icon" sizes="180x180" href="frontend/img/favicon_io/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="frontend/img/favicon_io/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="frontend/img/favicon_io/favicon-16x16.png">
  <link rel="manifest" href="frontend/img/favicon_io/site.webmanifest">

</head>

<body>
  <div class="container-fluid position-absolute top-50 start-50 translate-middle">
  <h1 style="text-align: center;">Registrar-se</h1>


  <form class="container w-25 p-3" method="post" action="" name="signup-form">

    <div class="form-outline mb-4">
      <input type="text" name="nome" class="form-control" placeholder="Pedro Cristal" />
      <label class="form-label" for="form2Example1">Nome</label>
    </div>

    <div class="form-outline mb-4">
      <input type="email" name="email" class="form-control" placeholder="smth@theemail.com" />
      <label class="form-label" for="form2Example1" >Email</label>
    </div>

    <div class="form-outline mb-4">
      <input type="password" name="senha" class="form-control" placeholder="**********" />
      <label class="form-label" for="form2Example2">Senha</label>
    </div>

    <div class="row mb-4">
      <div class="col d-flex justify-content-center">
      </div>

      <button class="btn bg-dark text-light btn-block mb-4" type="submit" name="register" value="register">Register</button>

      <div class="text-center">
        <p>Já tem uma conta? <a href="login.php">Entrar</a></p>
      </div>
  </form>
</div>

</body>

</html>