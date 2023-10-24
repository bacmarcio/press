<?php

/**
 * Classe Textos
 *
 * Essa classe representa a entidade de Textos e fornece métodos para interagir com o banco de dados.
 *
 * @package Press Release
 * @category Modelos
 * @author Márcio Maia <https://github.com/bacmarcio>
 * @version 1.0
 * @access public
 */

class Textos
{
    /**
     * @var PDO Uma instância da conexão PDO.
     */

    private $pdo;

    /**
     * @var Textos|null Uma instância única da classe Textos.
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
     * Obtém uma instância única da classe Textos.
     *
     * @param PDO $conexao Uma instância da conexão PDO.
     * @return Textos Uma instância da classe Textos.
     */

    public static function getInstance($conn)
    {
        if (self::$instance === null) {
            self::$instance = new Textos($conn);
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

    public function dadosTextos($id = '', $ativo = '',  $orderBy = '', $limite = '')
    {
        $filtro = [];
        $parametros = [];

        if (!empty($id)) {
            $filtro[] = 'id = ?';
            $parametros[] = $id;
        }

        if (!empty($ativo)) {
            $filtro[] = 'ativo = ?';
            $parametros[] = $ativo;
        }

        $sqlFiltro = !empty($filtro) ? 'WHERE ' . implode(' AND ', $filtro) : '';
        $sqlOrdem = !empty($orderBy) ? "ORDER BY {$orderBy}" : '';
        $sqlLimite = !empty($limite) ? "LIMIT 0,{$limite}" : '';

        try {
            $sql = "SELECT * FROM textos {$sqlFiltro} {$sqlOrdem} {$sqlLimite}";
            $stm = $this->pdo->prepare($sql);

            for ($i = 1; $i <= count($parametros); $i++) {
                $stm->bindValue($i, $parametros[$i - 1]);
            }

            $stm->execute();
            $textos = $stm->fetchAll(PDO::FETCH_OBJ);

            if (!empty($id) || $limite == 1) {
                return (!empty($textos[0])) ? $textos[0] : null;
            } else {
                return $textos;
            }
        } catch (PDOException $erro) {
            echo $erro->getMessage();
        }
    }

    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['acao']) && $_POST['acao'] === 'addTexto') {
            $titulo = filter_input(INPUT_POST, 'titulo', FILTER_SANITIZE_SPECIAL_CHARS);
            $conteudo = $_POST['conteudo']; // Recebe o conteúdo do campo textarea
            $conteudo = strip_tags($conteudo);
            $conteudo = preg_replace('/<script\b[^>]*>(.*?)<\/script>/is', '', $conteudo);
            $conteudo = htmlentities($conteudo, ENT_QUOTES, 'UTF-8');
            $ativo = filter_input(INPUT_POST, 'ativo', FILTER_SANITIZE_SPECIAL_CHARS);
            $url_amigavel = gerarTituloSEO($titulo);

            $diretorioFotos = 'post-images';
            
            try {
                $sql = "INSERT INTO textos (titulo, conteudo, url_amigavel, ativo, foto) VALUES (?, ?, ?, ?, ?)";
                $stm = $this->pdo->prepare($sql);
                $stm->bindValue(1, $titulo, PDO::PARAM_STR);
                $stm->bindValue(2, $conteudo, PDO::PARAM_STR);
                $stm->bindValue(3, $url_amigavel, PDO::PARAM_STR);
                $stm->bindValue(4, $ativo, PDO::PARAM_STR);
                $stm->bindValue(5, upload('foto', $diretorioFotos, 'N'), PDO::PARAM_STR);
                

                $stm->execute();
                $ultimoIdTexto = $this->pdo->lastInsertId();

                header('Location: textos.php');
                exit;
            } catch (PDOException $erro) {
                echo $erro->getMessage();
            }
        }
    }
    
    public function editar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['acao']) && $_POST['acao'] === 'editarTexto') {
            $titulo = filter_input(INPUT_POST, 'titulo', FILTER_SANITIZE_SPECIAL_CHARS);
            $conteudo = $_POST['conteudo']; // Recebe o conteúdo do campo textarea
            $conteudo = strip_tags($conteudo);
            $conteudo = preg_replace('/<script\b[^>]*>(.*?)<\/script>/is', '', $conteudo);
            $conteudo = htmlentities($conteudo, ENT_QUOTES, 'UTF-8');
            $ativo = filter_input(INPUT_POST, 'ativo', FILTER_SANITIZE_SPECIAL_CHARS);
            $url_amigavel = gerarTituloSEO($titulo);
            $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_SPECIAL_CHARS);

            $diretorioFotos = 'post-images';
            
            try {
                $sql = "UPDATE textos SET titulo=?, conteudo=?, url_amigavel=?, ativo=?, foto=? WHERE id=?";
                $stm = $this->pdo->prepare($sql);
                $stm->bindValue(1, $titulo, PDO::PARAM_STR);
                $stm->bindValue(2, $conteudo, PDO::PARAM_STR);
                $stm->bindValue(3, $url_amigavel, PDO::PARAM_STR);
                $stm->bindValue(4, $ativo, PDO::PARAM_STR);
                $stm->bindValue(5, upload('foto', $diretorioFotos, 'N'), PDO::PARAM_STR);
                $stm->bindValue(6, $id, PDO::PARAM_STR);
                

                $stm->execute();

                header('Location: textos.php');
                exit;
            } catch (PDOException $erro) {
                echo $erro->getMessage();
            }
        }
    }

    public function excluir()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['acao']) && $_GET['acao'] === 'excluirTexto' && isset($_GET['id'])) {
            
            $nomeArquivo = $_GET['foto']; // Substitua pelo nome do arquivo que você deseja excluir
            $caminhoArquivo = "post-images/" . $nomeArquivo; // Substitua pelo caminho correto

            if (file_exists($caminhoArquivo)) {
                    unlink($caminhoArquivo);
            }

            try {
                $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

                if ($id !== false) {
                    $sql = "DELETE FROM textos WHERE id=?";
                    $stm = $this->pdo->prepare($sql);
                    $stm->bindValue(1, $id, PDO::PARAM_INT);
                    $stm->execute();
                } else {
                    // Tratamento para o caso de 'id' não ser um inteiro válido
                    throw new Exception('ID inválido.');
                }

                // Redirecionamento após a exclusão
                header('Location: textos.php');
                exit;
            } catch (PDOException $erro) {
                echo $erro->getMessage();
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }
    }
}
