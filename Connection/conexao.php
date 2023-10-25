<?php
require_once("../Class/conexao.class.php");

define('HOST', 'localhost'); // O endereço do servidor de banco de dados
define('DBNAME', 'press_releases'); // O nome do banco de dados
define('CHARSET', 'utf8'); // O conjunto de caracteres (normalmente 'utf8' é uma boa escolha)
define('USER', 'root'); // O nome de usuário do banco de dados
define('PASSWORD', ''); // A senha do banco de dados

$conn = Conexao::getInstance();
