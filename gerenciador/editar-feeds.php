<?php
include "verifica.php";
$feeds->editar();

$descFeeds = $feeds->rsDados(intval($_GET['id']));
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=euc-jp">
  <title>Atualizar Feeds</title>

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

    <h2>Atualizar Feeds</h2>

    <form action="" method="post" enctype="multipart/form-data">
      <!-- area de campos do form -->
      <hr />

      <div class="row">
        <div class="form-group col-md-4">
          <label for="name">Nome do Feed</label>
          <input type="text" class="form-control" name="titulo" value='<?php echo $descFeeds->titulo; ?>'>
        </div>
        <div class="form-group col-md-4">
          <label for="name">Link do Feed</label>
          <input type="text" class="form-control" name="embed" placeholder="Link do Feed" value="<?php echo $descFeeds->embed; ?>">
        </div>
        <div class="form-group col-md-4">
          <label for="name">Fonte</label>
          <input type="text" class="form-control" name="fonte" placeholder="Fonte do Feed" value="<?php echo $descFeeds->fonte; ?>">
        </div>
      </div>

      <div id="actions" class="row">
        <div class="col-md-12">
          <button type="submit" class="btn btn-primary">Salvar</button>
          <a href="videos.php" class="btn btn-default">Cancelar</a>
        </div>
      </div>
      <input type="hidden" name="acao" value="editarFeeds">
      <input type="hidden" name="id" value="<?php echo $descFeeds->id; ?>">
      <input type="hidden" name="data" value="<?php echo date('Y-m-d'); ?>">

    </form>

  </main>
  <!--//----FIM DO CONTEUDO---//-->
  <hr>
  <?php include "footer.php"; ?>

</body>
<!--Ultima versão do jquery-->

<script src="vendor/ckeditor/ckeditor.js"></script>

</html>