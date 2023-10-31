<?php 
    include "verifica.php"; 
    session_start();
    $idUser = $_SESSION['dadosUsuario']['id'];

    $resultado = $planos->contarCreditos($idUser);
    
    if (is_string($resultado)) {
        // A função retornou uma mensagem de erro
        echo $resultado;
    }
    ?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.2/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
</head>

<body>
    <main>
        <div class="row row-cols-1 row-cols-md-3 mb-3 text-center">
            <div class="col">
                <div class="card mb-4 rounded-3 shadow-sm">
                    <div class="card-header py-3">
                        <h4 class="my-0 fw-normal">Free</h4>
                    </div>
                    <div class="card-body">
                        <h1 class="card-title pricing-card-title">$0<small class="text-body-secondary fw-light">/mo</small></h1>
                        <ul class="list-unstyled mt-3 mb-4">
                            <li>10 users included</li>
                            <li>2 GB of storage</li>
                            <li>Email support</li>
                            <li>Help center access</li>
                        </ul>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-id="1">Open modal for @getbootstrap</button>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card mb-4 rounded-3 shadow-sm">
                    <div class="card-header py-3">
                        <h4 class="my-0 fw-normal">Pro</h4>
                    </div>
                    <div class="card-body">
                        <h1 class="card-title pricing-card-title">$15<small class="text-body-secondary fw-light">/mo</small></h1>
                        <ul class="list-unstyled mt-3 mb-4">
                            <li>20 users included</li>
                            <li>10 GB of storage</li>
                            <li>Priority email support</li>
                            <li>Help center access</li>
                        </ul>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-id="2">Open modal for @fat</button>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card mb-4 rounded-3 shadow-sm border-primary">
                    <div class="card-header py-3 text-bg-primary border-primary">
                        <h4 class="my-0 fw-normal">Enterprise</h4>
                    </div>
                    <div class="card-body">
                        <h1 class="card-title pricing-card-title">$29<small class="text-body-secondary fw-light">/mo</small></h1>
                        <ul class="list-unstyled mt-3 mb-4">
                            <li>30 users included</li>
                            <li>15 GB of storage</li>
                            <li>Phone and email support</li>
                            <li>Help center access</li>
                        </ul>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-id="3" data-bs-imagem="qrcode.png" data-bs-link="www.link.com">Open modal for @mdo</button>
                    </div>
                </div>
            </div>
        </div>
    </main>


    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Plano Selecionado</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 ms-auto"><img id="imagemModal" src="" alt="" width="100%"></div>
                        <div class="col-md-6 ms-auto">
                            <h4>Escaneie o Qrcode ao lado com o seu aplicativo de pagamento ou copie o link abaixo</h4>
                            

                            <div class="input-group mb-3">
                                <button class="btn btn-outline-secondary" type="button" id="btnCopy" data-clipboard-target="#textoACopiar"><i class="fa-regular fa-clipboard"></i></button>
                                <input type="text" id="textoACopiar" class="form-control" placeholder="" aria-label="Example text with button addon" aria-describedby="btnCopy" value="">
                            </div>

                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@floating-ui/dom@1.5.3"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.8/clipboard.min.js"></script>

<script>
    const exampleModal = document.getElementById('exampleModal');
    if (exampleModal) {
        exampleModal.addEventListener('show.bs.modal', event => {
            // Button that triggered the modal
            const button = event.relatedTarget;
            // Extract info from data-bs-* attributes
            const recipient = button.getAttribute('data-bs-id');
            const imagem = button.getAttribute('data-bs-imagem');
            const link = button.getAttribute('data-bs-link');

            // Enviar o ID para o servidor via AJAX
            sendIdToServer(recipient);

            const modalTitle = exampleModal.querySelector('.modal-title')
            const modalBodyInput = exampleModal.querySelector('.modal-body input')

            modalTitle.textContent = `Plano ${recipient} selecionado`
            modalBodyInput.value = link
            document.getElementById('imagemModal').src = imagem;
        });
    }

    function sendIdToServer(id) {
        const xhr = new XMLHttpRequest();
        const url = 'envia-plano.php'; // Substitua pelo caminho correto para o seu script PHP
        const data = new FormData();
        data.append('id', id);

        xhr.open('POST', url, true);

        xhr.onload = function() {
            if (xhr.status === 200) {
                console.log(xhr.responseText); // Pode lidar com a resposta do servidor aqui
            }
        };

        xhr.send(data);
    }
</script>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    var btnCopy = document.getElementById('btnCopy');
    var clipboard = new ClipboardJS(btnCopy);

    clipboard.on('success', function (e) {
      e.clearSelection();
      btnCopy.innerHTML = '<i class="fa-solid fa-check"></i>';
    });
  });
</script>

</html>