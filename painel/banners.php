<?php
include "verifica.php";
$acesso->restritoAdmin();
$banners->excluir();
$dadosBanners = $banners->dadosBanners(); 
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>Banners</title>
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
<div class="clearfix">&nbsp;</div>
<div class="clearfix">&nbsp;</div>
<header>
	<div class="row">
		<div class="col-sm-5">
			<h2>Banners</h2>
		</div>
		<div class="col-sm-7 text-right h2">
    		<a class="btn btn-primary" href="add-banner.php"><i class="fa fa-plus"></i> Novo Banner</a>
	    	<a class="btn btn-default" href="banners.php"><i class="fa fa-refresh"></i> Atualizar</a>
	    </div>
	</div>
</header>

<hr>

<table class="table table-hover" border="1">
<thead>
	<tr>
		<th width="95">ID</th>
		<th width="100">Foto</th>
		<th width="296">Titulo</th>
		
		<th width="330" class="text-center">Opções</th>
	</tr>
</thead>
<tbody>
<?php if ($dadosBanners) : ?>
<?php foreach ($dadosBanners as $banner) : ?>
	<tr>
		<td><?php echo $banner->id; ?></td>
		<td> <img src="../post-images/<?php echo $banner->foto; ?>" width="100" alt=""></td>
		<td><?php echo $banner->titulo; ?></td>
		
		<td class="actions text-right">
			<!--<a href="view-banner.php?id=<?php echo $banner->id; ?>" class="btn btn-sm btn-success"><i class="fa fa-eye"></i> Visualizar</a>-->
			<a href="editar-banner/<?php echo $banner->id; ?>" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i> Editar</a>
							<a href="javascript:;" class="btn btn-sm btn-danger" onclick="if(confirm('Tem certeza que deseja excluir <?php echo preg_replace('~[\r\n]+~', '', $banner->titulo); ?>?')) { window.location='banner.php?acao=excluirBanner&id=<?php echo $banner->id; ?>'; } ">
									<i class="fa fa-trash"></i> Excluir
							</a>
		</td>
	</tr>
<?php endforeach;
else : ?>
	<tr>
		<td colspan="6">Nenhum registro encontrado.</td>
	</tr>
<?php endif; ?>
</tbody>
</table>
<?php //include('modal.php');?>
</main> 
 <!--//----FIM DO CONTEUDO---//-->
	<hr>
<?php //include('footer.php'); ?>

    </body>
    <!--Ultima versão do jquery-->
    
</html>