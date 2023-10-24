<?php
include "verifica.php";
$acesso->add();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <title>Adicionar Editor</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="css/style.css" rel="stylesheet">

  <!-- Ultima versão do bootstrap CSS, JS & FONT AWESOME -->
  <link rel="stylesheet" media="screen" href="//netdna.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.2/css/font-awesome.min.css">

</head>

<body>
  <?php include "header.php"; ?>

  <!--//----CONTEUDO---//-->
  <main class="container">
    <br><br><br>

    <h2>Novo Usuário</h2>

    <form action="" method="post" enctype="multipart/form-data">
      <!-- area de campos do form -->
      <hr />
      <div class="row">
        <div class="form-group col-md-12">
          <label for="name">Nome</label>
          <input type="text" class="form-control" name="nome">
        </div>
      </div>



      <div class="row">
        <div class="form-group col-md-6">
          <label for="campo1">Login</label>
          <input type="text" class="form-control" name="login">
        </div>

        <div class="form-group col-md-6">
          <label for="campo2">Senha</label>
          <input type="password" class="form-control" name="senha">
        </div>



        <div id="actions" class="row">
          <div class="col-md-12">
            <button type="submit" class="btn btn-primary">Salvar</button>
            <a href="usuarios.php" class="btn btn-default">Cancelar</a>
          </div>
        </div>
        <input type="hidden" name="acao" value="addUsuarios">
    </form>

  </main>
  <!--//----FIM DO CONTEUDO---//-->
  <hr>
  <?php include "footer.php"; ?>

</body>
<!--Ultima versão do jquery-->
<script src="//code.jquery.com/jquery.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
<script src="vendor/ckeditor/ckeditor.js"></script>

</html>