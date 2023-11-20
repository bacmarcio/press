<?php

class XssCleaner
{
    /**
     * Remove potenciais ataques XSS de uma string de entrada.
     *
     * @param string $data A string a ser tratada contra ataques XSS.
     * @return string A string tratada.
     */
    public static function clean($data)
    {
        // Remove códigos JavaScript e atributos "on*"
        $data = preg_replace('/<script\b[^>]*>(.*?)<\/script>/is', '', $data);
        $data = preg_replace('/on\w+\s*=\s*("[^"]*"|\'[^\']*\'|[^\s>]+)/i', '', $data);

        // Remove event handlers em tags HTML
        $data = preg_replace('/<[^>]+(on\w+)[^>]*>/i', '<$1>', $data);

        return htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
    }
}

// Aplicando o XssCleaner aos dados de $_GET e $_POST

foreach($_GET as $key => $value) {
    if(!is_array($_GET[$key])) {
        $_GET[$key] = XssCleaner::clean($value);
    }
}

foreach($_POST as $key => $value) {
    if(!is_array($_POST[$key])) {
        $_POST[$key] = XssCleaner::clean($value);
    }
}
