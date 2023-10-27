<?php

/**
 * Classe Posts
 *
 * Essa classe representa a entidade de Posts e fornece métodos para interagir com o banco de dados.
 *
 * @package Press Release
 * @category Modelos
 * @author Márcio Maia <https://github.com/bacmarcio>
 * @version 1.0
 * @access public
 */

class Posts
{
    /**
     * @var PDO Uma instância da conexão PDO.
     */

    private $pdo;

    /**
     * @var Posts|null Uma instância única da classe Posts.
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
     * Obtém uma instância única da classe Posts.
     *
     * @param PDO $conexao Uma instância da conexão PDO.
     * @return Posts Uma instância da classe Posts.
     */

    public static function getInstance($conn)
    {
        if (self::$instance === null) {
            self::$instance = new Posts($conn);
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

    public function dadosPosts($id = '', $destaque = '', $categoria = '', $usuario = '', $orderBy = '', $limite = '', $search = '')
    {
        $filtro = [];
        $parametros = [];

        if (!empty($id)) {
            $filtro[] = 'id = ?';
            $parametros[] = $id;
        }

        if (!empty($destaque)) {
            $filtro[] = 'destaque = ?';
            $parametros[] = $destaque;
        }

        if (!empty($categoria)) {
            $filtro[] = 'categoria = ?';
            $parametros[] = $categoria;
        }

        if (!empty($usuario)) {
            $filtro[] = 'usuario = ?';
            $parametros[] = $usuario;
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
            $sql = "SELECT * FROM posts {$sqlFiltro} {$sqlOrdem} {$sqlLimite}";
            $stm = $this->pdo->prepare($sql);

            for ($i = 1; $i <= count($parametros); $i++) {
                $stm->bindValue($i, $parametros[$i - 1]);
            }

            $stm->execute();
            $posts = $stm->fetchAll(PDO::FETCH_OBJ);

            if (!empty($id) || $limite == 1) {
                return (!empty($posts[0])) ? $posts[0] : null;
            } else {
                return $posts;
            }
        } catch (PDOException $erro) {
            echo $erro->getMessage();
        }
    }

    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['acao']) && $_POST['acao'] === 'addPost') {
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
            $usuario = filter_input(INPUT_POST, 'id_usuario', FILTER_SANITIZE_SPECIAL_CHARS);
            $created_at = date("Y-m-d H:i:s");
            $updated_at = date("Y-m-d H:i:s");
            $url_amigavel = gerarTituloSEO($titulo);

            $diretorioFotos = '../post-images';
            
            try {
                $sql = "INSERT INTO posts (titulo, conteudo, postado_por, resumo, url_amigavel, legenda, ativo, destaque, id_categoria, foto, id_usuario, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
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
                $stm->bindValue(11, $usuario, PDO::PARAM_STR);
                $stm->bindValue(12, $created_at, PDO::PARAM_STR);
                $stm->bindValue(13, $updated_at, PDO::PARAM_STR);
                

                $stm->execute();
                $ultimoIdPost = $this->pdo->lastInsertId();

                header('Location:'.SITE_URL.'noticias');
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
            $usuario = filter_input(INPUT_POST, 'usuario', FILTER_SANITIZE_SPECIAL_CHARS);
            $url_amigavel = gerarTituloSEO($titulo);
            $updated_at = date("Y-m-d H:i:s");
            $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_SPECIAL_CHARS);

            $diretorioFotos = '../post-images';
            
            try {
                $sql = "UPDATE posts SET titulo=?, conteudo=?, postado_por=?, resumo=?, url_amigavel=?, legenda=?, ativo=?, destaque=?, id_categoria=?, id_usuario=?, updated_at=?, foto=? WHERE id=?";
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
                $stm->bindValue(10, $usuario, PDO::PARAM_STR);
                $stm->bindValue(11, $updated_at, PDO::PARAM_STR);
                $stm->bindValue(12, upload('foto', $diretorioFotos, 'N'), PDO::PARAM_STR);
                $stm->bindValue(13, $id, PDO::PARAM_STR);
                
                $stm->execute();

                header('Location:'.SITE_URL.'noticias');
                exit;
            } catch (PDOException $erro) {
                echo $erro->getMessage();
            }
        }
    }

    public function excluir()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['acao']) && $_GET['acao'] === 'excluirPost' && isset($_GET['id'])) {
            
            $nomeArquivo = $_GET['foto']; // Substitua pelo nome do arquivo que você deseja excluir
            $caminhoArquivo = '../post-images' . $nomeArquivo; // Substitua pelo caminho correto

            if (file_exists($caminhoArquivo)) {
                    unlink($caminhoArquivo);
            }

            try {
                $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

                if ($id !== false) {
                    $sql = "DELETE FROM posts WHERE id=?";
                    $stm = $this->pdo->prepare($sql);
                    $stm->bindValue(1, $id, PDO::PARAM_INT);
                    $stm->execute();
                } else {
                    // Tratamento para o caso de 'id' não ser um inteiro válido
                    throw new Exception('ID inválido.');
                }

                // Redirecionamento após a exclusão
                header('Location:'.SITE_URL.'noticias');
                exit;
            } catch (PDOException $erro) {
                echo $erro->getMessage();
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }
    }

}
