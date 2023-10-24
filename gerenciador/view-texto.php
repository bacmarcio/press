<?php
include "verifica.php";

$texto = $textos->rsDados(intval($_GET['id']));
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title>Visualizar Texto</title>
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

        <h2>Texto <?php echo $texto->id; ?></h2>
        <hr>

        <dl class="dl-horizontal">
            <dt>Foto:</dt>
            <dd> <img src="../img/<?php echo $texto->foto; ?>" width="700" alt=""></dd>
        </dl>

        <dl class="dl-horizontal">
            <dt>Titulo:</dt>
            <dd><?php echo $texto->titulo; ?></dd>
        </dl>

        <dl class="dl-horizontal">
            <dt>Texto:</dt>
            <dd><?php echo $texto->texto; ?></dd>
        </dl>

        <div id="actions" class="row">
            <div class="col-md-12">
                <a href="editar-texto.php?id=<?php echo $texto->id; ?>" class="btn btn-primary">Editar</a>
                <a href="textos.php" class="btn btn-default">Voltar</a>
            </div>
        </div>
    </main>
    <!--//----FIM DO CONTEUDO---//-->
    <hr>
    <?php include "footer.php"; ?>

</body>
<!--Ultima versão do jquery-->

</html>