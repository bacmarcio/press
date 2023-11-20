<?php
include "verifica.php";
$resultado = $usuarios->add();


if (is_string($resultado)) {
    // A função retornou uma mensagem de erro
    echo $resultado;
} else {
    // A função retornou um sucesso (o redirecionamento é feito no próprio login)
}
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
							<h1 class="fs-4 card-title fw-bold mb-4">Cadastro</h1>
							<form method="POST" class="needs-validation" novalidate="" autocomplete="off">
								<div class="mb-3">
									<label class="mb-2 text-muted" for="validationNome">Name</label>
									<input id="validationNome" type="text" class="form-control" name="nome" value="" required>
									<div class="invalid-feedback">
										Preencha esse campo.
									</div>
								</div>

								<div class="mb-3">
									<label class="mb-2 text-muted" for="validationEmail">E-Mail </label>
									<input id="validationEmail" type="email" class="form-control" name="email" value="" required>
									<div class="invalid-feedback">
									Formato de e-mail inválido!
									</div>
								</div>

								<div class="mb-3">
									<label class="mb-2 text-muted" for="password">Password</label>
									<input id="password" type="password" class="form-control" name="senha" required>
								    <div class="invalid-feedback">
								    	Campo Obrigatório
							    	</div>
								</div>

								<p class="form-text text-muted mb-3">
								Ao se cadastrar, você concorda com nossos termos e condições.
								</p>

								<div class="align-items-center d-flex">
									<button type="submit" class="btn btn-primary ms-auto">
										Confirme	
									</button>
								</div>
								<input type="hidden" name="adm" value="N">
								<input type="hidden" name="acao" value="addUsuario">
								<input type="hidden" name="tipo" value="cadastro">

							</form>
						</div>
						<div class="card-footer py-3 border-0">
							<div class="text-center">
								Já possui conta? <a href="index.html" class="text-dark">Login</a>
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