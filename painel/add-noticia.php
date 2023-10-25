<?php
include "verifica.php";
$acesso->restritoAdmin();
$dadosCategorias = $categorias->dadosCategorias();
$posts->add();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <title>Adicionar Notícia</title>
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

    <h2>Nova Notícia</h2>

    <form action="" method="post" enctype="multipart/form-data">
      <!-- area de campos do form -->
      <hr />
      <div class="row">



        <div class="form-group col-md-3">
          <label for="campo1">Categoria</label>
          <select name="categoria" id="categoria" class="form-control">
            <option value="">SELECIONE</option>
            <?php foreach ($dadosCategorias as $categoria) : ?>
              <option value="<?php echo $categoria->id; ?>"><?php echo $categoria->titulo; ?></option>
            <?php endforeach; ?>
          </select>

        </div>
        <div class="form-group col-md-2">
          <label for="campo1">Destaque</label>
          <select name="destaque" id="destaque" class="form-control">
            <option value="S">Sim</option>
            <option value="N" selected>Não</option>
          </select>

        </div>
        <div class="form-group col-md-2">
          <label for="campo1">Ativo</label>
          <select name="ativo" id="ativo" class="form-control">
            <option value="S" selected>Sim</option>
            <option value="N">Não</option>
          </select>

        </div>
        
        <div class="form-group col-md-3">
          <label for="campo1">Data</label>
          <input type="text" name="data" disabled class="form-control" value="<?php echo date('d/m/Y'); ?>">

        </div>
      </div>
      <div class="row">
        <div class="form-group col-md-12">
          <label for="name">Titulo</label>
          <input type="text" class="form-control" name="titulo">
        </div>
      </div>

      <div class="row">
        <div class="form-group col-md-6">
          <label for="campo1">Foto</label>
          <input type="file" class="form-control" name="foto">
        </div>
        <div class="form-group col-md-6">
          <label for="campo1">Legenda Foto</label>
          <input type="text" class="form-control" name="legenda">
        </div>
      </div>
      <div class="row">
        <div class="form-group col-md-12">
          <label for="name">Fonte</label>
          <input type="text" class="form-control" name="postado_por">
        </div>
      </div>

      <div class="row">
        <div class="form-group col-md-12">
          <label for="campo2">Resumo</label>
          <textarea name="resumo" id="resumo" class="form-control" cols="30" rows="5"></textarea>
        </div>
      </div>
      <div class="row">
        <div class="form-group col-md-12">
          <label for="campo2">Descrição</label>
          <textarea name="conteudo" id="ckeditor" class="ckeditor" cols="30" rows="10"></textarea>
        </div>
      </div>
        <div id="actions" class="row">
          <div class="col-md-12">
            <button type="submit" class="btn btn-primary">Salvar</button>
            <a href="<?php echo SITE_URL?>noticias" class="btn btn-default">Cancelar</a>
          </div>
        </div>
        <input type="hidden" name="acao" value="addPost">
    </form>

  </main>
  <!--//----FIM DO CONTEUDO---//-->
  <hr>
  <?php //include "footer.php"; ?>

</body>
<!--Ultima versão do jquery-->

<script src="gerenciador/vendor/ckeditor/ckeditor.js"></script>

</html>