<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once 'Connection/conexao.php';
require_once 'Connection/xss-cleaner.php';
require_once 'Funcoes/funcoes.php';

define('SITE_URL', 'https://' . $_SERVER['HTTP_HOST']);

include "Class/posts.class.php";
$posts = Posts::getInstance(Conexao::getInstance());

include "Class/banners.class.php";
$banners = Banners::getInstance(Conexao::getInstance());

include "Class/categorias.class.php";
$categorias = Categorias::getInstance(Conexao::getInstance());  