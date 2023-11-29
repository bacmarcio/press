<?php
include "verifica.php";

$login = filter_input(INPUT_POST, 'login', FILTER_SANITIZE_SPECIAL_CHARS);
$senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_SPECIAL_CHARS);

$resultado = $acesso->login($login, $senha);

if (is_string($resultado)) {
    // A função retornou uma mensagem de erro
    echo $resultado;
}

$url = isset($_GET['url']) ? $_GET['url'] : '';

if ($url === 'logout') {
    // Lógica de logout
    // Execute ação de logout
    session_start(); // Inicie a sessão (se não estiver iniciada)
    session_destroy(); // Destrua a sessão
    // Redirecione para a página de login ou qualquer outra página desejada
    header('Location:'.SITE_URL.'login');
    exit();
}

$configurarSite = $config->dadosConfig();

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <title>Login</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- <meta http-equiv="Content-Security-Policy" content="style-src 'self' 'unsafe-inline' netdna.bootstrapcdn.com maxcdn.bootstrapcdn.com cdnjs.cloudflare.com; font-src 'self' fonts.gstatic.com fonts.googleapis.com netdna.bootstrapcdn.com maxcdn.bootstrapcdn.com cdnjs.cloudflare.com"> -->

  <link href="css/style.css" rel="stylesheet">

  <!-- Ultima versão do bootstrap CSS, JS & FONT AWESOME -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" >

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.2/css/font-awesome.min.css">
<link rel="stylesheet" href="css/style.css">		
</head>

<body>

<section class="h-100">
		<div class="container h-100">
			<div class="row justify-content-sm-center h-100">
				<div class="col-xxl-4 col-xl-5 col-lg-5 col-md-7 col-sm-9">
					<div class="text-center my-5">
						<img src="../post-images/<?php echo $configurarSite->favicon?>" alt="logo" width="100">
					</div>
					<div class="card shadow-lg">
						<div class="card-body p-5">
							<h1 class="fs-4 card-title fw-bold mb-4">Login</h1>
							
							<form method="POST" class="needs-validation" novalidate="" autocomplete="off">
								<div class="mb-3">
									<label class="mb-2 text-muted" for="validationEmail">E-Mail</label>
									<input id="validationEmail" type="email" class="form-control" name="login" value="" required>
									<div class="invalid-feedback">
										Formato de e-mail inválido
									</div>
								</div>

								<div class="mb-3">
									<div class="mb-2 w-100">
										<label class="text-muted" for="validationPassword">Senha</label>
										
									</div>
									<input id="validationPassword" type="password" class="form-control" name="senha" required>
								    <div class="invalid-feedback">
								    	Preencha esse campo
							    	</div>
									
								</div>

								<div class="d-flex align-items-center">
								<a href="recuperar-senha" class="float-end">
											Esqueceu a senha?
										</a>
									<!-- <div class="form-check">
										<input type="checkbox" name="remember" id="remember" class="form-check-input">
										<label for="remember" class="form-check-label">Remember Me</label>
									</div> -->
									<button type="submit" class="btn btn-primary ms-auto">
										Login
									</button>
								</div>
							</form>
						</div>
						<div class="card-footer py-3 border-0">
							<div class="text-center">
								Não possui uma conta? <a href="cadastro" class="text-dark">Cadastre-se</a>
							</div>
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
<!--Ultima versão do jquery-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@floating-ui/dom@1.5.3"></script>
<script src="js/script.js"></script>
</html>