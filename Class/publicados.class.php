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

    public function dadosPublicados($id = '', $idPost= '', $orderBy='', $limite = '')
    {
        $filtro = [];
        $parametros = [];

        if (!empty($id)) {
            $filtro[] = 'id = ?';
            $parametros[] = $id;
        }

        if (!empty($idPost)) {
            $filtro[] = 'id_post = ?';
            $parametros[] = $idPost;
        }

        $sqlFiltro = !empty($filtro) ? 'WHERE ' . implode(' AND ', $filtro) : '';
        $sqlOrdem = !empty($orderBy) ? "ORDER BY {$orderBy}" : '';
        $sqlLimite = !empty($limite) ? "LIMIT 0,{$limite}" : '';

        try {
            $sql = "SELECT * FROM publicados {$sqlFiltro} {$sqlOrdem} {$sqlLimite}";
            $stm = $this->pdo->prepare($sql);

            for ($i = 1; $i <= count($parametros); $i++) {
                $stm->bindValue($i, $parametros[$i - 1]);
            }

            $stm->execute();
            $publicados = $stm->fetchAll(PDO::FETCH_OBJ);

            if (!empty($id) || $limite == 1) {
                return (!empty($publicados[0])) ? $publicados[0] : null;
            } else {
                return $publicados;
            }
        } catch (PDOException $erro) {
            echo $erro->getMessage();
        }
    }

    public function add()
    {
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['acao']) && $_POST['acao'] === 'publicar') {

            // Verifica se o email já existe
            $sqlVerificaPublicado = "SELECT COUNT(*) FROM publicados WHERE link != '' AND id_post = ?";
            $stmVerificaPublicado = $this->pdo->prepare($sqlVerificaPublicado);
            $stmVerificaPublicado->bindValue(1, $_POST['idPost'], PDO::PARAM_STR);
            $stmVerificaPublicado->execute();
            $linkExistente = $stmVerificaPublicado->fetchColumn();
            
            if ($linkExistente >= 4) {
                $resultado = "A release já está foi publicada!";
                return $resultado;
            }else{
            
                try {
                    $sql = "INSERT INTO publicados (link, id_post, titulo) VALUES (?, ?, ?)";
                    $stm = $this->pdo->prepare($sql);
            
                    for ($i = 0; $i < count($_POST['link']); $i++) {
                        $link = $_POST['link'][$i];
                        $idPost = $_POST['idPost'];
                        $titulo = $_POST['titulo'][$i];
            
                        $stm->bindValue(1, $link, PDO::PARAM_STR);
                        $stm->bindValue(2, $idPost, PDO::PARAM_INT);
                        $stm->bindValue(3, $titulo, PDO::PARAM_STR);
            
                        $stm->execute();
                    }
                } catch (PDOException $erro) {
                    echo $erro->getMessage();
                }

                header('Location:'.SITE_URL.'noticias');
                exit;
            }
        }
        
        
    }

    public function contaLink($idPost)
    {
         // Verifica se o email já existe
         $sqlVerificaPublicado = "SELECT COUNT(*) FROM publicados WHERE link != '' AND id_post = ?";
         $stmVerificaPublicado = $this->pdo->prepare($sqlVerificaPublicado);
         $stmVerificaPublicado->bindValue(1, $idPost, PDO::PARAM_STR);
         $stmVerificaPublicado->execute();
         $linkExistente = $stmVerificaPublicado->fetchColumn();

         if($linkExistente >= 4){
            $publicado = "Publicado";
            return $publicado;
         }else{
            $publicado = "Publicar";
            return $publicado;
         }
    } 
}
