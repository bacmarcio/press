<?php
include "verifica.php";

//echo $_POST['codigo_fonte'];
//exit;
$banners->add();
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>Adicionar Banner</title>
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

<h2>Novo Banner</h2>

<form action="" method="post" enctype="multipart/form-data">
  <!-- area de campos do form -->
  <hr />
 
  <div class="row">
    <div class="form-group col-md-6">
      <label for="name">Posição</label>
      <select name="posicao" id="posicao" class="form-control">
      	<option value="">SELECIONE</option>
      	<option value="D">Direita 310x310</option>
      	<option value="N">Abaixo da Notícia 970x90</option>
      </select>
     
    </div>
  </div>
   
   <div class="row">
    <div class="form-group col-md-12">
      <label for="name">Titulo</label>
      <input type="text" class="form-control" name="titulo">
    </div>
  </div>
	<div class="row">
    <div class="form-group col-md-12">
      <label for="name">Link</label>
      <input type="text" class="form-control" name="link">
    </div>
  </div>
  
  <div class="row">
    <div class="form-group col-md-6">
      <label for="campo1">Foto</label>
      <input type="file" class="form-control" name="foto">
    </div>
   
  </div>
  <div class="row">
    <div class="form-group col-md-12">
      <label for="name">Descrição</label>
      <textarea name="conteudo" id="conteudo"  class="form-control ckeditor" cols="30" rows="5"></textarea>
    </div>
  </div>
 
  <div id="actions" class="row">
    <div class="col-md-12">
      <button type="submit" class="btn btn-primary">Salvar</button>
      <a href="banners" class="btn btn-default">Cancelar</a>
    </div>
  </div>
  <input type="hidden" name="acao" value="addBanner">
</form>

</main> 
 <!--//----FIM DO CONTEUDO---//-->
	<hr>
<?php //include('footer.php'); ?>

    </body>
    <!--Ultima versão do jquery-->
    
    <script src="vendor/ckeditor/ckeditor.js"></script>
</html>