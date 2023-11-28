<?php
include "verifica.php";
$acesso->restritoAdmin();
if (isset($_GET['id'])) {
  if (empty($_GET['id'])) {
      header('Location:'.SITE_URL.'planos');
  } else {
      $id = $_GET['id'];
  }
}

$banners->editar();
$dadosBanners = $banners->dadosBanners($id); 

?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>Atualizar Banner</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css/style.css" rel="stylesheet">
        
        <!-- Ultima versão do bootstrap CSS, JS & FONT AWESOME -->
        <link rel="stylesheet" media="screen" href="//netdna.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.2/css/font-awesome.min.css"> 
        
    </head>
    <body>
<?php //include('header.php');?>

    <!--//----CONTEUDO---//-->
    <main class="container">
    <br><br><br>

<h2>Atualizar Banner</h2>

<form action="" method="post" enctype="multipart/form-data">
  <!-- area de campos do form -->
  <hr>
  
  <div class="row">
    <div class="form-group col-md-6">
      <label for="name">Posição</label>
      <select name="posicao" id="posicao" class="form-control">
      	<option value="">SELECIONE</option>
      	<option value="D" <?php if($dadosBanners->posicao == 'D'): echo "selected"; endif; ?>>Direita 310x310</option>
      	<option value="N" <?php if($dadosBanners->posicao == 'R1'): echo "selected"; endif; ?>>Abaixo da Notícia</option>
      </select>
     
    </div>
  </div>
  
  <div class="row">
    <div class="form-group col-md-12">
      <label for="name">Titulo</label>
      <input type="text" class="form-control" name="titulo" value="<?php echo $dadosBanners->titulo; ?>">
    </div>
  </div>
	
	<div class="row">
    <div class="form-group col-md-12">
      <label for="name">Link</label>
      <input type="text" class="form-control" name="link" value="<?php echo $dadosBanners->link; ?>">
    </div>
  </div>
  
  <div class="row">
      <div class="form-group col-md-6">
          <img src="../../post-images/<?php echo $dadosBanners->foto; ?>" alt="" width="60">
          </div>
        <div class="form-group col-md-6">
          <label for="campo1">Foto</label>
          <input type="file" class="form-control" name="foto">
        </div>
        
  </div>
  
  <div class="row">
    <div class="form-group col-md-12">
      <label for="name">Descrição</label>
      <textarea name="conteudo"  id="ckeditor" class="form-control ckeditor" cols="30" rows="5">
		  <?php echo $dadosBanners->descricao; ?>
		</textarea>
    </div>
  </div>
 
  <div id="actions" class="row">
    <div class="col-md-12">
      <button type="submit" class="btn btn-primary">Salvar</button>
      <a href="banners" class="btn btn-default">Cancelar</a>
    </div>
  </div>
  <input type="hidden" name="acao" value="editarBanners">
  <input type="hidden" name="id" value="<?php echo $dadosBanners->id; ?>">
  <input type="hidden" name="foto_Atual" value="<?php echo $dadosBanners->foto; ?>">
 
</form>

</main> 
 <!--//----FIM DO CONTEUDO---//-->
	<hr>
<?php //include('footer.php'); ?>

    </body>
    <!--Ultima versão do jquery-->
    
    <script src="../../vendor/ckeditor/ckeditor.js"></script>
</html>