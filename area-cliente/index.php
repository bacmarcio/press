<?php
include 'verifica.php';
session_start();
if (!empty($_SESSION) || $_SESSION['dadosUsuario']['adm'] == 'N') {
    $id = $_SESSION['dadosUsuario']['id'];
    $nome = $_SESSION['dadosUsuario']['nome'];
} else {
    header('Location:login');
    exit;
}

$posts->excluir();

$dados = $posts->dadosPosts();

$resultado = $planos->contarCreditos($id);

$creditos = $resultado['creditos'];
$mensagem = $resultado['mensagem'];

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.2/css/font-awesome.min.css">
</head>
<style>
    .ultima-coluna {
        text-align: right;
    }
</style>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark p-3">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">logo</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class=" collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav ms-auto ">

                    <li class="nav-item dropdown">
                        <a class="nav-link mx-2 dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <?php echo $nome; ?>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="editar-perfil/<?php echo $id; ?>">Editar Perfil</a></li>
                            <li><a class="dropdown-item" href="logout">Sair</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <section class="h-100 mt-3">
        <div class="container">
            <div class="row">

                <div class="col-sm-4">
                    <div class="card rounded">
                        <div class="card-body">
                            <h5 class="card-title">Bem Vindo</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <div class="clearfix">&nbsp;</div>
                            <!-- <a href="#" class="card-link">Card link</a>
                            <a href="#" class="card-link">Another link</a> -->
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card rounded">
                        <div class="card-body">
                            <h5 class="card-title">Plano</h5>

                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <a href="#" class="card-link">Mudar Plano</a>

                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card rounded">
                        <div class="card-body">
                            <h5 class="card-title">Creditos</h5>
                            <p>Você possui <?php echo $creditos ?> </p>
                            <div class="clearfix">&nbsp;</div>

                            <a href="#" class="card-link">Adquirir Créditos</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- lxh-2,5e -->
    </section>
    <section class="mt-3">
        <div class="container">
            <div class="row">
                <div class="d-flex flex-row bd-highlight mb-3">
                    <a href="add-noticia" class="btn btn-primary ms-auto">Nova Release</a>
                </div>
                <?php if (isset($dados)) { ?>
                    <div class="table-responsive">

                        <table class="table caption-top">

                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Imagem</th>
                                    <th scope="col">titulo</th>
                                    <th scope="col" class="ultima-coluna">Opções</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($dados as $item) { ?>
                                    <?php if ($item->excluido != "S") {

                                    ?>

                                        <tr>
                                            <th><?php echo $item->id ?></th>
                                            <td><img src="../post-images/<?php echo $item->foto ?>" alt="" width="60"></td>
                                            <td><?php echo $item->titulo ?></td>
                                            <td class="ultima-coluna">
                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#publicadosModal<?php echo $item->id?>">Release Publicada</button>
                                                <a href="editar-noticia/<?php echo $item->id ?>" class="btn btn-outline-warning">Editar</a>
                                                <a href="#" onclick="if(confirm('Tem certeza que deseja excluir <?php echo preg_replace('~[\r\n]+~', '', $item->titulo); ?>?')) { window.location='index.php?acao=excluirPost&id=<?php echo $item->id ?>&foto=<?php echo $item->foto; ?>'; } " class="btn btn-outline-danger">Excluir</a>
                                            </td>
                                        </tr>

                                        <div class="modal fade" id="publicadosModal<?php echo $item->id?>" tabindex="-1" aria-labelledby="publicadosModalLabel<?php echo $item->id?>" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="publicadosModalLabel<?php echo $item->id?>">Releses Publicadas</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">

                                                            <?php $itensPublicados = $publicados->dadosPublicados('',$item->id); ?>
                                                            <?php foreach ($itensPublicados as $modalItens) { ?>
                                                                <div class="">
                                                                    <a href="<?php echo $modalItens->link ?>">
                                                                        <img src="https://justicaemfoco.com.br/images/logo.png" alt="" width="50" style="float: left; margin-right: 20px;">
                                                                        <?php echo $modalItens->titulo ?>
                                                                    </a>
                                                                </div>
                                                            <?php } ?>
                                                        </div>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    <?php } ?>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                <?php } else echo "<h6 class='text-center'>Nenhuma release encontrada!</h6>"; ?>
            </div>
        </div>
    </section>
    <!-- Modal -->

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@floating-ui/dom@1.5.3"></script>
</html>