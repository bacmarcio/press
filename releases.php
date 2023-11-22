<?php 

$tituloRelease = isset($_GET['titulo_release']) ? $_GET['titulo_release'] : '';

echo "<h1>OK o titulo é ".$tituloRelease."</h1>";