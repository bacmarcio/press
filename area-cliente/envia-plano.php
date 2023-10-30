<?php 
 session_start();   
include "verifica.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recuperar o ID do POST
    $idPlano = $_POST['id'];
    $idUser = $_SESSION['dadosUsuario']['id'];

    $planos->comprarPlano($idPlano, $idUser);
}