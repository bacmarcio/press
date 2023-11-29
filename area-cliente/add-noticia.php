<?php
include "verifica.php";
session_start();
$posts->add();
$dadosCategorias = $categorias->dadosCategorias();
$id = $_SESSION['dadosUsuario']['id'];
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <title>Adicionar Release</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="css/style.css" rel="stylesheet">

  <!-- Ultima versão do bootstrap CSS, JS & FONT AWESOME -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.2/css/font-awesome.min.css">
  <link rel="stylesheet" href="/css/style.css">
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark p-3">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">logo</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class=" collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav ms-auto ">

                    <li class="nav-item dropdown">
                        <a class="nav-link mx-2 dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <?php echo $nome; ?>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="editar-perfil/<?php echo $id; ?>">Editar Perfil</a></li>
                            <li><a class="dropdown-item" href="logout">Sair</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

  <!--//----CONTEUDO---//-->
  <main class="container">
    <br><br><br>

    <h2>Nova Release</h2>

    <form method="post" enctype="multipart/form-data" class="needs-validation" novalidate="" autocomplete="off">
      <!-- area de campos do form -->
      <div class="row">

        <div class="col-md-4">
          <label for="validationCategoria" class="form-label">Escolha a Categoria</label>
          <select class="form-select" id="validationCategoria" name="id_categoria" required>
            <option selected disabled value="">SELECIONE</option>
            <?php foreach ($dadosCategorias as $categoria) : ?>
              <option value="<?php echo $categoria->id; ?>"><?php echo $categoria->titulo; ?></option>
            <?php endforeach; ?>
          </select>
          <div class="invalid-feedback">
            Por favor escolha uma categoria.
          </div>
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
          <input type="text" class="form-control" name="titulo" required>
        </div>
      </div>
      <div class="row">
        <div class="form-group col-md-6">
          <label for="campo1">Imagem do Release</label>
          <input type="file" class="form-control" name="foto">
        </div>
        <div class="form-group col-md-6">
          <label for="campo1">Legenda Imagem</label>
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
          <label for="campo2">Resumo da Release</label>
          <textarea name="resumo" id="resumo" class="form-control" cols="30" rows="5" required></textarea>
        </div>
      </div>
      <div class="row">
        <div class="form-group col-md-12">
          <label for="campo2">Release</label>
          <textarea name="conteudo" class="ckeditor" cols="30" rows="10" required></textarea>
        </div>
      </div>
      <div id="actions" class="row">
        <div class="col-md-12">
          <button type="submit" class="btn btn-primary">Salvar</button>
          <a href="<?php echo SITE_URL ?>" class="btn btn-default">Cancelar</a>
        </div>
      </div>
      <input type="hidden" name="acao" value="addPost">
      <input type="hidden" name="id_usuario" value="<?php echo $id; ?>">
      <input type="hidden" name="ativo" value="N">
      <input type="hidden" name="destaque" value="N">

    </form>

  </main>
  <!--//----FIM DO CONTEUDO---//-->
  <hr>
  <?php //include "footer.php"; 
  ?>

</body>
<!--Ultima versão do jquery-->

<script src="../vendor/ckeditor/ckeditor.js"></script>
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