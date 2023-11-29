<?php

include "verifica.php";
$acesso->restritoAdmin();

$resultado = $usuarios->editar();


if (is_string($resultado)) {
    // A função retornou uma mensagem de erro
    echo $resultado;
} else {
    // A função retornou um sucesso (o redirecionamento é feito no próprio login)
}

if (isset($_GET['id'])) {
    if (empty($_GET['id'])) {
        header('Location:'.SITE_URL.'usuarios');
    } else {
        $id = $_GET['id'];
    }
}

$dados = $usuarios->dadosUsuarios($id);


?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <title>Editar Usuário</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  

  <!-- Ultima versão do bootstrap CSS, JS & FONT AWESOME -->
  <!-- <link rel="stylesheet" media="screen" href="//netdna.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.2/css/font-awesome.min.css"> -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link href="css/style.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</head>

<body>
  <?php //include "header.php";?>

  <!--//----CONTEUDO---//-->
  <main class="container">
    <br><br><br>

    <h2>Editar Usuário</h2>

    <form action="" method="post" enctype="multipart/form-data">
      <!-- area de campos do form -->
      <hr />
      <div class="row">
        <div class="form-group col-md-12">
          <label for="name">Nome</label>
          <input type="text" class="form-control" name="nome" value="<?php echo $dados->nome?>">
        </div>
      </div>

      <div class="row">
        <div class="form-group col-md-6">
          <label for="campo1">E-mail</label>
          <input type="text" class="form-control" name="login" value="<?php echo $dados->email?>">
        </div>

        <div class="form-group col-md-6">
          <label for="campo2">Senha</label>
          <input type="password" class="form-control" name="senha">
        </div>

        <div id="actions" class="row">
          <div class="col-md-12">
            <button type="submit" class="btn btn-primary">Salvar</button>
            <a href="<?php echo SITE_URL?>usuarios" class="btn btn-default">Cancelar</a>
          </div>
        </div>
        <input type="hidden" name="acao" value="editarUsuario">
        <input type="hidden" name="id" value="<?php echo $id;?>">
        

    </form>

  </main>
  <!--//----FIM DO CONTEUDO---//-->
  <hr>
  <?php //include "footer.php";?>

</body>
<!--Ultima versão do jquery-->
<script src="//code.jquery.com/jquery.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>

</html>