<?php
include "verifica.php";
$acesso->restritoAdmin();
$dadosPlanos = $planos->dadosPlanos();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
	<title>Planos</title>
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
		<div class="clearfix">&nbsp;</div>
		<div class="clearfix">&nbsp;</div>
		<header>
			<div class="row">
				<div class="col-sm-6">
					<h2>Planos</h2>
				</div>
				<div class="col-sm-2">&nbsp;</div>
                <div class="col-sm-2">&nbsp;</div>

                <div class="col-sm-6 text-right h2">
                    <a class="btn btn-primary" href="add-plano"><i class="fa fa-plus"></i> Novo Plano</a>
                    <a class="btn btn-default" href="planos"><i class="fa fa-refresh"></i> Atualizar</a>
                </div>
			</div>
		</header>

		

		<hr>

		<table class="table table-hover" border="1">
			<thead>
				<?php if ($dadosPlanos) : ?>
					<tr>
						<th width="48">ID</th>
						<th width="179">Foto</th>
						<th width="759">Titulo</th>
						<th width="179">Valor</th>
						<th width="225" class="text-center">Opções</th>
					</tr>
			</thead>
			<tbody>

				<?php foreach ($dadosPlanos as $plano) : ?>
					<tr>
						<td><?php echo $plano->id; ?></td>
						<td>
							<?php if ($plano->foto) : ?>
								<img src="../post-images/<?php echo $plano->foto; ?>" width="40" alt="">
							<?php endif; ?>
						</td>

						<td><?php echo $plano->titulo; ?></td>
						<td><?php echo $plano->valor; ?></td>
						<td class="actions text-right">
							<!-- <a href="view-texto.php?id=<?php echo $plano->id; ?>" class="btn btn-sm btn-success"><i class="fa fa-eye"></i> Visualizar</a> -->
							<a href="editar-plano/<?php echo $plano->id; ?>" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i> Editar</a>
							<a href="javascript:;" class="btn btn-sm btn-danger" onclick="if(confirm('Tem certeza que deseja excluir <?php echo preg_replace('~[\r\n]+~', '', $plano->titulo); ?>?')) { window.location='planos.php?acao=excluirUsuarios&id=<?php echo $plano->id; ?>'; } ">
									<i class="fa fa-trash"></i> Excluir
								</a
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
	</main>
	<!--//----FIM DO CONTEUDO---//-->
	<hr>
	<?php //include "footer.php"; ?>

</body>
<!--Ultima versão do jquery-->


</html>