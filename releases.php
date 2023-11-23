<?php 
include "verifica.php";

$tituloRelease = isset($_GET['titulo_release']) ? $_GET['titulo_release'] : '';

$dadosPost = $posts->dadosPosts('', '', '', '', $tituloRelease);

print_r($dadosPost);

// echo "<h1>OK o titulo é ".$tituloRelease."</h1>";