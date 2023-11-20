<?php
include "verifica.php";

if (isset($_GET['id'])) {
    if (empty($_GET['id'])) {
        header('Location:'.SITE_URL);
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
  <title>Editar Release</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Ultima versão do bootstrap CSS, JS & FONT AWESOME -->
  <link rel="stylesheet" media="screen" href="//netdna.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.2/css/font-awesome.min.css">
  <!-- <link href="css/style.css" rel="stylesheet"> -->

</head>

<body>
  <?php //include "header.php"; ?>

  <!--//----CONTEUDO---//-->
  <main class="container">
    <br><br><br>

    <h2>Editar Release</h2>

    <form action="" method="post" enctype="multipart/form-data" class="needs-validation" novalidate="" autocomplete="off">
      <!-- area de campos do form -->
      <hr />
      <div class="row">
        <div class="form-group col-md-4">
          <label for="validationCategoria">Categoria</label>
          <select name="id_categoria" id="validationCategoria" class="form-control" required>
            <option value="">SELECIONE</option>
            <?php foreach ($dadosCategorias as $categoria) { ?>
              <option value="<?php echo $categoria->id; ?>" <?php if ($editaPost->id_categoria == $categoria->id) {
                  echo "selected";
              } ?>><?php echo $categoria->titulo; ?></option>
            <?php } ?>
          </select>
          <!-- <div class="invalid-feedback">
            Por favor escolha uma categoria.
          </div>     -->
        </div>
        <div class="form-group col-md-4">&nbsp;</div>
        <div class="form-group col-md-4">
          <label for="campo1">Data</label>
          <input type="text" name="data" disabled class="form-control" value="<?php echo date('d/m/Y'); ?>">
        </div>
      </div>
      <div class="row">
        <div class="form-group col-md-12">
          <label for="name">Título do Release</label>
          <input type="text" class="form-control" name="titulo" value="<?php echo $editaPost->titulo; ?>">
        </div>
      </div>

      <div class="row">
      <div class="form-group col-md-2">
          <img src="../../post-images/<?php echo $editaPost->foto; ?>" alt="" width="60">
        </div>
        <div class="form-group col-md-5">
          <label for="campo1">Imagem do Release</label>
          <input type="file" class="form-control" name="foto">
        </div>
        <div class="form-group col-md-5">
          <label for="campo1">Legenda Imagem</label>
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
          <label for="campo2">Resumo da Release</label>
          <textarea name="resumo" id="resumo" class="form-control" cols="30" rows="5"><?php echo $editaPost->resumo; ?></textarea>
        </div>
      </div>
      <div class="row">
        <div class="form-group col-md-12">
          <label for="campo2">Release</label>
          <textarea name="conteudo" class="ckeditor" cols="30" rows="10">
            <?php echo html_entity_decode($editaPost->conteudo,ENT_COMPAT); ?>
          </textarea>
          
        </div>
      </div>
      
      <div id="actions" class="row">
        <div class="col-md-12">
          <button type="submit" class="btn btn-primary">Salvar</button>
          <a href="<?php echo SITE_URL?>" class="btn btn-default">Cancelar</a>
        </div>
      </div>
      <input type="hidden" name="acao" value="editarPost">
      <input type="hidden" name="id" value="<?php echo $editaPost->id; ?>">
      <input type="hidden" name="foto_Atual" value="<?php echo $editaPost->foto; ?>">
      <input type="hidden" name="ativo" value="N">
      <input type="hidden" name="destaque" value="N">
    </form>

  </main>
  <!--//----FIM DO CONTEUDO---//-->
  <hr>
  <?php //include "footer.php"; ?>

</body>
<!--Ultima versão do jquery-->

<script src="../../vendor/ckeditor/ckeditor.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@floating-ui/dom@1.5.3"></script>

<script>
  // Example starter JavaScript for disabling form submissions if there are invalid fields
  (() => {
    'use strict'

    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    const forms = document.querySelectorAll('.needs-validation')

    // Loop over them and prevent submission
    Array.from(forms).forEach(form => {
      form.addEventListener('submit', event => {
        if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()
        }

        form.classList.add('was-validated')
      }, false)
    })
  })()
</script>
</html>
