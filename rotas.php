<?php

// Receba a URL da variável $_GET
$url = isset($_GET['url']) ? $_GET['url'] : '';

// Defina rotas para URLs específicas
$routes = [
    'quem-somos' => 'quem-somos.php',
    'releases' => 'releases.php',
];

// Verifique se a URL corresponde a uma rota válida
if (array_key_exists($url, $routes)) {
    $file = $routes[$url];
} elseif (preg_match('/^releases\/([a-zA-Z-0-9-_]+)$/', $url, $matches)) {
    // Tratar URLs do tipo "releases/titulo-da-release"
    $tituloRelease = $matches[1];
    $file = 'releases.php';

    // Passe o título da release para a página
    $_GET['titulo_release'] = $tituloRelease;
} else {
    // Lógica padrão para URLs não reconhecidas
    $file = 'index.php';
}

// Inclua o arquivo correspondente
include($file);

