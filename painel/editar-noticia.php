<?php
include "verifica.php";
$acesso->restritoAdmin();
if (isset($_GET['id'])) {
    if (empty($_GET['id'])) {
        header('Location:'.SITE_URL.'noticias');
    } else {
        $id = $_GET['id'];
    }
}
$posts->editar();
$editaPost = $posts->dadosPosts($id);
$dadosCategorias = $categorias->dadosCategorias();


?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <title>Editar Notícias</title>
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

    <h2>Editar Notícia</h2>

    <form action="" method="post" enctype="multipart/form-data">
      <!-- area de campos do form -->
      <hr />
      <div class="row">



        <div class="form-group col-md-3">
          <label for="campo1">Categoria</label>
          <select name="id_categoria" id="categoria" class="form-control">
            <option value="">SELECIONE</option>
            <?php foreach ($dadosCategorias as $categoria) { ?>
              <option value="<?php echo $categoria->id; ?>" <?php if ($editaPost->id_categoria == $categoria->id) {
                  echo "selected";
              } ?>><?php echo $categoria->titulo; ?></option>
            <?php } ?>
          </select>

        </div>
        <div class="form-group col-md-2">
          <label for="campo1">Destaque</label>
          <select name="destaque" id="destaque" class="form-control">
            <option value="">SELECIONE</option>
            <option value="S" <?php if ($editaPost->destaque == 'S') : echo "selected";
            endif; ?>>Sim</option>
            <option value="N" <?php if ($editaPost->destaque == 'N') : echo "selected";
            endif; ?>>Não</option>
          </select>

        </div>
        <div class="form-group col-md-2">
          <label for="campo1">Ativo</label>
          <select name="ativo" id="ativo" class="form-control">
            <option value="">SELECIONE</option>
            <option value="S" <?php if ($editaPost->ativo == 'S') : echo "selected";
            endif; ?>>Sim</option>
            <option value="N" <?php if ($editaPost->ativo == 'N') : echo "selected";
            endif; ?>>Não</option>
          </select>

        </div>
        <div class="form-group col-md-3">
          <label for="campo1">Data
            <?php echo formataData($editaPost->updated_at) ?>
          </label>

        </div>
      </div>
      <div class="row">
        <div class="form-group col-md-12">
          <label for="name">Titulo</label>
          <input type="text" class="form-control" name="titulo" value="<?php echo $editaPost->titulo; ?>">
        </div>
      </div>

      <div class="row">
      <div class="form-group col-md-2">
          <img src="../post-images/<?php echo $editaPost->foto; ?>" alt="" width="60">
        </div>
        <div class="form-group col-md-5">
          <label for="campo1">Foto</label>
          <input type="file" class="form-control" name="foto">
        </div>
        <div class="form-group col-md-5">
          <label for="campo1">Legenda Foto</label>
          <input type="text" class="form-control" name="legenda" value="<?php echo $editaPost->legenda; ?>">
        </div>
      </div>
      
      <div class="row">
        <div class="form-group col-md-12">
          <label for="name">Fonte</label>
          <input type="text" class="form-control" name="postado_por" value="<?php echo $editaPost->postado_por; ?>">
        </div>
      </div>

      <div class="row">
        <div class="form-group col-md-12">
          <label for="campo2">Resumo</label>
          <textarea name="resumo" id="resumo" class="form-control" cols="30" rows="5"><?php echo $editaPost->resumo; ?></textarea>
        </div>
      </div>
      <div class="row">
        <div class="form-group col-md-12">
          <label for="campo2">Descrição</label>
          <textarea name="conteudo" id="ckeditor" class="ckeditor" cols="30" rows="10">
            <?php echo html_entity_decode($editaPost->conteudo,ENT_COMPAT); ?>
          </textarea>
          
        </div>
      </div>
      
      <div id="actions" class="row">
        <div class="col-md-12">
          <button type="submit" class="btn btn-primary">Salvar</button>
          <a href="<?php echo SITE_URL?>noticias" class="btn btn-default">Cancelar</a>
        </div>
      </div>
      <input type="hidden" name="acao" value="editarPost">
      <input type="hidden" name="id" value="<?php echo $editaPost->id; ?>">
      <input type="hidden" name="id_usuario" value="<?php echo $editaPost->id_usuario; ?>">
      <input type="hidden" name="foto_Atual" value="<?php echo $editaPost->foto; ?>">
    </form>
  </main>
  <!--//----FIM DO CONTEUDO---//-->
  <hr>
  <?php //include "footer.php"; ?>

</body>
<!--Ultima versão do jquery-->

<script src="../../vendor/ckeditor/ckeditor.js"></script>
<script>
  $("#data").datepicker("setDate", <?php echo ($editaPost->updated_at) ? $editaPost->updated_at : ''; ?>);
</script>

</html>