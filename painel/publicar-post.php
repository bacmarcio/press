<?php
include "verifica.php";
$acesso->restritoAdmin();
if (isset($_GET['id'])) {
    if (empty($_GET['id'])) {
        header('Location:'.SITE_URL.'noticias');
    } else {
        $id = $_GET['id'];
    }
}
$posts->editar();
$publicaPost = $posts->dadosPosts($id);
$dadosCategorias = $categorias->dadosCategorias($publicaPost->id_categoria);

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <title>Publicar Notícia</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="css/style.css" rel="stylesheet">

  <!-- Ultima versão do bootstrap CSS, JS & FONT AWESOME -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />

</head>

<body>
  <?php //include "header.php"; ?>

  <!--//----CONTEUDO---//-->
  <div class="container mt-5">
            <div class="row">
                <div class="col-lg-8">
                    <!-- Post content-->
                    <article>
                        <!-- Post header-->
                        <header class="mb-4">
                            <!-- Post title-->
                            <h1 class="fw-bolder mb-1"><?php echo $publicaPost->titulo?></h1>
                            <!-- Post meta content-->
                            <div class="text-muted fst-italic mb-2"><?php echo formataData($publicaPost->updated_at)?></div>
                            <!-- Post categories-->
                            <span class="badge bg-secondary text-decoration-none link-light"><?php echo $dadosCategorias->titulo?></span>
                            <span class="badge bg-secondary text-decoration-none link-light"><?php echo $publicaPost->postado_por?></span>
                        </header>
                        <!-- Preview image figure-->
                        <figure class="mb-4"><img class="img-fluid rounded" src="../post-images/<?php echo $publicaPost->foto?>" alt="<?php echo $publicaPost->legenda?>" /></figure>
                        
                        <span class="badge bg-secondary text-decoration-none link-light"><?php echo $publicaPost->legenda?></span>
                        <!-- Post content-->
                        <section class="mb-5">

                        <?php echo converterTextoHTML($publicaPost->conteudo)?>
                        </section>
                        
                    </article>
                    
                </div>
                <!-- Side widgets-->
                <div class="col-lg-4">
                    <!-- Search widget-->
                    <div class="card mb-4">
                        <div class="card-header"><h3>Link da Publicação</h3></div>
                        <form action="" method="post">
                            <div class="card-body">
                                
                                    <label for="">Justiça em Foco</label>
                                    <input class="form-control" type="text"/>
                                
                                
                                    <label for="">Jornal Brasil</label>
                                    <input class="form-control" type="text"/>
                                
                                
                                    <label for="">Revista Brasilia</label>
                                    <input class="form-control" type="text"/>
                                
                                
                                    <label for="">Rede News</label>
                                    <input class="form-control" type="text"/>

                                    <button type="button" class="btn btn-primary mt-5">Voltar</button>
                                    <button type="button" class="btn btn-primary mt-5">Confirmar</button>
                                    
                            </div>
                        </form>
                    </div>
                    <!-- Categories widget-->
                </div>
            </div>
        </div>
        
  <!--//----FIM DO CONTEUDO---//-->
  <hr>
  <?php //include "footer.php"; ?>

</body>
<!--Ultima versão do jquery-->

</html>


