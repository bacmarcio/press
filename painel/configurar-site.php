<?php
include "verifica.php";
$acesso->restritoAdmin();
$config->editar();
$configuracoes = $config->dadosConfig();

$nome_empresa  = $configuracoes->nome_empresa;
$favicon       = $configuracoes->favicon;
$facebook      = $configuracoes->facebook;
$twitter       = $configuracoes->twitter;
$instagram     = $configuracoes->instagram;
$linkedln      = $configuracoes->linkedln;
$youtube       = $configuracoes->youtube;
$tiktok        = $configuracoes->tiktok;
$endereco      = $configuracoes->endereco;
$telefone      = $configuracoes->telefone;
$email1        = $configuracoes->email1;
$email2        = $configuracoes->email2;
$cep           = $configuracoes->cep;
$cnpj          = $configuracoes->cnpj;
$id            = $configuracoes->id; 


?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <title>Configurações do Site</title>
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

    <h2>Configurações do Site</h2>

    <form action="" method="post" enctype="multipart/form-data">
      <!-- area de campos do form -->
      <hr />
        <div class="row">
          <div class="form-group col-md-12">
            <label for="name">Nome da Empresa</label>
            <input type="text" class="form-control" name="nome_empresa" value="<?php echo $nome_empresa ?>">
          </div>

        </div>

      <div class="row">
      <div class="form-group col-md-2">
          <img src="../post-images/<?php echo $favicon; ?>" alt="" width="60">
      </div>
        <div class="form-group col-md-10">
          <label for="campo1">Logomarca</label>
          <input type="file" class="form-control" name="favicon">
        </div>
        
      </div>
      <div class="row">
          <div class="form-group col-md-6">
            <label for="name">E-mail 1</label>
            <input type="text" class="form-control" name="email1" value="<?php echo $email1 ?>">
          </div>
          <div class="form-group col-md-6">
            <label for="name">E-mail 2</label>
            <input type="text" class="form-control" name="email2" value="<?php echo $email2 ?>">
          </div>
          <div class="form-group col-md-6">
            <label for="name">CNPJ</label>
            <input type="text" class="form-control" name="cnpj" value="<?php echo $cnpj ?>">
          </div>
          <div class="form-group col-md-6">
            <label for="name">Telefone</label>
            <input type="text" class="form-control" name="telefone" value="<?php echo $telefone ?>">
          </div>

        </div>
      <hr />
      <div class="row">
        <h3>Redes Sociais</h3>
        <div class="form-group col-md-4">
          <label for="name">Facebook</label>
          <input type="text" class="form-control" name="facebook" value="<?php echo $facebook ?>">
        </div>
        <div class="form-group col-md-4">
          <label for="name">Instagram</label>
          <input type="text" class="form-control" name="instagram" value="<?php echo $instagram ?>">
        </div>
        <div class="form-group col-md-4">
          <label for="name">Twitter</label>
          <input type="text" class="form-control" name="twitter" value="<?php echo $twitter ?>">
        </div>
      </div>
      <div class="row">
        <div class="form-group col-md-4">
          <label for="name">LinkedIn</label>
          <input type="text" class="form-control" name="linkedln" value="<?php echo $linkedln ?>">
        </div>
        <div class="form-group col-md-4">
          <label for="name">YouTube</label>
          <input type="text" class="form-control" name="youtube" value="<?php echo $youtube ?>">
        </div>
        <div class="form-group col-md-4">
          <label for="name">TikTok</label>
          <input type="text" class="form-control" name="tiktok" value="<?php echo $tiktok ?>">
        </div>
      </div>
      <hr />
      <div id="actions" class="row">
        <div class="col-md-12">
          <button type="submit" class="btn btn-primary">Salvar</button>
          <a href="<?php echo SITE_URL?>textos" class="btn btn-default">Cancelar</a>
        </div>
      </div>
      <input type="hidden" name="acao" value="editarConfig">
      <input type="hidden" name="favicon_Atual" value="<?php echo $favicon; ?>">
      <input type="hidden" name="id" value="<?php echo $id; ?>">
    </form>

  </main>
  <!--//----FIM DO CONTEUDO---//-->
  <hr>
  <?php //include "footer.php"; ?>

</body>
<!--Ultima versão do jquery-->

<script src="../../gerenciador/vendor/ckeditor/ckeditor.js"></script>

</html>