<?php

/**
 * Classe Categorias
 *
 * Essa classe representa a entidade de Categorias e fornece métodos para interagir com o banco de dados.
 *
 * @package Press Release
 * @category Modelos
 * @author Márcio Maia <https://github.com/bacmarcio>
 * @version 1.0
 * @access public
 */

class Categorias
{
    /**
     * @var PDO Uma instância da conexão PDO.
     */

    private $pdo;

    /**
     * @var Categorias|null Uma instância única da classe Categorias.
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
     * Obtém uma instância única da classe Categorias.
     *
     * @param PDO $conexao Uma instância da conexão PDO.
     * @return Categorias Uma instância da classe Categorias.
     */

    public static function getInstance($conn)
    {
        if (self::$instance === null) {
            self::$instance = new Categorias($conn);
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

    public function dadosCategorias($id = '', $titulo = '',  $orderBy = '', $limite = '')
    {
        $filtro = [];
        $parametros = [];

        if (!empty($id)) {
            $filtro[] = 'id = ?';
            $parametros[] = $id;
        }

        if (!empty($titulo)) {
            $filtro[] = 'titulo = ?';
            $parametros[] = $titulo;
        }

        $sqlFiltro = !empty($filtro) ? 'WHERE ' . implode(' AND ', $filtro) : '';
        $sqlOrdem = !empty($orderBy) ? "ORDER BY {$orderBy}" : '';
        $sqlLimite = !empty($limite) ? "LIMIT 0,{$limite}" : '';

        try {
            $sql = "SELECT * FROM categorias {$sqlFiltro} {$sqlOrdem} {$sqlLimite}";
            $stm = $this->pdo->prepare($sql);

            for ($i = 1; $i <= count($parametros); $i++) {
                $stm->bindValue($i, $parametros[$i - 1]);
            }

            $stm->execute();
            $categorias = $stm->fetchAll(PDO::FETCH_OBJ);

            if (!empty($id) || $limite == 1) {
                return (!empty($categorias[0])) ? $categorias[0] : null;
            } else {
                return $categorias;
            }
        } catch (PDOException $erro) {
            echo $erro->getMessage();
        }
    }

    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['acao']) && $_POST['acao'] === 'addCategoria') {
            $titulo = filter_input(INPUT_POST, 'titulo', FILTER_SANITIZE_SPECIAL_CHARS);
            $url_amigavel = gerarTituloSEO($titulo);
            $ordem = filter_input(INPUT_POST, 'ordem', FILTER_SANITIZE_SPECIAL_CHARS);
            
            try {
                $sql = "INSERT INTO categorias (titulo, url_amigavel, ordem) VALUES (?, ?, ?)";
                $stm = $this->pdo->prepare($sql);
                $stm->bindValue(1, $titulo, PDO::PARAM_STR);
                $stm->bindValue(2, $url_amigavel, PDO::PARAM_STR);
                $stm->bindValue(3, $ordem, PDO::PARAM_STR);
                
                $stm->execute();
                $ultimoIdCategoria = $this->pdo->lastInsertId();

                header('Location: categorias.php');
                exit;
            } catch (PDOException $erro) {
                echo $erro->getMessage();
            }
        }
    }

    public function editar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['acao']) && $_POST['acao'] === 'editarCategoria') {
            $titulo = filter_input(INPUT_POST, 'titulo', FILTER_SANITIZE_SPECIAL_CHARS);
            $url_amigavel = gerarTituloSEO($titulo);
            $ordem = filter_input(INPUT_POST, 'ordem', FILTER_SANITIZE_SPECIAL_CHARS);
            $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_SPECIAL_CHARS);

            try {
                $sql = "UPDATE categorias SET titulo=?, url_amigavel=?, ordem=? WHERE id=?";
                $stm = $this->pdo->prepare($sql);
                $stm->bindValue(1, $titulo, PDO::PARAM_STR);
                $stm->bindValue(2, $url_amigavel, PDO::PARAM_STR);
                $stm->bindValue(3, $ordem, PDO::PARAM_STR);
                $stm->bindValue(4, $id, PDO::PARAM_STR);
                

                $stm->execute();

                header('Location: categorias.php');
                exit;
            } catch (PDOException $erro) {
                echo $erro->getMessage();
            }
        }
    }

    public function excluir()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['acao']) && $_GET['acao'] === 'excluirCategoria' && isset($_GET['id'])) {
            
            try {
                $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

                if ($id !== false) {
                    $sql = "DELETE FROM categorias WHERE id=?";
                    $stm = $this->pdo->prepare($sql);
                    $stm->bindValue(1, $id, PDO::PARAM_INT);
                    $stm->execute();
                } else {
                    // Tratamento para o caso de 'id' não ser um inteiro válido
                    throw new Exception('ID inválido.');
                }

                // Redirecionamento após a exclusão
                header('Location: categorias.php');
                exit;
            } catch (PDOException $erro) {
                echo $erro->getMessage();
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }
    }

}
