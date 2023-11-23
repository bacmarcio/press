<?php
/**
 * Classe Config
 *
 * Essa classe representa a entidade de Config e fornece métodos para interagir com o banco de dados.
 *
 * @package Press Release
 * @category Modelos
 * @author Márcio Maia <https://github.com/bacmarcio>
 * @version 1.0
 * @access public
 */

 class Config
 {
     private $pdo;
     private $configuracoes; // Adicionada a propriedade para armazenar as configurações
 
     private static $instance = null;
 
     private function __construct($conn)
     {
         $this->pdo = $conn;
     }
 
     public static function getInstance($conn)
     {
         if (self::$instance === null) {
             self::$instance = new Config($conn);
         }
         return self::$instance;
     }
 
     public function getPdo()
     {
         return $this->pdo;
     }
 
     public function dadosConfig()
     {
         try {
             $sql = "SELECT * FROM config";
             $stm = $this->pdo->prepare($sql);
             $stm->execute();   
             $dadosConfig = $stm->fetchAll(PDO::FETCH_OBJ);
     
             if (!empty($dadosConfig)) {
                 $config = $dadosConfig[0];
                 
                 $this->configuracoes = [
                     'favicon'      => $config->favicon,
                     'facebook'     => $config->facebook,
                     'twitter'      => $config->twitter,
                     'instagram'    => $config->instagram,
                     'youtube'      => $config->youtube,
                     'linkedln'     => $config->linkedln,
                     'nome_empresa' => $config->nome_empresa,
                     'endereco'     => $config->endereco,
                     'telefone'     => $config->telefone,
                     'email1'       => $config->email1,
                     'email2'       => $config->email2,
                     'cep'          => $config->cep,
                     'cnpj'         => $config->cnpj,
                     'tiktok'       => $config->tiktok,
                     'id'           => $config->id,
                 ];
             }

         } catch (PDOException $erro) {
             // Log de erro ou lançar uma exceção
             throw new Exception("Erro na função dadosConfig: " . $erro->getMessage());
         }
         
         return (object)$this->configuracoes;
     }

     public function editar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['acao']) && $_POST['acao'] === 'editarConfig') {

            $nome_empresa = filter_input(INPUT_POST, 'nome_empresa', FILTER_SANITIZE_SPECIAL_CHARS);
            $facebook     = filter_input(INPUT_POST, 'facebook', FILTER_SANITIZE_SPECIAL_CHARS);
            $twitter      = filter_input(INPUT_POST, 'twitter', FILTER_SANITIZE_SPECIAL_CHARS);
            $instagram    = filter_input(INPUT_POST, 'instagram', FILTER_SANITIZE_SPECIAL_CHARS);
            $linkedln     = filter_input(INPUT_POST, 'linkedln', FILTER_SANITIZE_SPECIAL_CHARS);
            $youtube      = filter_input(INPUT_POST, 'youtube', FILTER_SANITIZE_SPECIAL_CHARS);
            $tiktok       = filter_input(INPUT_POST, 'tiktok', FILTER_SANITIZE_SPECIAL_CHARS);
            $endereco     = filter_input(INPUT_POST, 'endereco', FILTER_SANITIZE_SPECIAL_CHARS);
            $telefone     = filter_input(INPUT_POST, 'telefone', FILTER_SANITIZE_SPECIAL_CHARS);
            $email1       = filter_input(INPUT_POST, 'email1', FILTER_SANITIZE_SPECIAL_CHARS);
            $email2       = filter_input(INPUT_POST, 'email2', FILTER_SANITIZE_SPECIAL_CHARS);
            $cep          = filter_input(INPUT_POST, 'cep', FILTER_SANITIZE_SPECIAL_CHARS);
            $cnpj         = filter_input(INPUT_POST, 'cnpj', FILTER_SANITIZE_SPECIAL_CHARS);
            $id           = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_SPECIAL_CHARS);


            $diretorioFotos = '../post-images';
            
            try {
                $sql = "UPDATE config SET nome_empresa=?, favicon=?, facebook=?, twitter=?, instagram=?, linkedln=?, youtube=?, tiktok=?, endereco=?, telefone=?, email1=?, email2=?, cep=?, cnpj=?  WHERE id=?";
                $stm = $this->pdo->prepare($sql);
                $stm->bindValue(1,  $nome_empresa, PDO::PARAM_STR);
                $stm->bindValue(2,  upload('favicon', $diretorioFotos, 'N'), PDO::PARAM_STR);
                $stm->bindValue(3,  $facebook, PDO::PARAM_STR);
                $stm->bindValue(4,  $twitter, PDO::PARAM_STR);
                $stm->bindValue(5,  $instagram, PDO::PARAM_STR);
                $stm->bindValue(6,  $linkedln, PDO::PARAM_STR);
                $stm->bindValue(7,  $youtube, PDO::PARAM_STR);
                $stm->bindValue(8,  $tiktok, PDO::PARAM_STR);
                $stm->bindValue(9,  $endereco, PDO::PARAM_STR);
                $stm->bindValue(10, $telefone, PDO::PARAM_STR);
                $stm->bindValue(11, $email1, PDO::PARAM_STR);
                $stm->bindValue(12, $email2, PDO::PARAM_STR);
                $stm->bindValue(13, $cep, PDO::PARAM_STR);
                $stm->bindValue(14, $cnpj, PDO::PARAM_STR);
                $stm->bindValue(15, $id, PDO::PARAM_STR);
                

                $stm->execute();

                header('Location:'.SITE_URL);
                exit;
            } catch (PDOException $erro) {
                echo $erro->getMessage();
            }
        }
    }
 
 } 