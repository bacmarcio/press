<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_erros', 1);
// error_reporting(E_ALL);
include "verifica.php";

$acesso-> restritoAdmin();

$acesso->logout();

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
	<title>Gerenciador</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Security-Policy" content="style-src 'self' 'unsafe-inline' netdna.bootstrapcdn.com maxcdn.bootstrapcdn.com cdnjs.cloudflare.com; font-src 'self' netdna.bootstrapcdn.com maxcdn.bootstrapcdn.com cdnjs.cloudflare.com">
	<link href="css/style.css" rel="stylesheet">
	<!-- Ultima versão do bootstrap CSS, JS & FONT AWESOME -->
	<link rel="stylesheet" media="screen" href="https://netdna.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.2/css/font-awesome.min.css">
</head>
<body>
	<?php include "header.php"; ?>
	<!--//----CONTEUDO---//-->
	<main class="container">
		<br><br><br>
		<h1>Gerenciador</h1>
		<hr />
		
		<div class="row">

			<!--<div class="col-xs-6 col-sm-3 col-md-2">

		<a href="add-cliente.php" class="btn btn-primary">

			<div class="row">

				<div class="col-xs-12 text-center">

					<i class="fa fa-plus fa-5x"></i>

				</div>

				<div class="col-xs-12 text-center">

					<p>Novo Cliente</p>

				</div>

			</div>

		</a>

	</div>-->



	

	

	<!--<div class="col-xs-6 col-sm-3 col-md-2">

		<a href="orcamentos.php" class="btn btn-primary">

			<div class="row">

				<div class="col-xs-12 text-center">

					<i class="fa fa-folder fa-5x"></i>

				</div>

				<div class="col-xs-12 text-center">

					<p>Orçamentos</p>

				</div>

			</div>

		</a>

	</div>-->

			<!-- <div class="col-xs-6 col-sm-3 col-md-2">

		<a href="colunistas.php" class="btn btn-primary">

			<div class="row">

				<div class="col-xs-12 text-center">

					<i class="fa fa-user fa-5x"></i>

				</div>

				<div class="col-xs-12 text-center">

					<p>Colunistas</p>

				</div>

			</div>

		</a>

	</div> -->

			<!-- <div class="col-xs-6 col-sm-3 col-md-2">

		<a href="artigos.php" class="btn btn-primary">

			<div class="row">

				<div class="col-xs-12 text-center">

					<i class="fa fa-folder fa-5x"></i>

				</div>

				<div class="col-xs-12 text-center">

					<p>Artigos</p>

				</div>

			</div>

		</a>

	</div> -->

			<div class="col-xs-6 col-sm-3 col-md-2">

				<a href="noticias.php" class="btn btn-primary">

					<div class="row">

						<div class="col-xs-12 text-center">

							<i class="fa fa-book fa-5x"></i>

						</div>

						<div class="col-xs-12 text-center">

							<p>Notícias</p>

						</div>

					</div>

				</a>

			</div>
            <div class="col-xs-6 col-sm-3 col-md-2">
            
            		<a href="categorias.php" class="btn btn-primary">
            
            			<div class="row">
            
            				<div class="col-xs-12 text-center">
            
            					<i class="fa fa-quote-right fa-5x"></i>
            
            				</div>
            
            				<div class="col-xs-12 text-center">
            
            					<p>Categorias</p>
            
            				</div>
            
            			</div>
            
            		</a>
            
            	</div>
			<div class="col-xs-6 col-sm-3 col-md-2">

				<a href="textos.php" class="btn btn-primary">

					<div class="row">

						<div class="col-xs-12 text-center">

							<i class="fa fa-file-text fa-5x"></i>

						</div>

						<div class="col-xs-12 text-center">

							<p>Textos</p>

						</div>

					</div>

				</a>

			</div>


			<!-- <div class="col-xs-6 col-sm-3 col-md-2">

		<a href="apoiadores.php" class="btn btn-primary">

			<div class="row">

				<div class="col-xs-12 text-center">

					<i class="fa fa-picture-o fa-5x" aria-hidden="true"></i>

				</div>

				<div class="col-xs-12 text-center">

					<p>Apoiadores</p>

				</div>

			</div>

		</a>

	</div> -->



			<div class="col-xs-6 col-sm-3 col-md-2">

				<a href="banners.php" class="btn btn-primary">

					<div class="row">

						<div class="col-xs-12 text-center">

							<i class="fa fa-newspaper-o fa-5x" aria-hidden="true"></i>

						</div>

						<div class="col-xs-12 text-center">

							<p>Publicidade</p>

						</div>

					</div>

				</a>

			</div>
            <div class="col-xs-6 col-sm-3 col-md-2">

		<a href="usuarios.php" class="btn btn-primary">

			<div class="row">

				<div class="col-xs-12 text-center">

					<i class="fa fa-user fa-5x"></i>

				</div>

				<div class="col-xs-12 text-center">

					<p>Editores</p>

				</div>

			</div>

		</a>

	</div>
			<div class="col-xs-6 col-sm-3 col-md-2">

				<a href="login.php?acao=logout" class="btn btn-danger">

					<div class="row">

						<div class="col-xs-12 text-center">

							<i class="fa fa-times fa-5x"></i>

						</div>

						<div class="col-xs-12 text-center">

							<p>Sair</p>

						</div>

					</div>

				</a>

			</div>




			<!--<div class="col-xs-6 col-sm-3 col-md-2">

		<a href="conteudos.php?id_menu=1" class="btn btn-primary">

			<div class="row">

				<div class="col-xs-12 text-center">

					<i class="fa fa-book fa-5x"></i>

				</div>

				<div class="col-xs-12 text-center">

					<p>Soluções Syn Brasil</p>

				</div>

			</div>

		</a>

	</div>-->

	





		</div>

		<hr>

		<div class="row">





		</div>



	</main>

	<!--//----FIM DO CONTEUDO---//-->

	<hr>

