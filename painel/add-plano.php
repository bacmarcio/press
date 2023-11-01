<?php
include "verifica.php";
$acesso->restritoAdmin();
$planos->add();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <title>Adicionar Plano</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="css/style.css" rel="stylesheet">

  <!-- Ultima versão do bootstrap CSS, JS & FONT AWESOME -->
  <link rel="stylesheet" media="screen" href="//netdna.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.2/css/font-awesome.min.css">

</head>

<body>
  <?php //include "header.php"; 
  ?>

  <!--//----CONTEUDO---//-->
  <main class="container">
    <br><br><br>

    <h2>Adicionar Plano</h2>

    <form action="" method="post" enctype="multipart/form-data">
      <!-- area de campos do form -->
      <hr />
      <div class="row">
        <div class="form-group col-md-12">
          <label for="name">Titulo</label>
          <input type="text" class="form-control" name="titulo" value="">
        </div>

      </div>
      <div class="row">

        <div class="form-group col-md-6">
          <label for="campo1">Valor</label>
          <input type="text" class="form-control" name="valor" value="">
        </div>

        <div class="form-group col-md-6">
          <label for="campo1">Créditos</label>
          <input type="text" class="form-control" name="creditos" value="">
        </div>

      </div>
      <div class="row">

        <div class="form-group col-md-12">
          <label for="campo1">Foto</label>
          <input type="file" class="form-control" name="foto">
        </div>

      </div>

      <div class="row">

        <div class="form-group col-md-12">
          <label for="campo3">Descrição</label>
          <textarea name="conteudo" id="ckeditor" class="ckeditor" cols="30" rows="10"></textarea>
        </div>

      </div>

      <div id="actions" class="row">
        <div class="col-md-12">
          <button type="submit" class="btn btn-primary">Salvar</button>
          <a href="<?php echo SITE_URL ?>planos" class="btn btn-default">Cancelar</a>
        </div>
      </div>
      <input type="hidden" name="acao" value="addPlano">
      <input type="hidden" name="ativo" value="S">
    </form>

  </main>
  <!--//----FIM DO CONTEUDO---//-->
  <hr>
  <?php //include "footer.php"; 
  ?>

</body>
<!--Ultima versão do jquery-->

<script src="../vendor/ckeditor/ckeditor.js"></script>

</html>