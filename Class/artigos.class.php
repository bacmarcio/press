<?php

/**
 * Classe Artigos
 *
 * Essa classe representa a entidade de Artigos e fornece métodos para interagir com o banco de dados.
 *
 * @package Press Release
 * @category Modelos
 * @author Márcio Maia <https://github.com/bacmarcio>
 * @version 1.0
 * @access public
 */

class Artigos
{
    /**
     * @var PDO Uma instância da conexão PDO.
     */

    private $pdo;

    /**
     * @var Artigos|null Uma instância única da classe Artigos.
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
     * Obtém uma instância única da classe Artigos.
     *
     * @param PDO $conexao Uma instância da conexão PDO.
     * @return Artigos Uma instância da classe Artigos.
     */

    public static function getInstance($conn)
    {
        if (self::$instance === null) {
            self::$instance = new Artigos($conn);
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

    public function dadosArtigos($id = '', $ativo = '', $id_categoria = '', $destaque = '', $orderBy = '', $limite = '', $search = '')
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

        if (!empty($id_categoria)) {
            $filtro[] = 'id_categoria = ?';
            $parametros[] = $id_categoria;
        }

        if (!empty($destaque)) {
            $filtro[] = 'destaque = ?';
            $parametros[] = $destaque;
        }

        if (!empty($search)) {
            $filtro[] = '(titulo LIKE ? OR conteudo LIKE ? OR postado_por LIKE ?)';
            $parametros[] = "%$search%";
            $parametros[] = "%$search%";
            $parametros[] = "%$search%";
        }

        $sqlFiltro = !empty($filtro) ? 'WHERE ' . implode(' AND ', $filtro) : '';
        $sqlOrdem = !empty($orderBy) ? "ORDER BY {$orderBy}" : '';
        $sqlLimite = !empty($limite) ? "LIMIT 0,{$limite}" : '';

        try {
            $sql = "SELECT * FROM artigos {$sqlFiltro} {$sqlOrdem} {$sqlLimite}";
            $stm = $this->pdo->prepare($sql);

            for ($i = 1; $i <= count($parametros); $i++) {
                $stm->bindValue($i, $parametros[$i - 1]);
            }

            $stm->execute();
            $artigos = $stm->fetchAll(PDO::FETCH_OBJ);

            if (!empty($id) || $limite == 1) {
                return (!empty($artigos[0])) ? $artigos[0] : null;
            } else {
                return $artigos;
            }
        } catch (PDOException $erro) {
            echo $erro->getMessage();
        }
    }

    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['acao']) && $_POST['acao'] === 'addArtigo') {
            $titulo = filter_input(INPUT_POST, 'titulo', FILTER_SANITIZE_SPECIAL_CHARS);
            $conteudo = $_POST['conteudo']; // Recebe o conteúdo do campo textarea
            $conteudo = strip_tags($conteudo);
            $conteudo = preg_replace('/<script\b[^>]*>(.*?)<\/script>/is', '', $conteudo);
            $conteudo = htmlentities($conteudo, ENT_QUOTES, 'UTF-8');
            $postado_por = filter_input(INPUT_POST, 'postado_por', FILTER_SANITIZE_SPECIAL_CHARS);
            $resumo = filter_input(INPUT_POST, 'resumo', FILTER_SANITIZE_SPECIAL_CHARS);
            $id_categoria = filter_input(INPUT_POST, 'id_categoria', FILTER_SANITIZE_SPECIAL_CHARS);
            $legenda = filter_input(INPUT_POST, 'legenda', FILTER_SANITIZE_SPECIAL_CHARS);
            $ativo = filter_input(INPUT_POST, 'ativo', FILTER_SANITIZE_SPECIAL_CHARS);
            $destaque = filter_input(INPUT_POST, 'destaque', FILTER_SANITIZE_SPECIAL_CHARS);
            $url_amigavel = gerarTituloSEO($titulo);

            $diretorioFotos = SITE_URL.'post-images';
            
            try {
                $sql = "INSERT INTO artigos (titulo, conteudo, postado_por, resumo, url_amigavel, legenda, ativo, destaque, id_categoria, foto) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                $stm = $this->pdo->prepare($sql);
                $stm->bindValue(1, $titulo, PDO::PARAM_STR);
                $stm->bindValue(2, $conteudo, PDO::PARAM_STR);
                $stm->bindValue(3, $postado_por, PDO::PARAM_STR);
                $stm->bindValue(4, $resumo, PDO::PARAM_STR);
                $stm->bindValue(5, $url_amigavel, PDO::PARAM_STR);
                $stm->bindValue(6, $legenda, PDO::PARAM_STR);
                $stm->bindValue(7, $ativo, PDO::PARAM_STR);
                $stm->bindValue(8, $destaque, PDO::PARAM_STR);
                $stm->bindValue(9, $id_categoria, PDO::PARAM_STR);
                $stm->bindValue(10, upload('foto', $diretorioFotos, 'N'), PDO::PARAM_STR);
                

                $stm->execute();
                $ultimoIdArtigo = $this->pdo->lastInsertId();

                header('Location:'.SITE_URL.'artigos');
                exit;
            } catch (PDOException $erro) {
                echo $erro->getMessage();
            }
        }
    }
    
    public function editar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['acao']) && $_POST['acao'] === 'editarPost') {
            $titulo = filter_input(INPUT_POST, 'titulo', FILTER_SANITIZE_SPECIAL_CHARS);
            $conteudo = $_POST['conteudo']; // Recebe o conteúdo do campo textarea
            $conteudo = strip_tags($conteudo);
            $conteudo = preg_replace('/<script\b[^>]*>(.*?)<\/script>/is', '', $conteudo);
            $conteudo = htmlentities($conteudo, ENT_QUOTES, 'UTF-8');
            $postado_por = filter_input(INPUT_POST, 'postado_por', FILTER_SANITIZE_SPECIAL_CHARS);
            $resumo = filter_input(INPUT_POST, 'resumo', FILTER_SANITIZE_SPECIAL_CHARS);
            $id_categoria = filter_input(INPUT_POST, 'id_categoria', FILTER_SANITIZE_SPECIAL_CHARS);
            $legenda = filter_input(INPUT_POST, 'legenda', FILTER_SANITIZE_SPECIAL_CHARS);
            $ativo = filter_input(INPUT_POST, 'ativo', FILTER_SANITIZE_SPECIAL_CHARS);
            $destaque = filter_input(INPUT_POST, 'destaque', FILTER_SANITIZE_SPECIAL_CHARS);
            $url_amigavel = gerarTituloSEO($titulo);
            $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_SPECIAL_CHARS);

            $diretorioFotos = SITE_URL.'post-images';
            
            try {
                $sql = "UPDATE artigos SET titulo=?, conteudo=?, postado_por=?, resumo=?, legenda=?, ativo=?, destaque=?, id_categoria=?, foto=? WHERE id=?";
                $stm = $this->pdo->prepare($sql);
                $stm->bindValue(1, $titulo, PDO::PARAM_STR);
                $stm->bindValue(2, $conteudo, PDO::PARAM_STR);
                $stm->bindValue(3, $postado_por, PDO::PARAM_STR);
                $stm->bindValue(4, $resumo, PDO::PARAM_STR);
                $stm->bindValue(5, $url_amigavel, PDO::PARAM_STR);
                $stm->bindValue(6, $legenda, PDO::PARAM_STR);
                $stm->bindValue(7, $ativo, PDO::PARAM_STR);
                $stm->bindValue(8, $destaque, PDO::PARAM_STR);
                $stm->bindValue(9, $id_categoria, PDO::PARAM_STR);
                $stm->bindValue(10, upload('foto', $diretorioFotos, 'N'), PDO::PARAM_STR);
                $stm->bindValue(11, $id, PDO::PARAM_STR);
                

                $stm->execute();

                header('Location:'.SITE_URL.'artigos');
                exit;
            } catch (PDOException $erro) {
                echo $erro->getMessage();
            }
        }
    }

    public function excluir()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['acao']) && $_GET['acao'] === 'excluirArtigo' && isset($_GET['id'])) {
            
            $nomeArquivo = $_GET['foto']; // Substitua pelo nome do arquivo que você deseja excluir
            $caminhoArquivo = SITE_URL.'post-images' . $nomeArquivo; // Substitua pelo caminho correto

            if (file_exists($caminhoArquivo)) {
                    unlink($caminhoArquivo);
            }

            try {
                $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

                if ($id !== false) {
                    $sql = "DELETE FROM artigos WHERE id=?";
                    $stm = $this->pdo->prepare($sql);
                    $stm->bindValue(1, $id, PDO::PARAM_INT);
                    $stm->execute();
                } else {
                    // Tratamento para o caso de 'id' não ser um inteiro válido
                    throw new Exception('ID inválido.');
                }

                // Redirecionamento após a exclusão
                header('Location:'.SITE_URL.'artigos');
                exit;
            } catch (PDOException $erro) {
                echo $erro->getMessage();
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }
    }
}
