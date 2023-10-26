<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once('../Connection/conexao.php');
require_once('../Connection/xss-cleaner.php');
require_once('../Funcoes/funcoes.php');

define('SITE_URL', 'https://' . $_SERVER['HTTP_HOST'] . '/projetos/press/area-cliente/');

require_once ("../Class/acesso.class.php");
$acesso = Acesso::getInstance(Conexao::getInstance());

include ("../Class/usuarios.class.php");
$usuarios = Usuarios::getInstance(Conexao::getInstance());

include ("../Class/posts.class.php");
$posts = Posts::getInstance(Conexao::getInstance());

include ("../Class/categorias.class.php");
$categorias = Categorias::getInstance(Conexao::getInstance());

include ("../Class/textos.class.php");
$textos = Textos::getInstance(Conexao::getInstance());

include ("../Class/planos.class.php");
$planos = Planos::getInstance(Conexao::getInstance());

include ("../Class/banners.class.php");
$banners = Banners::getInstance(Conexao::getInstance());


