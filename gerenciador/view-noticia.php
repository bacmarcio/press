<?php
include "verifica.php";
if (isset($_GET['id'])) {
    if (empty($_GET['id'])) {
        header('Location: blogs.php');
    } else {
        $id = $_GET['id'];
    }
}

$viewBlog = $blogs->rsDados($id);
$dadosCategorias = $categorias->rsDados($viewBlog->categoria);
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title>Visualizar Notícia</title>
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

        <h2>Notícia <?php echo $viewBlog->id; ?></h2>
        <hr>

        <dl class="dl-horizontal">
            <dt>Foto:</dt>
            <dd> <img src="../img/<?php echo $viewBlog->foto; ?>" width="700" alt=""></dd>
        </dl>

        <dl class="dl-horizontal">
            <dt>Data:</dt>
            <dd><?php echo formataData($viewBlog->updated_at); ?></dd>
        </dl>
        <dl class="dl-horizontal">
            <dt>Categoria:</dt>
            <dd><?php echo $viewBlog->nomeCategoria; ?></dd>
        </dl>
        <dl class="dl-horizontal">
            <dt>Titulo:</dt>
            <dd><?php echo $viewBlog->titulo; ?></dd>
        </dl>

        <dl class="dl-horizontal">
            <dt>Resumo:</dt>
            <dd><?php echo $viewBlog->breve; ?></dd>
        </dl>

        <dl class="dl-horizontal">
            <dt>Descrição:</dt>
            <dd><?php echo $viewBlog->conteudo; ?></dd>
        </dl>

        <div id="actions" class="row">
            <div class="col-md-12">
                <a href="editar-noticia.php?id=<?php echo $viewBlog->id; ?>" class="btn btn-primary">Editar</a>
                <a href="noticias.php" class="btn btn-default">Voltar</a>
            </div>
        </div>
    </main>
    <!--//----FIM DO CONTEUDO---//-->
    <hr>
    <?php include "footer.php"; ?>

</body>
<!--Ultima versão do jquery-->

</html>