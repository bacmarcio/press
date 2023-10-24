<?php
include "verifica.php";

$dadosTextos = $textos->rsDados();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
	<title>Textos</title>
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
					<h2>Textos</h2>
				</div>

			</div>
		</header>

		<?php if (!empty($_SESSION['message'])) : ?>
			<div class="alert alert-<?php echo $_SESSION['type']; ?> alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<?php echo $_SESSION['message']; ?>
			</div>
			<?php //clear_messages();
            ?>
		<?php endif; ?>

		<hr>

		<table class="table table-hover" border="1">
			<thead>
				<?php if ($dadosTextos) : ?>
					<tr>
						<th width="48">ID</th>
						<th width="179">Foto</th>
						<th width="759">Titulo</th>
						<th width="225" class="text-center">Opções</th>
					</tr>
			</thead>
			<tbody>

				<?php foreach ($dadosTextos as $texto) : ?>
					<tr>
						<td><?php echo $texto->id; ?></td>
						<td>
							<?php if ($texto->foto) : ?>
								<img src="../img/<?php echo $texto->foto; ?>" width="100" alt="">
							<?php endif; ?>
						</td>

						<td><?php echo $texto->titulo; ?></td>
						<td class="actions text-right">
							<a href="view-texto.php?id=<?php echo $texto->id; ?>" class="btn btn-sm btn-success"><i class="fa fa-eye"></i> Visualizar</a>
							<a href="editar-texto.php?id=<?php echo $texto->id; ?>" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i> Editar</a>
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
	<?php include "footer.php"; ?>

</body>
<!--Ultima versão do jquery-->


</html>