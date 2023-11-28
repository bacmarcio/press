<?php 
include "verifica.php";
$banners->add();
$dadosBanners = $banners->dadosBanners();
$dadosPosts = $posts->dadosPosts();




if(isset($dadosBanners[0]->foto)){
  // echo "<style>
  //       .full-width-banner{
  //         background: url('/post-images/".$dadosBanners[0]->foto."') center/cover no-repeat;
  //       }
  //       </style>";
}


?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css">
  <title>Seu Site</title>
  <style>
    body {
      padding-top: 56px;
    }

    @media (min-width: 768px) {
      body {
        padding-top: 0;
      }
    }

    .full-width-banner {
      width: 100%;
      height: 100vh;
      /* background: url('/post-images/<?php echo $dadosBanners[0]->foto;?>') center/cover no-repeat; */
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      text-align: center;
      color: white;
    }

    .card-img-clip {
            object-fit: contain;
            height: 200px; /* Defina a altura desejada */
        }

    @media (max-width: 767px) {
      .jumbotron h1 {
        font-size: 3.5rem;
      }

      .jumbotron .lead {
        font-size: 1.80rem;
      }
    }
  </style>
</head>

<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
    <div class="container">
      <a class="navbar-brand" href="#">
        <img src="https://placehold.co/600x400" alt="Logo" height="40">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Notícias</a>
          </li>
          <!-- Adicione mais itens de menu conforme necessário -->
        </ul>
      </div>
    </div>
  </nav>

  <!-- Banner principal -->
  <header class="full-width-banner bg-primary">
    <div class="jumbotron text-center">
      <h1 class="display-4"><?php echo $dadosBanners[0]->titulo;?></h1>
      <p class="lead"><?php echo html_entity_decode($dadosBanners[0]->descricao,ENT_COMPAT); ?></p>
      <div class="row">
        <div class="col-4">
          <div class="card flex-row flex-wrap align-items-center">
            <div class="card-header border-0">
              <img src="//placehold.it/100" alt="">
            </div>
            <div class="card-block px-2">
              <h4 class="card-title text-dark">Title</h4>
              <p class="card-text text-dark">Description</p>
            </div>
            
          </div>
        </div>
        <div class="col-4">
          <div class="card flex-row flex-wrap align-items-center">
            <div class="card-header border-0">
              <img src="//placehold.it/100" alt="">
            </div>
            <div class="card-block px-2">
              <h4 class="card-title text-dark">Title</h4>
              <p class="card-text text-dark">Description</p>
              
            </div>
            
          </div>
        </div>
        <div class="col-4">
          <div class="card flex-row flex-wrap align-items-center">
            <div class="card-header border-0">
              <img src="//placehold.it/100" alt="">
            </div>
            <div class="card-block px-2">
              <h4 class="card-title text-dark">Title</h4>
              <p class="card-text text-dark">Description</p>
              
            </div>
            
          </div>
        </div>
        
      </div>
    </div>
  </header>

  <!-- Seção de Notícias -->
  <section class="container mt-4">
    <div class="row">
      <!-- Card 1 -->
      <?php foreach ($dadosPosts as $post) { ?>
      <div class="col-lg-4 mb-4">
        <div class="card">
          <img src="/post-images/<?php echo $post->foto;?>" class="card-img-top card-img-clip" alt="<?php echo $post->titulo;?>">
          <div class="card-body">
            <h5 class="card-title"><?php echo $post->titulo;?> </h5>
            <p class="card-text"><?php //echo $post->resumo;?></p>
          </div>
        </div>
      </div>
      <?php }?>
      
      <!-- x2-pro -- melhor console  |  g11-pro interface top -->

  

    </div>
  </section>

  <!-- Rodapé -->
  <footer class="bg-dark text-light text-center p-2">
    <p>Rodapé - Copyright © 2023 Seu Site</p>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>