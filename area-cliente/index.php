<!DOCTYPE html>
<html lang="en">

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
                            Perfil
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="#">Editar Perfil</a></li>
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
                            <h6 class="card-subtitle mb-2 text-body-secondary">Card subtitle</h6>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <a href="#" class="card-link">Card link</a>
                            <a href="#" class="card-link">Another link</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card rounded">
                        <div class="card-body">
                            <h5 class="card-title">Plano</h5>
                            <h6 class="card-subtitle mb-2 text-body-secondary">Card subtitle</h6>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <a href="#" class="card-link">Card link</a>
                            <a href="#" class="card-link">Another link</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card rounded">
                        <div class="card-body">
                            <h5 class="card-title">Creditos</h5>
                            <h6 class="card-subtitle mb-2 text-body-secondary">Card subtitle</h6>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <a href="#" class="card-link">Card link</a>
                            <a href="#" class="card-link">Another link</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="mt-3">
        <div class="container">
            <div class="row">
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
                            <tr>
                                <th>1</th>
                                <td>Otto</td>
                                <td>@mdo</td>
                                <td class="ultima-coluna">
                                    <button type="button" class="btn btn-outline-warning">Editar</button>
                                    <button type="button" class="btn btn-outline-danger">Excluir</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@floating-ui/dom@1.5.3"></script>

</html>