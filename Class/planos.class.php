<?php

/**
 * Classe Planos
 *
 * Essa classe representa a entidade de Planos e fornece métodos para interagir com o banco de dados.
 *
 * @package Press Release
 * @category Modelos
 * @author Márcio Maia <https://github.com/bacmarcio>
 * @version 1.0
 * @access public
 */

class Planos
{
    /**
     * @var PDO Uma instância da conexão PDO.
     */

    private $pdo;

    /**
     * @var Planos|null Uma instância única da classe Planos.
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
     * Obtém uma instância única da classe Planos.
     *
     * @param PDO $conexao Uma instância da conexão PDO.
     * @return Planos Uma instância da classe Planos.
     */

    public static function getInstance($conn)
    {
        if (self::$instance === null) {
            self::$instance = new Planos($conn);
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

    public function dadosPlanos($id = '', $titulo = '',  $orderBy = '', $limite = '')
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
            $sql = "SELECT * FROM planos {$sqlFiltro} {$sqlOrdem} {$sqlLimite}";
            $stm = $this->pdo->prepare($sql);

            for ($i = 1; $i <= count($parametros); $i++) {
                $stm->bindValue($i, $parametros[$i - 1]);
            }

            $stm->execute();
            $planos = $stm->fetchAll(PDO::FETCH_OBJ);

            if (!empty($id) || $limite == 1) {
                return (!empty($planos[0])) ? $planos[0] : null;
            } else {
                return $planos;
            }
        } catch (PDOException $erro) {
            echo $erro->getMessage();
        }
    }

    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['acao']) && $_POST['acao'] === 'addPlano') {
            $titulo = filter_input(INPUT_POST, 'titulo', FILTER_SANITIZE_SPECIAL_CHARS);
            $conteudo = $_POST['conteudo']; // Recebe o conteúdo do campo textarea
            $conteudo = strip_tags($conteudo);
            $conteudo = preg_replace('/<script\b[^>]*>(.*?)<\/script>/is', '', $conteudo);
            $conteudo = htmlentities($conteudo, ENT_QUOTES, 'UTF-8');
            $valor = filter_input(INPUT_POST, 'valor', FILTER_SANITIZE_SPECIAL_CHARS);

            $diretorioFotos = '../post-images';
            
            try {
                $sql = "INSERT INTO planos (titulo, conteudo, valor, foto) VALUES (?, ?, ?, ?)";
                $stm = $this->pdo->prepare($sql);
                $stm->bindValue(1, $titulo, PDO::PARAM_STR);
                $stm->bindValue(2, $conteudo, PDO::PARAM_STR);
                $stm->bindValue(3, valorCalculavel($valor), PDO::PARAM_STR);
                $stm->bindValue(4, upload('foto', $diretorioFotos, 'N'), PDO::PARAM_STR);
                
                $stm->execute();
                $ultimoIdPlano = $this->pdo->lastInsertId();

                header('Location:'.SITE_URL.'planos');
                exit;
            } catch (PDOException $erro) {
                echo $erro->getMessage();
            }
        }
    }
    
    public function editar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['acao']) && $_POST['acao'] === 'editarPlano') {
            $titulo = filter_input(INPUT_POST, 'titulo', FILTER_SANITIZE_SPECIAL_CHARS);
            $conteudo = $_POST['conteudo']; // Recebe o conteúdo do campo textarea
            $conteudo = strip_tags($conteudo);
            $conteudo = preg_replace('/<script\b[^>]*>(.*?)<\/script>/is', '', $conteudo);
            $conteudo = htmlentities($conteudo, ENT_QUOTES, 'UTF-8');
            $valor = filter_input(INPUT_POST, 'valor', FILTER_SANITIZE_SPECIAL_CHARS);
            $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_SPECIAL_CHARS);

            $diretorioFotos = '../post-images';
            
            try {
                $sql = "UPDATE planos SET titulo=?, conteudo=?, valor=?, foto=? WHERE id=?";
                $stm = $this->pdo->prepare($sql);
                $stm->bindValue(1, $titulo, PDO::PARAM_STR);
                $stm->bindValue(2, $conteudo, PDO::PARAM_STR);
                $stm->bindValue(3, valorCalculavel($valor), PDO::PARAM_STR);
                $stm->bindValue(4, upload('foto', $diretorioFotos, 'N'), PDO::PARAM_STR);
                $stm->bindValue(5, $id, PDO::PARAM_STR);
                
                $stm->execute();

                header('Location:'.SITE_URL.'planos');
                exit;
            } catch (PDOException $erro) {
                echo $erro->getMessage();
            }
        }
    }

    public function excluir()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['acao']) && $_GET['acao'] === 'excluirPlano' && isset($_GET['id'])) {
            
            $nomeArquivo = $_GET['foto']; // Substitua pelo nome do arquivo que você deseja excluir
            $caminhoArquivo = "../post-images/" . $nomeArquivo; // Substitua pelo caminho correto

            if (file_exists($caminhoArquivo)) {
                    unlink($caminhoArquivo);
            }

            try {
                $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

                if ($id !== false) {
                    $sql = "DELETE FROM planos WHERE id=?";
                    $stm = $this->pdo->prepare($sql);
                    $stm->bindValue(1, $id, PDO::PARAM_INT);
                    $stm->execute();
                } else {
                    // Tratamento para o caso de 'id' não ser um inteiro válido
                    throw new Exception('ID inválido.');
                }

                // Redirecionamento após a exclusão
                header('Location:'.SITE_URL.'planos');
                exit;
            } catch (PDOException $erro) {
                echo $erro->getMessage();
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }
    }


}
