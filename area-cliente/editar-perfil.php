<?php

include "verifica.php";

$resultado = $usuarios->editar();

if (is_string($resultado)) {
    // A função retornou uma mensagem de erro
    echo $resultado;
} else {
    // A função retornou um sucesso (o redirecionamento é feito no próprio login)
}

if (isset($_GET['id'])) {
    if (empty($_GET['id'])) {
        header('Location:'.SITE_URL);
    } else {
        $id = $_GET['id'];
    }
}

$dados = $usuarios->dadosUsuarios($id);

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" >
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.2/css/font-awesome.min.css">

</head>
<body>
<section class="h-100">
		<div class="container h-100">
			<div class="row justify-content-sm-center h-100">
				<div class="col-xxl-4 col-xl-5 col-lg-5 col-md-7 col-sm-9">
					<div class="text-center my-5">
						<img src="https://getbootstrap.com/docs/5.0/assets/brand/bootstrap-logo.svg" alt="logo" width="100">
					</div>
					<div class="card shadow-lg">
						<div class="card-body p-5">
							<h1 class="fs-4 card-title fw-bold mb-4">Atualizar Perfil</h1>
							<form method="POST" autocomplete="off">
								<div class="mb-3">
									<label class="mb-2 text-muted" for="nome">Name</label>
									<input id="nome" type="text" class="form-control" name="nome" value="<?php echo $dados->nome?>">
								</div>

								<div class="mb-3">
									<label class="mb-2 text-muted" for="showEmail">E-Mail Address</label>
									<input id="showEmail" type="email" disabled class="form-control" name="showEmail" value="<?php echo $dados->email?>">
								</div>
								
								<div class="mb-3">
									<label class="mb-2 text-muted" for="cpf">CPF</label>
									<input id="cpf" type="text" class="form-control" name="cpf" value="<?php echo $dados->cpf?>">
								</div>

								<div class="mb-3">
									<label class="mb-2 text-muted" for="telefone">Telefone</label>
									<input id="telefone" type="text" class="form-control" name="telefone" value="<?php echo $dados->telefone?>">
								</div>

								<div class="align-items-center d-flex">
									<button type="submit" class="btn btn-primary ms-auto">
										Confirmar	
									</button>
								</div>
								<input type="hidden" name="id" value="<?php echo $dados->id?>">
								<input type="hidden" name="acao" value="editarUsuario">
								<input type="hidden" name="email" value="<?php echo $dados->email?>">
							</form>
						</div>
					</div>
					<div class="text-center mt-5 text-muted">
						Copyright &copy; 2017-2021 &mdash; Your Company 
					</div>
				</div>
			</div>
		</div>
	</section>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@floating-ui/dom@1.5.3"></script>
</html>