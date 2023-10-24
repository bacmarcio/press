<?php
include "verifica.php";
$newsletters->excluir();
$dadosNewsletter = $newsletters->rsDados();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
	<title>Sistema</title>
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
		<div class="clearfix">&nbsp;</div>
		<div class="clearfix">&nbsp;</div>
		<header>
			<div class="row">
				<div class="col-sm-6">
					<h2>Newsletters</h2>
				</div>
				<div class="col-sm-6 text-right h2">
					<a class="btn btn-primary" href="add-newsletter.php"><i class="fa fa-plus"></i> Novo Newsletter</a>
					<a class="btn btn-default" href="newsletters.php"><i class="fa fa-refresh"></i> Atualizar</a>
				</div>
			</div>
		</header>

		<hr>

		<table class="table table-hover" border="1">
			<thead>
				<tr>
					<th>ID</th>
					<th>Nome</th>
					<th>E-mail</th>

					<th class="text-center">Opções</th>
				</tr>
			</thead>
			<tbody>
				<?php if ($dadosNewsletter) : ?>
					<?php foreach ($dadosNewsletter as $news) : ?>
						<tr>
							<td><?php echo $news->id; ?></td>
							<td><?php echo $news->nome; ?></td>
							<td><?php echo $news->email; ?></td>

							<td class="actions text-right">

								<a href="editar-newsletter.php?id=<?php echo $news->id; ?>" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i> Editar</a>
								<a href="javascript:;" class="btn btn-sm btn-danger" onclick="if(confirm('Tem certeza que deseja excluir <?php echo preg_replace('~[\r\n]+~', '', $news->nome); ?>?')) { window.location='newsletters.php?acao=excluirNewsletter&id=<?php echo $news->id; ?>'; } ">
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
		<?php include('modal.php'); ?>
	</main>
	<!--//----FIM DO CONTEUDO---//-->
	<hr>
	<?php include "footer.php"; ?>

</body>
<!--Ultima versão do jquery-->

</html>