<?php

// Receba a URL da variável $_GET
$url = isset($_GET['url']) ? $_GET['url'] : '';

// Defina rotas para URLs específicas
$routes = [
    'noticias' => 'noticias.php',
    'add-noticia' => 'add-noticia.php',
    'editar-noticia' => 'editar-noticia.php'
];

// Verifique se a URL corresponde a uma rota válida
if (array_key_exists($url, $routes)) {
    $file = $routes[$url];
    include($file);
} elseif (preg_match('/^editar-noticia\/([a-zA-Z-0-9-_]+)$/', $url, $matches)) {
    // Tratar URLs do tipo "editar-noticias/algum-id"
    $id = $matches[1];
    include('editar-noticia.php');
} else {
    // Lógica padrão para URLs não reconhecidas
    include('index.php');
}