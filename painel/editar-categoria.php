<?php
include "verifica.php";
$acesso->restritoAdmin();
if (isset($_GET['id'])) {
    if (empty($_GET['id'])) {
        header('Location:'.SITE_URL.'categorias');
    } else {
        $id = $_GET['id'];
    }
}

$categorias->editar();
$dadosCategoria = $categorias->dadosCategorias($id);
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <title>Editar Categoria</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="css/style.css" rel="stylesheet">

  <!-- Ultima versão do bootstrap CSS, JS & FONT AWESOME -->
  <link rel="stylesheet" media="screen" href="//netdna.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.2/css/font-awesome.min.css">

</head>

<body>
  <?php //include "header.php"; ?>

  <!--//----CONTEUDO---//-->
  <main class="container">
    <br><br><br>

    <h2>Editar Categoria</h2>

    <form action="" method="post">
      <!-- area de campos do form -->
      <hr />
      <div class="row">
        <div class="form-group col-md-12">
          <label for="name">Titulo</label>
          <input type="text" class="form-control" name="titulo" value="<?php echo $dadosCategoria->titulo; ?>">
        </div>
      </div>
      <div class="row">
        <div class="form-group col-md-12">
          <label for="name">Ordem</label>
          <input type="text" class="form-control" name="ordem" value="<?php echo $dadosCategoria->ordem; ?>">
        </div>
      </div>
      <div id="actions" class="row">
        <div class="col-md-12">
          <button type="submit" class="btn btn-primary">Salvar</button>
          <a href="<?php echo SITE_URL?>categorias" class="btn btn-default">Cancelar</a>
        </div>
      </div>
      <input type="hidden" name="acao" value="editarCategoria">
      <input type="hidden" name="id" value="<?php echo $dadosCategoria->id; ?>">
    </form>

  </main>
  <!--//----FIM DO CONTEUDO---//-->
  <hr>
  <?php //include "footer.php"; ?>

</body>
<!--Ultima versão do jquery-->

<!-- <script src="vendor/ckeditor/ckeditor.js"></script> -->

</html>