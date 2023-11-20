<?php

// Receba a URL da variável $_GET
$url = isset($_GET['url']) ? $_GET['url'] : '';

// Defina rotas para URLs específicas
$routes = [
    'releases'         => 'noticias.php',
    'add-release'      => 'add-noticia.php',
    'editar-release'   => 'editar-noticia.php',
    'textos'           => 'textos.php',
    'editar-texto'     => 'editar-texto.php',
    'categorias'       => 'categorias.php',
    'add-categoria'    => 'add-categoria.php',
    'editar-categoria' => 'editar-categoria.php',
    'usuarios'         => 'usuarios.php',
    'add-usuario'      => 'add-usuario.php',
    'editar-usuario'   => 'editar-usuario.php',
    'planos'           => 'planos.php',
    'add-plano'        => 'add-plano.php',
    'editar-plano'     => 'editar-plano.php',
    'banners'          => 'banners.php',
    'add-banner'       => 'add-banner.php',
    'editar-banner'    => 'editar-banner.php',
    'login'            => 'login.php',
    'logout'           => 'login.php',
    'cadastro'         => 'cadastro.php',
    'publicar-release' => 'publicar-post.php',
];

// Verifique se a URL corresponde a uma rota válida
if (array_key_exists($url, $routes)) 
{
    $file = $routes[$url];
} 
elseif (preg_match('/^editar-release\/([a-zA-Z-0-9-_]+)$/', $url, $matches)) 
{
    // Tratar URLs do tipo "editar-noticia/algum-id"
    $id = $matches[1];
    $file = 'editar-noticia.php';
} 
elseif (preg_match('/^editar-texto\/([a-zA-Z-0-9-_]+)$/', $url, $matches)) 
{
    // Tratar URLs do tipo "editar-texto/algum-id"
    $id = $matches[1];
    $file = 'editar-texto.php';
}
elseif (preg_match('/^editar-categoria\/([a-zA-Z-0-9-_]+)$/', $url, $matches)) 
{
    // Tratar URLs do tipo "editar-texto/algum-id"
    $id = $matches[1];
    $file = 'editar-categoria.php';
}
elseif (preg_match('/^editar-usuario\/([a-zA-Z-0-9-_]+)$/', $url, $matches)) 
{
    // Tratar URLs do tipo "editar-texto/algum-id"
    $id = $matches[1];
    $file = 'editar-usuario.php';
}
elseif (preg_match('/^editar-plano\/([a-zA-Z-0-9-_]+)$/', $url, $matches)) 
{
    // Tratar URLs do tipo "editar-texto/algum-id"
    $id = $matches[1];
    $file = 'editar-plano.php';
}
elseif (preg_match('/^editar-banner\/([a-zA-Z-0-9-_]+)$/', $url, $matches)) 
{
    // Tratar URLs do tipo "editar-texto/algum-id"
    $id = $matches[1];
    $file = 'editar-banner.php';
} 
elseif (preg_match('/^publicar-release\/([a-zA-Z-0-9-_]+)$/', $url, $matches)) 
{
    // Tratar URLs do tipo "editar-texto/algum-id"
    $id = $matches[1];
    $file = 'publicar-post.php';
}   
else 
{
    // Lógica padrão para URLs não reconhecidas
    $file = 'index.php';
}

// Inclua o arquivo correspondente
include($file);