<?php include "footer.php"; ?>

</body>

<!--Ultima versão do jquery-->
    
    <script>
		
        $(window).on('load', function() {
          $.ajax({
            url: 'gerar-feed-justica.php', // Substitua pelo caminho correto do seu script PHP
            type: 'POST',
            data: { data: 'alguns_dados_para_processamento' },
            async: true, // Usando uma solicitação assíncrona
            success: function(response) {
              // Lide com a resposta do servidor, se necessário
              console.log('Feed gerado com sucesso:', response);
            },
            error: function() {
              // Lide com erros de solicitação AJAX, se necessário
              console.log('Ocorreu um erro durante a geração do feed justica.');
            }
          });
        });

        
         $(window).on('load', function() {
          $.ajax({
            url: 'gerar-feed-politica.php', // Substitua pelo caminho correto do seu script PHP
            type: 'POST',
            data: { data: 'alguns_dados_para_processamento' },
            async: true, // Usando uma solicitação assíncrona
            success: function(response) {
              // Lide com a resposta do servidor, se necessário
              console.log('Feed gerado com sucesso:', response);
            },
            error: function() {
              // Lide com erros de solicitação AJAX, se necessário
              console.log('Ocorreu um erro durante a geração do feed politica.');
            }
          });
        });

         $(window).on('load', function() {
          $.ajax({
            url: 'gerar-feed-rb.php', // Substitua pelo caminho correto do seu script PHP
            type: 'POST',
            data: { data: 'alguns_dados_para_processamento' },
            async: true, // Usando uma solicitação assíncrona
            success: function(response) {
              // Lide com a resposta do servidor, se necessário
              console.log('Feed gerado com sucesso:', response);
            },
            error: function() {
              // Lide com erros de solicitação AJAX, se necessário
              console.log('Ocorreu um erro durante a geração do feed revista brasilia.');
            }
          });
        });
        
        $(window).on('load', function() {
          $.ajax({
            url: 'gerar-feed-360.php', // Substitua pelo caminho correto do seu script PHP
            type: 'POST',
            data: { data: 'alguns_dados_para_processamento' },
            async: true, // Usando uma solicitação assíncrona
            success: function(response) {
              // Lide com a resposta do servidor, se necessário
              console.log('Feed gerado com sucesso:', response);
            },
            error: function() {
              // Lide com erros de solicitação AJAX, se necessário
              console.log('Ocorreu um erro durante a geração do feed poder 360.');
            }
          });
        });
        
         $(window).on('load', function() {
          $.ajax({
            url: 'gerar-feed.php', // Substitua pelo caminho correto do seu script PHP
            type: 'POST',
            data: { data: 'alguns_dados_para_processamento' },
            async: true, // Usando uma solicitação assíncrona
            success: function(response) {
              // Lide com a resposta do servidor, se necessário
              console.log('Feed gerado com sucesso jornal brasil.');
            },
            error: function() {
              // Lide com erros de solicitação AJAX, se necessário
              console.log('Ocorreu um erro durante a geração do feed jornal brasil.');
            }
          });
        });
    </script>



</html>