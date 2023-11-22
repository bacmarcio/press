<?php 
    include "verifica.php"; 
    session_start();
    $idUser = $_SESSION['dadosUsuario']['id'];

    $resultado = $planos->contarCreditos($idUser);
    $dadosPlanos = $planos->dadosPlanos();
    
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
</head>

<body>
    <main>
        <div class="row row-cols-1 row-cols-md-3 mb-3 text-center">
            <?php foreach ($dadosPlanos as $itemPlano) { ?>  
                <div class="col">
                    <div class="card mb-4 rounded-3 shadow-sm">
                        <div class="card-header py-3">
                            <h4 class="my-0 fw-normal"><?php echo $itemPlano->titulo?></h4>
                        </div>
                        <div class="card-body">
                            <h1 class="card-title pricing-card-title">R$<?php echo $itemPlano->valor?><small class="text-body-secondary fw-light">/mes</small></h1>
                            <div class="mt-3 mb-4">
                            <?php echo html_entity_decode($itemPlano->conteudo,ENT_COMPAT); ?>
                            </div>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-id="<?php echo $itemPlano->id?>">Adquirir Plano</button>
                        </div>
                    </div>
                </div>
            <?php }?>
            
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