<?php

/**
 * Classe Publicados
 *
 * Essa classe representa a entidade de Publicados e fornece métodos para interagir com o banco de dados.
 *
 * @package Press Release
 * @category Modelos
 * @author Márcio Maia <https://github.com/bacmarcio>
 * @version 1.0
 * @access public
 */

class Publicados
{
    /**
     * @var PDO Uma instância da conexão PDO.
     */

    private $pdo;

    /**
     * @var Publicados|null Uma instância única da classe Publicados.
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
     * Obtém uma instância única da classe Publicados.
     *
     * @param PDO $conexao Uma instância da conexão PDO.
     * @return Publicados Uma instância da classe Publicados.
     */

    public static function getInstance($conn)
    {
        if (self::$instance === null) {
            self::$instance = new Publicados($conn);
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

    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['acao']) && $_POST['acao'] === 'publicar') {
            $link = filter_input(INPUT_POST, 'link', FILTER_SANITIZE_SPECIAL_CHARS);
            $idPost = filter_input(INPUT_POST, 'idPost', FILTER_SANITIZE_SPECIAL_CHARS);
            
            try {
                $sql = "INSERT INTO publicados (link, id_post) VALUES (?, ?)";
                $stm = $this->pdo->prepare($sql);
                $stm->bindValue(1, $link, PDO::PARAM_STR);
                $stm->bindValue(2, $idPost, PDO::PARAM_STR);
                
                $stm->execute();
                $ultimoIdPost = $this->pdo->lastInsertId();

            } catch (PDOException $erro) {
                echo $erro->getMessage();
            }
            
            $sqlVerificaSenha = "SELECT senha FROM usuarios WHERE id = ?";
                $stmVerificaSenha = $this->pdo->prepare($sqlVerificaSenha);
                $stmVerificaSenha->bindValue(1, $id, PDO::PARAM_STR);
                $stmVerificaSenha->execute();
                $senhaExistente = $stmVerificaSenha->fetchColumn();
                $senha = $senhaExistente;


            try {
                $sql = "UPDATE posts SET publicado=? WHERE id=?";
                $stm = $this->pdo->prepare($sql);
                $stm->bindValue(1, 'S', PDO::PARAM_STR);
                $stm->bindValue(2, $idPost, PDO::PARAM_STR);
                
                $stm->execute();
                $ultimoIdPost = $this->pdo->lastInsertId();
                
            } catch (PDOException $erro) {
                echo $erro->getMessage();
            }

        }
    }

}
