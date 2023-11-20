<?php
class Conexao
{
    private static $pdo;

    private function __construct()
    {
    }

    public static function getInstance()
    {
        if (!isset(self::$pdo)) {
            try {
                $dsn = "mysql:host=" . HOST . ";dbname=" . DBNAME . ";charset=" . CHARSET;
                $opcoes = array(
                    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
                    PDO::ATTR_PERSISTENT => true,
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
                );
                self::$pdo = new PDO($dsn, USER, PASSWORD, $opcoes);
            } catch (PDOException $e) {
                die("Erro ao conectar com o banco de dados: " . $e->getMessage());
            }
        }
        return self::$pdo;
    }
}
