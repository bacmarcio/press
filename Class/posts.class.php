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

    public function dadosPost($id = '', $principal = '', $destaque = '', $catDestaque = '', $categoria = '', $url_amigavel = '', $orderBy = '', $limite = '', $search = '')
    {
        $filtro = [];
        $parametros = [];

        if (!empty($id)) {
            $filtro[] = 'id = ?';
            $parametros[] = $id;
        }

        if (!empty($principal)) {
            $filtro[] = 'principal = ?';
            $parametros[] = $principal;
        }

        if (!empty($destaque)) {
            $filtro[] = 'destaque = ?';
            $parametros[] = $destaque;
        }

        if (!empty($catDestaque)) {
            $filtro[] = 'catDestaque = ?';
            $parametros[] = $catDestaque;
        }

        if (!empty($categoria)) {
            $filtro[] = 'categoria = ?';
            $parametros[] = $categoria;
        }

        if (!empty($url_amigavel)) {
            $filtro[] = 'url_amigavel = ?';
            $parametros[] = $url_amigavel;
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
            $sql = "SELECT * FROM tbl_blog {$sqlFiltro} {$sqlOrdem} {$sqlLimite}";
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
            $breve = filter_input(INPUT_POST, 'breve', FILTER_SANITIZE_SPECIAL_CHARS);
            $id_categoria = filter_input(INPUT_POST, 'id_categoria', FILTER_SANITIZE_SPECIAL_CHARS);
            $meta_title = filter_input(INPUT_POST, 'meta_title', FILTER_SANITIZE_SPECIAL_CHARS);
            $meta_keywords = filter_input(INPUT_POST, 'meta_keywords', FILTER_SANITIZE_SPECIAL_CHARS);
            $meta_description = filter_input(INPUT_POST, 'meta_description', FILTER_SANITIZE_SPECIAL_CHARS);
            $url_amigavel = filter_input(INPUT_POST, 'url_amigavel', FILTER_SANITIZE_SPECIAL_CHARS);
            $legenda_imagem = filter_input(INPUT_POST, 'legenda_imagem', FILTER_SANITIZE_SPECIAL_CHARS);
            $embed = filter_input(INPUT_POST, 'embed', FILTER_SANITIZE_SPECIAL_CHARS);
            $ativo = filter_input(INPUT_POST, 'ativo', FILTER_SANITIZE_SPECIAL_CHARS);
            $principal = filter_input(INPUT_POST, 'principal', FILTER_SANITIZE_SPECIAL_CHARS);
            $destaque = filter_input(INPUT_POST, 'destaque', FILTER_SANITIZE_SPECIAL_CHARS);
            $cat_destaque = filter_input(INPUT_POST, 'cat_destaque', FILTER_SANITIZE_SPECIAL_CHARS);
            
            try {
                $sql = "INSERT INTO tbl_blog (titulo, conteudo, postado_por, breve, id_categoria, meta_title, meta_keywords, meta_description, url_amigavel, legenda_imagem, embed, ativo, principal, destaque, cat_destaque) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                $stm = $this->pdo->prepare($sql);
                $stm->bindValue(1, $titulo, PDO::PARAM_STR);
                $stm->bindValue(2, $conteudo, PDO::PARAM_STR);
                $stm->bindValue(3, $postado_por, PDO::PARAM_STR);
                $stm->bindValue(4, $breve, PDO::PARAM_STR);
                $stm->bindValue(5, $meta_title, PDO::PARAM_STR);
                $stm->bindValue(6, $meta_keywords, PDO::PARAM_STR);
                $stm->bindValue(7, $meta_description, PDO::PARAM_STR);
                $stm->bindValue(8, $url_amigavel, PDO::PARAM_STR);
                $stm->bindValue(9, $legenda_imagem, PDO::PARAM_STR);
                $stm->bindValue(10, $embed, PDO::PARAM_STR);
                $stm->bindValue(11, $ativo, PDO::PARAM_STR);
                $stm->bindValue(12, $principal, PDO::PARAM_STR);
                $stm->bindValue(13, $destaque, PDO::PARAM_STR);
                $stm->bindValue(14, $cat_destaque, PDO::PARAM_STR);
                $stm->bindValue(15, $id_categoria, PDO::PARAM_STR);
                

                $stm->execute();
                $ultimoIdPost = $this->pdo->lastInsertId();

                header('Location: noticias.php');
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
            $breve = filter_input(INPUT_POST, 'breve', FILTER_SANITIZE_SPECIAL_CHARS);
            $id_categoria = filter_input(INPUT_POST, 'id_categoria', FILTER_SANITIZE_SPECIAL_CHARS);
            $meta_title = filter_input(INPUT_POST, 'meta_title', FILTER_SANITIZE_SPECIAL_CHARS);
            $meta_keywords = filter_input(INPUT_POST, 'meta_keywords', FILTER_SANITIZE_SPECIAL_CHARS);
            $meta_description = filter_input(INPUT_POST, 'meta_description', FILTER_SANITIZE_SPECIAL_CHARS);
            $url_amigavel = filter_input(INPUT_POST, 'url_amigavel', FILTER_SANITIZE_SPECIAL_CHARS);
            $legenda_imagem = filter_input(INPUT_POST, 'legenda_imagem', FILTER_SANITIZE_SPECIAL_CHARS);
            $embed = filter_input(INPUT_POST, 'embed', FILTER_SANITIZE_SPECIAL_CHARS);
            $ativo = filter_input(INPUT_POST, 'ativo', FILTER_SANITIZE_SPECIAL_CHARS);
            $principal = filter_input(INPUT_POST, 'principal', FILTER_SANITIZE_SPECIAL_CHARS);
            $destaque = filter_input(INPUT_POST, 'destaque', FILTER_SANITIZE_SPECIAL_CHARS);
            $cat_destaque = filter_input(INPUT_POST, 'cat_destaque', FILTER_SANITIZE_SPECIAL_CHARS);
            $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_SPECIAL_CHARS);
            
            try {
                $sql = "UPDATE tbl_usuarios SET titulo=?, conteudo=?, postado_por=?, breve=?, id_categoria=?, meta_title=?, meta_keywords=?, meta_description=?, url_amigavel=?, legenda_imagem=?, embed=?, ativo=?, principal=?, destaque=?, cat_destaque=? WHERE id=?";
                $stm = $this->pdo->prepare($sql);
                $stm->bindValue(1, $titulo, PDO::PARAM_STR);
                $stm->bindValue(2, $conteudo, PDO::PARAM_STR);
                $stm->bindValue(3, $postado_por, PDO::PARAM_STR);
                $stm->bindValue(4, $breve, PDO::PARAM_STR);
                $stm->bindValue(5, $meta_title, PDO::PARAM_STR);
                $stm->bindValue(6, $meta_keywords, PDO::PARAM_STR);
                $stm->bindValue(7, $meta_description, PDO::PARAM_STR);
                $stm->bindValue(8, $url_amigavel, PDO::PARAM_STR);
                $stm->bindValue(9, $legenda_imagem, PDO::PARAM_STR);
                $stm->bindValue(10, $embed, PDO::PARAM_STR);
                $stm->bindValue(11, $ativo, PDO::PARAM_STR);
                $stm->bindValue(12, $principal, PDO::PARAM_STR);
                $stm->bindValue(13, $destaque, PDO::PARAM_STR);
                $stm->bindValue(14, $cat_destaque, PDO::PARAM_STR);
                $stm->bindValue(15, $id_categoria, PDO::PARAM_STR);
                $stm->bindValue(16, $id, PDO::PARAM_STR);
                

                $stm->execute();

                header('Location: noticias.php');
                exit;
            } catch (PDOException $erro) {
                echo $erro->getMessage();
            }
        }
    }

    

}
