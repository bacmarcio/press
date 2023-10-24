<?php
/**
 * Formata a data que vem do Banco de Dados
 * @author Márcio Maia <https://github.com/bacmarcio>
 * @access public
 * @param string $data "2023-05-30"
 * @return "30/05/2023"
 */

function formataData($data)
{
    return date("d/m/Y", strtotime($data));
}

/**
 * Formata a data para enviar ao banco de dados
 * @author Márcio Maia <https://github.com/bacmarcio>
 * @access public
 * @param string $data " 30/05/2023"
 * @return "2023-05-30"
 */

function formataDataSql($data)
{
    return date("Y-m-d", strtotime($data));
}

/**
 * Envia a imagem para a pasta de imagens do site
 * @author Márcio Maia <https://github.com/bacmarcio>
 * @access public
 * @param string $campo $_POST['foto']
 * @param string $pasta ./imagens
 * @param string $array Insere um identificador para imagem ex: categoria tag local...
 * @return "1675101611.506-foto-N.jpg"
 */
  
function upload($campo, $pasta, $array)
{
    list($usec, $sec) = explode(" ", microtime());
    $tmp = (float)$usec + (float)$sec;
    
    if($array == 'N' and $array != '0') {
        if(isset($_FILES[$campo]['name']) && !empty($_FILES[$campo]['name'])) {
            $file = $_FILES[$campo];
            $file['name'];
            $ext = substr($file['name'], strrpos($file['name'], "."));
            copy($file['tmp_name'], $pasta."/$tmp-$campo-$array$ext");
        
            return("$tmp-$campo-$array$ext");
        } else {
            if(isset($_POST[$campo.'_Atual'])) {
                return($_POST[$campo.'_Atual']);
            }
        
        }
        /** Não substitue a imagem atual ao alterar o conteudo  */
      
    } else {
        if(isset($_FILES[$campo]['name'][$array]) && !empty($_FILES[$campo]['name'][$array])) {
            $file = $_FILES[$campo];
            $file['name'][$array];
            $ext = substr($file['name'][$array], strrpos($file['name'][$array], "."));
            copy($file['tmp_name'][$array], $pasta."/$tmp-$campo-$array$ext");
            return("$tmp-$campo-$array$ext");
        } else {
            return($_POST[$campo.'_Atual'][$array]);
        }
    }
}

/**
 * Cria uma URL amigavel
 *
 * @author Márcio Maia <https://github.com/bacmarcio>
 * @access public
 * @param string $strTitulo "Titulo da Postagem"
 * @return "titulo-da-postagem"
 */

function gerarTituloSEO($strTitulo)
{

    /* Remove pontos e underlines */
    $arrEncontrar = array(".", "_", ",");
    $arrSubstituir = '';
    $strTitulo = str_replace($arrEncontrar, $arrSubstituir, $strTitulo);

    /* Caracteres minúsculos */
    $strTitulo = strtolower($strTitulo);
      
    /* Remove os acentos */
    $acentos = array("á", "Á", "ã", "Ã", "â", "Â", "à", "À", "é", "É", "ê", "Ê", "è", "È", "í", "Í", "ó", "Ó", "õ", "Õ", "ò", "Ò", "ô", "Ô", "ú", "Ú", "ù", "Ù", "û", "Û", "ç", "Ç", "º", "ª");
    $letras = array("a", "A", "a", "A", "a", "A", "a", "A", "e", "E", "e", "E", "e", "E", "i", "I", "o", "O", "o", "O", "o", "O", "o", "O", "u", "U", "u", "U", "u", "U", "c", "C", "o", "a");

    $strTitulo = str_replace($acentos, $letras, $strTitulo);
    $strTitulo = preg_replace("/[^a-zA-Z0-9._$, ]/", "", $strTitulo);
    $strTitulo = iconv("UTF-8", "UTF-8//TRANSLIT", $strTitulo);
      
    /* Remove espaços em branco */
    $strTitulo = str_replace(" ", "-", $strTitulo);

    /* Remove preposições */
    $strCaracterSeparador = "-";
      
    $arrEncontrar = array("-a-", "-e-", "-i-", "-o-", "-u-", "-p-", "-em-", "-de-", "-do-", "-da-", "-dos-", "-das-", "-com-", "-um-", "-uma-", "-para-");
    $arrSubstituir = $strCaracterSeparador;
    $strTitulo = str_ireplace($arrEncontrar, $arrSubstituir, $strTitulo);

    return $strTitulo;

}


//valores e moedas

function valorCalculavel($valor)
{
    $formatado = str_replace('.', '', $valor);
    $formatado = str_replace(',', '.', $formatado);
    $formatado = str_replace('R$ ', '', $formatado);
    $formatado = str_replace('U$ ', '', $formatado);

    if(strpos(strrev($valor), ',')) {
        return(floatval($formatado));
    } else {
        return(floatval($valor));
    }
}

/**
 * Saudações Automaticas. Bom dia, boa tarde e boa noite
 *
 * @author Márcio Maia <https://github.com/bacmarcio>
 * @access public
 * @param string $nome "Márcio"
 * @return "Bom dia, Márcio"
 */

function saudacao($nome = '')
{
    date_default_timezone_set('America/Sao_Paulo');
    $hora = date('H');
    if($hora >= 6 && $hora <= 12) {
        return 'Bom dia' . (empty($nome) ? '' : ', ' . $nome);
    } elseif ($hora > 12 && $hora <=18) {
        return 'Boa tarde' . (empty($nome) ? '' : ', ' . $nome);
    } else {
        return 'Boa noite' . (empty($nome) ? '' : ', ' . $nome);
    }
}
  
/**
 * Alterna entre os diferentes idiomas inseridos no site
 *
 * @author Márcio Maia <https://github.com/bacmarcio>
 * @access public
 */
    
if(isset($_GET['lang'])) {
    $lang = $_GET['lang'];

    $_SESSION['lang'] = $lang;
    setcookie('lang', $lang, time()+ (3600 * 24 * 30));
} elseif(isset($_SESSION['lang'])) {
    $lang = $_SESSION['lang'];
} elseif(isset($_COOKIE['lang'])) {
    $lang = $_COOKIE['lang'];
} else {
    $lang = 'pt';
}
switch ($lang) {
    case 'pt':
        $lang_file = 'lang.pt.php';
        break;
    case 'en':
        $lang_file = 'lang.en.php';
        break;
    case 'th':
        $lang_file = 'lang.th.php';
        break;
    default:
        $lang_file = 'lang.pt.php';
        break;
}
//include_once 'lang/'.$lang_file;
