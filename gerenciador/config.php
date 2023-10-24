<?php

/* 
 * O arquivo de configurações vai guardar todos os dados que vão ser usados
 * em todos os outros scritps PHP do sistema.
 * ABSPATH define o caminho absoluto da pasta deste projeto no sistema de arquivos.
 * Ela vai ser usada para chamar os outros arquivos  
 * e templates via PHP (usando o include_once), já que ela guarda o caminho físico da pasta.
 * BASEURL define o caminho deste projeto no servidor web.
 * Esse valor deve ser igual ao nome da pasta do projeto. 
 * Ele será usada para montar os links do projeto, já que ele guarda a URL inicial.


 */

/*define('DB_NAME', 'mais');
define('DB_USER', 'root');
define('DB_PASSWORD', '12345');
define('DB_HOST', 'localhost');*/

// a condição abaixo só funciona se estiver aspas no defined também, sem ele vai dar mensagem de erro
/*if(!defined('ABSPATH'))
    define('ABSPATH', dirname(__FILE__).'/');
if(!defined('BASEURL'))
    define('BASEURL', '/mais/');
if(!defined('DBAPI'))
    define('DBAPI', ABSPATH . 'inc/database.php');*/

define('HEADER_TEMPLATE', ABSPATH . 'inc/header.php');
define('HEADER_TEMPLATE_LOGIN', ABSPATH . 'inc/header2.php');
define('FOOTER_TEMPLATE', ABSPATH . 'inc/footer.php');

