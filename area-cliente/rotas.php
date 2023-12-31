<?php

// Receba a URL da variável $_GET
$url = isset($_GET['url']) ? $_GET['url'] : '';

// Defina rotas para URLs específicas
$routes = [
    'noticias'       => 'noticias.php',
    'add-noticia'    => 'add-noticia.php',
    'editar-noticia' => 'editar-noticia.php',
    'login'          => 'login.php',
    'logout'         => 'login.php',
    'cadastro'       => 'cadastro.php',
    'editar-perfil'  => 'editar-perfil.php',
    'adquirir-plano' => 'adquirir-plano.php',
];

// Verifique se a URL corresponde a uma rota válida
if (array_key_exists($url, $routes)) 
{
    $file = $routes[$url];
} 
elseif (preg_match('/^editar-noticia\/([a-zA-Z-0-9-_]+)$/', $url, $matches)) 
{
    // Tratar URLs do tipo "editar-noticia/algum-id"
    $id = $matches[1];
    $file = 'editar-noticia.php';
} 
elseif (preg_match('/^editar-perfil\/([a-zA-Z-0-9-_]+)$/', $url, $matches)) 
{
    // Tratar URLs do tipo "editar-noticia/algum-id"
    $id = $matches[1];
    $file = 'editar-perfil.php';
}
else 
{
    // Lógica padrão para URLs não reconhecidas
    $file = 'index.php';
}

// Inclua o arquivo correspondente
include($file);

