<?php

include "verifica.php";

$login = filter_input(INPUT_POST, 'login', FILTER_SANITIZE_SPECIAL_CHARS);
$senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_SPECIAL_CHARS);

$acesso->login($login, $senha);

$acesso->logout();

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <title>Sistema</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="Content-Security-Policy" content="style-src 'self' 'unsafe-inline' netdna.bootstrapcdn.com maxcdn.bootstrapcdn.com cdnjs.cloudflare.com; font-src 'self' fonts.gstatic.com fonts.googleapis.com netdna.bootstrapcdn.com maxcdn.bootstrapcdn.com cdnjs.cloudflare.com">

  <link href="css/style.css" rel="stylesheet">

  <!-- Ultima versão do bootstrap CSS, JS & FONT AWESOME -->
  <link rel="stylesheet" media="screen" href="//netdna.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.2/css/font-awesome.min.css">

</head>

<body>
  <?php //include "header.php";?>

  <!--//----CONTEUDO---//-->
  <main class="container col-md-offset-4">
    <br><br><br>
    <h2>Login</h2>

    <form action="" method="post">
      <!-- area de campos do form -->

      <div class="row">
        <div class="form-group col-md-4">
          <label for="name">Login</label>
          <input type="text" class="form-control" name="login">
        </div>
      </div>
      <div class="row">
        <div class="form-group col-md-4">
          <label for="name">Senha</label>
          <input type="password" class="form-control" name="senha">
        </div>
      </div>

      <div id="actions" class="row">
        <div class="col-md-12">
          <button type="submit" class="btn btn-primary">Confirmar</button>
          <!--<a href="index.php" class="btn btn-default">Cancelar</a>-->
          <input type="hidden" name="acao" value="login">
        </div>
      </div>
    </form>

  </main>

  <!--//----FIM DO CONTEUDO---//-->


  <?php include "footer.php"; ?>

</body>
<!--Ultima versão do jquery-->


</html>