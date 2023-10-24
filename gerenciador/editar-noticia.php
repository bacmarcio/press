<?php
include "verifica.php";
if (isset($_GET['id'])) {
    if (empty($_GET['id'])) {
        header('Location: noticias.php');
    } else {
        $id = $_GET['id'];
    }
}
$blogs->editar();
$editaBlog = $blogs->rsDados($id);
$dadosCategorias = $categorias->rsDados();


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
  <?php include "header.php"; ?>

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
          <select name="categoria" id="categoria" class="form-control">
            <option value="">SELECIONE</option>
            <?php foreach ($dadosCategorias as $categoria) { ?>
              <option value="<?php echo $categoria->id; ?>" <?php if ($editaBlog->id_categoria == $categoria->id) {
                  echo "selected";
              } ?>><?php echo $categoria->nome; ?></option>
            <?php } ?>
          </select>

        </div>
        <div class="form-group col-md-2">
          <label for="campo1">Destaque</label>
          <select name="destaque" id="destaque" class="form-control">
            <option value="">SELECIONE</option>
            <option value="S" <?php if ($editaBlog->destaque == 'S') : echo "selected";
            endif; ?>>Sim</option>
            <option value="N" <?php if ($editaBlog->destaque == 'N') : echo "selected";
            endif; ?>>Não</option>
          </select>

        </div>
        <div class="form-group col-md-2">
          <label for="campo1">Ativo</label>
          <select name="ativo" id="ativo" class="form-control">
            <option value="">SELECIONE</option>
            <option value="S" <?php if ($editaBlog->ativo == 'S') : echo "selected";
            endif; ?>>Sim</option>
            <option value="N" <?php if ($editaBlog->ativo == 'N') : echo "selected";
            endif; ?>>Não</option>
          </select>

        </div>
        <div class="form-group col-md-2">
          <label for="campo1">Principal</label>
          <select name="principal" id="principal" class="form-control">
            <option value="">SELECIONE</option>
            <option value="S" <?php if ($editaBlog->principal == 'S') : echo "selected";
            endif; ?>>Sim</option>
            <option value="N" <?php if ($editaBlog->principal == 'N') : echo "selected";
            endif; ?>>Não</option>
          </select>

        </div>
        <div class="form-group col-md-2">
          <label for="campo1">Destaque da Categoria</label>
          <select name="cat_destaque" id="cat_destaque" class="form-control">
            <option value="">SELECIONE</option>
            <option value="S" <?php if ($editaBlog->cat_destaque == 'S') : echo "selected";
            endif; ?>>Sim</option>
            <option value="N" <?php if ($editaBlog->cat_destaque == 'N') : echo "selected";
            endif; ?>>Não</option>
          </select>

        </div>
        <div class="form-group col-md-3">
          <label for="campo1">Data
            <?php echo formataData($editaBlog->updated_at) ?>
          </label>

        </div>
      </div>
      <div class="row">
        <div class="form-group col-md-12">
          <label for="name">Titulo</label>
          <input type="text" class="form-control" name="titulo" value="<?php echo $editaBlog->titulo; ?>">
        </div>
      </div>

      <div class="row">
        <div class="form-group col-md-6">
          <label for="campo1">Foto</label>
          <input type="file" class="form-control" name="foto">
        </div>
        <div class="form-group col-md-6">
          <label for="campo1">Legenda Foto</label>
          <input type="text" class="form-control" name="legenda_imagem" value="<?php echo $editaBlog->legenda_imagem; ?>">
        </div>
      </div>
      <div class="row">
        <div class="form-group col-md-6">
          <label for="campo1">Arquivo PDF</label>
          <input type="file" class="form-control" name="pdf">
        </div>
        <div class="form-group col-md-6">
          <label for="campo1">Arquivo Audio</label>
          <input type="file" class="form-control" name="audio">
        </div>

      </div>
      <div class="row">
        <div class="form-group col-md-12">
          <label for="name">Fonte</label>
          <input type="text" class="form-control" name="postado_por" value="<?php echo $editaBlog->postado_por; ?>">
        </div>
      </div>

      <div class="row">
        <div class="form-group col-md-12">
          <label for="campo2">Resumo</label>
          <textarea name="breve" id="resumo" class="form-control" cols="30" rows="5"><?php echo $editaBlog->breve; ?></textarea>
        </div>
      </div>
      <div class="row">
        <div class="form-group col-md-12">
          <label for="campo2">Descrição</label>
          <textarea name="conteudo" id="ckeditor" class="ckeditor" cols="30" rows="10"><?php echo $editaBlog->conteudo; ?></textarea>
        </div>
      </div>
      <div class="form-group row">
        <div class="col-md-12 col-sm-12">
          <label class="col-form-label">Meta Title</label>
          <input class="form-control" type="text" name="meta_title" value="<?php if (isset($editaBlog->meta_title) && !empty($editaBlog->meta_title)) {
              echo $editaBlog->meta_title;
          } ?>" />
        </div>
      </div>
      <div class="form-group row">
        <div class="col-md-12 col-sm-12">
          <label class="col-form-label">Meta Keywords</label>
          <input class="form-control" type="text" name="meta_keywords" value="<?php if (isset($editaBlog->meta_keywords) && !empty($editaBlog->meta_keywords)) {
              echo $editaBlog->meta_keywords;
          } ?>" />
        </div>
      </div>
      <div class="form-group row">
        <div class="col-md-12 col-sm-12">
          <label class="col-form-label">Meta Description</label>
          <textarea name="meta_description" class="form-control" id="" cols="30" rows="10">
            <?php if (isset($editaBlog->meta_description) && !empty($editaBlog->meta_description)) {
                echo $editaBlog->meta_description;
            } ?>
          </textarea>
        </div>
      </div>
      <div id="actions" class="row">
        <div class="col-md-12">
          <button type="submit" class="btn btn-primary">Salvar</button>
          <a href="noticias.php" class="btn btn-default">Cancelar</a>
        </div>
      </div>
      <input type="hidden" name="acao" value="editaBlog">
      <input type="hidden" name="id" value="<?php echo $editaBlog->id; ?>">
      <input type="hidden" name="foto_Atual" value="<?php echo $editaBlog->foto; ?>">
      <input type="hidden" name="pdf_Atual" value="<?php echo $editaBlog->pdf; ?>">
      <input type="hidden" name="audio_Atual" value="<?php echo $editaBlog->audio; ?>">
    </form>

  </main>
  <!--//----FIM DO CONTEUDO---//-->
  <hr>
  <?php include "footer.php"; ?>

</body>
<!--Ultima versão do jquery-->

<script src="vendor/ckeditor/ckeditor.js"></script>
<script>
  $("#data").datepicker("setDate", <?php echo ($editaBlog->updated_at) ? $editaBlog->updated_at : ''; ?>);
</script>

</html>