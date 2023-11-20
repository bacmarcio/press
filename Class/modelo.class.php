<?php

/**
 * Classe Acesso
 *
 * Essa classe representa a entidade de Acesso e fornece métodos para interagir com o banco de dados.
 *
 * @package Press Release
 * @category Modelos
 * @author Márcio Maia <https://github.com/bacmarcio>
 * @version 1.0
 * @access public
 */

class Acesso
{
    /**
     * @var PDO Uma instância da conexão PDO.
     */

    private $pdo;

    /**
     * @var Acesso|null Uma instância única da classe Acesso.
     */

    private static $instance = null;

    /**
     * Construtor privado para garantir que a classe seja instanciada apenas uma vez.
     *
     * @param PDO $conexao Uma instância da conexão PDO.
     */

    private function __construct($conn)
    {
        $this->pdo = $conn;
    }

    /**
     * Obtém uma instância única da classe Acesso.
     *
     * @param PDO $conexao Uma instância da conexão PDO.
     * @return Acesso Uma instância da classe Acesso.
     */

    public static function getInstance($conn)
    {
        if (self::$instance === null) {
            self::$instance = new Acesso($conn);
        }
        return self::$instance;
    }

    /**
     * Obtém a instância da conexão PDO.
     *
     * @return PDO Uma instância da conexão PDO.
     */

    public function getPdo()
    {
        return $this->pdo;
    }
}
